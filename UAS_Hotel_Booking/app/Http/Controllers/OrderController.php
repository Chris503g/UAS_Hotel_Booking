<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingModel;
use App\Models\HotelModel;
use App\Models\RoomModel;
use App\Models\UserModel;
use DateTime;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->BookingModel = new BookingModel();
        $this->HotelModel = new HotelModel();
        $this->RoomModel = new RoomModel();
        $this->UserModel = new UserModel();
    }

    public function index()
    {   
        //$data = ['Jakarta', 'Bogor', 'Bekasi', 'Tangerang', 'Bandung', 'Jogjakarta', 'Surabaya', 'Medan', 'Semarang', 'Bali'];
        $data = [
            'booking' => $this->BookingModel->allData(),
            'hotel' => $this->HotelModel->allData(),
            'user' => $this->UserModel->allData(),
        ];
        return view('/order/v_order', $data);
    }

    public function bookingHotelPage($id)
    {

        if(!$this->HotelModel->detailData($id))
        {
            abort(404);
        }

        $data = [
            'hotel' => $this->HotelModel->detailData($id),
            'booking' => $this->BookingModel->allData(),
            'room' => $this->RoomModel->allData(),
            'user' => $this->UserModel->allData(),
        ];
        return view('/order/v_order_booking', $data);
    }

    public function addBookingHotel($id)
    {
        if(session()->has('LoggedUser'))
        {
            Request()->validate([
                'room_qty' => 'required',
                'date_check_in' => 'required',
                'date_check_out' => 'required', 
            ]);
            
            $nextID = $this->BookingModel->getBiggestID()->booking_id + 1;
            // get current hotel id 
            //$hotelDetailData = $this->HotelModel->detailData($id);
        
            // get current room id
            //$roomID = $this->RoomModel->detailData(Request()->room_id)->room_id;
            
            // find in between dates and change them into int value 
            $fDate = Request()->date_check_in;   // firstDate
            $lDate = Request()->date_check_out;  // lastDate
            $datetime1 = new DateTime($fDate);
            $datetime2 = new DateTime($lDate);
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');    
            
            // count for total price
            $pricePerDay = $this->RoomModel->detailData($id)->price_per_day;
            $totalPrice = $pricePerDay * Request()->room_qty * $days;
            
    
            $data = [
                'booking_id' => $nextID,
                'user_id' =>  session('LoggedUser'),
                'hotel_id' => $id,
                'room_id' => $id,
                'room_qty' => Request()->room_qty,
                'date_check_in' => Request()->date_check_in,
                'date_check_out' => Request()->date_check_out,
                'grand_total_price' => $totalPrice
            ];
            
            $this->BookingModel->addData($data); 
            return redirect('/')->with('success', "Hotel has been successfully booked");
        }
        else 
        {
            return redirect('/login')->with('fail', 'Please login to book hotel');
        }

    }

    public function deleteBooking($booking_id)
    {
        $this->BookingModel->deleteData($booking_id);
        return redirect('/order')->with('success', 'Your booking has been deleted');
    }

    public function print($booking_id)
    {
        if (!$this->BookingModel->detailData($booking_id))
        {
            abort(404);
        }
        $data = [
            'booking' => $this->BookingModel->detailData($booking_id),
            'hotel' => $this->HotelModel->allData(),
            'user' => $this->UserModel->allData(),
        ];
        return view('/order/v_order_printpdf', $data);
    }
}
