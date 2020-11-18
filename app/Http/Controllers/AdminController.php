<?php

namespace App\Http\Controllers;

use App\Models\ApprovalStatusComment;
use App\Models\Bike;
use App\Models\Event;
use App\Models\Ride;
use App\Models\Group;
use App\Models\Poll;
use App\Models\Supplier;
use App\Models\Tip;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function riders() {
        $result['riders'] = $this->getRidersList();
        return view('admin.riders.index', $result);
    }

    protected function getRidersList() {
        $result = [];
        $users = User::where('is_admin', 0)->get();
        foreach($users as $key => $user) {
            $profile = $user->profile;
            $result[$key] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'image' => !empty($profile->image) ? $profile->image: 'rider.jpg',
                'status' => $user->is_approved,             
                'riding_year' => isset($profile->riding_year) ? $profile->riding_year : 0,
                'total_km' => isset($profile->total_km) ? $profile->total_km : 0,
                'total_rides' => isset($profile->total_rides) ? $profile->total_rides : 0,
                'rating' => isset($profile->rating) ? $profile->rating : 0,
                'added_on' => $user->created_at,
            ];
        }
        return $result;
    }

    public function riderDetails($id) {
        //type 1 --> Rider Status Comment
        $user = User::find($id);
        $profile = $user->profile;
        $comments = $user->approvalComments->where('type', 1)->sortByDesc('created_at');
        $result = [
            'id' => $id,
            'rider_name' => $user->name,
            'email' => $user->email,
            'image' => isset($profile->image) ? $profile->image: 'rider.jpg',
            'riding_year' => isset($profile->riding_year) ? $profile->riding_year : 0,
            'total_rides' => isset($profile->total_rides) ? $profile->total_rides : 0,
            'total_km' => isset($profile->total_km) ? $profile->total_km : 0,
            'rating' => isset($profile->rating) ? $profile->rating : 0,
            'status' => $user->is_approved,
            'comments' => $this->getCommentList($comments),
        ];
        return view('admin.riders.view', $result);
    }

    public function bikeDetails($id) { 
        //type 2 --> Bike Status Comment
        $bike = Bike::find($id);
        $user = $bike->user;
        $comments = $bike->approvalComments->where('type', 2)->sortByDesc('created_at');
        $result = [
            'id' => $bike->id,
            'name' => $bike->name,
            'rider_name' => $bike->user->name,
            'image' => !empty($bike->image) ? $this->filterBikeImages($bike->image) : 'not_found.jpg',
            'total_km' => isset($bike->total_km) ? $bike->total_km : 0,
            'total_rides' => isset($bike->total_rides) ? $bike->total_rides : 0,
            'status' => $bike->is_approved,
            'comfortness' => $bike->comfortness,
            'reliability' => $bike->reliability,
            'visual_appeal' => $bike->visual_appeal,
            'performance' => $bike->performance,
            'service_experience' => $bike->service_experience,
            'rating' => $this->getBikeRating($bike),
            'info' => $bike->info,
            'added_on' => $bike->created_at,
            'comments' => $this->getCommentList($comments),
        ];
        $bikes = (object)$result;
        $i=1;
        return view('admin.bikes.view',compact('bikes','i'));
    }

    protected function getBikeRating($bike) {
        $rating = ($bike->comfortness+$bike->reliability+$bike->visual_appeal+$bike->performance+$bike->service_experience)/5;
        return $rating;
    }

    public function rideDetails($id) { 
        //type 3 --> Ride Status Comment
        $ride = Ride::find($id);
        $user = $ride->user;
        $comments = $ride->approvalComments->where('type', 3)->sortByDesc('created_at');
        $result = [
            'id' => $ride->id,
            'rider_name' => $ride->user->name,            
            'start_location' => $ride->start_location,            
            'end_location' => $ride->end_location,
            'via_location' => isset($ride->via_location) ? $this->filterViaLocation($ride->via_location) : '',  
            'total_km' => isset($ride->total_km) ? $ride->total_km : 0,
            'start_date' =>$ride->start_date,
            'end_date' =>$ride->end_date,
            'no_of_people' => $ride->no_of_people,
            'short_description' => $ride->short_description,
            'luggage' => $ride->luggae,
            'rating' => 0,
            'status' => $ride->is_approved,
            'ride_days' => $this->formateRideDays($ride->ride_days),
            'comments' => $this->getCommentList($comments),
        ];
        $rides = (object)$result;$i=1;
        return view('admin.rides.view',compact('rides','i'));
    }

    public function eventDetails($id) { 
        //type 5 --> Ride Status Comment
        $event = Event::find($id);
        $group = $event->group;
        $user = $group->user;
        $comments = $event->approvalComments->where('type', 5)->sortByDesc('created_at');
        $result = [
            'id' => $event->id,
            'rider_name' => $user->name,            
            'start_location' => $event->start_location,            
            'end_location' => $event->end_location,
            'via_location' => isset($event->via_location) ? $this->filterViaLocation($event->via_location) : '',  
            'total_km' => isset($event->total_km) ? $event->total_km : 0,
            'start_date' =>$event->start_date,
            'end_date' =>$event->end_date,
            'no_of_people' => $event->no_of_people,
            'short_description' => $event->short_description,
            'luggage' => $event->luggae,
            'rating' => 0,
            'status' => $event->is_approved,
            'ride_days' => $this->formateRideDays($event->ride_days),
            'comments' => $this->getCommentList($comments),
        ];
        $rides = (object)$result;$i=1;
        return view('admin.events.view',compact('rides','i'));
    }

    protected function formateRideDays($days) {
        $ride_days = json_decode($days,true);
        $result = [];
        foreach($ride_days as $key => $ride_day) {
            $result[$key] = [
                'start_location' => $ride_day['start_location'],
                'end_location' => $ride_day['end_location'],
                'road_type' => ($ride_day['road_type']==1) ? 'Highway' : '',
                'image' => !empty($ride_day['ride_images']) ? $ride_day['ride_images'][0] : ''
            ];
        }
        return $result;
    }

    protected function getCommentList($comments) {
        $result = [];
        
        if(!empty($comments)) {
            foreach($comments as $key => $comment) {
                $user = $comment->user;
                $result[$key] = [
                    'description' => !empty($comment->description) ? $comment->description : '-', 
                    'added_on' => $comment->created_at,
                    'status' => ($comment->status==1) ? 'Approved' : (($comment->status==0) ? 'Unapproved' : 'Rejected'),
                    'added_by' => $user->name
                ];
            }
        }
        return $result;
    }

    public function saveRiderStatus(Request $request) {

        $data = $request->all();
        $validator = Validator::make($data, [
            'status' => 'required',
            'description' => 'required',            
        ]);
        
        if ($validator->fails()) {
            $response = [
                'error' => $validator->errors()->all(), 
                'status' =>false
            ];
            return response()->json($response);
         } else {
            $this->updateStatus($request->type,$request->status,$request->referer_id);
            
            $data['added_by'] = user()->id;
            ApprovalStatusComment::create($data);
            $response = ['status'=>true, 'msg'=> 'Status updated successfully'];
            return response()->json($response);
         }
    }

    protected function updateStatus($type,$status,$id) {
        switch ($type) {
            case 1:
               $this->updateApprovalStatus($status,$id,'users');
               break;
            case 2:
                $this->updateApprovalStatus($status,$id,'bikes');
               break;
            case 3:
                $this->updateApprovalStatus($status,$id,'rides');
               break;
            case 4:
                $this->updateApprovalStatus($status,$id,'groups');
                break;
            case 5:
                $this->updateApprovalStatus($status,$id,'events');
                break;
            case 6:
                $this->updateApprovalStatus($status,$id,'suppliers');
                break;
            case 7:
                $this->updateApprovalStatus($status,$id,'tips');
                break;
            default:
                $this->updateApprovalStatus($status,$id,'polls');
                break;
         }
    }

    protected function updateApprovalStatus($status,$rider_id,$table) {
        $updated_by = user()->id;
        $ip_address = request()->ip();
        DB::table($table)->where('id', $rider_id)->update([
            'is_approved' => $status,
            'updated_by' => $updated_by,
            'ip_address' => $ip_address,
        ]);
    }


    public function bikes() {
        $result['bikes'] = $this->getBikesList();
        return view('admin.bikes.index', $result);
    }

    public function rides() {
        $result['rides'] = $this->getRidesList();
        return view('admin.rides.index', $result);
    }

    public function groups() {
        $result['groups'] = $this->getGroupsList();
        return view('admin.groups.index', $result);
    }

    public function events() {
        $result['events'] = $this->getEventsList();
        return view('admin.events.index', $result);
    }

    public function suppliers() {
        $result['suppliers'] = $this->getSuppliersList();
        return view('admin.suppliers.index', $result);
    }

    public function polls() {
        $result['polls'] = $this->getPollsList();
        return view('admin.polls.index', $result);
    }

    public function tips() {
        $result['tips'] = $this->getTipsList();
        return view('admin.tips.index', $result);
    }

    protected function getTipsList() {
        $result = [];
        $tips = Tip::get();
        foreach($tips as $key => $tip) {
            $user = $tip->user;
            $result[$key] = [
                'id' => $tip->id,
                'tip_title' => $tip->tip_title,
                'file_name' => $tip->file_name,
                'description' => !empty($tip->tip_description) ? substr($tip->tip_description, 0, 40).'.....' : '-',                
                'added_by' => $user->name,                
                'added_on' => $tip->created_at,
                'status' => $tip->is_approved,
            ];
        }
        return $result;
    }

    public function tipDetails($id){
        /* type 7 for tips */
        $result = [];
        $tip = Tip::find($id);       
        $user = $tip->user;
        $comments = $tip->approvalComments->where('type', 7)->sortByDesc('created_at');
        $result = [
            'id' => $tip->id,
            'tip_title' => $tip->tip_title,
            'file_name' => $tip->file_name,
            'description' => $tip->tip_description,                
            'added_by' => $user->name,                
            'added_on' => $tip->created_at,
            'status' => $tip->is_approved,
            'comments' => $this->getCommentList($comments),
        ];
        $tips = (object)$result;$i=1;
        return view('admin.tips.view', compact('tips','i'));
    }

    protected function getPollsList() {
        $result = [];
        $polls = Poll::get();
        foreach($polls as $key => $poll) {
            $user = $poll->user;
            $result[$key] = [
                'id' => $poll->id,
                'poll_name' => $poll->poll_name,
                'added_by' => $user->name,
                'added_on' => $poll->created_at,
                'status' => $poll->is_approved,
            ];
        }
        return $result;
    }

    public function pollDetails($id) {       
        $result = [];
        $poll = Poll::find($id);
        $user = $poll->user;
        $comments = $poll->approvalComments->where('type', 8)->sortByDesc('created_at');
        $result = [
            'id' => $poll->id,
            'poll_name' => $poll->poll_name,
            'added_by' => $user->name,
            'added_on' => $poll->created_at,
            'status' => $poll->is_approved,
            'comments' => $this->getCommentList($comments),
        ];
       $polls = (object)$result;$i=1;
       return view('admin.polls.view', compact('polls','i'));
    }

    protected function getSuppliersList() {
        $result = [];
        $suppliers = Supplier::get();
        foreach($suppliers as $key => $supplier) {
            $result[$key] = [
                'id' => $supplier->id,
                'supplier_name' => $supplier->supplier_name,
                'supplier_image' => isset($supplier->supplier_image) ? $supplier->supplier_image : 'rider.jpg',
                'supplier_rating' => $supplier->supplier_rating,
                'supplier_address' => $supplier->supplier_address,                
                'added_on' => $supplier->created_at,
                'status' => $supplier->is_approved,
            ];
        }
        return $result;
    }

    public function supplierDetails($id) {
        //type 6 for Suppliers
        $result = [];
        $supplier = Supplier::find($id);
        $comments = $supplier->approvalComments->where('type', 6)->sortByDesc('created_at');
        $result = [
            'id' => $supplier->id,
            'supplier_name' => $supplier->supplier_name,
            'supplier_image' => isset($supplier->supplier_image) ? $supplier->supplier_image : 'rider.jpg',
            'supplier_rating' => $supplier->supplier_rating,
            'supplier_address' => $supplier->supplier_address,                
            'added_on' => $supplier->created_at,
            'supplier_description' => $supplier->supplier_description,
            'supplier_owner' => $supplier->user->name,
            'status' => $supplier->is_approved,
            'spare_parts' => $this->filterSpareParts($supplier->spare_parts),
            'comments' => $this->getCommentList($comments)
        ];
        $suppliers = (object)$result;$i=1;
        return view('admin.suppliers.view', compact('suppliers','i'));
    }

    public function logout() {
        Auth::logout();
        return redirect('admin/login');
    }

    protected function filterSpareParts($spare_parts){
        $result = !empty($spare_parts) ? json_decode($spare_parts,true): [];
        return $result;
    }

    protected function getEventsList() {
        $result = [];
        $events = Event::get();
        foreach($events as $key => $event) {
            $group = $event->group;            
            $result[$key] = [
                'id' => $event->id,
                'start_location' => $event->start_location,
                'via_location' => isset($event->via_location) ? $this->filterViaLocation($event->via_location) : '',
                'end_location' => $event->end_location,
                'start_date' => $event->start_date,
                'end_date' => $event->end_date,
                'no_of_people' => $event->no_of_people,
                'total_km' => $event->total_km,
                'added_on' => $event->created_at,
                'added_by' => $group->user->name,
                'status' => $event->is_approved,
            ];
        }
        return $result;
    }
    

    public function groupDetails($id) {
        //type 4 --> Group Status Comment
        $group = Group::find($id);
        $user = $group->user;
        $comments = $group->approvalComments->where('type', 4)->sortByDesc('created_at');
        $result = [
            'id' => $group->id,
            'group_name' => $group->group_name,
            'group_image' => isset($group->group_image) ? $group->group_image : 'not_found.jpg',
            'group_rating' => $group->group_rating,
            'group_desc' => $group->group_desc,
            'total_km' => isset($group->total_km) ? $group->total_km : 0,
            'total_rides' => isset($group->total_rides) ? $group->total_rides : 0,
            'joined_people' => $group->total_group_members,
            'added_on' => $group->created_at,
            'group_owner' => $user->name,
            'status' => $group->is_approved,
            'comments' => $this->getCommentList($comments),
        ];
        $groups = (object)$result;$i=1;
        return view('admin.groups.view',compact('groups','i'));
    }

    protected function getGroupsList() {
        $result = [];
        $groups = Group::get();
        foreach($groups as $key => $group) {
            $user = $group->user;
            $result[$key] = [
                'id' => $group->id,
                'group_name' => $group->group_name,
                'group_image' => isset($group->group_image) ? $group->group_image : 'not_found.jpg',
                'group_rating' => $group->group_rating,
                'total_km' => isset($group->total_km) ? $group->total_km : 0,
                'total_rides' => isset($group->total_rides) ? $group->total_rides : 0,
                'joined_people' => $group->total_group_members,
                'added_on' => $group->created_at,
                'group_owner' => $user->name,
                'status' => $group->is_approved,
            ];
        }
        return $result;
    }

    protected function getRidesList() {
        $result = [];
        $rides = Ride::get();
        foreach($rides as $key => $ride) {
            $user = $ride->user;
            
            $result[$key] = [
                'id' => $ride->id,
                'rider_name' => $user->name,
                'profile' => isset($user->profile->image) ? $user->profile->image : 'rider.jpg',
                'start_location' => $ride->start_location,
                'end_location' => $ride->end_location,
                'via_location' => isset($ride->via_location) ? $this->filterViaLocation($ride->via_location) : '',
                'total_km' => isset($ride->total_km) ? $ride->total_km : 0,
                'no_of_people' => $ride->no_of_people,
                'start_date' => $ride->start_date,
                'end_date' => $ride->end_date,
                'status' => $ride->is_approved,
                'rating' => 0,
                'added_on' => $ride->created_at,
            ];
        }
        return $result;
    }

    protected function filterViaLocation($via_locations) {
        $locations = implode(',' ,json_decode($via_locations,true));
        return $locations;
    }

    protected function getBikesList() {
        $result = [];
        $bikes = Bike::get();
        foreach($bikes as $key => $bike) {
            $user = $bike->user;
            $result[$key] = [
                'id' => $bike->id,
                'name' => $bike->name,
                'image' => !empty($bike->image) ? $this->filterBikeImages($bike->image) : 'not_found.jpg',
                'total_km' => isset($bike->total_km) ? $bike->total_km : 0,
                'total_rides' => isset($bike->total_rides) ? $bike->total_rides : 0,
                'status' => $bike->is_approved,
                'rating' => 0,
                'added_on' => $bike->created_at,
            ];
        }
        return $result;
    }

    protected function filterBikeImages($bikeImages) { 
        $bike_images = json_decode($bikeImages,true);
        if($bikeImages != 'null') {
            return $bike_images[0];
        }
        return 'not_found.jpg';
    }
}
