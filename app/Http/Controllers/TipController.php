<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipRequest;
use App\Models\Tip;
use App\User;
use Illuminate\Http\Request;

class TipController extends Controller
{
    public function index() {
        $id = user()->id;
        $user = User::find($id);
        $tips = $user->tips->sortByDesc('created_at');
        $result = [];
        foreach($tips as $key => $tip) {
            $status_comment = $tip->approvalComments->sortBydesc('created_at');
            $result[$key] = [
                'id' => $tip->id,
                'file_name' => !empty($tip->file_name) ? $tip->file_name : '',
                'tip_title' => $tip->tip_title,
                'rider' => $user->profile,
                'added_on' => formatDate($tip->created_at, 'd M Y'),
                'description' => $tip->tip_description,
                'status' => $tip->is_approved,
                'status_comment' => $status_comment
            ];
           
        }
        //$tips = (object)$result;$i=1;
        return view('front.tip.index')->with(['tips'=>$result,'i'=>1]);
        //return view('front.tip.index',compact('tips', 'i'));
    }

    public function create() {
        return view('front.tip.create');
    }

    public function store(TipRequest $request)
    {
        $tipData = $request->all();
        $new_name='';
        if($request->has('file_name')) {
            $image = $request->file_name;
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('videos/tips/'), $new_name);
        } 
        elseif(empty($request->tip_description)) {
            $response = ['status' => false, 'error' => ['tip_description'=>'Select either media file or Enter Tip Description']];
            return response()->json($response);
        }
        $tipData['rider_id'] = user()->id;
        $tipData['file_name'] = $new_name;
        Tip::create($tipData);
        $response = array('status'=>true, 'msg' => 'Tip has been added successfully');
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tip = Tip::find($id);
        $tip->delete();
        $response = ['status' => true, 'msg'=>'Tip has been deleted successfully'];
        return response()->json($response);
    }
}
