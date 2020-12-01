<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Group;
use App\Models\Ride;
use App\Models\RoadType;
use App\Notifications\EventNotify;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index($id) {

        $user = user();
        $group = $user->groups->where('id', $id)->first();
        if($group) {
            $data = [
                'group_id' => $id,
                'rider' => $user->profile,
                'rides' => $this->getRidesList($user,$id)
            ];
            return view('front.group.event.index',$data);
        }
        else{
            return redirect('my-groups');
        }
        // $user = user();
        // $group = $user->groups->where('id', $id)->first();
        // if($group) {
        //     $data = [
        //         'group_id' => $id,
        //         'group_name' => $group->group_name,
        //         'rides' => $this->getEventsList($id)
        //     ];
        //     return view('front/group/event/index',$data);
        // } else {
        //     return redirect('groups');
        // }
        
    }

    protected function getRidesList($user, $group_id) {
        $rides = $user->rides->where('group_id', $group_id)->sortByDesc('created_at');
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

    public function create($id) {
        $result['road_types'] = RoadType::all();
        $result['group_id'] = $id;
        return view('front/group/event/create', $result);
    }

    public function eventAddStep1(Request $request) {

        $rider_id = user()->id;
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
            $data['added_by'] = 'group';          
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

    public function eventAddStep2(Request $request) {
        $data = $request->all();
        $filterData = $this->filterData($data);
        $event = $request->session()->get('event');
        $event->rideDay = $filterData;
        $request->session()->put('event', $event);
        $html = view('front.group.event.review', compact('event'))->render();
        return $html;
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
                    $image->move(public_path('images/groups/events/'), $new_name);
                    $img_result[$key_child] = $new_name;
                }
                $result[$index][$keyNew] = $img_result;
            } else {
                $result[$index][$keyNew] = $value;
            }
        }
        return $result;
    }
    
    public function store(Request $request)
    {
        $user = user();
        $event = $request->session()->get('event');
        $event->via_location = json_encode($event->via_location);
        $event->rider_id = $user->id;        
        $event->ride_days = json_encode($event->rideDay);
        Event::create([
            'group_id' => $event->group_id,
            'rider_id' => $user->id,
            'start_location' => $event->start_location,
            'via_location' => $event->via_location,
            'end_location' => $event->end_location,
            'start_date' => formatDate($event->start_date),
            'end_date' => formatDate($event->end_date),
            'no_of_people' => $event->no_of_people,
            'short_description' => $event->short_description,
            'ride_days' => $event->ride_days,
            'luggage' => $event->luggage
        ]);
        
        $route = route('my-groups.events', $event->group_id);

        $this->sendNotificationToGroupMembers($event->group_id);

        return $response = ['msg'=>'Event Added Successfully', 'status'=>true, 'redirect' => $route];       
    }

    protected function sendNotificationToGroupMembers($group_id) {
        $group = Group::find($group_id);
        $groupJoins = $group->groupJoinedRider;
        foreach($groupJoins as $groupJoin) {
            $user = $groupJoin->user;            
            $data = [
                'group_name' => $group->group_name
            ];
            $data = (object)$data;
            $user->notify((new EventNotify($data)));
        }
    }

    protected function getEventsList($id) {
        $user = user();
        $group = Group::find($id);
        $events = $group->events;
        $result = [];
        foreach($events as $key => $event) {
            $rideDays = $this->formateRideDays($event->ride_days);
            $result[$key] = [
                'id' => $event->id,
                'rider_name' => $user->name,
                'rider_id' => $user->id,
                'rider_image' => isset($user->profile->image) ? $user->profile->image : '',
                'start_location' => $event->start_location,
                'via_location' => $this->formateViaLocation($event->via_location),
                'end_location' => $event->end_location,
                'start_date' => formatDate($event->start_date, 'M Y'),
                'total_km' => $event->total_km,
                'no_of_people' => $event->no_of_people,
                'description' => $event->short_description,
                'rider_rating' => isset($user->profile->rating) ? $user->profile->rating: 0,
                'ride_rating' => 4,
                'ride_image' => !empty($rideDays[0]['image']) ? $rideDays[0]['image'] : '',
            ];
        }
        return $result;
    }

    // protected function formateViaLocation($via_locations) {
    //     $locations = json_decode($via_locations,true);
    //     return implode(',', $locations);
    // }

    // protected function formateRideDays($days) {
    //     $ride_days = json_decode($days,true);
    //     $result = [];
    //     foreach($ride_days as $key => $ride_day) {
    //         $result[$key] = [
    //             'start_locations' => $ride_day['start_location'],
    //             'road_type' => ($ride_day['road_type']==1) ? 'Highway' : '',
    //             'image' => !empty($ride_day['ride_images']) ? $ride_day['ride_images'][0] : ''
    //         ];
    //     }
    //     return $result;
    // }

}
