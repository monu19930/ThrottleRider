@extends('layouts.adminLayout.admin-layout')
@section('title', 'Group Details')
@section('content')
<div class="container-fluid">
  <div class="row">
      @include('layouts.adminLayout.admin-sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">        
            <h4>Group Details</h4>
            <strong><a href="{{route('admin.groups')}}" class=""><< Back</a> </strong>
            <div class="row mt-5">                
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('public/images/group_images')}}/{{$groups->group_image}}" class="img-fluid" width="100" height="100">                                    
                                </div>
                                <div class="col-md-4"><strong>Group Name </strong><br/><span>{{$groups->group_name}}</span></div>
                                <div class="col-md-4"><strong>Total Rides </strong><br/><span>{{$groups->total_rides}}</span></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4"><strong>Total KMs </strong><br/><span>{{$groups->total_km}}</span></div>
                                <div class="col-md-4">
                                    <strong>Current Status</strong><br/>
                                    @if($groups->status == 1)
                                        <button class="btn btn-success">Approved</button>
                                    @elseif($groups->status == 0)
                                        <button class="btn btn-warning">UnApproved</button>
                                    @else
                                        <button class="btn btn-danger">Rejected</button>
                                    @endif
                                </div>
                                <div class="col-md-4"><strong>Added On </strong><br/><span>{{$groups->added_on}}</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div>
                                        <strong>Group Owner </strong><br/><span>{{$groups->group_owner}}</span>
                                    </div>
                                </div>
                                <div class="col-md-4"><strong>Group Joined Members </strong><br/><span>{{$groups->joined_people}}</span></div>
                                <div class="col-md-4"><strong>Rating </strong><br/><span>{{$groups->group_rating}}</span></div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <strong>Description </strong><br/>
                            <span>{{$groups->group_desc}}</span>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <button class="btn btn-primary" id="change_status" type="4" content="{{$groups->status}}" onclick="changeStatus('{{$groups->id}}')"><i class="fa fa-eye"></i>Change Status</button>
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
                        @foreach($groups->comments as $key => $comment)
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
