<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingModel;
use App\Models\UserModel;
use App\Models\RoomModel;
use App\Models\HotelModel;
use DateTime;

use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function __construct()
    {   
        $this->BookingModel = new BookingModel();
        $this->UserModel = new UserModel();
        $this->RoomModel = new RoomModel();
        $this->HotelModel = new HotelModel();
    }

    public function index()
    {
        $data = [
            'booking' => $this->BookingModel->allData(),
            'booking' => DB::table('bookings')->paginate(2),
        ];
        return view('booking/v_booking', $data);
    }

    public function detail($booking_id)
    {
        if (!$this->BookingModel->detailData($booking_id))
        {
            abort(404);
        }

        $data = [
            'booking' => $this->BookingModel->detailData($booking_id),
        ];
        return view('booking/v_booking_detail', $data);
    }

    public function addPage()
    {
        $data = [
            'booking' => $this->BookingModel->allData(),
            'room' => $this->RoomModel->allData(),
            'user' => $this->UserModel->allData(),
            'hotel' => $this->HotelModel->allData()
        ];
        return view('booking/v_booking_add', $data);
    }

    public function addData()
    {
        Request()->validate([
            'user_id' => 'required|exists:users,id',
            'hotel_id' => 'required|exists:hotels,id',
            'room_id' => 'required|exists:rooms,room_id',
            'room_qty' => 'required',
            'date_check_in' => 'required',
            'date_check_out' => 'required',
        ]);

        // Jika validatiom berhasil, simpan data kedalam database

        $nextID = $this->BookingModel->getBiggestID()->booking_id + 1;

        $fDate = Request()->date_check_in;   // firstDate
        $lDate = Request()->date_check_out;  // lastDate
        $datetime1 = new DateTime($fDate);
        $datetime2 = new DateTime($lDate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a'); 

        /**
         * ('%a') Total number of days as a result of a DateTime::diff() or (unknown) otherwise
         */
        
        //$roomUse = Request()->room_qty;

        $pricePerDay = $this->RoomModel->detailData(Request()->room_id)->price_per_day;
        $totalPrice = $pricePerDay * Request()->room_qty * $days;

        $data = [
            'booking_id' => $nextID,
            'user_id' => Request()->user_id,
            'hotel_id' => Request()->hotel_id,
            'room_id' => Request()->room_id,
            'room_qty' => Request()->room_qty,
            'date_check_in' => Request()->date_check_in,
            'date_check_out' => Request()->date_check_out,
            'grand_total_price' => $totalPrice
        ];

        
        $this->BookingModel->addData($data);
        return redirect()->route('booking')->with('success', 'Data has been successfully added');
    
    }

    public function editPage($booking_id)
    {
        if (!$this->BookingModel->detailData($booking_id))
        {
            abort(404);
        }
        $data = [
            'booking' => $this->BookingModel->detailData($booking_id),
        ];
        return view('booking/v_booking_edit', $data);
    }

    public function editData($booking_id)
    {
        Request()->validate([
            'user_id' => 'required|exists:users,id',
            'hotel_id' => 'required|exists:hotels,id',
            'room_id' => 'required|exists:rooms,room_id',
            'room_qty' => 'required',
            'date_check_in' => 'required',
            'date_check_out' => 'required',
        ]);

        // Jika validatiom berhasil, simpan data kedalam database
        
        $PricePerDay = $this->RoomModel->detailData(Request()->room_id)->price_per_day;
        $totalPrice = $PricePerDay * Request()->room_qty;

        $data = [
            'booking_id' => Request()->booking_id,
            'hotel_id' => Request()->hotel_id,
            'user_id' => Request()->user_id,
            'room_id' => Request()->room_id,
            'room_qty' => Request()->room_qty,
            'date_check_in' => Request()->date_check_in,
            'date_check_out' => Request()->date_check_out,
            'grand_total_price' => $totalPrice
        ];

        $this->BookingModel->editData($booking_id, $data);
        return redirect()->route('booking')->with('success', 'Data has been successfully Updataed');
   
    }

    public function deleteData($booking_id)
    {
        $this->BookingModel->deleteData($booking_id);
        return redirect()->route('booking')->with('success', 'Data has been Deleted');
    }

    // Booking print Invoice page
    public function print()
    {
        $data = [
            'booking' => $this->BookingModel->allData(),
        ];
        return view('booking/v_booking_printpdf', $data);
    }

}

/*
'booking' => BookingModel::join('bookings', 'bookings.hotel_id', '=', 'hotels.id')
->join('users', 'users.id', '=', 'bookings.user_id')
->join('rooms', 'rooms.room_id', '=', 'bookings.room_id')
->get(['hotels.hotel_name', 'users.user_full_name', 'users.email', 'rooms.room_name'])
*/