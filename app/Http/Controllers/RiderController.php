<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rider\RiderRequest;
use App\Jobs\SendGroupInvitationEmail;
use App\Jobs\SendVerificationEmail;
use App\Mail\InvitationMail;
use App\Mail\VerificationEmail;
use App\Models\Chat;
use App\Models\Group;
use App\Models\GroupJoin;
use App\Models\Ride;
use App\Models\RiderFollow;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\RiderProfile;
use App\Models\RoadType;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use Image;

class RiderController extends Controller
{
    public function register(RiderRequest $request) {

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'email_verification_token' => Str::random(32)
        ];
        $user = User::create($userData);
        
        $response = array('status'=>true, 'msg' => 'Registration has been successful, Verification Email has been sent on your email-id');

        //send verification email
        Mail::to($request->email)->send(new VerificationEmail($user));
        return response()->json($response);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        
        if ($validator->fails()) {
            $response = ['error' => $validator->errors(), 'status' =>false];
         }
         else {
            $user = User::where('email',$request->email)->first();
            if(!empty($user)) {
                if($user->email_verified == 1){
                    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                        $response = ['msg' => 'Logged In Successfully !', 'status' => true];
                    } else {
                        $response = ['error' => ['password' => 'Either email or password is incorrect'], 'status' => false];
                    }
                } else {
                    $response = ['error' => ['email' => 'Verify your email address'], 'status' => false];
                }
            }
            else{
                $response = ['error' => ['email' => 'Please enter valid email address'], 'status' => false];
            }
        }
        return response()->json($response);
    }

    public function index(Request $request) {
        $loggedInUser = user();
        $user = User::find($loggedInUser->id);
        $profile = $user->profile;
        $followers = $user->followedRiders->pluck('followed_by')->toArray();
        $data = [
            'name' => $loggedInUser->name,
            'email' => $loggedInUser->email,
            'phone' => $loggedInUser->phone,
            'total_km' => isset($profile->total_km) ? $profile->total_km : 0,
            'total_rides' => isset($profile->total_rides) ? $profile->total_rides : 0,
            'rating' => isset($profile->rating) ? $profile->rating : 0,
            'description' => isset($profile->description) ? $profile->description : '',
            'image' => isset($profile->image) ? $profile->image : 'rider.jpg',
            'cover_image' => isset($profile->cover_image) ? $profile->cover_image : 'cover.png',
            'cityName' => isset($user->profile->city) ? $user->profile->city : '',
            'added_on' => formatDate($loggedInUser->created_at, 'd M Y'),
            'is_social' => !empty($user->provider) ? true : false,
            'rides' => $this->latestRides(),
            'bikes' => $user->bikes->take(2)->sortBydesc('created_at'),
            'total_followers' => count($followers)
        ];
        return view('front/profile/index',$data);
    }

    protected function latestRides() {
        $id = user()->id;
        $result = [];
        $rides = Ride::where('rider_id',$id)->where('is_approved', 1)->limit(2)->OrderBy('created_at', 'desc')->get();
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
                'ride_rating' => $ride->rating,
                'ride_image' => $rideDays[0],
            ];
        }
        return $result;
    }

    protected function formateRideDays($days) {
        $ride_days = json_decode($days,true);
        $result = [];
        foreach($ride_days as $key => $ride_day) {
            $roadType = RoadType::find($ride_day['road_type']);
            $result[$key] = [
                'start_locations' => $ride_day['start_location'],
                'road_type' => $roadType->road_type,
                'image' => isset($ride_day['ride_images'])  ? $ride_day['ride_images'][0]['image'] : 'not_found.png'
            ];
        }
        return $result;
    }

    protected function formateViaLocation($via_locations) {
        $locations = json_decode($via_locations,true);
        return implode(',', $locations);
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
            'image' => 'mimes:png,gif,jpg,jpeg|max:2048',
            'cover_image' => 'mimes:png,gif,jpg,jpeg|max:2048',
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

            if(isset($request->cover_image)) {
                $cover_image = $request->file('cover_image');
                $profile_name = rand() . '.' . $cover_image->getClientOriginalExtension();
                //$cover_image->move(public_path('images/rider/cover_images/'), $profile_name);
                $destinationPath = public_path('images/rider/cover_images/');
                $new_img = Image::make($cover_image->getRealPath())->resize(490, 230);
                $new_img->save($destinationPath . $profile_name, 80);   
                //$cover_image->move($destinationPath, $profile_name);

                $rider = RiderProfile::find($rider->id);
                $rider->cover_image = $profile_name;
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
       //dd($emails);
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
        if($emails == null || count($emails) < 1) {
            $response = [
                'status' => false,
                'msg' => 'Please enter email address'
            ];
        }
        else {
            $emailList = array_unique($emails) ;
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
        }
        return $response;
    }

    public function create() {
        $loggedInUser = user();
        $user = User::find($loggedInUser->id);
        
        $data = [
            'name' => $loggedInUser->name,
            'email' => $loggedInUser->email,
            'phone' => $loggedInUser->phone,
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

     public function followRider(Request $request){
        $groupArray = [
            'rider_id' => $request->rider_id,
            'followed_by' => user()->id
        ];
        RiderFollow::create($groupArray);
        $response = ['status' => true];
        return response()->json($response);
     }

     public function unFollowRider(Request $request){
        RiderFollow::where('followed_by',user()->id)->where('rider_id', $request->rider_id)->delete();
        $response = ['status' => true];
        return response()->json($response);
     }
     

    public function groupMemberList(Request $request) {
        $group = Group::find($request->group_id);
        $members = $group->groupJoinedRider->pluck('rider_id')->toArray();
        if(empty($members)) {
            $response = ['status' => false, 'msg' => 'Group member is not available'];
        } else{
            $users = User::whereIn('id',$members)->get();
            $options = "";
            foreach($users as $user) {
                $options .= "<option value='".$user->id."'>".$user->name."</option>";
            }
            $response = ['status' => true, 'html' => $options];
        }
        return response()->json($response);
    }

    public function saveDataChat(Request $request) {
        $members = $request->group_member;
        $user = user();
        if(empty($members)) {
            $response = ['status' => false, 'msg' => 'Please select group member'];
        }
        else{
            foreach($members as $key => $member_id) {
                $chatData = [
                    'send_to' => $member_id,
                    'send_by' => $user->id,
                    'message' => $user->phone
                ];
                Chat::create($chatData);
            }
            $response = ['status'=>true, 'msg'=>'Contact has been shared'];
        }
        return response()->json($response);
    }


    public function updateDescription(Request $request){
        $loggedInUser = user();
    
        $description = $request->description;
        $profile = RiderProfile::where('rider_id', $loggedInUser->id)->first();
        $profile->description = $description;
        $profile->save();

        $response = array('msg' => 'Profile Description updated Successfully', 'status' => true);
        return response()->json($response);
    }

    public function updateDetail(Request $request){
       
        $loggedInUser = user();
        $validator = Validator::make($request->all(), [
            'total_rides' => 'required',
            'riding_year' => 'required',
        ]);
        
        if ($validator->fails()) {
            $response = array('error' => $validator->errors(), 'status' =>false);
         }
         else {
            $profile = RiderProfile::where('rider_id', $loggedInUser->id)->first();

            if(isset($request->image)) {
                $image = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/rider_images/'), $new_name);

                $profile->image = $new_name;
            }
            $profile->riding_year = $request->riding_year;
            $profile->total_rides = $request->total_rides;
            $profile->save();
            $response = array('msg' => 'Profile Updated Successfully', 'status' => true);
        }

        return response()->json($response);
    }


    public function updateCoverImage(Request $request){
       
        $loggedInUser = user();
        
        $profile = RiderProfile::where('rider_id', $loggedInUser->id)->first();

        if(isset($request->cover_image)) {
            $cover_image = $request->file('cover_image');
            $cover_image_name = rand() . '.' . $cover_image->getClientOriginalExtension();
            $destinationPath = public_path('images/rider/cover_images/');
            $new_img = Image::make($cover_image->getRealPath())->resize(490, 230);
            $new_img->save($destinationPath . $cover_image_name, 80);  

            $profile->cover_image = $cover_image_name;
        }
        $profile->save();
        $response = array('msg' => 'Profile Cover Image Updated Successfully', 'status' => true);
        return response()->json($response);
    }
}
