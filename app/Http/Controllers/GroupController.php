<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use Illuminate\Http\Request;
use App\User;
use App\Models\Group;
use App\Models\GroupFollow;
use App\Models\GroupJoin;
use App\Models\GroupPastExperience;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Image;
class GroupController extends Controller
{
    public function index() {
        $id = user()->id;
        $result = [];
        $groups = Group::where('create_rider_id', $id)->orderBy('created_at', 'desc')->get();
        foreach($groups as $key => $group) {
           $user = $group->user;
           $status_comment = $group->approvalComments->sortBydesc('created_at');
           $result[$key] =[
               'rider_name' => $user->name,
               'id' => $group->id,
               'rider_email' => $user->email,
               'added_on' => formatDate($group->created_at, 'd M Y'),
               'rider_image' => isset($user->profile->image) ? $user->profile->image : '',
               'group_name' => $group->group_name,
               'group_image' => $group->group_image,
               'group_rating' => $group->group_rating,
               'group_desc' => $group->group_desc,
               'total_km' => $group->total_km,
               'total_rides' => $group->total_rides,
               'total_group_members' => $group->groupJoinedRider->count(),
               'group_member_list' => $this->getGroupMembersList($group->groupJoinedRider),
               'past_experience' => $group->pastExperience->first(),
               'status' => $group->is_approved,
               'status_comment' => $status_comment
           ];
        }
        $result = (object)$result;$i=1;
        return view('front/group/index',compact('result','i'));
    }

    protected function getGroupMembersList($groupJoins) {
        $result = [];
        foreach($groupJoins as $key => $groupJoin) {
            $user = $groupJoin->user;
            $result[$key] = isset($user->profile->image) ? $user->profile->image : '';
        }
        return $result;
    }

    public function create() {
        $cities = $this->getCity();
        return view('front/group/create',compact('cities'));
    }

    protected function getCity() {

        return $data = [
            'Delhi' => 'Delhi',
            'Noida' => 'Noida',
            'New Delhi' => 'New Delhi',
            'Punjab' => 'Punjab',
            'Ghaziabad' => 'Ghaziabad',
            'Haryana' => 'Haryana',
            'Varanasi' => 'Varanasi',
        ];
    }
    
    public function store(GroupRequest $request)
    {
        $user = user();    
        $new_name='';
        if(isset($request->profile)) {
            $image = $request->profile;
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            //$image->move(public_path('images/group_images/'), $new_name);
            $destinationPath = public_path('images/group_images/');
            $new_img = Image::make($image->getRealPath())->resize(490, 230);
            $new_img->save($destinationPath . $new_name, 80);   
        }
        $data = [
            'create_rider_id'=> $user->id,
            'group_name' => $request->group_name,
            'group_desc' => $request->group_description,
            'city' => $request->city,
            'group_image' =>$new_name,
            'city' => isset($user->profile->city) ? $user->profile->city : ''
        ];
        Group::Create($data);
        $response = array('status'=>true, 'msg' => 'Group has been added successfully');
        return response()->json($response);
    }

    public function savePastExperience(Request $request) {
       
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'added_on' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'error' => $validator->errors(), 
                'status' =>false
            ];
         } else {
             $data = $request->all();
             $data['images'] = isset($request->images)?$this->filterImages($data['images']):'';
             $data['rider_id'] = user()->id;
             $data['added_on'] = formatDate($request->added_on);
             GroupPastExperience::create($data);
             $response = ['msg' => 'Past Experience Added Successfully','status' =>true];
         }

         return response()->json($response);
    }

    protected function filterImages($images){
        $result = [];
        foreach($images as $key => $image) {
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/group/past_experience/'), $new_name);

            $result[$key] = $new_name;
        }
        return json_encode($result);
    }

    public function followGroup(Request $request){
        $groupArray = [
            'group_id' => $request->group_id,
            'followed_by' => user()->id
        ];
        GroupFollow::create($groupArray);
        $response = ['status' => true];
        return response()->json($response);
     }

     public function unFollowGroup(Request $request){
        GroupFollow::where('followed_by',user()->id)->where('group_id', $request->group_id)->delete();
        $response = ['status' => true];
        return response()->json($response);
     }

     public function joinGroup(Request $request){
        $groupArray = [
            'group_id' => $request->group_id,
            'rider_id' => user()->id
        ];
        GroupJoin::create($groupArray);
        $response = ['status' => true];
        return response()->json($response);
     }

     public function leaveGroup(Request $request){
        GroupJoin::where('rider_id',user()->id)->where('group_id', $request->group_id)->delete();
        $response = ['status' => true];
        return response()->json($response);
     }
}
