@extends('layouts.frontLayout.front-layout')

@section('title', 'Polls')

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

						<h2 class="page-heading">POLLS <small>{{ count($polls) }} Polls added</small></h2>

						<span class="ml-auto filter-block3 mob-filter"><a href="{{route('polls.create')}}" class="post-btn lg px-5">ADD NEW POLL</a></span>

					</div>

					<div class="d-flex align-items-center filter-details mb-4"></div>



					<div class="row">
						@if(count($polls) > 0)
						@foreach($polls as $key => $poll)
						<div class="col-12 mb-3 poll_refferer_{{$poll['id']}}">
							<h5 class="blue-heading mt-4 mb-3">{{$poll['poll_name']}}
								<small class="sml-txt d-block">Added on <strong>{{$poll['added_on']}}</strong></small>
							</h5>
							<div class="rides-block d-none d-md-flex">

								<div class="rider-details-block w-100 order-1 order-md-2">
								<div>

@if($poll['status']==1)

<span class="badge badge-pill badge-success">Approved</span>

@elseif($poll['status']==0)

<span class="badge badge-pill badge-warning">Pending for approval</span>

@elseif($poll['status']==2)

<span class="badge badge-pill badge-danger">Rejected</span>

@else

<span class="badge badge-pill badge-warning">UnApproved</span>

@endif

</div>
									@foreach($poll['questions'] as $newKey => $list)
									<div class="location-heading-block mt-2">
										<div class="poll-item">
											<h4 class="location-title"> {{$list['question']}}</h4>
											<div class="mt-2">
												@if(count($list['options']) > 0)
												<ul class="d-flex align-item-center option-list flex-wrap">
													@foreach($list['options'] as $key => $option)
													<li>{{$option}}</li>
													@endforeach
												</ul>
												@endif
											</div>
										</div>

										@if($newKey==0)
										<div class="prof-ride-menu ml-auto dropdown">

											<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

												<img src="{{ asset('public/rider/images/circles-menu.png')}}">

											</a>

											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

												<a class="dropdown-item" href="javascript:void(0)">Edit</a>

												<a class="dropdown-item remove_record" id="poll_refferer_{{$poll['id']}}" data-content="{{route('polls.destroy',$poll['id'])}}" href="javascript:void(0)">Remove</a>

											</div>

										</div>
										@endif
									</div>
									<hr class="full-h-line mx-0">
									@endforeach
							
										<div class="col-md-12" id="status_comment{{$key}}">

											@if(count($poll['status_comment']) > 0)
											<?php $i = 0; ?>
											<h4 class="page-sub-heading mt-4 mb-2">Comments
												<small>Got any shots on this way? Post here</small>
											</h4>
											<div class="comment-block scroll-div" style="max-height:250px;">
												@foreach($poll['status_comment'] as $comment)
												<div class="d-flex align-items-center location-block">

													<span class="time sml-txt-lg">By <span>Admin</span></span> <span class="time sml-txt-lg left-seperater">on <span>{{formatDate($comment['created_at'], 'd-M-Y')}}</span></span>

												</div>
												<div class="rider-overview mt-3 mt-lg-0">{{$comment['description']}}</div>
												<?php $i = $i + 1; ?>
												@if(count($poll['status_comment']) != $i)

												<hr class="full-h-line mx-0">

												@endif

												@endforeach


											</div>


											@endif

										</div>

									

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

		</div>

	</div>

</section>

@stop