@extends('layouts.frontLayout.front-layout')
@section('title', 'Add Supplier')
@section('content')
<section class="main-bg">
	<div class="container ">
	  <div class="row">
		<div class="col-md-8">
		  <div class="cust-left-block">
          <a href="{{route('suppliers.index')}}">< Back To Supplier Page</a>
			<div class="d-flex align-items-center filter-details mb-4">
			  <span class="filter-block1"></span><br/>
            </div>
			<div class="row" id="tab1">
				<div class="col-12 mb-3">
            <div class="row">
              <div class="col-8 mb-3">                        
                  <form id="supplierForm" method="post"  enctype="multipart/form-data">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                      <h2 class="page-heading">Supplier Details</h2><br>
                      <div class="login-input">
                          <div class="form-group">
                            <label for="">Supplier Name</label>
                              <input type="text" class="form-control" name="supplier_name">
                          </div>
                          <div class="form-group">
                          <label for="">Profile Image</label>
                            <input type="file" class="form-control-file uplode_file dropzone"
                            required accept="image/*" name="supplier_image" id="supplier_image">
                          </div>
                          <div class="form-group">
                              <label for="">Supplier Location</label>
                              <input type="text" class="form-control" name="supplier_address">
                          </div>
                          <div class="form-group">
                              <label for="">Supplier Rating</label>
                              <input type="number" class="form-control" name="supplier_rating">
                          </div>
                          <div class="form-group">
                              <label for="">Spare Part</label>
                              <input type="text" class="form-control" name="spare_part_name[]" placeholder="Name">
                              <input type="text" class="form-control" name="spare_part_number[]" placeholder="Serial Number">
                              <input type="file" class="form-control" name="spare_part_image[]">
                              <i class="fa fa-plus-circle review-details" id="more_spare_parts" aria-hidden="true"></i>
                          </div>
                          <div class="form-group" id="spare_parts_div"></div>
                          <div class="form-group">
                            <label for="">About Supplier</label>
                              <textarea class="md-textarea form-control" name="supplier_description" rows="3"></textarea>
                          </div>
                          <div class="form-group">
                            <button type="button" id="submitSupplier" class="btn btn-danger w-50">Submit</button>
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