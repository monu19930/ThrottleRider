@extends('layouts.adminLayout.admin-layout')
@section('title', 'Groups')
@section('content')
<div class="container-fluid">
  <div class="row">
      @include('layouts.adminLayout.admin-sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">        
            <h2>Groups</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Group Name</th>
                        <th>Image</th>
                        <th>Rating</th>
                        <th>Total KM</th>
                        <th>Total Rides</th>
                        <th>Total Members Joined</th>
                        <th>Created Date</th>
                        <th>Status</th>
                        <th>Group Owner</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($groups) > 0)
                        @foreach($groups as $key => $group)
                        <tr>
                        <td><strong>{{$key+1}}.</strong></td>
                        <td>{{$group['group_name']}}</td>
                        <td>                  
                            <img src="{{ asset('public/images/group_images/')}}/{{$group['group_image']}}" class="img-fluid" width="100" height="100">
                        </td>
                        <td>{{$group['group_rating']}}</td>
                        <td>{{$group['total_km']}}</td>
                        <td>{{$group['total_rides']}}</td>
                        <td>{{$group['joined_people']}}</td>
                        <td>{{$group['added_on']}}</td>
                        <td>
                        @if($group['status']==1)
                            <button class="btn btn-success">Approved</button>
                        @elseif($group['status']==0)
                            <button class="btn btn-warning">UnApproved</button>
                        @else
                            <button class="btn btn-danger">Rejected</button>
                        @endif
                        </td>
                        <td>{{$group['group_owner']}}</td>
                        <td>
                        <a href="{{route('admin.group.view', $group['id'])}}" class=""><i class="fa fa-eye"></i>View</a>
                        </td>
                        </tr>
                        @endforeach
                    @else
                        <tr colspan="11" style="color:red;text-align:center;">Group is not available</tr>
                    @endif            
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@stop
