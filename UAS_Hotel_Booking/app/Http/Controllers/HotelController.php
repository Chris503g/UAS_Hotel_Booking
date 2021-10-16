<?php

namespace App\Http\Controllers;

use App\Models\HotelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{   
    public function __construct()
    {
        $this->HotelModel = new HotelModel();
        $this->defaultImg = "hotel-dummy.jpg";
    }
    
    public function index()
    {
        $data = [
            'hotel' => $this->HotelModel->allData(),
            'hotel' => DB::table('hotels')->paginate(2)
        ];
        return view('hotel/v_hotel', $data);
    }

    public function detail($id)
    {
        if (!$this->HotelModel->detailData($id))
        {
            abort(404);
        }

        $data = [
            'hotel' => $this->HotelModel->detailData($id),
        ];
        return view('hotel/v_hotel_detail', $data);
    }

    public function addPage()
    {
        $data = [
            'hotel' => $this->HotelModel->allData(),
        ];
        return view('hotel/v_hotel_add', $data);
    }

    public function addData()
    {
        Request()->validate([
            'hotel_name' => 'required',
            'rating' => 'required|min:1|max:5', 
            'facility' => 'required',
            'description' => 'required|max:255',
            'city' => 'required',
            'picture' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Jika validatiom berhasil, simpan data kedalam database
        $nextID = $this->HotelModel->getBiggestID()->id + 1;

        $file = Request()->picture;
        if (!empty($file)) {
            $filename = $nextID . '.' . $file->extension();
            $file->move(public_path('hotel_images'), $filename);
        } else {
            $filename = $this->defaultImg;
        }
        
        $data = [
            'id' => $nextID,
            'hotel_name' => Request()->hotel_name,
            'rating' => Request()->rating,
            'facility' => Request()->facility,
            'description' => Request()->description,
            'city' => Request()->city,
            'picture' => $filename
        ];

        $this->HotelModel->addData($data);
        return redirect()->route('hotel')->with('success', 'Data has been successfully added');
    }

    public function editPage($id)
    {
        if (!$this->HotelModel->detailData($id))
        {
            abort(404);
        }
        $data = [
            'hotel' => $this->HotelModel->detailData($id),
        ];
        return view('hotel/v_hotel_edit', $data);
    }

    public function editData($id)
    {
        Request()->validate([
            'hotel_name' => 'required',
            'rating' => 'required|min:1|max:5', 
            'facility' => 'required',
            'description' => 'required|max:255',
            'city' => 'required',
            'picture' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Jika validatiom berhasil, simpan data kedalam database
        $file = Request()->picture;
        if (!empty($file)) {
            $filename = $id . '.' . $file->extension();
            $file->move(public_path('hotel_images'), $filename);
            
            $data = [
                'id' => Request()->id,
                'hotel_name' => Request()->hotel_name,
                'rating' => Request()->rating,
                'facility' => Request()->facility,
                'description' => Request()->description,
                'city' => Request()->city,
                'picture' => $filename
            ];

        }
        else {
            $data = [
                'id' => Request()->id,
                'hotel_name' => Request()->hotel_name,
                'rating' => Request()->rating,
                'facility' => Request()->facility,
                'description' => Request()->description,
                'city' => Request()->city
            ];
        }

        $this->HotelModel->editData($id, $data);
        return redirect()->route('hotel')->with('success', 'Data has been successfully Updated');
    
    }

    public function deleteData($id)
    {

        $hotelToDelete = $this->HotelModel->getSingleData($id);

        if (empty($hotelToDelete)) {
            return redirect()->route('hotel')->with('fail', 'Data not found');
        }

        if ($hotelToDelete->picture != $this->defaultImg) {
            unlink(public_path('/hotel_images/') . $hotelToDelete->picture);
        }


        $this->HotelModel->deleteData($id);
        return redirect()->route('hotel')->with('success', 'Data has been Deleted');
    }

}
