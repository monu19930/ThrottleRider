<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ride;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $search = 'Bangaluru';
        $data['rides'] = Ride::where('start_location',$search)->OrderBy('created_at', 'desc')->get();
        return view('front/index', $data);
    }

    public function search(Request $request) {
        $start_location = $request->start_location;
        $search = $request->search;
        $rides = Ride::where('start_location',$start_location)->where('end_location',$search)->OrderBy('created_at', 'desc')->get();
        $html = view('front/search',compact('rides'))->render();
        return $html;
    }

    
}
