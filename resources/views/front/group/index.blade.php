@extends('layouts.frontLayout.front-layout')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
			<h2 class="page-heading">My Groups</h2>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1">{{ count($result) }} Groups Added</span><br/>
			</div>
            <a href="{{route('add-group')}}">Add New Groups</a>
			<div class="row">
			  <!-- repeat div from here START -->
			@if(count($result) > 0)
				@foreach($result as $group)
				<div class="col-12 mb-3">
				<div class="rides-block d-none d-md-flex">
					<div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
					<img src="{{ asset('public/images/group_images/')}}/{{$group['group_image']}}" class="img-fluid" style="width:350px;height:150px;">
					</div>
					<div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
						<div>
						<h4 class="location-title">{{$group['group_name']}} </h4>
						<div class="d-flex align-items-center location-block">
							<span class="time left-seperater">Added on <span>{{$group['added_on']}}</span></span></span>
						</div>
						</div>
						<div class="bookmark ml-auto"><a href="#"><i class="fa fa-bookmark-o"></i></a></div>
					</div>
					<div class="location-details d-flex align-items-center">
						<span class="rating"><i class="fa fa-star"></i>{{ $group['group_rating']}} <small>Rating</small></span>
						<div class="d-flex followers-block align-items-center">
						@foreach($group['group_member_list'] as $group_member_list)
						 	<span class="follow-users"><img src="{{ asset('public/images/rider_images/')}}/{{!empty($group_member_list)?$group_member_list:'rider.jpg'}}" style="height: 25px; width:25px;" /></span>
						 @endforeach						 
						 <span class="joined-grp">{{$group['total_group_members']}} People<small>Joined the group</small></span>
					   </div>
						<button class="btn btn-primary invite-member" onclick="inviteMembers('<?=$group['id']?>')"><i class="fa fa-send"></i>Invite</button>
						<button class="btn btn-link invite-member"><a href="{{route('group.events',$group['id'])}}">Add Event</a></button>						
					</div>
					<div class="userdetails d-flex align-items-center">						
						<span class="username">
							<span class="d-block">{{$group['group_desc']}}</span>
							<span class="badge badge-warning"></span>
						</span>
					</div>
					</div>
				</div>
				</div>
				@endforeach
			@else
				<div class="col-12 mb-3">
					<h2 class="page-heading">Rides is not available</h2>
				</div>
			@endif		   
			</div>		   
		  </div>
		</div>
		<div class="col-md-4 d-none d-md-block">
		  <div class="right-block">
		  <img src="{{ asset('public/images/rider_images/rider.jpg')}}" style="position: relative;margin-left:50px;"class="img-circle" alt="Cinque Terre" width="200" height="180">
			<div class="card mt-2 mb-3 border-0"  >
			 <ul class="list-group list-group-flush cust-notify">
			   <li class="list-group-item">
				   <h4 class="notify-heading">
				   <a href="{{route('my-profile')}}">Profile</a>
					</h4>
				</li>
			   <li class="list-group-item">
				   <h4 class="notify-heading">
					   <a href="{{ route('rides')}}">Rides</a>
					</h4>
				</li>
			   <li class="list-group-item">
				   
			   	<h4 class="notify-heading">
					<a href="{{ route('bikes')}}">Bikes</a>
				</h4>
				</li>
			   <li class="list-group-item"><h4 class="notify-heading"><a href="{{ route('groups')}}">Groups</a></h4></li>
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