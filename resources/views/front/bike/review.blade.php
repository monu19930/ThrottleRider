<h5 class="add-bike-heading">
	Review bike information
	<small>Verify information you’ve entered and submit</small>
</h5>
<div class="d-flex align-items-center mt-4 mb-2 review-bike-selected">
	<h4 class="page-sub-heading ">Bike selected</h4>
	<span class="ml-auto filter-block3 mob-filter"><a href="javascript:void(0)" onclick="reviewBikeDetails()">Change Bike</a></span>
</div>

<div class="d-flex rounded-5x bg-blue review-bike-selected">
	<span><img src="http://localhost/gull-html-laravel/public/images/bike_models/{{$result['bike_model_image']}}" id="review_bike_image" class="selected-bike" /></span>
	<div class="selected-byke-name p-4">
		<h5 class="add-bike-heading review-bike-name">{{$result['bike_details']['name']}} <small class="sml-txt-md d-block mt-2"></small></h5>
	</div>
</div>

<div class="align-items-center mt-4 mb-2" id="review_bike_change" style="display:none !important">
	<i class="fa fa-window-close mt-2 text-danger review-close-icon" aria-hidden="true" onclick="cancelReviewBikeChange()"></i>
	<div class="row">
		<div class="col-8">
			<form id="addReviewBikeForm1" method="post">
				@if(isset($result['bike_id']))
					<input type="hidden" name="id" content="{{$result['bike_id']}}">
				@endif
				<div class="alert alert-danger print-error-msg" style="display:none">
					<ul></ul>
				</div>
				<h5 class="add-bike-heading">Select your bike<small>Choose brand, bike and model</small></h5>
				<div class="input-field my-4">
					<input type="text" autocomplete="off" name="name" value="{{$result['bike_details']['name']}}" id="review_bike_list" class="input-block" placeholder=" ">
					<label for="search-bike" class="input-lbl">Search for bike brand or model name</label>
				</div>
				<h5 class="add-bike-heading"><small>or choose from following brands:-</small></h5>
				<div class="d-flex flex-wrap">
					@foreach($result['brands'] as $brand)
					<a class="logo-block" style="cursor:pointer;" onclick="showReviewBikeModelList('{{$brand->id}}')">
						<span class="d-block"><img src="http://localhost/gull-html-laravel/public/images/bike_brands/{{$brand->logo}}" style="width: 60px;height: 54px;" /></span>
						<span class="d-block mt-2">{{$brand->brand_name}}</span>
					</a>
					@endforeach
				</div>
				<a href="#" class="d-inline-block font-weight-bold mt-4">Show more brands <i class="fa fa-angle-down ml-1"></i> </a>
			</form>
		</div>
		<div class="col-4">
			<div class="review_selected_bike">
				<img src="http://localhost/gull-html-laravel/public/images/bike_models/{{$result['bike_model_image']}}" alt="" width="200" height="200" id="review_selected_bike"/>
				<div class="selected-list d-flex">
					<span class="bike-select-number">
						<i class="fa fa-check" aria-hidden="true"></i>
					</span>selected
				</div>
				<h5 class="add-bike-heading" id="review_model_name">{{$result['bike_details']['name']}}</h5>
			</div>
		</div>
	</div>

	<div class="text-right pb-3">
		<button type="button" onclick="submitReviewBikeChangeStep()" class="btn btn-outline-success btn-sm px-5"> SAVE</button>
	</div>

</div>

<div class="d-flex align-items-center mt-4 mb-2 review-bike-image-selected">
	<h4 class="page-sub-heading ">Images</h4>
	<span class="ml-auto filter-block3 mob-filter"><a href="javascript:void(0)" onclick="reviewBikeImagesDetails()">Add or Remove Images</a></span>
</div>
<div class="d-flex flex-wrap review_bike_images_list review-bike-image-selected">
	@if(isset($result['bike_details']['image']))
	@foreach($result['bike_details']['image'] as $image)
	<div class="bike-pic-box">
		<img src="{{ asset('public/images/rider/bikes/')}}/{{ $image }}" class="byke-pics">
	</div>
	@endforeach
	@elseif(isset($result['images']))
	@foreach($result['images'] as $image)
	<div class="bike-pic-box">
		<img src="{{ asset('public/images/rider/bikes/')}}/{{ $image }}" class="byke-pics">
	</div>
	@endforeach
	@endif
</div>

