<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\BookingModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;

class UserAuthController extends Controller
{
    public function __construct()
    {
        $this->UserModel = new UserModel();     
        $this->BookingModel = new BookingModel();
    }

    function login()
    {
        return view('auth.login');
    }

    function register()
    {
        return view('auth.register');
    }

    function registerUser(Request $request)
    {
        //return $request->input();

        $request->validate([
            'user_full_name' => 'required|alpha',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/',
            'confirm_password' => 'required|min:8|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/|same:password',
            'birthdate' => 'required|date|before_or_equal:-18 year',
            'phone_number' => 'required',
            
        ], [
            'birth_date.before_or_equal' => 'User must be at least 18 years old.',
            'confirm_password.same' => 'Confirm password must be the same as password.'
        ]);

        /**
         * 
         * USING QUERY BUILDER
         * 
         */

         if($request->photo != "") // jika ada foto 
         {
            $nextID = $this->UserModel->getBiggestID()->id + 1;

            $file = $request->photo;
            $fileName = $nextID . '.' . $file->extension();
            $file->move(public_path('user_images', $fileName));

            $query = DB::table('users')
                   ->insert([
                       'id' => $nextID,
                       'user_full_name' => $request->user_full_name,
                       'email' => $request->email,
                       'password' => Hash::make($request->password),
                       'birthdate' => $request->birthdate,
                       'phone_number' => $request->phone_number,
                       'photo' => $fileName,
                       'role' => "user"
   
                   ]);
         }
         else // jika tidak ada foto 
         {
            $nextID = $this->UserModel->getBiggestID()->id + 1;

            $photoDefault = 'default.jpg';

            $query = DB::table('users')
                   ->insert([
                       'id' => $nextID,
                       'user_full_name' => $request->user_full_name,
                       'email' => $request->email,
                       'password' => Hash::make($request->password),
                       'birthdate' => $request->birthdate,
                       'phone_number' => $request->phone_number,
                       'photo' => $photoDefault,
                       'role' => "user"
   
                   ]);
         }

        if($query)
        {
            return redirect('/login')->with('success', 'You have been successfully registered');
        }
        else
        {
            return back()->with('failed', 'Something went wrong');
        }
    }

    function LoginUser(Request $request)
    {
        //return $request->input();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|regex:/^[A-Za-z0-9_!@#$%^&*?]+$/',
        ]);

        if(isset($_POST['g-recaptcha-response']))
        {
            $captcha = $_POST['g-recaptcha-response'];
            $str = "https://www.google.com/recaptcha/api/siteverify?"
                ."secret=6LcyxSAbAAAAABi2a7LPHWM8xqGGIdKqSVKp2eFl"
                ."&response=".$captcha."&remoteip" . $_SERVER['REMOTE_ADDR'];
            $response = file_get_contents($str);
            $response_arr = (array) json_decode($response);
            if($response_arr["success"] == false)
            {
                return back()->with('fail', 'Recaptcha Required');
            }
        } 
        else
        {
            return back()->with('fail', 'Recaptcha failed');
        } 

        //if form validated successfully, login process

        // Change check method code in query builder
        $user = DB::table('users')
                ->where('email', $request->email)
                ->first();
        if($user)
        {
            if(Hash::check($request->password, $user->password)){

                if($user->role == 'admin')
                {
                    Request()->session()->put('LoggedAdmin', $user->id);
                    
                    return redirect('/user');
                }
                else if ($user->role == 'user')
                {
                    Request()->session()->put('LoggedUser', $user->id);

                    return redirect('/');
                }

            }
            else
            {
                return back()->with('fail', 'Invalid Email or Password!');
            }
        }
        else 
        {
            return back()->with('fail', 'No account found for this email');
        }
    } 
    
    function profile()
    {
        if(session()->has('LoggedUser'))
        {
            $user = DB::table('users')
                    ->where('id', session('LoggedUser'))
                    ->first();
            $data = [
                'LoggedUserInfo' => $user,
            ];
        }
        else if(!session()->has('LoggedUser'))
        {
            return redirect('/login')->with('fail', 'You must Log in');
        }
        return view('/profile', $data);
    }

    public function editProfilePage($id)
    {
        if (!$this->UserModel->detailData($id)) 
        {
            abort(404);
        }
        $data = [
            'user' => $this->UserModel->detailData($id),
        ];
        return view('profile_edit', $data);
    }

    public function editProfile($id)
    {
        Request()->validate([
            'photo' =>'image|mimes:jpg,jpeg,bmp,png|max:2048',
            'phone_number' => 'required',
            'birthdate' => 'required|date|before_or_equal:-18 year',
        ]);

        if(Request()->photo != "")
        {
            $file = Request()->photo;
            $fileName = $id . '.' . $file->extension();
            $file->move(public_path('user_images', $fileName));

            $data = [
                'photo' => $fileName,
                'phone_number' => Request()->phone_number,
                'birthdate' => Request()->birthdate,
            ];

            $this->UserModel->editData($id, $data);
        }
        else // jika tidak ingin ganti foto 
        {
            $data = [ 
                'phone_number' => Request()->phone_number,
                'birthdate' => Request()->birthdate,
            ];

            $this->UserModel->editData($id, $data);
        }

        return redirect('/profile');
    }
    

    function logout()
    {
       if(session()->has('LoggedAdmin'))
       {
           session()->pull('LoggedAdmin');
           return redirect('/');
       }
       else if(session()->has('LoggedUser'))
       {
           session()->pull('LoggedUser');
           return redirect('/')->with('alert', 'You have logged out');
       }
    }
}
