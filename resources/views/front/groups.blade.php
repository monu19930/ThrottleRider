@extends('layouts.frontLayout.front-layout')
@section('title', 'Groups');
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8" id="search_res">
		  <div class="cust-left-block">
			<h2 class="page-heading">
			  Groups
			</h2>
			<div class="d-flex align-items-center filter-details mb-4">			
			  
			</div>
			
			  <!-- repeat div from here START -->
              <div class="col-md-12">
				  <div class="row">
			@if(count($groups) > 0)
				@foreach($groups as $group)			   
			 <div class="col-md-6 mt-2">
				<div class="top-riders-block">
				 <div class="card" >
				   <img src="{{ asset('public/images/group_images/')}}/{{$group['group_image']}}" class="card-img-top" alt="">
				   <div class="card-body position-relative">
					 <img src="{{ asset('public/images/rider_images/')}}/{{$group['rider_image']}}" class="user-pic" widtj="60" height="60"/>
					 <div class="username mb-2  d-md-none">
					   <span class="badge badge-warning"><i class="fa fa-star"></i> 4.5</span> 
					 </div>
					 <h3 class="user-name">{{$group['group_name']}}<small class="sml-txt">{{$group['city']}}</small></h3>
					 <div class="location-details py-4 d-flex align-items-center">
					   <span class="rating d-none d-md-block"><i class="fa fa-star"></i> {{$group['group_rating']}} <small>Rating</small></span>
					   <span class="other-details"><i class="fa fa-calendar-o"></i>{{$group['total_rides']}} <small>Rides</small></span>
					   <span class="other-details"><i class="fa fa-map-o"></i> {{$group['total_km']}} km <small>Driven</small></span>
					   <div class="d-flex followers-block align-items-center">
						@foreach($group['group_member_list'] as $group_member_list)
						 	<span class="follow-users">
								 <img src="{{ asset('public/images/rider_images/')}}/{{!empty($group_member_list) ? $group_member_list:'rider.jpg'}}" class="profile-pic" /></span>
						 @endforeach
						 
						 @if($group['total_group_members'] > 0)
						 <span class="joined-grp">{{$group['total_group_members']}} People<small>Joined the group</small></span>
						 @endif
					   </div>
					 </div>
					 
					 <div class="d-flex group_{{$group['group_owner_id']}}">
						@if($group['current_rider_join_status'] == false)
							<button class="join-btn flex-grow-1 mt-2 mr-1 join-group-{{$group['group_owner_id']}}" onclick="joinGroup('<?=$group['group_owner_id']?>')" @if($group['is_group_owner'] == true) disabled @endif>
							<i class="fa fa-send mr-2"></i>Join
							</button>
						@else
							<button class="join-btn flex-grow-1 mt-2 mr-1 leave-group-{{$group['group_owner_id']}}" onclick="leaveGroup('<?=$group['group_owner_id']?>')">
							<i class="fa fa-minus mr-2"></i>Cancel</button>
							<!-- <button class="join-btn flex-grow-1 mt-2 mr-1 view-feedback-poll" data-content="{{$group['group_owner_id']}}" >
							<i class="fa fa-send mr-2"></i>Polls</button> -->
						@endif

						@if($group['current_rider_follow_status'] == false)
							<button class="follow-btn flex-grow-1 mt-2 ml-1 follow-group-{{$group['group_owner_id']}}" onclick="followGroup('<?=$group['group_owner_id']?>')" @if($group['is_group_owner']==true) disabled @endif>
							<i class="fa fa-plus mr-2"></i>Follow</button>
						@else
							<button class="follow-btn flex-grow-1 mt-2 ml-1 unfollow-group-{{$group['group_owner_id']}}" onclick="unFollowGroup('<?=$group['group_owner_id']?>')">
							<i class="fa fa-minus mr-2"></i>Unfollow</button>
						@endif
				   
				   </div>
				   
				   </div>
				 </div>
				</div>
			 </div>
			 @endforeach
			@else
				Groups Not available
			@endif
		   </div>
              </div>
		   
			</div>
		   
		  </div>
		
		<div class="col-md-4 d-none d-md-block">
		  <div class="right-block">
			<button class="post-btn w-100 mb-3">POST A RIDE
			@guest
				<small>LOGIN REQUIRED</small>
			@endguest
			</button>
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