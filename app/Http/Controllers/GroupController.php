<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use Illuminate\Http\Request;
use App\User;
use App\Models\Group;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class GroupController extends Controller
{
    public function index() {
        $id = user()->id;
        $result = [];
        $groups = Group::where('create_rider_id', $id)->orderBy('created_at', 'desc')->get();
        foreach($groups as $key => $group) {
           $user = $group->user;
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
               'group_member_list' => $this->getGroupMembersList($group->groupJoinedRider)
           ];
        }
        return view('front/group/index',compact('result'));
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
        return view('front/group/create');
    }
    public function saveGroup(GroupRequest $request)
    {
        $user = user();    
        $new_name='';
        if(isset($request->profile)) {
            $image = $request->profile;
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/group_images/'), $new_name);
        }
        $data = [
            'create_rider_id'=> $user->id,
            'group_name' => $request->group_name,
            'group_desc' => $request->group_description,
            'group_image' =>$new_name,
            'city' => isset($user->profile->city) ? $user->profile->city : ''
        ];
        Group::Create($data);
        $response = array('status'=>true, 'msg' => 'Group  has been successfully created');
        return response()->json($response);
    }
}
