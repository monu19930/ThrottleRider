
<div class="col-12">
	<div class="cust-left-block">
		<h2 class="page-heading">
			Review Bike Information
		</h2>
		<div class="d-flex align-items-center filter-details mb-4">
			<span class="filter-block1">Verify Information you've entered and submit</span>
		</div>
		<div class="row">
			<div class="col-12 mb-3 review-bike-selected">
				<div class="review-more-details">
					<h4>Bike Selected</h4>
					<a href="javascript:void(0)" class="review-details" onclick="reviewBikeDetails()">Change Bike</a>
				</div>
				<div>
					<img src="http://localhost/gull-html-laravel/public/images/bike_models/{{$result['bike_model_image']}}" id="review_bike_image" width="200" height="200">
					<h4 class="review-h4 review-bike-name">{{$result['bike_details']['name']}}</h4>
				</div>
			</div>

			<div class="col-md-12" id="review_bike_change" style="display:none;">
				<button type="button">
					<span aria-hidden="true" onclick="cancelReviewBikeChange()">&times;</span>
				</button>
				<div class="row">					
					<div class="col-md-6">
						<form id="addReviewBikeForm1" method="post">
							@if(isset($result['bike_id']))
								<input type="hidden" name="id" content="{{$result['bike_id']}}">
							@endif
							<div class="alert alert-danger print-error-msg" style="display:none">
								<ul></ul>
							</div>
							<div class="login-input">
								<div class="form-group">                                        
									<input type="text" class="form-control" autocomplete="off" value="{{$result['bike_details']['name']}}" name="name" id="review_bike_list" placeholder="Search for bike brand or model name">
								</div>
							</div>
							
							<div class="d-flex align-items-center filter-details mb-4">
								<span class="filter-block1"> or Choose from following brands</span>
							</div>
							<div class="row">
								@foreach($result['brands'] as $brand)
									<div class="col-3">
										<img src="http://localhost/gull-html-laravel/public/images/bike_brands/{{$brand->logo}}" onclick="showReviewBikeModelList('{{$brand->id}}')" width="100" height="80"/>
									</div>
								@endforeach
							</div>                                
						</form>
					</div>
					<div class="col-md-6">						
						<div class="selected_bike">
							<img src="http://localhost/gull-html-laravel/public/images/bike_models/{{$result['bike_model_image']}}" alt="" width="200" height="200" id="review_selected_bike"/>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<button type="button" onclick="submitReviewBikeChangeStep()" class="btn btn-danger w-50"> SAVE</button>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12 mb-3 review-bike-image-selected">
				<div class="review-more-details">
					<h4>Images</h4>					
					<a href="javascript:void(0)" class="review-details" onclick="reviewBikeImagesDetails()">Add or Remove Images</a>
				</div>
				<div class="form-group review_bike_images_list">					
					@if(isset($result['bike_details']['image']))
						@foreach($result['bike_details']['image'] as $image)
							<img src="{{ asset('public/images/rider/bikes/')}}/{{ $image }}" width="200" height="200">
						@endforeach
					@elseif(isset($result['images']))
						@foreach($result['images'] as $image)
							<img src="{{ asset('public/images/rider/bikes/')}}/{{ $image }}" width="200" height="200">
						@endforeach					
					@endif
				</div>
			</div>

			<div class="col-12 mb-3" id="review_bike_images_change" style="display:none">
				<button type="button">
					<span aria-hidden="true" onclick="cancelReviewBikeImagesChange()">&times;</span>
				</button>
				<form id="addReviewBikeImageForm" method="post" enctype="multipart/form-data">
					<div class="alert alert-danger print-error-msg" style="display:none">
						<ul></ul>
					</div>
					<div class="login-input">
						<h2 class="page-heading">Upload Bike Images</h2>
						<div class="form-group">
							@if(isset($result['bike_details']['image']))
								@foreach($result['bike_details']['image'] as $image)
									<img src="{{ asset('public/images/rider/bikes/')}}/{{ $image }}" width="200" height="200">
								@endforeach
							@endif
						</div>
						<div class="form-group">
							<input type="file" class="form-control" id="review_bike_images" name="image[]" multiple>
						</div>                        
					</div>
					<div class="form-group">
						<button type="button" onclick="submitReviewBikeImageStep()" class="btn btn-danger w-50"> SAVE</button>
					</div>
				</form>     
			</div>

			<div class="col-12 mb-3 review-bike-moredetails-selected">
				<div class="review-more-details">
					<h4>More Details</h4>
					<a href="javascript:void(0)" class="review-details"  onclick="reviewBikeMoreDetails()">Change Details</a>
				</div>
				
				<div class="d-flex align-items-center filter-details mb-4">
					<span class="filter-block1">KMs Driven</span>
					<h4 class="review-h4 review_total_km"> <i class="fa fa-map"></i>{{$result['bike_details']['total_km']}} km</h4>
				</div>
				<div class="d-flex align-items-center filter-details mb-4">
					<span class="filter-block1">Rides Completed</span>
					<h4 class="review-h4 review_total_rides">{{$result['bike_details']['total_rides']}}</h4>
				</div>

				<div class="review-rating">
					<div class="d-flex align-items-center filter-details mb-4">
						<span class="filter-block1">Comfortness</span>
						<h4 class="review-h4 review_comfortness"> {{$result['bike_details']['comfortness']}} <i class="fa fa-star"></i></h4>
					</div>
					<div class="d-flex align-items-center filter-details mb-4">
						<span class="filter-block1">Visual Appeal</span>
						<h4 class="review-h4 review_visual_appeal"> {{$result['bike_details']['visual_appeal']}} <i class="fa fa-star"></i></h4>
					</div>
					<div class="d-flex align-items-center filter-details mb-4">
						<span class="filter-block1">Reliability</span>
						<h4 class="review-h4 review_reliability"> {{$result['bike_details']['reliability']}} <i class="fa fa-star"></i></h4>
					</div>
					<div class="d-flex align-items-center filter-details mb-4">
						<span class="filter-block1">Performance</span>
						<h4 class="review-h4 review_performance"> {{$result['bike_details']['performance']}} <i class="fa fa-star"></i></h4>
					</div>
					<div class="d-flex align-items-center filter-details mb-4">
						<span class="filter-block1">Service Experience</span>
						<h4 class="review-h4 review_service_experience"> {{$result['bike_details']['service_experience']}} <i class="fa fa-star"></i> </h4>
					</div>
				</div>
			</div>
			<div class="col-md-12" id="review-bike-moredetails-change" style="display:none">
				<button type="button">
					<span aria-hidden="true" onclick="cancelReviewBikeDetailsChange()">&times;</span>
				</button>
				<form id="addReviewBikeMoreDetailsForm1" method="post">
					<input type="hidden" name="csrf" content="{{ csrf_token() }}">
					<div class="alert alert-danger print-error-msg" style="display:none">
						<ul></ul>
					</div>                                
					
					<div class="login-input">
						<h2 class="page-heading">Highlight Details</h2>
						<div class="form-group">
							<label>KMs Driven</label>
							<input type="number" class="form-control rview_total_km" value="{{$result['bike_details']['total_km']}}" name="total_km">
						</div>
						<div class="form-group">
							<label>Rides you have completed with this bike</label>
							<input type="number" class="form-control rview_total_rides" value="{{$result['bike_details']['total_km']}}" name="total_rides">
						</div>
					</div>

					<div class="login-input">
						<h2 class="page-heading">Rate Your Bike</h2>
						<div class="form-group">
							<label>Comfortness</label>
							<input type="number" class="rview_comfortness" name="comfortness" value="{{$result['bike_details']['comfortness']}}">
						</div>
						<div class="form-group">
							<label>Visual Appeal</label>
							<input type="number" class="rview_visual_appeal" name="visual_appeal" value="{{$result['bike_details']['visual_appeal']}}">
						</div>
						<div class="form-group">
							<label>Reliability</label>
							<input type="number" class="rview_reliability" name="reliability" value="{{$result['bike_details']['reliability']}}">
							</div>
						<div class="form-group">
							<label>Performance</label>
							<input type="number" class="rview_performance" name="performance" value="{{$result['bike_details']['performance']}}">
						</div>
						<div class="form-group">
							<label>Service Experience</label>
							<input type="number" class="rview_service_experience" name="service_experience" value="{{$result['bike_details']['service_experience']}}">
						</div>
					</div>
					<div class="login-input">
						<div class="form-group">
							<button type="button" onclick="submitReviewBikeMoreDetailsStep()" class="btn btn-danger w-50"> SAVE</button>
						</div>
					</div>
				</form>
			</div>
		
			<div class="col-12 mb-3 review-bike-description-selected">
				<div class="review-more-details">
					<h4>Description</h4>
					<a href="javascript:void(0)" class="review-details" onclick="reviewBikeDescription()" >Change</a>
				</div>
				<div class="d-flex align-items-center filter-details mb-4">
					<span class="filter-block1 review_description">{{$result['bike_details']['info']}}</span><br/>
				</div>
			</div>
			<div class="col-12 mb-3" id="review-bike-description-change" style="display:none">
				<button type="button">
					<span aria-hidden="true" onclick="cancelReviewBikeDescChange()">&times;</span>
				</button>
				<form id="addReviewBikeDescForm1" action="post">
					<div class="login-input">
						<h2 class="page-heading">Other Optional</h2>
						<div class="form-group">
							<textarea id="form7" class="md-textarea form-control rview_description" name="info" id="description" placeholder="Anything else you want to share about this bike ? Write it down here" rows="3">{{$result['bike_details']['info']}}</textarea>
						</div>
					</div>
					<div class="login-input">
						<div class="form-group">
							<button type="button" onclick="submitReviewBikeDescriptionStep()" class="btn btn-danger w-50"> SAVE</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-12 mb-3">     
				<div class="form-group">
					<button type="button" onClick="bikeDetailsStep()" class="btn back-btn w-40"><< BACK</button>
					<button type="button" onClick="submitBike('<?=isset($result['bike_id']) ? $result['bike_id'] : ''?>')" class="btn btn-danger w-40">SUBMIT</button>
				</div>
			</div>
			
		</div>		   
	</div>
</div>