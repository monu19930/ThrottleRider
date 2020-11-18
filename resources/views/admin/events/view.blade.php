@extends('layouts.adminLayout.admin-layout')
@section('title', 'Event Details')
@section('content')
<div class="container-fluid">
  <div class="row">
      @include('layouts.adminLayout.admin-sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">        
            <h4>Event Details</h4>
            <div class="row mt-5">
                <strong><a href="{{route('admin.events')}}" class="href"><< Back</a></strong>
                <div class="col-md-12 mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4"><strong>Rider/Biker Name </strong><br/><span>{{$rides->rider_name}}</span></div>
                                <div class="col-md-4"> <strong>Start Location </strong> <br/> <span>{{$rides->start_location}}</span></div>
                                <div class="col-md-4"><strong>Via Location </strong><br/><span>{{$rides->via_location}}</span></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4"><strong>End Location </strong><br/><span>{{$rides->end_location}}</span></div>
                                <div class="col-md-4"><strong>Start Date </strong><br/><span>{{$rides->start_date}}</span></div>
                                <div class="col-md-4"><strong>End Date </strong><br/><span>{{$rides->end_date}}</span></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4"><strong>Number Of People </strong><br/><span>{{$rides->no_of_people}}</span></div>
                                <div class="col-md-4"><strong>Rating </strong><br/><span>{{$rides->rating}}</span></div>
                                <div class="col-md-4"><strong>Luggage </strong><br/><span>{{$rides->luggage}}</span></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4"><strong>Current Status </strong><br/>
                                    @if($rides->status == 1)
                                    <button class="btn btn-success">Approved</button>
                                    @elseif($rides->status == 0)
                                    <button class="btn btn-warning">UnApproved</button>
                                    @else
                                    <button class="btn btn-danger">Rejected</button>
                                    @endif
                                </div>                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4><strong>Ride Days List</h4></strong>
                            @foreach($rides->ride_days as $key => $ride_day)
                            <strong>Day {{$key+1}} </strong>
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <img src="{{ asset('public/images/rides/')}}/{{ $ride_day['image'] }}" style="width: 150px; height: 100px;" class="img-fluid">
                                </div>
                                <div class="col-md-3">
                                    <strong>Start Location </strong><span>{{$ride_day['start_location']}}</span>
                                </div>
                                <div class="col-md-3">
                                    <strong>End Location </strong><span>{{$ride_day['end_location']}}</span>
                                </div>
                                <div class="col-md-2">
                                    <strong>Road </strong><span>{{$ride_day['road_type']}}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>                    
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <button class="btn btn-primary" id="change_status" type="5" content="{{$rides->status}}" onclick="changeStatus('{{$rides->id}}')"><i class="fa fa-eye"></i>Change Status</button>
                        </div>
                    </div>              
                </div>
            </div>
            <div class="table-responsive mt-5">
                <h5>Status Change comments</h5>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                        <th>#</th>                        
                        <th>Comment</th>
                        <th>Added On</th>
                        <th>Status</th>              
                        <th>Added By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rides->comments as $key => $comment)
                            <tr>
                                <td>{{$i++}}.</td>
                                <td>{{$comment['description']}}</td>
                                <td>{{$comment['added_on']}}</td>
                                <td>{{$comment['status']}}</td>
                                <td>{{$comment['added_by']}}</td>
                            </tr>
                        @endforeach            
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@stop
