<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RideController extends Controller
{
    public function index() {
        $id = Auth::user()->id;
        $data['rides'] = Ride::where('rider_id', $id)->get();
        return view('front/ride/index',$data);
    }

    public function create() {
        return view('front/ride/create');
    }

    public function addRideStep1(Request $request) {
        $rider_id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'start_location' => 'required',
            'end_location' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'no_of_people' => 'required'
        ]);

        if ($validator->fails()) {
            $response = [
                'error' => $validator->errors()->all(), 
                'status' =>false
            ];
         }
         else {
            $data = $request->all();
            unset( $data['csrf'] );
            if(empty($request->session()->get('ride'))){
                $ride = new Ride();
                $ride->fill($data);
                $request->session()->put('ride', $ride);
            }else{
                $ride = $request->session()->get('ride');
                $ride->fill($data);
                $request->session()->put('product', $ride);
            }
            $ride = $request->session()->get('ride');
            $response = ['status' => true];
        }
        return response()->json($response);

    }

    public function addRideStep2(Request $request) {
        $data = $request->all();
        $filterData = $this->filterData($data);
        $ride = $request->session()->get('ride');
        $ride->rideDay = $filterData;
        $request->session()->put('ride', $ride);
        $html = view('front.ride.ride-review', compact('ride'))->render();
        return $html;
    }

    public function addRideDay(Request $request) {
        $html = view('front.ride.ride-more')->with(['i'=>$request->val])->render();
        return $html;
    }

    public function saveRide(Request $request)
    {
        $ride = $request->session()->get('ride');
        $ride->via_location = json_encode($ride->via_location);
        $ride->rider_id = Auth::user()->id;        
        $ride->ride_days = json_encode($ride->rideDay);
        Ride::create([
            'rider_id' => Auth::user()->id,
            'start_location' => $ride->start_location,
            'via_location' => $ride->via_location,
            'end_location' => $ride->end_location,
            'start_date' => $ride->start_date,
            'end_date' => $ride->end_date,
            'no_of_people' => $ride->no_of_people,
            'short_description' => $ride->short_description,
            'ride_days' => $ride->ride_days,
        ]);
        return $response = ['msg'=>'Ride Added Successfully', 'status'=>true];       
    }

    

    protected function filterData($data) {
        $result = [];
        unset( $data['csrf'] );
        foreach($data as $key => $value) {
            $keyNew = rtrim(strrev(strstr(strrev($key), '_')), '_');
            $index = intval(ltrim(strrchr($key, '_'), '_'));
            if($keyNew == 'ride_images') {
                $img_result = [];
                foreach($value as $key_child => $image) {
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/rides'), $new_name);
                    $img_result[$key_child] = $new_name;
                }
                $result[$index][$keyNew] = $img_result;
            } else {
                $result[$index][$keyNew] = $value;
            }
        }
        return $result;
    }
    
}
