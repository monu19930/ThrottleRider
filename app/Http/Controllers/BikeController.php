<?php

namespace App\Http\Controllers;

use App\Http\Requests\BikeRequest;
use App\Http\Resources\BikeResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Bike;
use App\Models\BikeBrand;
use App\Models\BikeModel;
use App\User;
use Illuminate\Support\Facades\Auth;

class BikeController extends Controller
{
    public function index() {
        $id = user()->id;
        $user = User::find($id);
        $bikes = $user->bikes->sortBydesc('created_at');
        $result = [];
        foreach($bikes as $key => $bike) {
            $status_comment = $bike->approvalComments->sortBydesc('created_at');
            $result[$key] = [
                'id' => $bike->id,
                'image' => $this->filterBikeImage($bike->image),
                'bike_name' => $bike->name,
                'added_on' => formatDate($bike->created_at, 'd M Y'),
                'total_km' => $bike->total_km,
                'total_rides' => $bike->total_rides,
                //'rider' => $user->profile,
                'rider_name' => $user->name,
                'rider_rating' => isset($user->profile->rating) ? $user->profile->rating : 0,
                'rider_image' => !empty($user->profile->image)?$user->profile->image:'rider.jpg',
                'description' => $bike->info,
                'status' => $bike->is_approved,
                'status_comment' => $status_comment,
            ];
        }
        $bikes = (object)$result;$i=1;
        return view('front/bike/index',compact('bikes', 'i'));
    }

    protected function filterBikeImage($images) {
        $image_list = json_decode($images,true);
        $image = !empty($image_list[0]) ? $image_list[0] : 'not_found.jpg';
        return $image;
    }

    public function create() {
        $data['brands'] = BikeBrand::all();
        return view('front/bike/create',$data);
    }

    public function edit($id) {
        $loggedRiderId = user()->id;
        $details = Bike::where('id',$id)->where('rider_id', $loggedRiderId)->first();
        if($details) {
            $result = [
                'id' => $id,
                'rider_id' => $details->rider_id,
                'name' =>$details->name,
                'total_km' =>$details->total_km,
                'total_rides' =>$details->total_rides,
                'comfortness' =>$details->comfortness,
                'visual_appeal' =>$details->visual_appeal,
                'reliability' =>$details->reliability,
                'performance' =>$details->performance,
                'service_experience' =>$details->service_experience,
                'info' => trim($details->info),
                'images' => json_decode($details->image,true),
                'brands' =>BikeBrand::all()
            ];
            return view('front/bike/create',$result);
        }
        else {
            return redirect('bikes');
        }
    }

    public function search(Request $request) {

        $search = $request->search;
        $models = BikeModel::select('name')->where('name','LIKE','%'.$search.'%')->get();
        $result = [];
        if($models->count() > 0) {
            foreach($models as $key=> $model) {
                $result[$key] = $model->name;
            }
        }
        return $result;
    }

    public function searchBikeDetails(Request $request) {
        $search = $request->keyword;
        $details = BikeModel::select('id','image')->where('name','LIKE','%'.$search.'%')->first();
        return $details;
    }

    public function brandList(Request $request) {
        $brand_id = $request->brand_id;
        $models = BikeModel::select('id','name', 'image')->where('brand_id',$brand_id)->get();
        $options = "";
        foreach($models as $model) {
            $image = !empty($model->image) ? $model->image : 'not_available.png';
            $options .= "<option value='".$model->name."' data-content='".$image."'>".$model->name."</option>";
        }
        return $options;
    }

    public function addBikeStep1(BikeRequest $request) {
       
        $request->session()->forget('bike');
        $data = $request->all();
        unset( $data['csrf'] );

        $bike = new Bike();
        $bike->fill($data);
        $request->session()->put('bike', $bike);
        return true;
    }
    
    public function delete(Request $request) {
        $id = $request->id;
        $bike = Bike::find($id);
        $bike->delete();
        $response = ['status' => true, 'msg'=>'Bike has been deleted successfully'];
        return response()->json($response);
    }

