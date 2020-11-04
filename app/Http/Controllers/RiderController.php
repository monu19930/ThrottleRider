<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rider\RiderRequest;
use App\Jobs\SendGroupInvitationEmail;
use App\Mail\InvitationMail;
use App\Models\GroupJoin;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\RiderProfile;
use Illuminate\Support\Facades\Mail;

class RiderController extends Controller
{
    public function register(RiderRequest $request) {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $response = array('status'=>true, 'msg' => 'New Account Created Successfully');

        //login after successfully account created
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            //do nothing
        }
        return response()->json($response);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        
        if ($validator->fails()) {
            $response = array('error' => $validator->errors()->all(), 'status' =>false);
         }
         else {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $response = array('msg' => 'Logged In Successfully !', 'status' => true);
            } else {
                $response = array('msg' => 'Something goes to wrong, Please try again', 'status' => false);
            }
        }
        return response()->json($response);
    }

    public function index(Request $request) {
        $loggedInUser = user();
        $user = User::find($loggedInUser->id);
        $data = [
            'name' => $loggedInUser->name,
            'email' => $loggedInUser->email,
            'rider' => $user->profile,
            'is_social' => !empty($user->provider) ? true : false
        ];
        return view('front/profile/index',$data);
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }

    public function update(Request $request){
        $loggedInUser = user();
        $validator = Validator::make($request->all(), [
            'total_rides' => 'required',
            'riding_year' => 'required',
            'city' => 'required',           
            'image' => 'mimes:png,gif,jpg,jpeg|max:2048'
        ]);
        
        if ($validator->fails()) {
            $response = array('error' => $validator->errors()->all(), 'status' =>false);
         }
         else {
            $dataArray = [
                'rider_id' => $loggedInUser->id,
                'riding_year' => $request->riding_year,
                'total_rides' => $request->total_rides,
                'city' => $request->city,
                'description' => $request->description
            ];
            $rider = RiderProfile::where('rider_id', $loggedInUser->id)->first();
            if(!empty($rider)) {
                RiderProfile::where('rider_id',$loggedInUser->id)->update($dataArray);
            }
            else {
                $rider = RiderProfile::create($dataArray);
            }

            if(isset($request->image)) {
                $image = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/rider_images/'), $new_name);

                $rider = RiderProfile::find($rider->id);
                $rider->image = $new_name;
                $rider->save();
            }
            $response = array('msg' => 'Profile Updated Successfully', 'status' => true);
        }
        return response()->json($response);
    }

    public function invitationJoinGroup($id) {
        $rider_id = user()->id;
        $data = [
            'group_id' => $id,
            'rider_id' => $rider_id
        ];
        $details = GroupJoin::where('group_id', $id)->where('rider_id', $rider_id)->first();
        if(empty($details)) {
            GroupJoin::create($data);
        }
        return redirect('/');
    }

    public function inviteGroupMembers(Request $request) {
        $emails = $request->email;
        $group_id = $request->member;
        $result = $this->filterEmails($emails);
        if($result['status'] == true) {
            foreach($result['emails'] as $email) {
                $data = [
                    'url' => url('/group').'/'.$group_id.'/join',
                    'email' => $email,
                ];
                $data = (object)$data;
                dispatch(new SendGroupInvitationEmail($data));
            }
            $response = ['status' => true, 'msg' => 'Invitation has been sent successfully'];
            return response()->json($response); 
        } 
        else {
            return response()->json($result);
        }
    }

    protected function filterEmails($emails) {
        $emailList = explode(',', $emails);
        $response = ['status' => true];
        foreach($emailList as $key => $email) {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $response = [
                    'status' => false,
                    'msg' => 'Please enter valid email address'
                ];
                return $response;
            } else {
                $response['emails'][$key] = $email;
            }
        }
        return $response;
    }

    public function create() {
        $loggedInUser = user();
        $user = User::find($loggedInUser->id);
        
        $data = [
            'name' => $loggedInUser->name,
            'email' => $loggedInUser->email,
            'rider' => $user->profile,
            'rider_city' => isset($user->profile->city) ? $user->profile->city : '',
            'cities' => $this->getCity()
        ];
        return view('front/profile/edit',$data);
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


    
    public function joinGroup(Request $request){
        $groupArray = [
            'group_id' => $request->group_id,
            'rider_id' => user()->id
        ];
        GroupJoin::create($groupArray);
        $response = ['status' => true];
        return response()->json($response);
     }  
}
