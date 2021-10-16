<?php

namespace App\Http\Controllers;

use App\Models\HotelModel;
use App\Models\RoomModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->HotelModel = new HotelModel();
        $this->RoomModel = new RoomModel();
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'hotel' => $this->HotelModel->allData(),
            'room' => $this->RoomModel->allData(),
            'user' => $this->UserModel->allData(),
        ];
        return view('v_home', $data);
    }

    public function aboutUsPage()
    {
        return view('v_aboutUs');
    }

}
