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
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        $rides = $this->getRidesList($search);        
        if(empty($rides)){
            $search = config('app.default_location');
            $rides = $this->getRidesList($search);
        } else{
            config(['app.default_location' => $search]);
        }
        
        $nearestLocation = $this->getNearestEventLocation($search);
        $result = [
            'rides' =>  $rides,
            'explore_rides' => $this->getExploredRides($search),
            'riders' => $this->getBikersList($search),
            'groups' => $this->getGroupList($search),
            'events' => $this->getEventList([$search],2),
            'upcoming_events' => $this->getEventList($nearestLocation),
            'location' => $search
        ];
        return view('front/index', $result);
    }

    protected function getNearestEventLocation($search) {
        $result = [];
        $rides = Ride::where('start_location','LIKE', '%'.$search.'%')->where('added_by', 'group')->where('is_approved', 1)->OrderBy('created_at', 'desc')->get();
        $total_rides = $rides->count();
        foreach($rides as $key => $ride) {
            
            $result[$key] = $this->formateViaLocationsList($ride->via_location);
        }
       $result[$total_rides] = $search;
       return $result;
    }

    protected function getEventList($search,$limit='') {
        $result = [];
        $current_date = formatDate(Carbon::now(), 'Y-m-d');
        $rides = Ride::whereIn('start_location',$search)->where('is_approved', 1)->where('start_date', '>', $current_date)->OrderBy('created_at', 'desc');

        if(!empty($limit)){
            $rides = $rides->limit($limit);
        }
        $rides = $rides->get();

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
                'start_date' => $ride->start_date,
                'created_at' => formatDate($ride->created_at, 'd-M-Y'),
                'total_km' => $ride->total_km,
                'description' => $ride->short_description,
                'rider_rating' => isset($profile->rating) ? $profile->rating: 0,
                'ride_rating' => $ride->rating,
                'slug' => $ride->slug,
                'ride_image' => !empty($rideDays[0]['image']) ? $rideDays[0]['image'] : '',
            ];
        }
        return $result; 
    }



    protected function getExploredRides($search) {
        $result = [];
        $rides = Ride::where('start_location',$search)->where('is_approved', 1)->OrderBy('created_at', 'desc')->get();
        //$i = 0;
        foreach($rides as $ride) {
            $rideDays = $this->formateRideDays($ride->ride_days);
            foreach($rideDays as $key => $rideDay) {
                $result[$rideDay['start_locations']][$key] = $rideDay['image'];
                //$i++;
            }
        }
        if(array_key_exists($search, $result)) {
            unset($result[$search]);
        }
        return $result;
    }

    protected function getRidesList($search) {
        $result = [];
        $current_date = formatDate(Carbon::now(), 'Y-m-d');
        $rides = Ride::where('start_location','LIKE', '%'.$search.'%')->where('added_by', 'group')->where('is_approved', 1)
            ->where('start_date', '>=', $current_date)
            ->OrderBy('created_at', 'desc')->get();
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
                'number_of_day' => dateDifference($ride->start_date,$ride->end_date),
                'description' => $ride->short_description,
                'rider_rating' => isset($profile->rating) ? $profile->rating: 0,
                'ride_rating' => $ride->rating,
                'ride_image' => !empty($rideDays[0]['image']) ? $rideDays[0]['image'] : '',
                'slug' => $ride->slug
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
        $data = implode(',', $locations);
        return $data;
    }

    protected function formateViaLocationsList($via_locations) {
        $locations = json_decode($via_locations,true);
        return $locations[0];
    }

    protected function getBikersList($city) {
        $result = [];
        $riderProfiles = RiderProfile::where('city', 'LIKE', '%'.$city.'%')->orderBy('rating', 'Desc')->get();
        foreach($riderProfiles as $key => $riderProfile) {
            if(isset($riderProfile->user) && $riderProfile->user->is_approved==1) {
                $user = $riderProfile->user;
                $followedRiders = $user->followedRiders->pluck('followed_by')->toArray();
                $result[$key] = [
                    'id' => $user->id,
                    'rider_name' => $user->name,
                    'rider_id' => $user->id,
                    'rider_email' => $user->email,
                    'rider_image' => isset($riderProfile->image) ? $riderProfile->image : 'rider.jpg',
                    'cover_image' => !empty($riderProfile->cover_image)?$riderProfile->cover_image:'cover.png',
                    'total_km' => $riderProfile->total_km,
                    'total_rides' => $riderProfile->total_rides,
                    'rating' => $riderProfile->rating,
                    'description' => $riderProfile->description,
                    'current_rider_follow_status' => $this->getCurrentRiderJoinStatus($followedRiders),
                    'is_rider_owner' => isOwner($riderProfile->rider_id),
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
           $groupFollowedRiders = $group->groupFollowedRider->pluck('followed_by')->toArray();
           $result[$key] =[
               'rider_name' => $user->name,
               'group_owner_id' => $group->id,
               'rider_email' => $user->email,
               'rider_image' => $user->profile->image,
               'group_name' => $group->group_name,
               'city' => $group->city,
               'group_image' => $group->group_image,
               'group_rating' => $group->group_rating,
               'group_desc' => $group->group_desc,
               'total_km' => $group->total_km,
               'total_rides' => $group->total_rides,
               'total_group_members' => $group->groupJoinedRider->count(),
               'current_rider_join_status' => $this->getCurrentRiderJoinStatus($groupJoinedRiders),
               'current_rider_follow_status' => $this->getCurrentRiderGroupFollowStatus($groupFollowedRiders),
               'group_member_list' => $this->getGroupMembersList($group->groupJoinedRider),
               'is_group_owner' => isOwner($group->create_rider_id),
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

    protected function getCurrentRiderGroupFollowStatus($rider_ids){
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

        $rides = Ride::where('start_location', 'LIKE', '%'.$start_location.'%')->where('end_location', 'LIKE', '%'.$end_location.'%')
                 ->OrderBy('rating', 'desc')->get();

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
                'total_km' => $ride->total_km,
                'start_date' => formatDate($ride->start_date, 'M Y'),
                'number_of_day' => dateDifference($ride->start_date, $ride->end_date),
                'description' => $ride->description,
                'rider_rating' => isset($profile->rating) ? $profile->rating: 0,
                'ride_rating' => $ride->rating,
                'road_type' => 'Highay',
                'ride_image' => !empty($rideDays[0]['image']) ? $rideDays[0]['image'] : '',
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
        //$start_location = getCurrentLocation();
        $start_location = config('app.default_location');
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
        $rides = Ride::where('is_approved', 1)->OrderBy('rating', 'desc')->get();
        $road_types = RoadType::get()->toArray();  
        foreach($rides as $key => $ride) {
            $user = $ride->user;
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
                'description' => $ride->short_description,
                'rider_rating' => isset($user->profile->rating) ? $user->profile->rating: 0,
                'ride_rating' => $ride->rating,
                'no_of_days' => dateDifference($ride->start_date, $ride->end_date)+1,
                'ride_image' => !empty($rideDays[0]['image']['image']) ? $rideDays[0]['image']['image'] : 'not_found.png',
                'slug' => $ride->slug
                
            ];
        }
        return view('front.rides',compact('result', 'road_types'));
    }

    public function rideDetail($slug){
        $ride = Ride::where('slug', $slug)->first();
        $user = $ride->user;
        $rideDays = $ride->rideDays;
        //dd($rideDays);
        $followedRiders = $user->followedRiders->pluck('followed_by')->toArray();
        $rating = $this->rideRating($rideDays);
        $result['ride'] = [
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
            'ride_rating' => $ride->rating,
            'road_quality' => $rating['road_quality'],
            'road_scenic' => $rating['road_scenic'],
            //'ride_image' => !empty($rideDays[0]['image']) ? $rideDays[0]['image'] : '',
            'rideDays' => $rideDays,
            'related_rides' => $this->getRelatedRides($user->profile->city),
            'rideImagesList' => $this->getRideDaysImages($rideDays),
            'current_rider_follow_status' => $this->getCurrentRiderJoinStatus($followedRiders),
            'is_rider_owner' => isOwner($user->id)
        ];
       // dd($result);
        return view('front.ride-details', $result);
    }

    protected function rideRating($rideDays){
        $rating = [];
        $i=0;
        foreach($rideDays as $key => $rideDay) {            
            $rating['road_quality'][$key] = $rideDay->road_quality;
            $rating['road_scenic'][$key] = $rideDay->road_scenic;
            //$rating['rating'][$key] = $rideDay->road_quality+$rideDay->road_scenic;
            $i++;
        }
        $result = [
            'road_quality' => array_sum($rating['road_quality'])/$i,
            'road_scenic' => array_sum($rating['road_scenic'])/$i,
            //'rating' => array_sum($rating['rating'])/(2*$i),
        ];
        return $result;
    }

    protected function getRideDaysImages($rideDays) {
        $images = [];
        $i=0;
        foreach($rideDays as $key => $rideDay) {
            $ride_images = $rideDay->ride_images;
            if(!empty($rideDay->ride_images)) {
                $imageList = json_decode($ride_images,true);
                foreach($imageList as $image) {
                    $images[$i] = $image['image'];
                    $i++;
                }
            }            
        }
        return $images;
    }

    protected function getRelatedRides($start_location='') {
        $result = [];
        $current_date = formatDate(Carbon::now(), 'Y-m-d');
        $rides = Ride::where('is_approved', 1)->where('added_by', 'group')->where('start_date', '>=', $current_date);
        if(!empty($start_location)) {
            $rides = $rides->where('start_location', $start_location);
        }
        $rides = $rides->OrderBy('created_at', 'desc')->get();

        foreach($rides as $key => $ride) {
            $user = $ride->user;
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
                'description' => $ride->short_description,
                'rider_rating' => isset($user->profile->rating) ? $user->profile->rating: 0,
                'ride_rating' => $ride->rating,
                'ride_image' => !empty($rideDays[0]['image']) ? $rideDays[0]['image'] : 'not_found.png',
                'slug' => $ride->slug
                
            ];
        }
        return $result;
    }

    public function bikers(){
        $result = [];
        $users = User::where('is_admin', 0)->where('is_approved', 1)->get();
        foreach($users as $key => $user) {
            $profile = $user->profile;
            $followedRiders = $user->followedRiders->pluck('followed_by')->toArray();
            $result['riders'][$key] = [
                'rider_name' => $user->name,
                'rider_id' => $user->id,
                'rider_email' => $user->email,
                'rider_image' => !empty($profile->image)?$profile->image:'rider.jpg',
                'cover_image' => !empty($profile->cover_image)?$profile->cover_image:'cover.png',
                'total_km' => isset($profile->total_km)?$profile->total_km:0,
                'total_rides' => isset($profile->total_rides)?$profile->total_rides:0,
                'rating' => isset($profile->rating)?$profile->rating:0,
                'description' => isset($profile->description)?$profile->description:'',
                'current_rider_follow_status' => $this->getCurrentRiderJoinStatus($followedRiders),
                'is_rider_owner' => isOwner($user->id)
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
           $groupFollowedRiders = $group->groupFollowedRider->pluck('followed_by')->toArray();
           $result['groups'][$key] =[
               'rider_name' => $user->name,
               'group_owner_id' => $group->id,
               'rider_email' => $user->email,
               'rider_image' => isset($user->profile->image)?$user->profile->image:'rider.jpg',
               'group_name' => $group->group_name,
               'group_image' => $group->group_image,
               'group_rating' => $group->group_rating,
               'group_desc' => $group->group_desc,
               'city' => $group->city,
               'total_km' => $group->total_km,
               'total_rides' => $group->total_rides,
               'total_group_members' => $group->groupJoinedRider->count(),
               'current_rider_join_status' => $this->getCurrentRiderJoinStatus($groupJoinedRiders),
               'current_rider_follow_status' => $this->getCurrentRiderGroupFollowStatus($groupFollowedRiders),
               'group_member_list' => $this->getGroupMembersList($group->groupJoinedRider),
               'is_group_owner' => (isset(user()->id) && user()->id == $group->create_rider_id) ? true : false,
           ];
        }
        return view('front.groups',$result);
    }

    public function RideSearchFilter(Request $request){
       
        //dd($request->all());
        $rides = [];
        $km_range[0] = str_replace(',', '', $request->min_value);
        $km_range[1] = str_replace(',', '', $request->max_value);
        $rides = Ride::select('rides.*', 'users.id as rider_id', 'users.name as rider_name', 'rider_profiles.image as rider_image', 'rider_profiles.rating as rider_rating')
                ->join('users', 'rides.rider_id', '=', 'users.id')
                ->join('rider_profiles', 'users.id', '=', 'rider_profiles.rider_id')                
                ->where('rides.start_location', 'LIKE', '%'.$request->start_location.'%')                    
                ->where('rides.end_location', 'LIKE', '%'.$request->end_location.'%')
                ->where('rides.is_approved', 1)
                ->whereBetween('rides.total_km', $km_range);
                   
        if($request->month != '') {
            $month = formatDate($request->month, 'm');
            $rides = $rides->whereMonth('rides.start_date', $month);
        }
        
        if(!empty($request->ride_rating)) {
            $rides = $rides->where('rides.rating', '>', $request->ride_rating);
        }

        if(!empty($request->rider_rating)){
            $rides = $rides->where('rider_profiles.rating', '>',  $request->rider_rating);
        }

        if(!empty($request->posted_by)) {
            $rides = $rides->whereIn('rides.added_by', $request->posted_by);
        }

        // if(!empty($request->road_quality) || !empty($request->road_scenic) || !empty($request->road_type)) {
        //     $rides = $rides->leftjoin('ride_days', 'rides.id', '=', 'ride_days.ride_id');
        // }

        // if(!empty($request->road_quality)) {
        //     $rides = $rides->where('ride_days.road_quality', '>', $request->road_quality);
        // }

        // if(!empty($request->road_scenic)) {
        //     $rides = $rides->where('ride_days.road_scenic', '>', $request->road_scenic);
        // }

        // if(!empty($request->road_type)) {
        //     $rides = $rides->whereIn('ride_days.road_type', $request->road_type);
        // }

        $rides = $rides->get();

        foreach($rides as $key => $ride) {
            $rideDays = $this->formateRideDays($ride->ride_days);  
            $rides[$key] = [
                'id' => $ride->id,
                'rider_name' => $ride->rider_name,
                'rider_id' => $ride->rider_id,
                'rider_image' => isset($ride->rider_image) ? $ride->rider_image : '',
                'start_location' => $ride->start_location,
                'via_location' => $this->formateViaLocation($ride->via_location),
                'end_location' => $ride->end_location,
                'start_date' => formatDate($ride->start_date, 'M Y'),
                'total_km' => $ride->total_km,
                'description' => $ride->short_description,
                'rider_rating' => isset($ride->rider_rating) ? $ride->rider_rating: 0,
                'ride_rating' => $ride->rating,
                'number_of_day' => dateDifference($ride->start_date,$ride->end_date),
                'road_type' => 'Highway',
                'ride_image' => !empty($rideDays[0]['image']['image']) ? $rideDays[0]['image']['image'] : 'not_found.png',
                'slug' => $ride->slug
            ];
        }

        $result = [
            'search_location' => $request->end_location,
            'location' => $request->start_location,
        ];
        //dd($rides);
        $total = count($rides);
        $html = view('front.ride_search_filter',compact('rides','result', 'total'))->render();
        return $html;

    }

    public function signinForm(){
        return view('front.mobile-login');
    }


    public function searchCityFilter(Request $request){
        $search = $request->city;
        $rides = $this->getRidesList($search);        
        config(['app.default_location' => $search]);
        
        $nearestLocation = $this->getNearestEventLocation($search);
        $result = [
            'rides' =>  $rides,
            'explore_rides' => $this->getExploredRides($search),
            'riders' => $this->getBikersList($search),
            'groups' => $this->getGroupList($search),
            'events' => $this->getEventList([$search],2),
            'upcoming_events' => $this->getEventList($nearestLocation),
            'location' => $search
        ];
        $html = view('front.index_filter',$result)->render();
        return $html;
    }
    
    
}
