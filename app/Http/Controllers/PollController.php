<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollRequest;
use App\Models\Group;
use App\Models\Poll;
use App\Models\PollFeedback;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = user()->id;
        $user = User::find($id);
        $polls = $user->polls->sortByDesc('created_at');
        $result = [];
        foreach($polls as $key => $poll) {
            $status_comment = $poll->approvalComments->sortBydesc('created_at');
            $result[$key] = [
                'id' => $poll->id,
                'poll_name' => $poll->poll_name,
                'added_on' => formatDate($poll->created_at, 'd M Y'),
                'status' => $poll->is_approved,
                'status_comment' => $status_comment,
                'options' => $this->filterOptions($poll->options)
            ];
        }
        $polls = (object)$result;$i=1;
        return view('front.poll.index',compact('polls', 'i'));
    }

    protected function filterOptions($options) {
        $options = json_decode($options,true);
        return $options;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = user();
        $groups = $user->groups->where('is_approved',1);
        return view('front.poll.create',compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PollRequest $request)
    {
        $data = $request->all();
        $filterData = $this->filterPollsData($data);
        $response = array('status'=>false, 'error'=> ['Something goes wrong, try again']);        
        if(count($filterData) > 0) {
            Poll::insert($filterData);
            $response = array('status'=>true, 'msg' => 'Poll added successfully');
        }
        return response()->json($response);
    }

    protected function filterPollsData($data) {
        $rider_id = user()->id;
        $questions = $data['question'];
        $group_id = $data['group_id'];
        $result = [];
        unset($data['question']);unset($data['group_id']);
        foreach($data as $key => $value) {
            
            $keyNew = rtrim(strrev(strstr(strrev($key), '_')), '_');
            $index = intval(ltrim(strrchr($key, '_'), '_'));
            $result[$index]['poll_name'] = $questions[$index];
            if($keyNew == 'options') {
                $result[$index][$keyNew] = json_encode($value);
            }
            $result[$index]['group_id'] = $group_id;
            $result[$index]['rider_id'] = $rider_id;
            $result[$index]['created_at'] = Carbon::now();
        }
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $poll = Poll::find($id);
        $poll->delete();
        $response = ['status' => true, 'msg'=>'Poll has been deleted successfully'];
        return response()->json($response);
    }


    public function groupPollsList(Request $request) {
        $group_id = $request->group;
        $group = Group::find($group_id);
        $polls = $group->polls->where('is_approved', 1);
        $result = [];
        foreach($polls as $key => $poll) {
            $result[$key] = [
                'id' => $poll->id,
                'title' => $poll->poll_name,
                'options' =>  $this->filterOptions($poll->options)
            ];
        }
        $i=1;
        $html = view('front.poll.question',compact('result','i'))->render();
        return $html;
    }
    
    public function savePollsFeedback(Request $request) {
        $data = $request->all();
        $result = [];
        foreach($data as $question => $answer) {
            $list = explode('_',$question);
            $result['answer'][$list[1]] = $answer;
        }
        $data = [
            'rider_id' => user()->id,
            'answer' => json_encode($result['answer'])
        ];
        
        PollFeedback::create($data);
        $response = ['status' => true, 'msg'=>'Polls Feedabck done successfully'];
        return response()->json($response);
    }
}