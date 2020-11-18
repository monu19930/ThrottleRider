<div id="row{{ $i }}">
        <button type="button" name="remove" id="{{ $i }}" class="btn btn-danger btn_remove">Day {{$i+1}} x</button><div class="login-input">
        <div class="form-group">
            <input type="text" class="form-control" name="start_location_{{$i}}" value="{{$start_location}}" placeholder="Start Locations" readonly>
        </div>                                   
        <div class="form-group">
            <input type="email" class="form-control" name="end_location_{{$i}}" placeholder="End Locations">
        </div>                                    
    </div>
    <h4>Road Amenties</h4>
    <div class="login-input">
        <div class="form-group">
            <label class="radio">Was there any petrol pump available ?</label>
            <div class="custom-control custom-radio custom-control-inline">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_petrol_pump_{{$i}}" value="1" onChange="showHideField(this.value,'{{$i}}','petrol_pump')">
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_petrol_pump_{{$i}}" value="0" onChange="showHideField(this.value,'{{$i}}','petrol_pump')" checked>
                    <label class="form-check-label">No</label>
                </div>
            </div>
        </div>

        <div class="form-group petrol_pump_{{$i}}" style="display:none">
            <input type="text" class="form-control" name="petrol_pump_comment_{{$i}}" placeholder="Add Your Comment">
        </div>
        
        <div class="form-group">
            <label class="radio">Was there any Restaurant/cafe ?</label>
            <div class="custom-control custom-radio custom-control-inline">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_restaurant_{{$i}}" value="1" onChange="showHideField(this.value,'{{$i}}','restaurant_comment')">
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_restaurant_{{$i}}" value="0" onChange="showHideField(this.value,'{{$i}}','restaurant_comment')" checked>
                    <label class="form-check-label">No</label>
                </div>
            </div>
        </div>

        <div class="form-group restaurant_comment_{{$i}}" style="display:none">
            <input type="text" class="form-control" name="restaurant_comment_{{$i}}" placeholder="Add Your Comment">
        </div>

        <div class="form-group">
            <label class="radio">Was there any Hotel Available ?</label>
            <div class="custom-control custom-radio custom-control-inline">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_hotel_{{$i}}" value="1" onChange="showHideField(this.value,'{{$i}}','is_hotel')">
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_hotel_{{$i}}" value="0" onChange="showHideField(this.value,'{{$i}}','is_hotel')" checked>
                    <label class="form-check-label">No</label>
                </div>
            </div>
        </div>

        <div class="form-group is_hotel_{{$i}}" style="display:none">
            <input type="text" class="form-control" name="hotel_name_{{$i}}" placeholder="Hotel name and location">
        </div>

        <div class="form-group is_hotel_{{$i}}" style="display:none">
            <label class="radio">Parking was available at hotel ?</label>
            <div class="custom-control custom-radio custom-control-inline">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_parking_{{$i}}" value="1">
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_parking_{{$i}}" value="0" checked>
                    <label class="form-check-label">No</label>
                </div>
            </div>
        </div>

        <div class="form-group is_hotel_{{$i}}" style="display:none">
            <label class="radio">Wifi was available at hotel room ?</label>
            <div class="custom-control custom-radio custom-control-inline">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_wifi_{{$i}}" value="1">
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_wifi_{{$i}}" value="0" checked>
                    <label class="form-check-label">No</label>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label>Road Type</label>
            <select class="custom-select" name="road_type_{{$i}}" style="width:150px;"> 
            @foreach($road_types as $road_type)
                <option value="{{$road_type->id}}">{{$road_type->road_type}}</option>
            @endforeach
            </select> 
        </div>

        <div class="form-group">
            <p>Road Quality</p>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="road_quality_{{$i}}" value="1">
                <label class="form-check-label" for="exampleRadios2"> 1</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="road_quality_{{$i}}" value="2" checked>
                <label class="form-check-label" for="exampleRadios2">2</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="road_quality_{{$i}}" value="3">
                <label class="form-check-label" for="exampleRadios2">3</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="road_quality_{{$i}}" value="4">
                <label class="form-check-label" for="exampleRadios2">4</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="road_quality_{{$i}}" value="5">
                <label class="form-check-label" for="exampleRadios2">5</label>
            </div>
        </div>

        <div class="form-group">
            <p>Road Scenic</p>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="road_scenic_{{$i}}" value="1">
                <label class="form-check-label" for="exampleRadios2"> 1</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="road_scenic_{{$i}}" value="2">
                <label class="form-check-label" for="exampleRadios2">2</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="road_scenic_{{$i}}" value="3" checked>
                <label class="form-check-label" for="exampleRadios2">3</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="road_scenic_{{$i}}" value="4">
                <label class="form-check-label" for="exampleRadios2">4</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="road_scenic_{{$i}}" value="5">
                <label class="form-check-label" for="exampleRadios2">5</label>
            </div>
        </div>

        <div class="form-group">
            <label>Add Images</label>
            <input type="file" class="form-control" name="ride_images_{{$i}}[]" multiple >
        </div>
        <div class="form-group">
            <textarea id="form7" class="md-textarea form-control" name="day_description_{{$i}}" rows="3" placeholder="Day description. i.e, How was your experience on this day"></textarea>
        </div>
    