@extends('layouts.frontLayout.front-layout')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
			<h2 class="page-heading">My Groups</h2>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1">{{ count((array)$result) }} Groups Added</span><br/>
			</div>
            <a href="{{route('groups.create')}}">Add New Groups</a>
			<div class="row">
			  <!-- repeat div from here START -->
			@if(count((array)$result) > 0)
				@foreach($result as $key => $group)
				@php
					$group = (object)$group;
				@endphp
				<div class="col-12 mb-3">
				<div class="rides-block d-none d-md-flex">
					<div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
					<img src="{{ asset('public/images/group_images/')}}/{{$group->group_image}}" class="img-fluid" style="width:350px;height:150px;">
					</div>
					<div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
						<div>
						<h4 class="location-title">{{$group->group_name}} </h4>
						<div class="d-flex align-items-center location-block">
							<span class="time">Added on <span>{{$group->added_on}}</span></span></span>
						</div>
						</div>
						<div class="bookmark ml-auto">
							<a href="javascript:void(0)"><i class="fa fa-edit"></i></a>
							<a href="javascript:void(0)"><i class="fa fa-remove"></i></a>
						</div>
					</div>
					<div class="location-details d-flex align-items-center">
						<span class="rating"><i class="fa fa-star"></i>{{ $group->group_rating}} <small>Rating</small></span>
						<div class="d-flex followers-block align-items-center">
						@foreach($group->group_member_list as $group_member_list)
						 	<span class="follow-users"><img src="{{ asset('public/images/rider_images/')}}/{{!empty($group_member_list)?$group_member_list:'rider.jpg'}}" class="profile-pic" /></span>
						 @endforeach
						 
						 @if($group->total_group_members > 0)
						 <span class="joined-grp">{{$group->total_group_members}} People<small>Joined the group</small></span>
						 @endif
					   </div>
						<button class="btn btn-primary invite-member" onclick="inviteMembers('{{$group->id}}')"><i class="fa fa-send"></i>Invite</button>
						<button class="btn btn-link invite-member"><a href="{{route('group.events',$group->id)}}">Add Event</a></button>
						
						@if($group->status==1)
                            <button class="btn btn-success" data-target="#status_comment{{$key}}" data-toggle="collapse">Approved</button>
						@elseif($group->status==0)
							<button class="btn btn-dark">Pending</button>
						@elseif($group->status==2)
							<button class="btn btn-danger">Rejected</button>
						@else
							<button class="btn btn-warning">UnApproved</button>
						@endif					
					</div>
					
					<div class="userdetails d-flex align-items-center">						
						<span class="username">
							<span class="d-block">{{$group->group_desc}}</span>
							<span class="badge badge-warning">
								<button class="btn btn-link group_past_experience" content="{{$group->id}}">
									<i class="fa fa-plus-circle"></i>Past Experience
								</button>
							</span>
						</span>
						<span class="username">
							<span class="badge badge-warning">								
								@if(!empty($group->past_experience))
								<div class="action" data-target="#content{{$key}}" data-toggle="collapse">
									<button class="btn btn-link"><i class="fa fa-eye"></i>Past Experience</button>
								</div>
								@endif
								<div class="action">
									@if($group->total_group_members > 0)
										<button class="btn btn-link" onclick="shareContact('{{$group->id}}')"><i class="fa fa-share"></i>Contact</button>
									@endif
								</div>
							</span>
						</span>
					</div>
					<div class="col-md-12 action_text collapse" id="content{{$key}}">
					@if(!empty($group->past_experience))
						<div class="row">
							<div class="col-md-12">
								<span class="rating">{{$group->past_experience['title']}}</span>
								<div class="d-flex align-items-center location-block">
									<span class="time">Added on <span>{{$group->added_on}}</span></span></span>
								</div>
								<span class="d-block">{{$group->past_experience['description']}}</span>
							</div>
						</div>
					@endif
				</div>

				<div class="col-md-12 collapse" id="status_comment{{$key}}">
						@if(count($group->status_comment) > 0)						
						<div class="table-responsive mt-5">
							<table class="table table-striped table-sm">
								<thead>
									<tr>
									<th>#</th>                        
									<th>Comment</th>
									<th>Added On</th>
									</tr>
								</thead>
								<tbody>
									@foreach($group->status_comment as $key => $comment)
										<tr>
											<td>{{$i++}}.</td>
											<td>{{$comment['description']}}</td>
											<td>{{formatDate($comment['created_at'], 'd-M-Y')}}</td>
										</tr>
									@endforeach
									
									@php
									$i=1;
									@endphp      
								</tbody>
							</table>
						</div>
						@endif						
					</div>

					</div>
				</div>
				</div>
				@endforeach
			@else
				<div class="col-12 mb-3">
					<h2 class="page-heading">Group is not available</h2>
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