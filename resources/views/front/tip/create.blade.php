@extends('layouts.frontLayout.front-layout')
@section('title', 'Add Tip')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
          <a href="{{route('tips.index')}}">< Back To Tip Page</a>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1"></span><br/>
            </div>
			<div class="row" id="tab1">
				<div class="col-12 mb-3">
            <div class="row">
              <div class="col-8 mb-3">                        
                  <form id="tipForm" method="post"  enctype="multipart/form-data">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                      <h2 class="page-heading">Tip Details</h2><br>
                      <div class="login-input">
                          <div class="form-group">
                              <input type="text" class="form-control" name="tip_title" placeholder="Tip Title">
                          </div>
                          <div class="form-group">
                            <input type="file" class="form-control-file uplode_file dropzone" name="file_name">
                          </div>                          
                          <div class="form-group">
                              <textarea class="md-textarea form-control" name="tip_description" rows="3" placeholder="Tip Description"></textarea>
                          </div>
                          <div class="form-group">
                            <button type="button" id="submitTip" class="btn btn-danger w-50">Submit</button>
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