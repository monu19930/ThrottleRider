<?php

namespace App\Http\Controllers;

use App\Models\Ride;
use App\Models\RideDay;
use App\Models\RoadType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Str;

class RideController extends Controller
{
    public function index() {
        $loggedInRiderId = user()->id;
        $user = User::find($loggedInRiderId);
        $data = [
            'rider' => $user->profile,
            'rides' => $this->getRidesList($user)
        ];
        return view('front/ride/index',$data);
    }

    protected function getRidesList($user) {
        $rides = $user->rides->sortByDesc('created_at');
        $result = [];
        if($rides->count() > 0) {
            foreach($rides as $key => $ride) {
                $rideDays = $this->formateRideDays($ride->ride_days);            
                $status_comment = $ride->approvalComments;
                $result[$key] = [
                    'i' => 1,
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
                    'no_of_days' => dateDifference($ride->start_date, $ride->end_date),
                    'description' => $ride->short_description,
                    'rider_rating' => isset($user->profile->rating) ? $user->profile->rating: 0,
                    //'ride_rating' => $rideDays['ride_rating'],
                    'ride_rating' => $ride->rating,
                    'road_type' => $rideDays['ride_days'][0]['road_type'],
                    'is_approved' => $ride->is_approved,
                    'status_comment' => $status_comment,
                    'ride_image' => !empty($rideDays['ride_days'][0]['image']) ? $rideDays['ride_days'][0]['image'] : 'not_found.png',
                ];
            }
        }
        return $result;
    }

    public function destroy(Request $request) {
        $id = $request->id;
        $bike = Ride::find($id);
        $bike->delete();

        RideDay::where('ride_id', $id)->delete();
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
        $rating = 0;$i=0;
        foreach($ride_days as $key => $ride_day) {
            $roadType = RoadType::find($ride_day['road_type']);
            $result['ride_days'][$key] = [
                'start_locations' => $ride_day['start_location'],
                'road_type' => $roadType->road_type,
                'image' => !empty($ride_day['ride_images']) ? $ride_day['ride_images'][0] : ''
            ];

            $rating+= $ride_day['road_quality']+$ride_day['road_scenic'];
            $i++;
        }
        $rating = $rating/(2*$i);
        $result['ride_rating'] = strlen(preg_replace("/.*\./", "", $rating)) == 2 ? round($rating) : $rating;
        return $result;
    }

    public function create() {
        $result['road_types'] = RoadType::all();
        return view('front/ride/create', $result);
    }

