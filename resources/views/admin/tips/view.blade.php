@extends('layouts.adminLayout.admin-layout')
@section('title', 'Tip Details')
@section('content')
<div class="container-fluid">
  <div class="row">
      @include('layouts.adminLayout.admin-sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">        
            <h4>Tip Details</h4>
            <strong><a href="{{route('admin.tips')}}" class=""><< Back</a> </strong>
            <div class="row mt-5">                
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                <strong>File </strong>
                                @if(!empty($tips->file_name))
                                <video width="150" height="100" controls>
                                    <source src="{{ asset('public/videos/tips/')}}/{{$tips->file_name}}" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                                @else
                                    <img src="{{ asset('public/images/rides/not_found.png')}}" class="img-fluid" style="width:150px;height:100px;">
                                @endif
                                </div>
                                <div class="col-md-4"><strong>Tip Title </strong><br/><span>{{$tips->tip_title}}</span></div>
                                <div class="col-md-4"><strong>Current Status</strong><br/>
                                    @if($tips->status == 1)
                                        <button class="btn btn-success">Approved</button>
                                    @elseif($tips->status == 0)
                                        <button class="btn btn-warning">UnApproved</button>
                                    @else
                                        <button class="btn btn-danger">Rejected</button>
                                    @endif</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                        <strong>Added By </strong><br/><span>{{$tips->added_by}}</span>
                                </div>
                                <div class="col-md-4"><strong>Added On </strong><br/><span>{{$tips->added_on}}</span></div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-4"></div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                        <strong>Description </strong><br/>
                            <span>{{$tips->description}}</span>
                        </div>
                    </div>
               
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <button class="btn btn-primary" id="change_status" type="7" content="{{$tips->status}}" onclick="changeStatus('{{$tips->id}}')"><i class="fa fa-eye"></i>Change Status</button>
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
                        @foreach($tips->comments as $key => $comment)
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
