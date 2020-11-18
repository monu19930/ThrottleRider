<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\Ride;
use App\Models\RideDay;
use App\Models\RiderProfile;
use App\Models\RoadType;
use App\Models\Supplier;
use App\User;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\json_decode;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $search = getCurrentLocation();
        $nearestLocation = $this->getNearestEventLocation($search);
        $result = [
            'rides' =>  $this->getRidesList($search),
            'explore_rides' => $this->getExploredRides($search),
            'riders' => $this->getBikersList($search),
            'groups' => $this->getGroupList($search),
            'events' => $this->getEventList([$search]),
            'upcoming_events' => $this->getEventList($nearestLocation),
            'location' => $search
        ];
        return view('front/index', $result);
    }

    protected function getNearestEventLocation($search) {
        $result = [];
        $events = Event::where('start_location',$search)->where('is_approved', 1)->OrderBy('created_at', 'desc')->get();
        foreach($events as $key => $event) {
            
            $result[$key] = $this->formateViaLocationsList($event->via_location);
        }
        return $result;
    }

    protected function getEventList($search) {
        $result = [];
        $events = Event::whereIn('start_location',$search)->where('is_approved', 1)->OrderBy('created_at', 'desc')->get();
        foreach($events as $key => $event) {
            $group = $event->group;
            $user = $group->user;
            $profile = $user->profile;

            $rideDays = $this->formateRideDays($event->ride_days);
            
            $result[$key] = [
                'rider_name' => $user->name,
                'rider_id' => $user->id,
                'rider_image' => isset($profile->image) ? $profile->image : '',
                'start_location' => $event->start_location,
                'via_location' => $this->formateViaLocation($event->via_location),
                'end_location' => $event->end_location,
                'start_date' => $event->start_date,
                'created_at' => formatDate($event->created_at, 'd-M-Y'),
                'total_km' => $event->total_km,
                'description' => $event->short_description,
                'rider_rating' => isset($profile->rating) ? $profile->rating: 0,
                'ride_rating' => 4,
                'ride_image' => !empty($rideDays[0]['image']) ? $rideDays[0]['image'] : '',
            ];
        }
        return $result;
    }



    protected function getExploredRides($search) {
        $result = [];
        $rides = Ride::where('start_location',$search)->where('is_approved', 1)->OrderBy('created_at', 'desc')->get();
        $i = 0;
        foreach($rides as $ride) {
            $rideDays = $this->formateRideDays($ride->ride_days);
            foreach($rideDays as $key => $rideDay) {
                $result[$rideDay['start_locations']][$i] = $rideDay['image'];
                $i++;
            }
        }
        if(array_key_exists($search, $result)) {
            unset($result[$search]);
        }
        return $result;
    }

    protected function getRidesList($search) {
        $result = [];
        $rides = Ride::where('start_location',$search)->where('is_approved', 1)->OrderBy('created_at', 'desc')->get();
        foreach($rides as $key => $ride) {
            $user = $ride->user;
            $profile = $user->profile;

            $rideDays = $this->formateRideDays($ride->ride_days);
            
            $result[$key] = [
                'rider_name' => $user->name,
                'rider_id' => $user->id,
                'rider_image' => isset($profile->image) ? $profile->image : '',
                'start_location' => $ride->start_location,
                'via_location' => $this->formateViaLocation($ride->via_location),
                'end_location' => $ride->end_location,
                'start_date' => formatDate($ride->start_date, 'M Y'),
                'total_km' => $ride->total_km,
                'description' => $ride->short_description,
                'rider_rating' => isset($profile->rating) ? $profile->rating: 0,
                'ride_rating' => 4,
                'ride_image' => !empty($rideDays[0]['image']) ? $rideDays[0]['image'] : '',
            ];
        }
        return $result;
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

    protected function formateViaLocation($via_locations) {
        $locations = json_decode($via_locations,true);
        return implode(',', $locations);
    }

    protected function formateViaLocationsList($via_locations) {
        $locations = json_decode($via_locations,true);
        return $locations[0];
    }

    protected function getBikersList($city) {
        $result = [];
        $riderProfiles = RiderProfile::where('city',$city)->where('rating', '>', 2)->orderBy('rating', 'Desc')->get();
        foreach($riderProfiles as $key => $riderProfile) {
            if($riderProfile->user->is_approved==1) {
                $user = $riderProfile->user;
                $followedRiders = $user->followedRiders->pluck('followed_by')->toArray();
                $result[$key] = [
                    'id' => $user->id,
                    'rider_name' => $user->name,
                    'rider_id' => $user->id,
                    'rider_email' => $user->email,
                    'rider_image' => isset($riderProfile->image) ? $riderProfile->image : 'rider.jpg',
                    'total_km' => $riderProfile->total_km,
                    'total_rides' => $riderProfile->total_rides,
                    'rating' => $riderProfile->rating,
                    'description' => $riderProfile->description,
                    'current_rider_follow_status' => $this->getCurrentRiderJoinStatus($followedRiders),
                ];
            }  
        }
        return $result;
    }

    protected function getGroupList($city) {
        $result = [];
        $groups = Group::where('city',$city)->where('is_approved', 1)->where('group_rating', '>', 2)->orderBy('group_rating', 'desc')->get();
        foreach($groups as $key => $group) {
           $user = $group->user;
           $groupJoinedRiders = $group->groupJoinedRider->pluck('rider_id')->toArray();
           $result[$key] =[
               'rider_name' => $user->name,
               'group_owner_id' => $group->id,
               'rider_email' => $user->email,
               'rider_image' => $user->profile->image,
               'group_name' => $group->group_name,
               'group_image' => $group->group_image,
               'group_rating' => $group->group_rating,
               'group_desc' => $group->group_desc,
               'total_km' => $group->total_km,
               'total_rides' => $group->total_rides,
               'total_group_members' => $group->groupJoinedRider->count(),
               'current_rider_join_status' => $this->getCurrentRiderJoinStatus($groupJoinedRiders),
               'group_member_list' => $this->getGroupMembersList($group->groupJoinedRider)
           ];
        }
        return $result;
    }

    protected function getCurrentRiderJoinStatus($rider_ids){
        $status = false;
        if(!empty(user()) && !empty($rider_ids)) {
            $loggedInRiderId = user()->id;
            if(in_array($loggedInRiderId, $rider_ids)) {
                $status = true;
            } 
        }
        return $status;
    }

    protected function getGroupMembersList($groupJoins) {
        $result = [];
        foreach($groupJoins as $key => $groupJoin) {
            $user = $groupJoin->user;
            $result[$key] = isset($user->profile->image) ? $user->profile->image : '';
        }
        return $result;
    }

    public function search(Request $request) {
        $start_location = $request->start_location;
        $search = $request->search;
        $rides = Ride::where('start_location',$start_location)->where('end_location',$search)->OrderBy('created_at', 'desc')->get();
        $html = view('front/search',compact('rides'))->render();
        return $html;
    }

    public function searchToLocation(Request $request) {
        $search_item = $request->search;
        $newResult = $this->filterSearchResult($search_item);
        return $newResult;  
    }

    public function filterSearchResult($search_item) {
        
        if(preg_match('/^[0-9kmKM]+$/', $search_item)) {

            $array = [
                'Rides Within _key',
                'Events Within _key',
                'Groups Within _key',
                'Bikers Within _key',
                'Suppliers Within _key',            
            ];
        } else {
            $array = [
                'Rides To _key',
                'Events in _key',
                'Groups in _key',
                'Bikers in _key',
                'Suppliers in _key',
            ];
        }
        
        $result = [];

        $search = explode(' ',$search_item);
        $find = [];
       
        foreach($array as $key => $items) {

            if(strpos($items, $search[0]) !== false) {
                $find[0] = $search_item;
                return $find;
            }
            
            $newItem = str_replace('_key', $search_item, $items);
            $result[$key] = $newItem;
                      
        };
        return $result;
    }

    protected function getRidesToList($start_location, $end_location) {
        $result = [];
        $rides = Ride::where('start_location', 'LIKE', '%'.$start_location.'%')->where('end_location', 'LIKE', '%'.$end_location.'%')
                ->where('is_approved', 1)->OrderBy('created_at', 'desc')->get();
        foreach($rides as $key => $ride) {
            $user = $ride->user;
            $profile = $user->profile;

            $rideDays = $this->formateRideDays($ride->ride_days);
            
            $result[$key] = [
                'rider_name' => $user->name,
                'rider_id' => $user->id,
                'rider_image' => isset($profile->image) ? $profile->image : '',
                'start_location' => $ride->start_location,
                'via_location' => $this->formateViaLocation($ride->via_location),
                'end_location' => $ride->end_location,
                'start_date' => formatDate($ride->start_date, 'M Y'),
                'total_km' => $ride->total_km,
                'description' => $ride->short_description,
                'rider_rating' => isset($profile->rating) ? $profile->rating: 0,
                'ride_rating' => 4,
                'ride_image' => !empty($rideDays[0]['image']) ? $rideDays[0]['image'] : '',
            ];
        }
        return $result;
    }


    protected function getRidesToDayList($start_location, $end_location) {
        $result = [];
        $rideDays = RideDay::where('start_location', 'LIKE', '%'.$start_location.'%')->where('end_location', 'LIKE', '%'.$end_location.'%')
                ->OrderBy('created_at', 'desc')->get();
        foreach($rideDays as $key => $rideDay) {
            $ride = $rideDay->ride;
            $user = $ride->user;
            $profile = $user->profile;
            
            $result[$key] = [
                'rider_name' => $user->name,
                'rider_id' => $user->id,
                'rider_image' => isset($profile->image) ? $profile->image : '',
                'start_location' => $rideDay->start_location,
                //'via_location' => $this->formateViaLocation($ride->via_location),
                'via_location' => '',
                'end_location' => $rideDay->end_location,
                'total_km' => $rideDay->total_km,
                'start_date' => formatDate($ride->start_date, 'M Y'),
                'number_of_day' => $rideDay->number_of_day,
                'description' => $rideDay->day_description,
                'rider_rating' => isset($profile->rating) ? $profile->rating: 0,
                'ride_rating' => $rideDay->ride_rating,
                'road_type' => $rideDay->roadType->road_type,
                'ride_image' => !empty($rideDays['ride_image']) ? $this->filterRideImage($rideDays['ride_image']) : '',
            ];
        }
        return $result;
    }

    protected function getRideRating($road_quality,$road_scenic) {
        $rating = ($road_quality+$road_scenic)/2;
        return $rating;
    }

    protected function filterRideImage($images) {
        $images = json_decode($images,true);
        return $images[0];
    }

    public function searchToLocationData(Request $request) {
        $start_location = getCurrentLocation();
        $search_type = $request->search_type;
        $array = explode(" ", $search_type);
        $result = [
            'type' => $request->search_type,
            'key' => $array[0],
            'search_location' => $array[2],
            'location' => $start_location
        ];

        $html = '';

        if($array[0]=='Rides') {     
            $road_types = RoadType::get()->toArray();  
            //$rides = $this->getRidesToList($start_location, $array[2]);
            $rides = $this->getRidesToDayList($start_location, $array[2]);
            $total = count($rides);
            $html = view('front/ride_search',compact('rides','result', 'total', 'road_types'))->render();
        }

        if($array[0]=='Groups') {
            $groups = $this->getGroupList($array[2]);           
            $total = count($groups);
            $html = view('front/search',compact('groups','result', 'total'))->render();
        }

        if($array[0]=='Bikers') {
            $riders = $this->getBikersList($array[2]);
            $total = count($riders);
            $html = view('front/search',compact('riders','result', 'total'))->render();
        }

        if($array[0]=='Events') {
            $events = $this->getEventList($array[2]);
            $total = count($events);
            $html = view('front/search',compact('events','result', 'total'))->render();
        }

        if($array[0]=='Suppliers') {
            $suppliers = $this->getSuppliersList($array[2]);
            $total = count($suppliers);
            $html = view('front/search',compact('suppliers','result', 'total'))->render();
        }
        return $html;
    }

    protected function getSuppliersList($search_location) {
        $result = [];
        $suppliers = Supplier::where('supplier_address', 'LIKE', '%'.$search_location.'%')->where('is_approved', 1)->get();
        foreach($suppliers as $key => $supplier){
            $result[$key] = [
                'id' => $supplier->id,
                'supplier_name' => $supplier->supplier_name,
                'supplier_image' => !empty($supplier->supplier_image) ? $supplier->supplier_image : 'not_found.jpg',
                'supplier_rating' => $supplier->supplier_rating,
                'supplier_address' => $supplier->supplier_address,
                'supplier_description' => $supplier->supplier_description,
                'created_at' => formatDate($supplier->created_at, 'd M Y')
            ];
        }
        return $result;
    }

    public function rides(){
        $result = [];
        $rides = Ride::where('is_approved', 1)->OrderBy('created_at', 'desc')->get();
        foreach($rides as $key => $ride) {
            $user = $ride->user;
            $rideDays = $this->formateRideDays($ride->ride_days);            
            $result[$key] = [
                'rider_name' => $user->name,
                'rider_id' => $user->id,
                'rider_image' => isset($user->profile->image) ? $user->profile->image : '',
                'start_location' => $ride->start_location,
                'via_location' => $this->formateViaLocation($ride->via_location),
                'end_location' => $ride->end_location,
                'start_date' => formatDate($ride->start_date, 'M Y'),
                'total_km' => $ride->total_km,
                'description' => $ride->short_description,
                'rider_rating' => isset($user->profile->rating) ? $user->profile->rating: 0,
                'ride_rating' => 4,
                'ride_image' => !empty($rideDays[0]['image']) ? $rideDays[0]['image'] : 'not_found.png',
            ];
        }
        return view('front.rides',compact('result'));
    }

    public function bikers(){
        $result = [];
        $users = User::where('is_admin', 0)->where('is_approved', 1)->get();
        foreach($users as $key => $user) {
            $profile = $user->profile;
            $result['riders'][$key] = [
                'rider_name' => $user->name,
                'rider_id' => $user->id,
                'rider_email' => $user->email,
                'rider_image' => !empty($profile->image)?$profile->image:'rider.jpg',
                'total_km' => isset($profile->total_km)?$profile->total_km:0,
                'total_rides' => isset($profile->total_rides)?$profile->total_rides:0,
                'rating' => isset($profile->rating)?$profile->rating:0,
                'description' => isset($profile->description)?$profile->description:''
            ];
        }
        return view('front.riders',$result);
    }

    public function groups() {
        $result = [];
        $groups = Group::where('is_approved', 1)->orderBy('created_at', 'desc')->get();
        foreach($groups as $key => $group) {
           $user = $group->user;
           $groupJoinedRiders = $group->groupJoinedRider->pluck('rider_id')->toArray();
           $result['groups'][$key] =[
               'rider_name' => $user->name,
               'group_owner_id' => $group->id,
               'rider_email' => $user->email,
               'rider_image' => isset($user->profile->image)?$user->profile->image:'rider.jpg',
               'group_name' => $group->group_name,
               'group_image' => $group->group_image,
               'group_rating' => $group->group_rating,
               'group_desc' => $group->group_desc,
               'total_km' => $group->total_km,
               'total_rides' => $group->total_rides,
               'total_group_members' => $group->groupJoinedRider->count(),
               'current_rider_join_status' => $this->getCurrentRiderJoinStatus($groupJoinedRiders),
               'group_member_list' => $this->getGroupMembersList($group->groupJoinedRider)
           ];
        }
        return view('front.groups',$result);
    }

    public function RideSearchFilter(Request $request){
        $rides = [];
        $rideDays = RideDay::where('ride_days.start_location', 'LIKE', '%'.$request->start_location.'%')                    
                    ->where('ride_days.end_location', 'LIKE', '%'.$request->end_location.'%');

        if($request->month != 'Any month') {
            $month = formatDate($request->month, 'm');
            $rideDays = $rideDays->whereMonth('created_at', $month);
        }
                    
        if(!empty($request->ride_rating)) {
            $rideDays = $rideDays->where('ride_days.ride_rating', $request->ride_rating);
        }

        if(!empty($request->road_quality)) {
            $rideDays = $rideDays->where('ride_days.road_quality', $request->road_quality);
        }

        if(!empty($request->road_scenic)) {
            $rideDays = $rideDays->where('ride_days.road_scenic', $request->road_scenic);
        }
        $rideDays = $rideDays->get();


        foreach($rideDays as $key => $rideDay) {
            $ride = $rideDay->ride;
            $user = $ride->user;
            $profile = $user->profile;
            
            $rides[$key] = [
                'rider_name' => $user->name,
                'rider_id' => $user->id,
                'rider_image' => isset($profile->image) ? $profile->image : '',
                'start_location' => $rideDay->start_location,
                'via_location' => '',
                'end_location' => $rideDay->end_location,
                'total_km' => $rideDay->total_km,
                'start_date' => formatDate($ride->start_date, 'M Y'),
                'number_of_day' => $rideDay->number_of_day,
                'description' => $rideDay->day_description,
                'rider_rating' => isset($profile->rating) ? $profile->rating: 0,
                'ride_rating' => $rideDay->ride_rating,
                'road_type' => $rideDay->roadType->road_type,
                'ride_image' => !empty($rideDays['ride_image']) ? $this->filterRideImage($rideDays['ride_image']) : '',
            ];
        }

        $result = [
            'search_location' => $request->end_location,
            'location' => $request->start_location,
        ];

        $total = count($rides);
        $html = view('front/ride_search_filter',compact('rides','result', 'total'))->render();
        return $html;

    }

    
    
}