    public function addRideStep1(Request $request) {
        $request->session()->forget('ride');
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
                'error' => $validator->errors(), 
                'status' =>false
            ];
         }
         else {
            $data = $request->all();
            unset( $data['csrf'] );
            $data['slug'] = $this->createSlug($data);          
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

    protected function createSlug($data){
        $str = $data['start_location']. ' '.implode(' ', $data['via_location']). ' '.$data['end_location'];
        $slug = Str::slug($str, '-');
        return $slug;
    }

    public function addRideStep2(Request $request) {
        $data = $request->all();
        $filterData = $this->filterData($data);
        $ride = $request->session()->get('ride');
        $ride->rideDay = $filterData;
        $ride->rating = $this->calculateRideRating($ride->rideDay); 
        $request->session()->put('ride', $ride);
        $html = view('front.ride.ride-review', compact('ride'))->render();
        return $html;
    }

    public function addRideDay(Request $request) {
        $road_types = RoadType::all();
        $html = view('front.ride.ride-more')->with(['i'=>$request->val, 'road_types' => $road_types, 'start_location' => $request->end_location])->render();
        return $html;
    }

    protected function calculateRideRating($rideDays){
        $result = [];
        foreach($rideDays as $key => $rideDay) {            
            $result[$key] = $rideDay['road_quality']+$rideDay['road_scenic'];
        }
        $rating = array_sum($result)/(2*count($rideDays));
        $rating = strlen(preg_replace("/.*\./", "", $rating)) == 2 ? round($rating) : $rating;
        return $rating;
    }

    public function store(Request $request)
    {
        $user = user();
        $ride = $request->session()->get('ride');
        $ride->via_location = json_encode($ride->via_location);
        $ride->rider_id = $user->id;        
        $ride->ride_days = json_encode($ride->rideDay);
        //dd($ride);
        $rideDetails = Ride::create([
                'rider_id' => $user->id,
                'start_location' => $ride->start_location,
                'via_location' => $ride->via_location,
                'end_location' => $ride->end_location,
                'start_date' => formatDate($ride->start_date),
                'end_date' => formatDate($ride->end_date),
                'no_of_people' => $ride->no_of_people,
                'short_description' => $ride->short_description,
                'rating' => $ride->rating,
                'ride_days' => $ride->ride_days,
                'total_km' => 400,
                'luggage' => $ride->luggage,
                'added_by' => isset($ride->added_by) ? $ride->added_by : 'rider',
                'group_id' => isset($ride->group_id) ? $ride->group_id : 0,
                'slug' => $ride->slug
            ]); 
            
        $this->storeRideDays($ride->rideDay,$rideDetails->id, $ride->start_date);
        $url = route('my-rides.confirmation',$rideDetails->id);
        return $response = ['msg'=>'Ride Added Successfully', 'status'=>true, 'url' => $url];       
    }

    protected function storeRideDays($rideDays, $ride_id, $start_date){
        foreach($rideDays as $key => $rideDay) {
            $rideDays[$key]['ride_id'] = $ride_id;
            $rideDays[$key]['ride_rating'] = ($rideDay['road_quality']+$rideDay['road_scenic'])/2;
            $rideDays[$key]['number_of_day'] = $key+1;
            $rideDays[$key]['total_km'] = 150;
            $rideDays[$key]['start_date'] = addNumberOfDate($start_date,$key+1);
            if(!empty($rideDay['ride_images'])) {
                $rideDays[$key]['ride_images'] = json_encode($rideDay['ride_images']);
            }
            RideDay::create($rideDays[$key]);
        }
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
                    //$img_result[$key_child] = $new_name;
                    $img_result[$key_child] = [
                        'image' => $new_name,
                        'is_published' => 0
                    ];
                }
                $result[$index][$keyNew] = $img_result;
            } else if($keyNew == 'is_hotel' || $keyNew == 'is_restaurant' || $keyNew == 'is_petrol_pump' || $keyNew == 'is_wifi' || $keyNew == 'is_parking'){
                $result[$index][$keyNew] = ($value=='on') ? 1 : 0;
            } else{
                $result[$index][$keyNew] = $value;
            }
            $result[$index]['total_km'] = $this->calculateTotalKM();
        }
        return $result;
    }

    protected function calculateTotalKM() {
        return 0;
    }

    public function publishImages(Request $request){
        $data = $request->all();
        $img_result = [];
        $keyId = '';
        foreach($data as $key => $images){  
            $list = explode('_',$key);
            $keyId = $list[1];
            if($list[0] == 'images') {        
                foreach($images as $key_child => $image) {
                    $img_result[$image] = 1;
                }
            }
        }

        $ride = $request->session()->get('ride');
        $rideDays = $ride->rideDay;
        $rideDays = $this->publishRideImages($img_result, $rideDays, $keyId);
        $ride->rideDay = $rideDays;
        $request->session()->put('ride', $ride);
        
        $response = array('status' => true, 'msg' => 'Selected images has been published');
        return response()->json($response);
    }

    protected function publishRideImages($img_result, $rideDays, $keyId) {
        
        $rideImages = $rideDays[$keyId]['ride_images'];
        $imageList = [];
        foreach($rideImages as $key => $value) {
            if(array_key_exists($value['image'], $img_result)) {
                $value['is_published'] = $img_result[$value['image']];
            }
            $imageList[$key] = $value;
        }
        $rideImages = $imageList;
        $rideDays[$keyId]['ride_images'] = $rideImages;
        return $rideDays;        
    }

    public function confirm($id){
        $ride = Ride::find($id);
        $user = $ride->user;
        $rideDays = $this->formateRideDays($ride->ride_days);
        $rides = [
            'rider_name' => $user->name,
            'rider_id' => $user->id,
            'rider_image' => isset($user->profile->image) ? $user->profile->image : '',
            'start_location' => $ride->start_location,
            'via_location' => $this->formateViaLocation($ride->via_location),
            'end_location' => $ride->end_location,
            'start_date' => formatDate($ride->start_date, 'M Y'),
            'total_km' => $ride->total_km,
            'no_of_people' => $ride->no_of_people,
            'no_of_days' => dateDifference($ride->start_date, $ride->end_date),
            'description' => $ride->short_description,
            'rider_rating' => isset($user->profile->rating) ? $user->profile->rating: 0,
            'ride_rating' => $rideDays['ride_rating'],
            'road_type' => $rideDays['ride_days'][0]['road_type'],
            'ride_image' => !empty($rideDays['ride_days'][0]['image']) ? $rideDays['ride_days'][0]['image'] : 'not_found.png',
        ];
        $rides = (object)$rides;
        return view('front.ride.confirm', compact('rides'));
    }
    
}