<div class="align-items-center mt-4 mb-2" id="review_bike_images_change" style="display:none !important">
	<i class="fa fa-window-close mt-2 text-danger review-close-icon" aria-hidden="true" onclick="cancelReviewBikeImagesChange()"></i>
	<form id="addReviewBikeImageForm" action="post" enctype="multipart/form-data" style="width:100%;">
		<div class="alert alert-danger print-error-msg" style="display:none">
			<ul></ul>
		</div>
		<h4 class="page-sub-heading mt-4 mb-2">Upload bike images</h4>
		<div class="drag-drop">
			<input type="file" name="image[]" id="review_drag-drop" multiple />
			<div id="review_uploads"></div>
			<div class="dropzone" id="review_dropzone">
				<div class="drop-icon"><i class="fa fa-file-image-o"></i></div>
				<div class="drop-box-format mt-2">Drag and drop <span class="text-gray">or</span>
					<span class="text-danger">Select from Gallery</span>
				</div>
				<small class="sml-txt-md mt-2">Tip: For better buildup, Please upload Bike front and Odometer Photos.</small>
			</div>
		</div>
		<div class="text-right pb-3">
			<button type="button" onclick="submitReviewBikeImageStep()" class="btn btn-outline-success btn-sm px-5"> SAVE</button>
		</div>
	</form>
</div>

<div class="d-flex align-items-center mt-4 mb-2 review-bike-moredetails-selected">
	<h4 class="page-sub-heading ">More details</h4>
	<span class="ml-auto filter-block3 mob-filter"><a href="javascript:void(0)" onclick="reviewBikeMoreDetails()">Change Details</a></span>
</div>

<div class="row review-bike-moredetails-selected">
	<div class="col-7">
		<div class="d-flex align-items-center w-100 mt-3">
			<div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-km-riden.svg')}}" class="img-fluid"></div>

			<h5 class="txt-14 m-0">
				<small class="sml-txt d-block">KMs driven</small>
				<span class="review_total_km">{{$result['bike_details']['total_km']}} km
			</h5>

		</div>
		<div class="d-flex align-items-center mt-3 w-100">
			<div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-destination.svg')}}" class="img-fluid"></div>

			<h5 class="txt-14 m-0">
				<small class="sml-txt d-block">Rides completed</small>
				<span class="review_total_rides">{{$result['bike_details']['total_rides']}}</span>
			</h5>
		</div>
	</div>
</div>
<div class="d-flex flex-wrap mt-3 review-bike-moredetails-selected">
	<div class="d-flex rating-btn-review">
		<span class="rating txt-14 mr-2 text-nowrap review_comfortness">
			<i class="fa fa-star"></i> {{isset($result['bike_details']['comfortness']) ? $result['bike_details']['comfortness'] : 0}}
		</span><small class="sml-txt">Comfortness</small>
	</div>
	<div class="d-flex rating-btn-review">
		<span class="rating txt-14 mr-2 text-nowrap review_visual_appeal">
			<i class="fa fa-star"></i> {{isset($result['bike_details']['visual_appeal']) ? $result['bike_details']['visual_appeal'] : 0}}
		</span><small class="sml-txt">Visual Appeal</small>
	</div>
	<div class="d-flex rating-btn-review">
		<span class="rating txt-14 mr-2 text-nowrap review_reliability">
			<i class="fa fa-star"></i> {{isset($result['bike_details']['reliability']) ? $result['bike_details']['reliability'] : 0}}
		</span><small class="sml-txt">Reliability</small>
	</div>
	<div class="d-flex rating-btn-review">
		<span class="rating txt-14 mr-2 text-nowrap review_performance">
			<i class="fa fa-star"></i> {{isset($result['bike_details']['performance']) ? $result['bike_details']['performance'] : 0}}
		</span><small class="sml-txt">Performance</small>
	</div>
	<div class="d-flex rating-btn-review">
		<span class="rating txt-14 mr-2 text-nowrap review_service_experience">
			<i class="fa fa-star"></i> {{isset($result['bike_details']['service_experience']) ? $result['bike_details']['service_experience'] : 0}}
		</span><small class="sml-txt">Service Experience</small>
	</div>
</div>

