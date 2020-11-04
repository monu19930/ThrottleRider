<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\Ride;
use App\Models\RiderProfile;
use App\User;
use Illuminate\Support\Facades\Auth;

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
        $result = [
            'rides' =>  $this->getRidesList($search),
            'explore_rides' => $this->getExploredRides($search),
            'riders' => $this->getBikersList($search),
            'groups' => $this->getGroupList($search),
            'location' => $search
        ];
        return view('front/index', $result);
    }

    protected function getExploredRides($search) {
        $result = [];
        $rides = Ride::where('start_location',$search)->OrderBy('created_at', 'desc')->get();
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
        $rides = Ride::where('start_location',$search)->OrderBy('created_at', 'desc')->get();
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

    protected function getBikersList($city) {
        $result = [];
        $riderProfiles = RiderProfile::where('city',$city)->where('rating', '>', 2)->orderBy('rating', 'Desc')->get();
        foreach($riderProfiles as $key => $riderProfile) {
            $user = $riderProfile->user;
            $result[$key] = [
                'rider_name' => $user->name,
                'rider_id' => $user->id,
                'rider_email' => $user->email,
                'rider_image' => $riderProfile->image,
                'total_km' => $riderProfile->total_km,
                'total_rides' => $riderProfile->total_rides,
                'rating' => $riderProfile->rating,
                'description' => $riderProfile->description
            ];
        }
        return $result;
    }

    protected function getGroupList($city) {
        $result = [];
        $groups = Group::where('city',$city)->where('group_rating', '>', 2)->orderBy('group_rating', 'desc')->get();
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
                'Supliers Within _key',            
            ];
        } else {
            $array = [
                'Rides To _key',
                'Tripes To _key',
                'Events in _key',
                'Groups in _key',
                'Bikers in _key',
                'Supliers in _key',
            ];
        }
        
        $result = [];
        foreach($array as $key => $items) {
            $newItem = str_replace('_key', $search_item, $items);
            $result[$key] = $newItem;
        };
        return $result;
    }

    public function searchToLocationData(Request $request) {
        $start_location = getCurrentLocation();
        $search_type = $request->search_type;
        $array = explode(" ", $search_type);

        if($array[0]=='Rides') {
            $rides = Ride::where('start_location',$start_location)->where('end_location',$array[2])->OrderBy('created_at', 'desc')->get();
            $html = view('front/search',compact('rides'))->render();
        }
        return $html;
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
    
}
