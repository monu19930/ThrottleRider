<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Group;
use App\Notifications\EventNotify;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class EventController extends Controller
{
    public function index($id) {

        $user = user();
        $group = $user->groups->where('id', $id)->first();
        if($group) {
            $data = [
                'group_id' => $id,
                'group_name' => $group->group_name,
                'rides' => $this->getEventsList($id)
            ];
            return view('front/group/event/index',$data);
        } else {
            return redirect('groups');
        }
        
    }

    public function create($id) {
        $result['group_id'] = $id;
        return view('front/group/event/create', $result);
    }

    public function eventAddStep1(EventRequest $request) {

        $data = $request->all();
        $data['rider_id'] =  user()->id;
        unset( $data['csrf'] );
        if(empty($request->session()->get('event'))){
            $event = new Event();
            $event->fill($data);
            $request->session()->put('event', $event);
        }else{
            $event = $request->session()->get('event');
            $event->fill($data);
            $request->session()->put('event', $event);
        }
        $different_days = dateDifference($request->start_date, $request->end_date);
        $response = ['status' => true, 'days' => $different_days, 'start_location' => $request->start_location];
        
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

}
