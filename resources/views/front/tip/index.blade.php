@extends('layouts.frontLayout.front-layout')
@section('title', 'Tips')
@section('content')
<section class="left-main-bg">
	<div class="container ">
	  <div class="row">
	  	<div class="col-md-4 d-none d-md-block">
			@include('layouts.frontLayout.profile-sidebar')
		</div>
		<div class="col-md-8">
		  <div class="cust-left-block">
		  		<div class="d-flex align-items-center mt-4 mb-2">
					<h2 class="page-heading">TIPS <small>{{ count($tips) }} Tips added</small></h2>
					<span class="ml-auto filter-block3 mob-filter"><a class="post-btn  px-5" href="#" data-toggle="modal" data-target="#createTipModal" >ADD NEW TIP</a></span>
				</div>
				<div class="d-flex align-items-center filter-details mb-4"></div>
				
			<div class="row">
			@if(count($tips) > 0)
				@foreach($tips as $key => $tip)
				<div class="col-12 mb-3 tip_referer_{{$tip['id']}}">
				<div class="rides-block d-none d-md-flex">
					<div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
                        @if(!empty($tip['file_name']))
                        <video width="320" height="240" controls>
                            <source src="{{ asset('public/videos/tips/')}}/{{$tip['file_name'] }}" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                        @else
                            <img src="{{ asset('public/images/rides/not_found.png')}}" class="img-fluid" width="250" height="180">
                        @endif
					</div>
					<div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
						<div>
							<h4 class="location-title">{{ $tip['tip_title']}}</h4>
							<div class="d-flex align-items-center location-block">
								<span class="time">Added on <span>{{$tip['added_on']}}</span></span></span>
							</div>
						</div>

						<div class="prof-ride-menu ml-auto dropdown">												
							<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="{{ asset('public/rider/images/circles-menu.png')}}">
							</a>												
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">													
								<a class="dropdown-item" href="javascript:void(0)">Edit</a>													
								<a class="dropdown-item remove_record" id="tip_referer_{{$tip['id']}}" data-content="{{route('tips.destroy',$tip['id'])}}" href="javascript:void(0)">Remove</a>
							</div>											
						</div>
					</div>
					<div class="location-details d-flex align-items-center"></div>
					<div class="userdetails d-flex align-items-center">
						<span class="username">
						<span class="d-block">{{substr($tip['description'], 0, 200)}}..</span>
						<span class="badge badge-warning">
						</span>
						</span>
					</div>
					<div>
						@if($tip['status']==1)
							<button class="btn btn-success" data-target="#status_comment{{$key}}" data-toggle="collapse">Approved</button>
						@elseif($tip['status']==0)
							<button class="btn btn-dark">Pending</button>
						@elseif($tip['status']==2)
							<button class="btn btn-danger">Rejected</button>
						@else
							<button class="btn btn-warning">UnApproved</button>
						@endif
					</div>
					<div class="col-md-12 collapse" id="status_comment{{$key}}">
						@if(count($tip['status_comment']) > 0)						
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

									@foreach($tip['status_comment'] as $comment)
									<tr>
										<td>#.</td>
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
			@else
				<div class="col-12 mb-3">
					<h2 class="page-heading">Tip is not available</h2>
				</div>
			@endif		   
			</div>		   
		  </div>
		</div>		
	  </div>
	</div>
  </section>
@stop