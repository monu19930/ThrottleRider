<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Bike;

class RiderController extends Controller
{
    //
    public function register(Request $request) {
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|max:255',
            'password' => 'required'
        ]);
        
        if ($validator->fails()) {
            $response = array('error' => $validator->errors()->all(), 'status' =>false);
         }
         else {
            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
            $response = array('msg' => 'New Account Created Successfully', 'status' => true);
        }
        return response()->json($response);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        
        if ($validator->fails()) {
            $response = array('error' => $validator->errors()->all(), 'status' =>false);
         }
         else {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $response = array('msg' => 'Logged In Successfully !', 'status' => true);
            } else {
                $response = array('msg' => 'Something goes to wrong, Please try again', 'status' => false);
            }
        }
        return response()->json($response);
    }

    public function profile(Request $request) {
        $id = Auth::user()->id;
        $data['bikes'] = Bike::where('rider_id', $id)->get();
        return view('front/profile',$data);
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
