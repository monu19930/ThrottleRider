@extends('layouts.frontLayout.front-layout')
@section('title', 'Add Group')
@section('content')
<section class="left-main-bg  h-100">
	<div class="container  h-100">	    <div class="row h-100">		<div class="col-md-4 d-none d-md-block  h-100">			         	@include('layouts.frontLayout.profile-sidebar')			</div>
		<div class="col-md-8">
		  <div class="cust-left-block pt-4">
           
			<!--<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1"></span><br/>
      </div>-->
			                      
                  <form id="groupForm" method="post"  enctype="multipart/form-data">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                      <h2 class="page-heading">Group Details</h2> 					           <div class="row">              <div class="col-8 mb-3">   
                      <div class="login-input">							<div class="input-field mb-0  mt-3 w-100">                                 <input type="text" name="group_name" id="group_name" class="input-block" placeholder=" ">                                 <label for="group_name" class="input-lbl">Group Name</label>                               </div>					
                           								<div class="input-field mb-0  mt-3 w-100">  												  <select class="floating-select" name="city"  onclick="this.setAttribute('value', this.value);" value="">													                                                       <option value="">  </option>													@foreach($cities as $key => $city)													  <option value="{{$key}}">{{$city}}</option>																							@endforeach												  </select>												   												  <label class="input-lbl" >Select city</label>												</div>	
                          
                          <div class="input-field mb-0  mt-3 w-100">      						  <textarea class="input-block floating-textarea md-textarea" placeholder=" " style="height:100px" name="group_description"></textarea>						   						  <label class="input-lbl">Write short description about this Group</label>						</div>
                          
                          
                      </div>                                 </div>            </div>			 <div class="dropzone position-relative mt-3" id="dropzone">                            <div class="drop-icon"><i class="fa fa-file-image-o"></i></div>                            <div class="drop-box-format mt-2">Drag and drop <span class="text-gray">or</span> <span class="text-danger">Select from Gallery</span></div>                            <small class="sml-txt-md mt-2">Tip: For better buildup, Please upload Bike front and Odometer Photos.</small>							<input type="file" class="form-control-file uplode_file dropzone upload-group-detail" required accept="image/*" name="profile" id="profile" />                          </div>			 <hr class="full-h-line my-4">			<div class="mt-3 text-right">                            <button type="button" id="submitGroup" class="post-btn lg px-5">Submit</button>                          </div>
                  </form>
             
				 
		</div>
	</div>
		  </div>
		</div-->
	   
	</div>
  </section>
@stop