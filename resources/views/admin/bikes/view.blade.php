@extends('layouts.adminLayout.admin-layout')
@section('title', 'Bike Details')
@section('content')
<div class="container-fluid">
  <div class="row">
      @include('layouts.adminLayout.admin-sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">        
            <h4>Bike Details</h4>
            <div class="row mt-5">
                <strong><a href="{{route('admin.bikes')}}" class="href"><< Back</a></strong>
                <div class="col-md-12 mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('public/images/rider/bikes/')}}/{{$bikes->image}}" class="img-fluid" width="150" height="150">                                    
                                </div>
                                <div class="col-md-4"><strong>Rider/Biker Name </strong><br/><span>{{$bikes->rider_name}}</span></div>
                                <div class="col-md-4"><strong>Total Rides </strong><br/><span>{{$bikes->total_rides}}</span></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4"><strong>Total Kms Driven </strong><br/><span>{{$bikes->total_km}}</span></div>
                                <div class="col-md-4">
                                    <strong>Current Status</strong><br/>
                                    @if($bikes->status == 1)
                                        <button class="btn btn-success">Approved</button>
                                    @elseif($bikes->status == 0)
                                        <button class="btn btn-warning">UnApproved</button>
                                    @else
                                        <button class="btn btn-danger">Rejected</button>
                                    @endif
                                </div>
                                <div class="col-md-4"><strong>Service Experience </strong><br/><span>{{$bikes->service_experience}}</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4"><strong>Bike Name </strong><br/><span>{{$bikes->name}}</span></div>
                                <div class="col-md-4"><strong>Comfortness </strong><br/><span>{{$bikes->comfortness}}</span></div>
                                <div class="col-md-4"><strong>Reliability </strong><br/><span>{{$bikes->reliability}}</span></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4"><strong>Performance </strong><br/><span>{{$bikes->performance}}</span></div>
                                <div class="col-md-4"><strong>Visual Appeal </strong><br/><span>{{$bikes->visual_appeal}}</span></div>
                                <div class="col-md-4"><strong>Rating </strong><br/><span>{{$bikes->rating}}</span></div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <strong>Description </strong><br/>
                            <span>{{$bikes->info}}</span>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <button class="btn btn-primary" id="change_status" type="2" content="{{$bikes->status}}" onclick="changeStatus('{{$bikes->id}}')"><i class="fa fa-eye"></i>Change Status</button>
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
                        @foreach($bikes->comments as $key => $comment)
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
