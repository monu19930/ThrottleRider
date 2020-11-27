@extends('layouts.frontLayout.front-layout')
@section('title', 'Add Group')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
          <a href="{{route('my-groups.index')}}">< Back to My Groups</a>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1"></span><br/>
      </div>
			<div class="row" id="tab1">
				<div class="col-12 mb-3">
          <div class="row">
              <div class="col-8 mb-3">                        
                  <form id="groupForm" method="post"  enctype="multipart/form-data">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                      <h2 class="page-heading">Group Details</h2><br>
                      <div class="login-input">
                          <div class="form-group">
                              <input type="text" class="form-control" name="group_name" placeholder="Group Name">
                          </div>
                          <div class="form-group">
                            <input type="file" class="form-control-file uplode_file dropzone"
                            required accept="image/*" name="profile" id="profile">
                          </div>
                          <div class="form-group">
                            <label>City</label>
                            <select class="custom-select" name="city" >
                                <option value="">Select city </option>
                                @foreach($cities as $key => $city)
                                  <option value="{{$key}}">{{$city}}</option>										
                                @endforeach
                            </select>								
                          </div>
                          <div class="form-group">
                              <textarea class="md-textarea form-control" name="group_description" rows="3" placeholder="Write short description about this Group"></textarea>
                          </div>
                          <div class="form-group">
                            <button type="button" id="submitGroup" class="btn btn-danger w-50">Submit</button>
                          </div>
                      </div>                                
                  </form>
              </div>
            </div>
				</div>
      </div>
		</div>
	</div>
		  </div>
		</div-->
	  </div>
	</div>
  </section>
@stop