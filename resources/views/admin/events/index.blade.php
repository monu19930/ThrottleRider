@extends('layouts.adminLayout.admin-layout')
@section('title', 'Events')
@section('content')
<div class="container-fluid">
  <div class="row">
      @include('layouts.adminLayout.admin-sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">        
            <h2>Events</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Start Location</th>
                    <th>Via Locations</th>
                    <th>End Location</th>          
                    <th>Total KMs</th>
                    <th>Number of People</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($events) > 0)
                        @foreach($events as $key => $event)
                        <tr>
                        <td><strong>{{$key+1}}.</strong></td>                    
                        <td>{{$event['start_location']}}</td>              
                        <td>{{$event['end_location']}}</td>
                        <td>{{$event['via_location']}}</td>
                        <td>{{$event['total_km']}}</td>
                        <td>{{$event['no_of_people']}}</td>
                        <td>{{$event['start_date']}}</td>
                        <td>{{$event['end_date']}}</td>
                        <td>
                        @if($event['status']==1)
                            <button class="btn btn-success">Approved</button>
                        @elseif($event['status']==0)
                            <button class="btn btn-warning">UnApproved</button>
                        @else
                            <button class="btn btn-danger">Rejected</button>
                        @endif
                        </td>
                        <td>
                            <a href="{{route('admin.event.view',$event['id'])}}" class="href">View</a>
                        </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" style="text-align:center;color:red">Event not available</td>
                        </tr>
                    @endif      
                </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@stop
