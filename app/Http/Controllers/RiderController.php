<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Bike;
use App\Models\RiderProfile;

class RiderController extends Controller
{
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

    public function index(Request $request) {
        $id = Auth::user()->id;
        $data['name'] = Auth::user()->name;
        $data['email'] = Auth::user()->email;
        $data['rider'] = RiderProfile::where('rider_id', $id)->first();
        return view('front/profile/index',$data);
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    public function update(Request $request){
        $rider_id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'total_rides' => 'required',
            'riding_year' => 'required',            
            'image' => 'mimes:png,gif,jpg,jpeg|max:2048'
        ]);
        
        if ($validator->fails()) {
            $response = array('error' => $validator->errors()->all(), 'status' =>false);
         }
         else {
            $dataArray = [
                'rider_id' => $rider_id,
                'riding_year' => $request->riding_year,
                'total_rides' => $request->total_rides,
                'description' => $request->description
            ];
            $rider = RiderProfile::where('rider_id', $rider_id)->first();
            if(!empty($rider)) {
                RiderProfile::where('rider_id',$rider_id)->update($dataArray);
            }
            else {
                $rider = RiderProfile::create($dataArray);
            }

            if(isset($request->image)) {
                $image = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/rider_images/'), $new_name);

                $rider = RiderProfile::find($rider->id);
                $rider->image = $new_name;
                $rider->save();
            }
            $response = array('msg' => 'Profile Updated Successfully', 'status' => true);
        }
        return response()->json($response);
    }

    public function create() {
        $id = Auth::user()->id;
        $data['name'] = Auth::user()->name;
        $data['email'] = Auth::user()->email;
        $data['rider'] = RiderProfile::where('rider_id', $id)->first();
        return view('front/profile/edit',$data);
    }
}