<div class="align-items-center mt-4 mb-2" id="review-bike-moredetails-change" style="display:none !important">
	<i class="fa fa-window-close mt-2 text-danger review-close-icon" aria-hidden="true" onclick="cancelReviewBikeDetailsChange()"></i>
	<form id="addReviewBikeMoreDetailsForm1" action="post" style="width:100%;">
		<h4 class="page-sub-heading mt-4 mb-2">Highlight details</h4>
		<div class="row">
			<div class="col-7">
				<div class="d-flex align-items-center w-100">
					<div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-km-riden.svg')}}" class="img-fluid"></div>

					<div class="input-field mt-4 w-100">
						<input type="text" autocomplete="off" name="total_km" id="total_km" value="{{$result['bike_details']['total_km']}}" class="input-block rview_total_km" placeholder=" ">
						<label for="search-bike" class="input-lbl">KMs driven</label>
					</div>

				</div>
				<div class="d-flex align-items-center w-100">
					<div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-destination.svg')}}" class="img-fluid"></div>

					<div class="input-field  mb-0 w-100">
						<input type="text" autocomplete="off" name="total_rides" id="total_rides" value="{{$result['bike_details']['total_rides']}}" class="input-block rview_total_rides" placeholder=" ">
						<label for="search-bike" class="input-lbl">Rides you’ve completed with this bike?</label>
					</div>

				</div>
			</div>
		</div>
		<h4 class="page-sub-heading mt-4 mb-2">Rate your bike</h4>
		<div class="row align-items-center mt-3">
			<div class="col-3">
				<span class="rating-txt">Comfortness</span>
			</div>
			<div class="col-4">
				<div class="star-rating-block">
					<input type="radio" name="comfortness" value="5" class="rview_comfortness"
					@if($result['bike_details']['comfortness'] == 5)
						checked
					@endif
					/>					
					<span class="star"> </span>
					<input type="radio" name="comfortness" value="4" class="rview_comfortness"
					@if($result['bike_details']['comfortness'] == 4)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="comfortness" value="3" class="rview_comfortness"
					@if($result['bike_details']['comfortness'] == 3)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="comfortness" value="2" class="rview_comfortness"
					@if($result['bike_details']['comfortness'] == 2)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="comfortness" value="1" class="rview_comfortness"
					@if($result['bike_details']['comfortness'] == 1)
						checked
					@endif
					/><span class="star"> </span>
				</div>
			</div>
		</div>
		<div class="row align-items-center mt-3">
			<div class="col-3">
				<span class="rating-txt">Visual Appeal</span>
			</div>
			<div class="col-4">
				<div class="star-rating-block">
					<input type="radio" name="visual_appeal" value="5" class="rview_visual_appeal"
					@if($result['bike_details']['visual_appeal'] == 5)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="visual_appeal" value="4" class="rview_visual_appeal"
					@if($result['bike_details']['visual_appeal'] == 4)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="visual_appeal" value="3" class="rview_visual_appeal"
					@if($result['bike_details']['visual_appeal'] == 3)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="visual_appeal" value="2" class="rview_visual_appeal"
					@if($result['bike_details']['visual_appeal'] == 2)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="visual_appeal" value="1" class="rview_visual_appeal"
					@if($result['bike_details']['visual_appeal'] == 1)
						checked
					@endif
					/><span class="star"> </span>
				</div>
			</div>
		</div>
		<div class="row align-items-center mt-3">
			<div class="col-3">
				<span class="rating-txt">Reliability</span>
			</div>
			<div class="col-4">
				<div class="star-rating-block">
					<input type="radio" name="reliability" value="5" class="rview_reliability"
					@if($result['bike_details']['reliability'] == 5)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="reliability" value="4" class="rview_reliability"
					@if($result['bike_details']['reliability'] == 4)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="reliability" value="3" class="rview_reliability"
					@if($result['bike_details']['reliability'] == 3)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="reliability" value="2" class="rview_reliability"
					@if($result['bike_details']['reliability'] == 2)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="reliability" value="1" class="rview_reliability"
					@if($result['bike_details']['reliability'] == 1)
						checked
					@endif
					/><span class="star"> </span>
				</div>
			</div>
		</div>
		<div class="row align-items-center mt-3">
			<div class="col-3">
				<span class="rating-txt">Performance</span>
			</div>
			<div class="col-4">
				<div class="star-rating-block">
					<input type="radio" name="performance" value="5" class="rview_performance"
					@if($result['bike_details']['performance'] == 5)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="performance" value="4" class="rview_performance"
					@if($result['bike_details']['performance'] == 4)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="performance" value="3" class="rview_performance"
					@if($result['bike_details']['performance'] == 3)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="performance" value="2" class="rview_performance"
					@if($result['bike_details']['performance'] == 2)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="performance" value="1" class="rview_performance"
					@if($result['bike_details']['performance'] == 1)
						checked
					@endif
					/><span class="star"> </span>
				</div>
			</div>
		</div>
		<div class="row align-items-center mt-3">
			<div class="col-3">
				<span class="rating-txt">Service Experience</span>
			</div>
			<div class="col-4">
				<div class="star-rating-block">
					<input type="radio" name="service_experience" value="5" class="rview_service_experience"
					@if($result['bike_details']['service_experience'] == 5)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="service_experience" value="4" class="rview_service_experience"
					@if($result['bike_details']['service_experience'] == 4)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="service_experience" value="3" class="rview_service_experience"
					@if($result['bike_details']['service_experience'] == 3)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="service_experience" value="2" class="rview_service_experience"
					@if($result['bike_details']['service_experience'] == 2)
						checked
					@endif
					/><span class="star"> </span>
					<input type="radio" name="service_experience" value="1" class="rview_service_experience"
					@if($result['bike_details']['service_experience'] == 1)
						checked
					@endif
					/><span class="star"> </span>
				</div>
			</div>
		</div>
		<div class="text-right pb-3">
			<button type="button" onclick="submitReviewBikeMoreDetailsStep()" class="btn btn-outline-success btn-sm px-5"> SAVE</button>
		</div>
	</form>
