<?php

namespace App\Http\Controllers;

use App\Models\RoomModel;
use App\Models\HotelModel;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->RoomModel = new RoomModel();
        $this->HotelModel = new HotelModel();
    }

    public function index()
    {
        $data = [
            'room' => $this->RoomModel->allData(),
            'hotel' => $this->HotelModel->allData(),
            'room' => DB::table('rooms')->paginate(2)
        ];
        return view('room/v_room', $data);
    }

    public function detail($room_id)
    {
        if (!$this->RoomModel->detailData($room_id))
        {
            abort(404);
        }

        $data = [
            'room' => $this->RoomModel->detailData($room_id),
        ];
        return view('room/v_room_detail', $data);
    }

    public function addPage()
    {
        return view('room/v_room_add');
    }

    public function addData()
    {
        Request()->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'price_per_day' => 'required',
            'available_room_qty' => 'required', 
        ]);

        // Jika validatiom berhasil, simpan data kedalam database

        $nextID = $this->RoomModel->getBiggestID()->room_id + 1;
        //$HotelID = $this->HotelModel->detailData(Request()->hotel_id);

        $data = [
            'room_id' => $nextID,
            'hotel_id' => Request()->hotel_id,
            'price_per_day' => Request()->price_per_day,
            'available_room_qty' => Request()->available_room_qty
        ];

        $this->RoomModel->addData($data);
        return redirect()->route('room')->with('success', 'Data has been successfully added');
    }

    public function editPage($room_id)
    {
        if (!$this->RoomModel->detailData($room_id))
        {
            abort(404);
        }
        $data = [
            'room' => $this->RoomModel->detailData($room_id),
        ];
        return view('room/v_room_edit', $data);
    }

    public function editData($room_id)
    {
        Request()->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'price_per_day' => 'required',
            'available_room_qty' => 'required', 
        ]);

        // Jika validatiom berhasil, simpan data kedalam database

        //$HotelID = $this->HotelModel->detailData(Request()->hotel_id);

        $data = [
            'hotel_id' => Request()->hotel_id,
            'price_per_day' => Request()->price_per_day,
            'available_room_qty' => Request()->available_room_qty
        ];

        $this->RoomModel->editData($room_id, $data);
        return redirect()->route('room')->with('success', 'Data has been successfully Updated');
   
    }

    public function deleteData($room_id)
    {
        $this->RoomModel->deleteData($room_id);
        return redirect()->route('room')->with('success', 'Data has been Deleted');
    }

    public function searchRoom(Request $request)
    {
        $keyword = $request->searchRoom;
        $room = Room::Where('room_id', 'like', '%'.$keyword.'%')->paginate(2);
        return view('room/v_room', compact('room'))->with('i', (request()->input('page', 1) - 1) * 2 );

    }

}
