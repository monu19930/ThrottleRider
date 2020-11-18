@extends('layouts.adminLayout.admin-layout')
@section('title', 'Rides')
@section('content')
<div class="container-fluid">
  <div class="row">
      @include('layouts.adminLayout.admin-sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">        
            <h2>Rides</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Rider Name</th>
                    <th>Profile</th>
                    <th>Start Location</th>
                    <th>Via Locations</th>
                    <th>End Location</th>          
                    <th>Total KMs</th>
                    <th>Number of People</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Rating</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($rides) > 0)
                    @foreach($rides as $key => $ride)
                        <tr>
                        <td><strong>{{$key+1}}.</strong></td>
                        <td>{{$ride['rider_name']}}</td>
                        <td>                  
                            <img src="{{ asset('public/images/rider_images')}}/{{$ride['profile']}}" class="img-fluid" width="100" height="100">
                        </td>
                        <td>{{$ride['start_location']}}</td>              
                        <td>{{$ride['end_location']}}</td>
                        <td>{{$ride['via_location']}}</td>
                        <td>{{$ride['total_km']}}</td>
                        <td>{{$ride['no_of_people']}}</td>
                        <td>{{$ride['start_date']}}</td>
                        <td>{{$ride['end_date']}}</td>
                        <td>
                        @if($ride['status']==1)
                            <button class="btn btn-success">Approved</button>
                        @elseif($ride['status']==0)
                            <button class="btn btn-warning">UnApproved</button>
                        @else
                            <button class="btn btn-danger">Rejected</button>
                        @endif  
                        </td>
                        <td>{{$ride['rating']}}</td>
                        <td>
                            <a href="{{route('admin.ride.view', $ride['id'])}}" class="">View</a>
                        </td>
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="13" style="text-align:center;color:red">Rides is not available</td>
                </tr>
                @endif           
                </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@stop
