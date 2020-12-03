@extends('layouts.frontLayout.front-layout')
@section('title', 'Suppliers')
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
						<h2 class="page-heading">SUPPLIERS <small>{{ count($suppliers) }} Suppliers added</small></h2>
						<span class="ml-auto filter-block3 mob-filter"><a href="{{route('suppliers.create')}}" class="post-btn  px-5">ADD NEW SUPPLIER</a></span>
					</div>
					<div class="d-flex align-items-center filter-details mb-4"></div>

					<div class="row">
					@if(count($suppliers) > 0)
						@foreach($suppliers as $key => $supplier)
							<div class="col-12 mb-3 supplier_referer_{{$supplier['id']}}">
								<div class="rides-block d-none d-md-flex">
									<div class="rider-img-block mr-md-3 ml-3 ml-md-0 order-2 order-md-1">
										<img src="{{ asset('public/images/supplier_images/')}}/{{ $supplier['supplier_image'] }}" class="img-fluid" width="250" height="180">
									</div>
									<div class="rider-details-block w-100 order-1 order-md-2">
										<div class="location-heading-block ">
											<div>
												<h4 class="location-title">{{ $supplier['supplier_name']}}</h4>
												<div class="d-flex align-items-center location-block">
													<span class="time">Added on <span>{{$supplier['created_at']}}</span></span></span>
												</div>
											</div>

											<div class="prof-ride-menu ml-auto dropdown">												
												<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<img src="{{ asset('public/rider/images/circles-menu.png')}}">
												</a>												
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">													
													<a class="dropdown-item" href="javascript:void(0)">Edit</a>													
													<a class="dropdown-item remove_record" id="supplier_referer_{{$supplier['id']}}" data-content="{{route('suppliers.destroy',$supplier['id'])}}" href="javascript:void(0)">Remove</a>
												</div>											
											</div>											
										</div>
										<div class="location-details d-flex align-items-center">
											<span class="rating">
												<i class="fa fa-star"></i>{{ $supplier['supplier_rating']}} <small>Rating</small>
											</span>
											<span class="rating">
												<i class="fa fa-home"></i>{{ $supplier['supplier_address']}} <small>Location</small>
											</span>
											@if($supplier['status']==1)
												<button class="btn btn-success" data-target="#status_comment{{$key}}" data-toggle="collapse">Approved</button>
											@elseif($supplier['status']==0)
												<button class="btn btn-dark">Pending</button>
											@elseif($supplier['status']==2)
												<button class="btn btn-danger">Rejected</button>
											@else
												<button class="btn btn-warning">UnApproved</button>
											@endif
										</div>
										<div class="col-md-12 collapse" id="status_comment{{$key}}">
											@if(count($supplier['status_comment']) > 0)						
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

														@foreach($supplier['status_comment'] as $comment)
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
										<div class="userdetails d-flex align-items-center">
											<span class="username">
												
												<span class="d-block">{{substr($supplier['supplier_description'], 0, 200)}}..</span>

												<span class="badge badge-warning">
													@if(!empty($supplier['spare_parts']))
													<div class="action" data-target="#spare_parts_content{{$key}}" data-toggle="collapse">
														<i class="fa fa-eye"></i><button class="btn btn-link">View Spare Parts</button>
													</div>
													@endif													
												</span>
											</span>
										</div>
										<div class="col-md-12 action_text collapse" id="spare_parts_content{{$key}}">
											@if(!empty($supplier['spare_parts']))
												@foreach($supplier['spare_parts'] as $spare_part)
													<div class="row">
														<div class="col-md-12">
															<img src="{{ asset('public/images/supplier/spare_parts/')}}/{{!empty($spare_part['image'])?$spare_part['image']:'not_found.png' }}" class="img-fluid" style="width:70px;height:70px;">
															<span class="">{{$spare_part['name']}}</span>
															<span class="rating">{{$spare_part['number']}}</span>
														</div>
													</div>													
												@endforeach
											@endif
										</div>
									</div>
								</div>
							</div>
						@endforeach
					@else
						<div class="col-12 mb-3"><h2 class="page-heading">Supplier is not available</h2></div>
					@endif		   
				</div>		   
			</div>
		</div>		
	</div>
</section>
@stop