@extends('layouts.frontLayout.front-layout')
@section('title', 'Polls')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
			<h2 class="page-heading">
			  Polls List
			</h2>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1">{{ count((array)$polls) }} Poll Added</span><br/>
			</div>
            <span>
				<!-- <button class="btn btn-success" data-toggle="modal" data-target="#pollModal">Add New Poll</button> -->
				<a href="{{route('polls.create')}}" class="href">Add New Poll</a>
            </span>
			<div class="row">
			@if(count((array)$polls) > 0)
				@foreach($polls as $key => $poll)
				<div class="col-12 mb-3 poll_refferer_{{$poll['id']}}">
				<div class="rides-block d-none d-md-flex">					
					<div class="rider-details-block w-100 order-1 order-md-2">
					<div class="location-heading-block ">
						<div class="poll-item">
						<h4 class="location-title">{{ $poll['poll_name']}}</h4>
						<div class="d-flex align-items-center location-block">
							<span class="time">Added on <span>{{$poll['added_on']}}</span></span></span><br/>
						</div>
						<div>
							@if(count($poll['options']) > 0)
							<h4 class="location-title">Options</h4>
							<ul>
								@foreach($poll['options'] as $key => $option)
								<li>{{$option}}</li>
								@endforeach
							</ul>
							@endif
						</div>
						<div>
							@if($poll['status']==1)
								<button class="btn btn-success" data-target="#status_comment{{$key}}" data-toggle="collapse">Approved</button>
							@elseif($poll['status']==0)
								<button class="btn btn-dark">Pending</button>
							@elseif($poll['status']==2)
								<button class="btn btn-danger">Rejected</button>
							@else
								<button class="btn btn-warning">UnApproved</button>
							@endif
						</div>
						<div class="col-md-12 collapse" id="status_comment{{$key}}">
							@if(count($poll['status_comment']) > 0)						
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

										@foreach($poll['status_comment'] as $comment)
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
						<div class="bookmark ml-auto">
							<a href="javascript:void(0)"><i class="fa fa-edit"></i></a>
							<a class="remove_record" style="cursor:pointer" id="poll_refferer_{{$poll['id']}}" data-content="{{route('polls.destroy',$poll['id'])}}"><i class="fa fa-remove"></i></a>
						</div>
					</div>
					<div class="location-details d-flex align-items-center"></div>
					
					</div>
				</div>
				</div>
				@endforeach
			@else
				<div class="col-12 mb-3">
					<h2 class="page-heading">Poll is not available</h2>
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