<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Bike;
use App\Models\BikeBrand;
use Illuminate\Support\Facades\Auth;

class BikeController extends Controller
{
    public function index() {
        $id = Auth::user()->id;
        $data['bikes'] = Bike::where('rider_id', $id)->get();
        return view('front/bike/index',$data);
    }

    public function create() {
        $data['brands'] = BikeBrand::all();
        return view('front/bike/create',$data);
    }

    public function addBikes(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'total_km' => 'required|numeric',
            'info' => 'required'
        ]);
        
        if ($validator->fails()) {
            $response = array('error' => $validator->errors()->all(), 'status' =>false);
         }
         else {
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            $newUser = Bike::create([
                'name' => $request->name,
                'total_km' => $request->total_km,
                'info' => $request->info,
                'image' => $new_name,
                'rider_id' => $request->rider_id
            ]);
            $response = array('msg' => 'Bike Added Successfully', 'status' => true);
        }
        return response()->json($response);
    }
}
