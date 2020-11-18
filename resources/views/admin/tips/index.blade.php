@extends('layouts.adminLayout.admin-layout')
@section('title', 'Tips')
@section('content')
<div class="container-fluid">
  <div class="row">
      @include('layouts.adminLayout.admin-sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">        
            <h2>Tips List</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>File</th>
                    <th>Description</th>
                    <th>Added By</th>
                    <th>Added On</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($tips) > 0)
                        @foreach($tips as $key => $tip)
                        <tr>
                        <td><strong>{{$key+1}}.</strong></td>           
                        <td>{{$tip['tip_title']}}</td>
                        <td>
                        @if(!empty($tip['file_name']))
                        <video width="150" height="100" controls>
                            <source src="{{ asset('public/videos/tips/')}}/{{$tip['file_name']}}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                        @else
                            <img src="{{ asset('public/images/rides/not_found.png')}}" class="img-fluid" style="width:150px;height:100px;">
                        @endif
                        </td>
                        <td>{{$tip['description']}}</td>
                        <td>{{$tip['added_by']}}</td>
                        <td>{{$tip['added_on']}}</td>
                        <td>
                        @if($tip['status']==1)
                            <button class="btn btn-success">Approved</button>
                        @elseif($tip['status']==0)
                            <button class="btn btn-warning">UnApproved</button>
                        @else
                            <button class="btn btn-danger">Rejected</button>
                        @endif   
                        </td>                        
                        <td>
                            <a href="{{route('admin.tip.view', $tip['id'])}}">View</a>
                        </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" style="text-align:center;color:red">Tip is not available</td>
                        </tr>
                    @endif      
                </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@stop