    public function addBikeStep2(Request $request) {

        $data = $request->all();

        if(isset($data['id'])) {
            $details = Bike::find($data['id']);
            $result['images'] = json_decode($details->image,true);
            $result['bike_id'] = $data['id'];
            unset($data['id']);
        }

        $validator = Validator::make($data, [
            'total_km' => 'required',
            'total_rides' => 'required',
        ]);
        
        if ($validator->fails()) {
            $response = [
                'error' => $validator->errors()->all(), 
                'status' =>false
            ];
            return response()->json($response);
         }
         else {
            $filterData = $this->filterData($data);
            $filterData['name'] = $request->session()->get('bike')->name;
            $request->session()->forget('bike');
    
            $bike = new Bike();
            $bike->fill($filterData);
            $request->session()->put('bike', $bike);
            $bike_models = BikeModel::select('image')->where('name', $bike->name)->first();
            $result['bike_model_image'] = !empty($bike_models->image) ? $bike_models->image : 'not_available.png';
            $result['bike_details'] = $bike;

            $result['brands'] = BikeBrand::all();
            
            $html = view('front.bike.review', compact('result'))->render();
            return $html;
         }
    }

    
    public function reviewBikeImageSave(Request $request) {
        $data = $request->all();
        $filterData = $this->filterData($data);
        $bike = $request->session()->get('bike');
        $oldData = $bike->toArray();
        $newData = array_merge($oldData, $filterData);

        $bike = new Bike();
        $bike->fill($newData);
        $request->session()->put('bike', $bike);
        $bike = $request->session()->get('bike');
        $response = ['status'=>true, 'img' => $filterData];
        return response()->json($response);
    }

    public function reviewBikeMoreDetailsSave(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data, [
            'total_km' => 'required',
            'total_rides' => 'required',
        ]);
        
        if ($validator->fails()) {
            $response = [
                'error' => $validator->errors()->all(), 
                'status' =>false
            ];
            return response()->json($response);
         }
         else {
            unset($data['csrf']);
            $bike = $request->session()->get('bike');
            $oldData = $bike->toArray();
            $newData = array_merge($oldData, $data);

            $bike = new Bike();
            $bike->fill($newData);
            $request->session()->put('bike', $bike);
            $response = ['status'=>true];
            return response()->json($response);
         }
    }

    public function reviewBikeDescSave(Request $request) {
        $data = $request->all();
        unset($data['csrf']);
        $bike = $request->session()->get('bike');
        $oldData = $bike->toArray();
        $newData = array_merge($oldData, $data);

        $bike = new Bike();
        $bike->fill($newData);
        $request->session()->put('bike', $bike);
        $response = ['status'=>true];
        return response()->json($response);
    }

    

    protected function filterData($data) {
        $result = [];
        unset( $data['csrf'] );
        foreach($data as $key => $value) {
            if($key == 'image') {
                $img_result = [];
                foreach($value as $key_child => $image) {
                    $new_name = rand() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/rider/bikes'), $new_name);
                    $img_result[$key_child] = $new_name;
                }
                $result[$key] = $img_result;
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    public function saveBike(Request $request){
       
        $bike = $request->session()->get('bike');
        $bike->rider_id = Auth::user()->id;
        $result = [
            'rider_id' => $bike->rider_id,
            'name' => $bike->name,
            'rider_id' => $bike->rider_id,
            'total_km' => $bike->total_km,
            'total_rides' => $bike->total_rides,
            'info' => trim($bike->info),
            'comfortness' => $bike->comfortness,
            'reliability' => $bike->reliability,
            'visual_appeal' => $bike->visual_appeal,
            'performance' => $bike->performance,
            'service_experience' => $bike->service_experience,
        ];
        if(isset($request->id)) {
            if(!empty($bike->image)) {
                $result['image'] = json_encode($bike->image);
            }
            Bike::where('id',$request->id)->update($result);
        } else {
            $result['image'] = json_encode($bike->image);
            Bike::create($result);
        }
        return $response = ['msg'=>'Bike Added Successfully', 'status'=>true];
    }

}
