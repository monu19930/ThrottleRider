<div id="row{{ $i }}">
    <button type="button" name="remove" id="{{ $i }}" class="btn btn-danger btn_remove">Day {{$i+1}} x</button>
    <div class="login-input">
        <div class="form-group">
            <input type="text" class="form-control" name="start_location_{{$i}}" value="{{$start_location}}" placeholder="Start Locations" readonly>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="end_location_{{$i}}" placeholder="End Locations">
        </div>
    </div>
    <h4>Road Amenties</h4>
    <div class="d-flex align-items-center w-100">
        <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-km-riden.svg')}}" class="img-fluid"></div>
        <div class="input-field mt-4 w-100">
            <label class="radio">Was there any petrol pump available ?</label>
            <input type="radio" autocomplete="off" name="is_petrol_pump_{{$i}}" value="0" checked onChange="showHideField(this.value,'{{$i}}','petrol_pump')"> No
            <input type="radio" autocomplete="off" name="is_petrol_pump_{{$i}}" value="1" onChange="showHideField(this.value,'{{$i}}','petrol_pump')"> Yes
        </div>
    </div>
    <div class="align-items-center w-100 petrol_pump_{{$i}}" style="display:none">
        <div class="mr-2 pr-1"></div>
        <div class="input-field mt-4 w-100">
            <input type="text" class="input-block" autocomplete="off" name="petrol_pump_comment_{{$i}}" placeholder=" ">
            <label for="search-bike" class="input-lbl">Add Your Comment</label>
        </div>
    </div>

    <div class="d-flex align-items-center w-100">
        <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-km-riden.svg')}}" class="img-fluid"></div>
        <div class="input-field mt-4 w-100">
            <label class="radio">Was there any Restaurant/cafe ?</label>
            <input type="radio" autocomplete="off" name="is_restaurant_{{$i}}" value="0" checked onChange="showHideField(this.value,'{{$i}}','restaurant_comment')"> No
            <input type="radio" autocomplete="off" name="is_restaurant_{{$i}}" value="1" onChange="showHideField(this.value,'{{$i}}','restaurant_comment')"> Yes
        </div>
    </div>
    <div class="align-items-center w-100 restaurant_comment_{{$i}}" style="display:none">
        <div class="mr-2 pr-1"></div>
        <div class="input-field mt-4 w-100">
            <input type="text" class="input-block" autocomplete="off" name="restaurant_comment_{{$i}}" placeholder=" ">
            <label for="search-bike" class="input-lbl">Add Your Comment</label>
        </div>
    </div>

    <div class="d-flex align-items-center w-100">
        <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-km-riden.svg')}}" class="img-fluid"></div>
        <div class="input-field mt-4 w-100">
            <label class="radio">Was there any hotel available ?</label>
            <input type="radio" autocomplete="off" name="is_hotel_{{$i}}" value="0" checked onChange="showHideField(this.value,'{{$i}}','is_hotel')"> No
            <input type="radio" autocomplete="off" name="is_hotel_{{$i}}" value="1" onChange="showHideField(this.value,'{{$i}}','is_hotel')"> Yes
        </div>
    </div>

    <div class="align-items-center w-100 is_hotel_{{$i}}" style="display:none">
        <div class="mr-2 pr-1"></div>
        <div class="input-field mt-4 w-100">
            <input type="text" class="input-block" autocomplete="off" name="hotel_name_{{$i}}" placeholder=" ">
            <label for="search-bike" class="input-lbl">Hotel name and location</label>
        </div>
    </div>
    <div class="align-items-center w-100 is_hotel_{{$i}}" style="display:none">
        <div class="mr-2 pr-1"></div>
        <div class="input-field mt-4 w-100">
            <label class="radio">Parking was available at hotel ?</label>
            <input type="radio" autocomplete="off" name="is_parking_{{$i}}" value="0" checked> No
            <input type="radio" autocomplete="off" name="is_parking_{{$i}}" value="1"> Yes
        </div>
    </div>
    <div class="align-items-center w-100 is_hotel_{{$i}}" style="display:none">
        <div class="mr-2 pr-1"></div>
        <div class="input-field mt-4 w-100">
            <label class="radio">Wifi was available at hotel room ?</label>
            <input type="radio" autocomplete="off" name="is_wifi_{{$i}}" value="0" checked> No
            <input type="radio" autocomplete="off" name="is_wifi_{{$i}}" value="1"> Yes
        </div>
    </div>

    <div class="d-flex align-items-center w-100">
        <div class="mr-2 pr-1"><img src="{{ asset('public/rider/images/icons-km-riden.svg')}}" class="img-fluid"></div>
        <div class="input-field mt-4 w-100">
            <select class="custom-select" name="road_type_{{$i}}" placeholder="Road Type">
                @foreach($road_types as $road_type)
                <option value="{{$road_type->id}}">{{$road_type->road_type}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="row align-items-center mt-3">
        <div class="col-4">
            <span class="rating-txt">Road Quality</span>
        </div>
        <div class="col-4">
            <div class="star-rating-block">
                <input type="radio" name="road_quality_{{$i}}" value="5"><span class="star"> </span>
                <input type="radio" name="road_quality_{{$i}}" value="4"><span class="star"> </span>
                <input type="radio" name="road_quality_{{$i}}" value="3"><span class="star"> </span>
                <input type="radio" name="road_quality_{{$i}}" value="2"><span class="star"> </span>
                <input type="radio" name="road_quality_{{$i}}" value="1" checked><span class="star"> </span>
            </div>
        </div>
    </div>

    <div class="row align-items-center mt-3">
        <div class="col-4">
            <span class="rating-txt">Road Scenic</span>
        </div>
        <div class="col-4">
            <div class="star-rating-block">
                <input type="radio" name="road_scenic_{{$i}}" value="5"><span class="star"> </span>
                <input type="radio" name="road_scenic_{{$i}}" value="4"><span class="star"> </span>
                <input type="radio" name="road_scenic_{{$i}}" value="3"><span class="star"> </span>
                <input type="radio" name="road_scenic_{{$i}}" value="2"><span class="star"> </span>
                <input type="radio" name="road_scenic_{{$i}}" value="1" checked><span class="star"> </span>
            </div>
        </div>
    </div>

    <h5 class="add-bike-heading mt-4">Add Images
        <small>Got any shots on this way? Post here</small>
    </h5>
    <div class="form-group mt-2">
        <input type="file" class="form-control" name="ride_images_{{$i}}[]" multiple>
    </div>

    <div class="d-flex align-items-center w-100">
        <div class="mr-2 pr-1"></div>
        <div class="input-field mt-4 w-100">
            <textarea class="text-format" name="day_description_{{$i}}" rows="3" placeholder="Day description. i.e, How was your experience on this day"></textarea>
        </div>
    </div>
</div>