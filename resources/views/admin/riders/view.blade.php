@extends('layouts.adminLayout.admin-layout')
@section('title', 'Rider Details')
@section('content')
<div class="container-fluid">
  <div class="row">
      @include('layouts.adminLayout.admin-sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">        
            <h4>Rider Details</h4>
            <div class="row mt-5">
                <a href="{{route('admin.riders')}}" class="href"> <strong><< Back</strong></a>
                <div class="col-md-12 mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('public/images/rider_images')}}/{{$image}}" class="img-fluid" width="100" height="100">                                    
                                </div>
                                <div class="col-md-4"><strong>Riding Years </strong><br/><span>{{$riding_year}}</span></div>
                                <div class="col-md-4"><strong>Total Rides </strong><br/><span>{{$total_rides}}</span></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4"><strong>Total Kms Driven </strong><br/><span>{{$total_km}}</span></div>
                                <div class="col-md-4">
                                    <strong>Current Status</strong><br/>
                                    @if($status == 1)
                                        <button class="btn btn-success">Approved</button>
                                    @elseif($status == 0)
                                        <button class="btn btn-warning">UnApproved</button>
                                    @else
                                        <button class="btn btn-danger">Rejected</button>
                                    @endif
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div>
                                        <strong>Rider Name </strong><br/><span>{{$rider_name}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4"><strong>Email Address </strong><br/><span>{{$email}}</span></div>
                                <div class="col-md-4"><strong>Rating </strong><br/><span>{{$rating}}</span></div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <button class="btn btn-primary" id="change_status" type="1" content="{{$status}}" onclick="changeStatus('{{$id}}')"><i class="fa fa-eye"></i>Change Status</button>
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
                        @foreach($comments as $key => $comment)
                            <tr>
                                <td>{{$key+1}}.</td>
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
