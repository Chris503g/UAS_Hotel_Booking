<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'user' => $this->UserModel->allData(),
            'user' => DB::table('users')->paginate(2)
        ];
        return view('user/v_user',$data);
    }

    public function detail($id)
    {
        if (!$this->UserModel->detailData($id))
        {
            abort(404);
        }

        $data = [
            'user' => $this->UserModel->detailData($id),
        ];
        return view('user/v_user_detail', $data);
    }

    public function addPage()
    {
        return view('user/v_user_add');
    }

    public function addData()
    {
        Request()->validate([
            'user_full_name' => 'required|alpha',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/',
            //'confirm_password' => 'required|min:8|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/|same:password_input',
            'birthdate' => 'required|date|before_or_equal:-18 year',
            'phone_number' => 'required',
            'photo' =>'image|mimes:jpg,jpeg,bmp,png|max:2048',
            'role' => 'required',
        ], [
            'birth_date.before_or_equal' => 'User must be at least 18 years old.',
            //'confirm_password.same' => 'Confirm password must be the same as password.'
        ]);

        // JIka validatiom berhasil, simpan data kedalam database
        if(Request()->photo != "") // jika ada foto 
        {
            $nextID = $this->UserModel->getBiggestID()->id + 1;

            $file = Request()->photo;
            $fileName = $nextID . '.' . $file->extension();
            $file->move(public_path('user_images', $fileName));
    
            $hashedPassword = hash("sha256", Request()->password, false);
    
            $data = [
                'id' => $nextID,
                'user_full_name' => Request()->user_full_name,
                'email' => Request()->email,
                'password' => $hashedPassword,
                'birthdate' => Request()->birthdate,
                'phone_number' => Request()->phone_number,
                'photo' => $fileName,
                'role' => Request()->role,
            ];
    
            $this->UserModel->addData($data);
        }
        else // jika tidak ada foto 
        {
            $nextID = $this->UserModel->getBiggestID()->id + 1;

            $photoDefault = 'default.jpg';
            $hashedPassword = hash("sha256", Request()->password, false);
    
            $data = [
                'id' => $nextID,
                'user_full_name' => Request()->user_full_name,
                'email' => Request()->email,
                'password' => $hashedPassword,
                'birthdate' => Request()->birthdate,
                'phone_number' => Request()->phone_number,
                'photo' => $photoDefault,
                'role' => Request()->role,
            ];
    
            $this->UserModel->addData($data);
        }
       
        return redirect()->route('user')->with('success', 'Data has been successfully added');

    }

    public function editPage($id)
    {
        if (!$this->UserModel->detailData($id)) 
        {
            abort(404);
        }
        $data = [
            'user' => $this->UserModel->detailData($id),
        ];
        return view('user/v_user_edit', $data);
    }

    public function editData($id)
    {
        Request()->validate([
            'user_full_name' => 'required|alpha',
            'email' => 'required|email',
            'birthdate' => 'required|date|before_or_equal:-18 year',
            'phone_number' => 'required',
            'photo' =>'image|mimes:jpg,jpeg,bmp,png|max:2048',
            'role' => 'required',
        ], [
            'birth_date.before_or_equal' => 'User must be at least 18 years old.',
            //'confirm_password.same' => 'Confirm password must be the same as password.'
        ]);

        // JIka validatiom berhasil, simpan data kedalam database

        if (Request()->photo != "")  // Jika ingin ganti photo
        {
            $file = Request()->photo;
            $fileName = $id . '.' . $file->extension();
            $file->move(public_path('user_images', $fileName));

            $data = [
                'id' => Request()->id,
                'user_full_name' => Request()->user_full_name,
                'email' => Request()->email,
                'birthdate' => Request()->birthdate,
                'phone_number' => Request()->phone_number,
                'photo' => $fileName,
                'role' => Request()->role,
            ];

            $this->UserModel->editData($id, $data);
        }
        else // Jika tidak ingin ganti foto
        {

            $photoDefault = 'default.jpg';

            $data = [
                'id' => Request()->id,
                'user_full_name' => Request()->user_full_name,
                'email' => Request()->email,
                'birthdate' => Request()->birthdate,
                'phone_number' => Request()->phone_number,
                'photo' => $photoDefault,
                'role' => Request()->role,
            ];
            $this->UserModel->editData($id, $data);
        }

        return redirect()->route('user')->with('success', 'Data has been successfully Updated');

    }

    public function deleteData($id)
    {
        $this->UserModel->deleteData($id);
        return redirect()->route('user')->with('success', 'Data has been Deleted');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $user = User::where('user_full_name', 'like', "%".$keyword."%")->paginate(2);
        return view('user/v_user', compact('user'))->with('i', (request()->input('page', 1) - 1) * 2);
    }

}
