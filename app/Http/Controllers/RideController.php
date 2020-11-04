<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

class RideController extends Controller
{
    public function index() {

        $data = [
            'rides' => $this->getRidesList()
        ];
        return view('front/ride/index',$data);
    }

    protected function getRidesList() {
        $loggedInRiderId = user()->id;
        $user = User::find($loggedInRiderId);
        $rides = $user->rides;
        $result = [];
        foreach($rides as $key => $ride) {
            $rideDays = $this->formateRideDays($ride->ride_days);
            $result[$key] = [
                'id' => $ride->id,
                'rider_name' => $user->name,
                'rider_id' => $user->id,
                'rider_image' => isset($user->profile->image) ? $user->profile->image : '',
                'start_location' => $ride->start_location,
                'via_location' => $this->formateViaLocation($ride->via_location),
                'end_location' => $ride->end_location,
                'start_date' => formatDate($ride->start_date, 'M Y'),
                'total_km' => $ride->total_km,
                'no_of_people' => $ride->no_of_people,
                'description' => $ride->short_description,
                'rider_rating' => isset($user->profile->rating) ? $user->profile->rating: 0,
                'ride_rating' => 4,
                'ride_image' => !empty($rideDays[0]['image']) ? $rideDays[0]['image'] : '',
            ];
        }
        return $result;
    }

    public function delete(Request $request) {
        $id = $request->id;
        $bike = Ride::find($id);
        $bike->delete();
        $response = ['status' => true, 'msg'=>'Ride has been deleted successfully'];
        return response()->json($response);
    }

    protected function formateViaLocation($via_locations) {
        $locations = json_decode($via_locations,true);
        return implode(',', $locations);
    }

    protected function formateRideDays($days) {
        $ride_days = json_decode($days,true);
        $result = [];
        foreach($ride_days as $key => $ride_day) {
            $result[$key] = [
                'start_locations' => $ride_day['start_location'],
                'road_type' => ($ride_day['road_type']==1) ? 'Highway' : '',
                'image' => !empty($ride_day['ride_images']) ? $ride_day['ride_images'][0] : ''
            ];
        }
        return $result;
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
                $request->session()->put('ride', $ride);
            }
            $different_days = dateDifference($request->start_date, $request->end_date);
            $response = ['status' => true, 'days' => $different_days, 'start_location' => $request->start_location];
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
        $user = user();
        $ride = $request->session()->get('ride');
        $ride->via_location = json_encode($ride->via_location);
        $ride->rider_id = $user->id;        
        $ride->ride_days = json_encode($ride->rideDay);
        Ride::create([
            'rider_id' => $user->id,
            'start_location' => $ride->start_location,
            'via_location' => $ride->via_location,
            'end_location' => $ride->end_location,
            'start_date' => formatDate($ride->start_date),
            'end_date' => formatDate($ride->end_date),
            'no_of_people' => $ride->no_of_people,
            'short_description' => $ride->short_description,
            'ride_days' => $ride->ride_days,
            'luggage' => $ride->luggage
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