</div>

<div class="d-flex align-items-center mt-4 mb-2 review-bike-description-selected">
	<h4 class="page-sub-heading ">Description</h4>
	<span class="ml-auto filter-block3 mob-filter"><a href="javascript:void(0)" onclick="reviewBikeDescription()">Change</a></span>
</div>
<div class="read-only-txt review_description review-bike-description-selected">{{$result['bike_details']['info']}}</div>

<div class="align-items-center mt-4 mb-2" id="review-bike-description-change" style="display:none !important">
	<i class="fa fa-window-close mt-2 text-danger review-close-icon" aria-hidden="true" onclick="cancelReviewBikeDescChange()"></i>
	<form id="addReviewBikeDescForm1" action="post" style="width:100%;">
		<h4 class="page-sub-heading mt-4 mb-2">Other (Optional)</h4>
		<textarea class="text-format rview_description" name="info" id="description" placeholder="Anything else you want to share about this bike? Write it down here"></textarea>

		<div class="text-right pb-3">
			<button type="button" onclick="submitReviewBikeDescriptionStep()" class="btn btn-outline-success btn-sm px-5"> SAVE</button>
		</div>
	</form>
</div>

<hr class="full-h-line my-4">
<div class="text-right pb-3">
	<button class="red-outline-btn px-5 mr-3" onClick="bikeDetailsStep()">BACK</button>
	<button class="post-btn lg px-5" onClick="submitBike('<?= isset($result['bike_id']) ? $result['bike_id'] : '' ?>')">SUBMIT</button>
</div>


<script>
	$("#review_bike_list").autocomplete({ 
		source: function (request, response) {
			$.ajaxSetup({
				headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
			});
			$.ajax({ 
				url:"{{route('bike-search')}}", 
				type: "POST",
				format: "json",
				data: {
					limit: 8,
					search: request.term,
				},
				
				success: function (data) {
					response(data);
				}, 
			}); 
		},
		select : getBikeDetails
	});

	function getBikeDetails(event, ui) {
		$(function() {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('search-bike-details')}}",
                type: "POST",
                data: {keyword:ui.item.label},
                success: function( response ) {
                    var img = "http://localhost/gull-html-laravel/public/images/bike_models/"+response.image;
                    $('.review_selected_bike').show();
                    $('#review_selected_bike').attr('src', img);
					$('#review_model_name').text(ui.item.label);
					console.log(ui.item.label)
                }
            });

        });
	}



	$(function() {
	const dropzone = document.getElementById("review_dropzone");
	const uploads = document.getElementById("review_uploads");
	var fileInput = document.getElementById("review_drag-drop");
	var text, i, dropped = false;

	var generateNames = function(files) {
		for (i = 0; i < files.length; i++) {
			if (
				files[i].type === "image/jpeg" ||
				files[i].type === "image/png" ||
				files[i].type === "image/gif"
			) {
				text = document.createTextNode(files[i].name + " | ");
				uploads.appendChild(text);
			} else {
				text = document.createTextNode("Error! One or more files is not an image.");
				uploads.appendChild(text);
			}
		}
	};
	dropzone.ondragover = function() {
		this.className = "dropzone dragover";
		return false;
	};
	dropzone.ondragleave = function() {
		this.className = "dropzone";
		return false;
	};
	dropzone.ondrop = function(e) {
		e.preventDefault();
		dropped = true;
		uploads.innerHTML = "";
        fileInput.files = e.dataTransfer.files;
        generateNames(e.dataTransfer.files);
        this.className = "dropzone";
	};
	dropzone.onclick = function(e) {
		e.preventDefault();
		fileInput.click();
	};
	fileInput.onchange = function() {
		uploads.innerHTML = "";
		if(!dropped)
            generateNames(this.files);
        dropped = false;
	};
});
</script>