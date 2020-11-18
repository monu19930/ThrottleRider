@extends('layouts.adminLayout.admin-layout')
@section('title', 'Riders')
@section('content')
<div class="container-fluid">
  <div class="row">
      @include('layouts.adminLayout.admin-sidebar')
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">        
            <h2>Riders</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>              
                        <th>Riding Year</th>
                        <th>Total Rides</th>
                        <th>Total KMs Driven</th>
                        <th>Status</th>
                        <th>Rating</th>
                        <th>Added Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($riders) > 0)
                        @foreach($riders as $key => $rider)
                        <tr>
                        <td><strong>{{$key+1}}.</strong></td>
                        <td>{{$rider['name']}}</td>
                        <td>{{$rider['email']}}</td>
                        <td>                  
                            <img src="{{ asset('public/images/rider_images')}}/{{$rider['image']}}" class="img-fluid" width="100" height="100">
                        </td>
                        <td>{{$rider['riding_year']}}</td>              
                        <td>{{$rider['total_rides']}}</td>
                        <td>{{$rider['total_km']}}</td>
                        <td>
                        @if($rider['status']==1)
                            <button class="btn btn-success">Approved</button>
                        @elseif($rider['status']==0)
                            <button class="btn btn-dark">Pending</button>
                        @elseif($rider['status']==2)
                            <button class="btn btn-warning">UnApprove</button>
                        @else
                            <button class="btn btn-danger">Rejected</button>
                        @endif
                        </td>                    
                        <td>{{$rider['rating']}}</td>
                        <td>{{$rider['added_on']}}</td>
                        <td>
                            <a href="{{route('admin.rider.view', $rider['id'])}}" class=""><i class="fa fa-eye"></i>View</a>
                        </td>
                        </tr>
                        @endforeach
                    @else
                        <tr colspan="11" style="color:red;text-align:center;">Rider is not available</tr>
                    @endif             
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@stop
