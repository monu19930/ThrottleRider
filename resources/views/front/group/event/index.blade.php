@extends('layouts.frontLayout.front-layout')
@section('title', 'Events')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
			<h2 class="page-heading">
			  Group {{$group_name}} 
            </h2>
			<h4>Events</h4>
			<a href="{{route('my-groups.index')}}" class="href"> << Back </a>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1">{{ count($rides) }} Events Added</span><br/>
			</div>
			
                <a href="{{route('my-groups.events.create', $group_id)}}">Add New Event</a>
			
			<div class="row">
			  <!-- repeat div from here START -->
			@if(count($rides) > 0)
				@foreach($rides as $ride)
				<div class="col-12 mb-3">
				<div class="rides-block d-none d-md-flex">
					<div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
					<img src="{{ asset('public/images/groups/events/')}}/{{ $ride['ride_image'] }}" style="width: 200px; height: 150px;" class="img-fluid">
					</div>
					<div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
						<div>
						<h4 class="location-title">Ride To {{ $ride['end_location']}} Via {{$ride['via_location']}}</h4>
						<div class="d-flex align-items-center location-block">
							<span class="location">from {{ $ride['start_location']}}</span>
							<span class="time left-seperater">in month of <span>{{$ride['start_date']}}</span></span></span>
						</div>
						</div>
						<div class="bookmark ml-auto">
							<a href="#"><i class="fa fa-bookmark-o"></i></a>
							<a href="javascript:void(0)"><i class="fa fa-remove"></i></a>
						</div>
					</div>
					<div class="location-details d-flex align-items-center">
						<span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
						<span class="other-details"><i class="fa fa-map-o"></i>{{$ride['total_km']}} km <small>from {{ $ride['start_location']}}</small></span>
						<span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
						<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					</div>
					<div class="userdetails d-flex align-items-center">
						
						<span class="username">
						<span class="d-block">{{$ride['description']}}</span>
						<span class="badge badge-warning"></span>
						</span>
					</div>
					</div>
				</div>
				<!-- <mobile div start from here -->
				<div class="rides-block flex-column d-md-none">
				<div class="d-flex"> 
				<div class="rider-details-block w-100 ">
					<div class="location-heading-block ">
						<div>
						<div class="location-details  p-0">
						<span class="rating d-flex align-items-center"><i class="fa fa-star"></i>4.5 <small class="ml-2">Rating</small></span>
						</div>
						<h4 class="location-title my-2">Ride To {{ $ride['end_location']}} Via {{$ride['via_location']}}</h4>
						<div class="d-flex align-items-center location-block mb-2">
							<!-- <span class="location">Banglore, Karnatka, India</span> -->
							<span class="time">in month of <span>June 2019</span></span></span>
						</div>
						<div class="location-details d-flex align-items-center ">
						
						<span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from {{$ride['start_location']}}</small></span>
						<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
						<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
						</div>
						</div>
						
					</div>
					
					
				</div>
				<div class="rider-img-block ml-3 ">
					<img src="{{ asset('public/images/groups/events/')}}/{{ $ride['ride_image'] }}" class="img-fluid">
				</div>
				</div>
				<div class="d-flex align-items-center mt-1">
					<div class="userdetails d-flex align-items-center">
					<span class="userimg mr-2"><img src="{{ asset('public/rider/images/userpic.png')}}" class="img-fluid" /></span>
					<span class="username">
					<span class="d-block">Ekene Obasey</span>
					<span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span>
					</span>
					</div> 
					<div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
				</div>
				</div>
				<!-- <mobile div END here -->
				</div>
				@endforeach
			@else
				<div class="col-12 mb-3">
					<h2 class="page-heading">Event is not available</h2>
				</div>
			@endif		   
			</div>		   
		  </div>
		</div>
		<div class="col-md-4 d-none d-md-block">
		@include('layouts.frontLayout.profile-sidebar')
		</div>
	  </div>
	</div>
  </section>
@stop