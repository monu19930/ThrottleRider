@extends('layouts.adminLayout.admin-layout')
@section('title', 'Bikes')
@section('content')
<div class="container-fluid">
  <div class="row">
      @include('layouts.adminLayout.admin-sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">        
            <h2>Bikes</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Model Name</th>
                    <th>Image</th>
                    <th>Total Rides</th>
                    <th>Total KMs Driven</th>
                    <th>Status</th>
                    <th>Rating</th>
                    <th>Added Date</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($bikes) > 0)
                    @foreach($bikes as $key => $bike)
                    <tr>
                    <td><strong>{{$key+1}}.</strong></td>
                    <td>{{$bike['name']}}</td>
                    <td>                  
                        <img src="{{ asset('public/images/rider/bikes/')}}/{{$bike['image']}}" class="img-fluid" width="100" height="100">
                    </td>
                    <td>{{$bike['total_rides']}}</td>
                    <td>{{$bike['total_km']}}</td>
                    <td>
                    @if($bike['status']==1)
                        <button class="btn btn-success">Approved</button>
                    @elseif($bike['status']==0)
                        <button class="btn btn-warning">UnApproved</button>
                    @else
                        <button class="btn btn-danger">Rejected</button>
                    @endif
                    </td>
                    <td>{{$bike['rating']}}</td>
                    <td>{{$bike['added_on']}}</td>
                    <td>
                        <a href="{{route('admin.bike.view', $bike['id'])}}">View</a>
                    </td>
                    </tr>
                    @endforeach
                @else
                    <tr colspan="9" style="color:red;text-align:center;">Bike is not available</tr>
                @endif
                </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@stop
