@extends('layouts.frontLayout.front-layout')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
			<h2 class="page-heading">
			  My Bikes
			</h2>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1">{{ $bikes->count() }} Bikes Added</span><br/>
			  <button class="post-btn w-10 mb-3" data-toggle="modal" data-target="#bikeModal">Add New Bike</button>
			</div>
			
			<div class="row">
			  <!-- repeat div from here START -->
			@if($bikes->count() > 0)
				@foreach($bikes as $bike)
				<div class="col-12 mb-3">
				<div class="rides-block d-none d-md-flex">
					<div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
					<img src="{{ asset('public/images')}}/{{ $bike->image }}" class="img-fluid">
					</div>
					<div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
						<div>
						<h4 class="location-title">{{ $bike->name}}</h4>
						<div class="d-flex align-items-center location-block">
							<span class="location">Banglore, Karnatka, India</span>
							<span class="time left-seperater">in month of <span>June 2019</span></span></span>
						</div>
						</div>
						<div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
					</div>
					<div class="location-details d-flex align-items-center">
						<span class="rating"><i class="fa fa-star"></i>4.5 <small>Rating</small></span>
						<span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
						<span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span>
						<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
					</div>
					<div class="userdetails d-flex align-items-center">
						
						<span class="username">
						<span class="d-block">Information</span>
						<span class="badge badge-warning">
						</span>
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
						<h4 class="location-title my-2">Ooty, Banglore-Mysore Highway</h4>
						<div class="d-flex align-items-center location-block mb-2">
							<!-- <span class="location">Banglore, Karnatka, India</span> -->
							<span class="time">in month of <span>June 2019</span></span></span>
						</div>
						<div class="location-details d-flex align-items-center ">
						
						<span class="other-details"><i class="fa fa-map-o"></i>2176 km <small>from bengaluru</small></span>
						<!-- <span class="other-details"><i class="fa fa-calendar-o"></i>12 <small>Days trip</small></span> -->
						<span class="other-details"><i class="fa fa-road"></i>Highway <small>Road Type</small></span>
						</div>
						</div>
						
					</div>
					
					
				</div>
				<div class="rider-img-block ml-3 ">
					<img src="{{ asset('public/rider/images/mobe_byke.png')}}" class="img-fluid">
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
			@endif		   
			</div>		   
		  </div>
		</div>
		<div class="col-md-4 d-none d-md-block">
		  <div class="right-block">
			<button class="post-btn w-100 mb-3">{{Auth::user()->name}}</button>
			<div class="card mt-2 mb-3 border-0"  >
			 <ul class="list-group list-group-flush cust-notify">
			   <li class="list-group-item"><h4 class="notify-heading">Profile</h4></li>
			   <li class="list-group-item"><h4 class="notify-heading">Rides</h4></li>
			   <li class="list-group-item"><h4 class="notify-heading">Bikes</h4></li>
			   <li class="list-group-item"><h4 class="notify-heading">Groups</h4></li>
			 </ul>
		   </div>
		   <div class="card mt-4 mb-3 border-0"  >
			 <div class="card-body text-center">
			   <div class="badge-icon"><img src="{{ asset('public/rider/images/badge.png')}}"></div>
			   <div class="badge-status">Current status of Badge</div>
			   <p class="badge-txt">Also we’ll show the available points in your account here.</p>
			 </div>
		   </div>
		   <div class="sponser-ads"><span>SPONSERED ADS</span></div>
		  </div>
		</div>
	  </div>
	</div>
  </section>
@stop