@extends('layouts.adminLayout.admin-layout')
@section('title', 'Supplier Details')
@section('content')
<div class="container-fluid">
  <div class="row">
      @include('layouts.adminLayout.admin-sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">        
            <h4>Supplier Details</h4>
            <strong><a href="{{route('admin.suppliers')}}" class=""><< Back</a> </strong>
            <div class="row mt-5">                
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ asset('public/images/supplier_images')}}/{{$suppliers->supplier_image}}" class="img-fluid" width="100" height="100">                                    
                                </div>
                                <div class="col-md-4"><strong>Supplier Name </strong><br/><span>{{$suppliers->supplier_name}}</span></div>
                                <div class="col-md-4"><strong>Supplier Address </strong><br/><span>{{$suppliers->supplier_address}}</span></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4"><strong>Added By </strong><br/><span>{{$suppliers->supplier_owner}}</span></div>
                                <div class="col-md-4"><strong>Added On </strong><br/><span>{{$suppliers->added_on}}</span></div>
                                <div class="col-md-4"><strong>Rating </strong><br/><span>{{$suppliers->supplier_rating}}</span></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-4">
                                    <strong>Current Status</strong><br/>
                                    @if($suppliers->status == 1)
                                        <button class="btn btn-success">Approved</button>
                                    @elseif($suppliers->status == 0)
                                        <button class="btn btn-warning">UnApproved</button>
                                    @else
                                        <button class="btn btn-danger">Rejected</button>
                                    @endif
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                <strong>Description </strong><br/>
                                 <span>{{$suppliers->supplier_description}}</span>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <strong>Spare Parts List</strong>
                            @if(count($suppliers->spare_parts) > 0)
                                @foreach($suppliers->spare_parts as $key => $spare_part)
                                <div class="row">
                                    <div class="col-md-4 mt-2">
                                        <img src="{{ asset('public/images/supplier/spare_parts/')}}/{{$spare_part['image']}}" class="img-fluid" width="100" height="100">
                                        <br/>
                                        <span>{{$spare_part['name']}}</span>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <br/><span>Not available</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <button class="btn btn-primary" id="change_status" type="6" content="{{$suppliers->status}}" onclick="changeStatus('{{$suppliers->id}}')"><i class="fa fa-eye"></i>Change Status</button>
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
                        @foreach($suppliers->comments as $key => $comment)
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
