@extends('layouts.frontLayout.front-layout')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8" id="search_res">
		  <div class="cust-left-block">
			<h2 class="page-heading">
			  Bikers
			</h2>
			<div class="d-flex align-items-center filter-details mb-4">			
			  <span class="ml-auto filter-block3 mob-filter"><a href="#">View all Bikers</a></span>
			</div>
			
			  <!-- repeat div from here START -->
              <div class="top-riders-slider slider  mb-2">
			@if(count($riders) > 0)
				@foreach($riders as $rider)
				<div class="slide">
					<div class="top-riders-block">
					<div class="card" >
					<img src="{{ asset('public/rider/images/top-rider1.png')}}" class="card-img-top" alt="">
					<div class="card-body position-relative">
						<img src="{{ asset('public/images/rider_images/')}}/{{$rider['rider_image']}}" class="user-pic" widtj="60" height="60"/>
						<div class="username mb-2">
						<span class="badge badge-warning d-md-none"><i class="fa fa-star"></i> {{$rider['rating']}}</span> 
						</div>
						
						<h3 class="user-name">{{$rider['rider_name']}}<small>{{$rider['rider_email']}}</small></h3>
						<blockquote class="blockquote-block d-none d-md-block">“{{$rider['description']}}”</blockquote>
						<div class="location-details d-flex align-items-center">
						<span class="rating pl-0 d-none d-md-inline-block">{{$rider['rating']}} <small>Rating</small></span>
						<span class="other-details pl-0">{{$rider['total_rides']}} <small>Rides</small></span>
						<span class="other-details pl-0">{{$rider['total_km']}} km <small>Driven</small></span>
						
						</div>
						<button class="follow-btn w-100 mt-2"><i class="fa fa-plus mr-2"></i>FOLLOW</button>
					</div>
					</div>
					</div>
				</div>
				@endforeach			 
			@else
				Bikers Not available
			@endif
		   </div>
		   
			</div>
		   
		  </div>
		
		<div class="col-md-4 d-none d-md-block">
		  <div class="right-block">
			<button class="post-btn w-100 mb-3">POST A RIDE<small>LOGIN REQUIRED</small></button>
			<div class="card mt-2 mb-3 border-0"  >
			 <ul class="list-group list-group-flush cust-notify">
			   <li class="list-group-item"><h4 class="notify-heading">Notifications</h4></li>
			   <li class="list-group-item">
				 <div class="notify-title">Title of notification</div>
				 <p class="notify-txt">The kit consists of more than a hundred ready-to-use elements that you… <a href="">more</a></p>
				 <span class="right-arrow"><i class="fa fa-angle-right"></i></span>
			   </li>
			   <li class="list-group-item">
				 <div class="notify-title">Title of notification</div>
				 <p class="notify-txt">The kit consists of more than a hundred ready-to-use elements that you… <a href="">more</a></p>
				 <span class="right-arrow"><i class="fa fa-angle-right"></i></span>
			   </li>
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