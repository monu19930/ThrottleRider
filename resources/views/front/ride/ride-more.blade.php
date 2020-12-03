<div class="tab-pane fade active show" id="day{{$i+1}}" aria-labelledby="login-tab" role="tabpanel">
    <h5 class="add-bike-heading">
        <!-- <span class="right-seperater">Day {{$i+1}}</span>Bangalore to Marvanthe -->

    </h5>

    <div class="row">
        <div class="col-7">
            <div class="d-flex align-items-center w-100">
                <div class="mr-2 pr-1"><img src="{{asset('public/rider/images/icons-startlocation.svg')}}" class="img-fluid img-icon"></div>

                <div class="input-field mb-0 w-100 left-seprater-dotted">
                    <input type="text" name="start_location_{{$i}}" class="input-block" value="{{$start_location}}" placeholder=" " readonly>
                    <label for="search-bike" class="input-lbl">Start location</label>
                </div>

            </div>

            <div class="d-flex align-items-center mt-4 w-100">
                <div class="mr-2 pr-1"><img src="{{asset('public/rider/images/icons-destination.svg')}}" class="img-fluid img-icon"></div>

                <div class="input-field  mb-0 w-100">
                    <input type="text" autocomplete="off" name="end_location_{{$i}}" class="input-block select-location" placeholder=" ">
                    <label for="search-bike" class="input-lbl">Destination for this day</label>
                </div>

            </div>
            <h4 class="page-sub-heading mt-4 mb-2">Road Amenities
                <small>Help others to fill available amenities on your way.</small>
            </h4>
            <div class="tip d-flex mt-3">
                <span class="tip-head">Tip</span>
                <span class="tip-txt">Tap on <img src="{{asset('public/rider/images/icons-clickable-comment.svg')}}" style="width:20px;" class="mx-1" /> to comment about particular section.<br>i.e. Road caution, One Petrol pump on this way e.t.c.</span>
            </div>
            <div class="d-flex align-items-center mt-4 w-100">
                <div class="mr-2 pr-1"><img src="{{asset('public/rider/images/icons-petrol.svg')}}" class="img-fluid img-icon"></div>

                <div class="txt-14">
                    Was there any Petrol pump?
                </div>
                <div class="can-toggle ml-auto">
                    <input id="a{{$i}}" type="checkbox" name="is_petrol_pump_{{$i}}">
                    <label for="a{{$i}}" class="mb-0">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
                <div class="add-via-btn"> <a href="javascript:void(0)" onclick="addCommentField('petrol_pump_comment_{{$i}}')"><img src="{{asset('public/rider/images/icons-clickable-comment.svg')}}"></a></div>
            </div>
            <div id="petrol_pump_comment_{{$i}}"></div>
            <div class="d-flex align-items-center mt-4 w-100">
                <div class="mr-2 pr-1"><img src="{{asset('public/rider/images/icons-restaurant.svg')}}" class="img-fluid img-icon"></div>

                <div class="txt-14">
                    Was there any Restaurant/ Cafe?
                </div>
                <div class="can-toggle ml-auto">
                    <input id="b{{$i}}" type="checkbox" name="is_restaurant_{{$i}}" checked>
                    <label for="b{{$i}}" class="mb-0">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
                <div class="add-via-btn"> <a href="javascript:void(0)" onclick="addCommentField('restaurant_comment_{{$i}}')"><img src="{{asset('public/rider/images/icons-clickable-comment.svg')}}"></a></div>
            </div>
            <div id="restaurant_comment_{{$i}}"></div>
            <div class="d-flex align-items-center mt-4 w-100">
                <div class="mr-2 pr-1"><img src="{{asset('public/rider/images/icons-hotel.svg')}}" class="img-fluid img-icon"></div>

                <div class="txt-14">
                    Was there any Hotel?
                </div>
                <div class="can-toggle ml-auto">
                    <input id="c{{$i}}" type="checkbox" name="is_hotel_{{$i}}" checked onchange="valueChanged(this)">
                    <label for="c{{$i}}" class="mb-0">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>

                </div>
                <div class="add-via-btn"> <a href="javascript:void(0)" onclick="addCommentField('hotel_comment_{{$i}}')"><img src="{{asset('public/rider/images/icons-clickable-comment.svg')}}"></a></div>
            </div>
            <div id="hotel_comment_{{$i}}"></div>
            <div id="checkbox-content" class="open-txt-box is_hotel_{{$i}}">
                <textarea class="text-format" name="hotel_name_{{$i}}" placeholder="Hotel name and location" style="height:52px;"></textarea>
            </div>
            <div class="d-flex align-items-center mt-4 w-100 is_hotel_{{$i}}">
                <div class="mr-4 pr-3"></div>

                <div class="txt-14 pl-1">
                    Parking was available at Hotel?
                </div>
                <div class="can-toggle ml-auto">
                    <input id="d{{$i}}" type="checkbox" name="is_parking_{{$i}}">
                    <label for="d{{$i}}" class="mb-0">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
                <!-- <div class="add-via-btn"> <a href="#" id="btnAdd"><img src="{{asset('public/rider/images/icons-clickable-comment.svg')}}"></a></div> -->
            </div>
            <div class="d-flex align-items-center mt-4 w-100 is_hotel_{{$i}}">
                <div class="mr-4 pr-3"> </div>

                <div class="txt-14 pl-1">
                    Wi-Fi was available at Hotel?
                </div>
                <div class="can-toggle ml-auto">
                    <input id="e{{$i}}" type="checkbox" name="is_wifi_{{$i}}" checked>
                    <label for="e{{$i}}" class="mb-0">
                        <div class="can-toggle__switch" data-checked="Yes" data-unchecked="No"></div>
                    </label>
                </div>
                <!-- <div class="add-via-btn"> <a href="#" id="btnAdd"><img src="{{asset('public/rider/images/icons-clickable-comment.svg')}}"></a></div> -->
            </div>
            <div class="d-flex align-items-center w-100 mt-4">
                <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-road.svg')}}" class="img-fluid img-icon"></div>


                <div class="input-field mb-0 w-100">
                    <select class="floating-select" name="road_type_{{$i}}" onclick="this.setAttribute('value', this.value);" value="">
                        @foreach($road_types as $road_type)
                        <option value="{{$road_type->id}}">{{$road_type->road_type}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="add-via-btn"> <a href="javascript:void(0)" onclick="addCommentField('road_type_comment_{{$i}}')"><img src="{{asset('public/rider/images/icons-clickable-comment.svg')}}"></a></div>
            </div>
            <div id="road_type_comment_{{$i}}"></div>
            <div class="d-flex align-items-center mt-4 w-100">
                <div class="mr-4 pr-3"> </div>

                <div class="txt-14 pl-1">
                    Road Quality
                </div>
                <div class="star-rating-block ml-auto">
                    <input type="radio" name="road_quality_{{$i}}" value="5"><span class="star"> </span>
                    <input type="radio" name="road_quality_{{$i}}" value="4"><span class="star"> </span>
                    <input type="radio" name="road_quality_{{$i}}" value="3"><span class="star"> </span>
                    <input type="radio" name="road_quality_{{$i}}" value="2"><span class="star"> </span>
                    <input type="radio" name="road_quality_{{$i}}" value="1" checked><span class="star"> </span>
                </div>

            </div>
            <div class="d-flex align-items-center mt-4 w-100">
                <div class="mr-4 pr-3"> </div>

                <div class="txt-14 pl-1">
                    Road Scenic
                </div>
                <div class="star-rating-block ml-auto">
                    <input type="radio" name="road_scenic_{{$i}}" value="5"><span class="star"> </span>
                    <input type="radio" name="road_scenic_{{$i}}" value="4"><span class="star"> </span>
                    <input type="radio" name="road_scenic_{{$i}}" value="3"><span class="star"> </span>
                    <input type="radio" name="road_scenic_{{$i}}" value="2"><span class="star"> </span>
                    <input type="radio" name="road_scenic_{{$i}}" value="1" checked><span class="star"> </span>
                </div>

            </div>

        </div>
        <div class="col-4 ml-auto">
            <div class="card">
                <div class="map-location rounded-top"><img src="{{ asset('public/rider/images/map1.png')}}" class="img-fluid" /></div>
                <div class="card-body">
                    <!-- <h4 class="page-sub-heading  mb-0">2176 km <small class="sml-txt">From Bengaluru to Delhi via Goa</small></h4> -->
                </div>
            </div>
        </div>
    </div>
    <h4 class="page-sub-heading mt-4 mb-2">Add Images
        <small>Got any shots on this way? Post here</small>
    </h4>
    <div class="drag-drop">
        <input type="file" name="ride_images_{{$i}}[]" accept="image/*" style="display:none;" id="drag-drop_{{$i}}" multiple />
        <div id="uploads_{{$i}}"></div>
        <div class="dropzone flex-row justify-content-start p-4" style="height:87px;" id="dropzone_{{$i}}">
            <div class="drop-icon mr-3"><i class="fa fa-file-image-o"></i></div>
            <div class="drop-box-format">Drag and drop <span class="text-gray">or</span> <span class="text-danger">Select from Gallery</span></div>

        </div>
    </div>
    <textarea class="text-format mt-5" name="day_description_{{$i}}" placeholder="Day description. i.e. How was your experience on this day? (Optional)"></textarea>
</div>

<script>
    $(function() {
	const dropzone = document.getElementById("dropzone_{{$i}}");
	const uploads = document.getElementById("uploads_{{$i}}");
	var fileInput = document.getElementById("drag-drop_{{$i}}");
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

    $(".select-location").autocomplete({ 
            source: function (request, response) {
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
                $.ajax({ 
                    url:"{{route('find-location')}}", 
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
        });
});

</script>