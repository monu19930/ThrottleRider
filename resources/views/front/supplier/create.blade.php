@extends('layouts.frontLayout.front-layout')

@section('title', 'Add Supplier')

@section('content')

<section class="left-main-bg  ">

  <div class="container ">

    <div class="row ">
      <div class="col-md-4 d-none d-md-block ">

        @include('layouts.frontLayout.profile-sidebar')

      </div>

      <div class="col-md-8">

        <div class="cust-left-block pt-4">

          <!--<div class="d-flex align-items-center filter-details mb-4">

              <span class="filter-block1"></span><br />

        </div>-->



          <div class="row">

            <div class="col-12 mb-3">

              <form id="supplierForm" method="post" enctype="multipart/form-data">

                <div class="alert alert-danger print-error-msg" style="display:none">

                  <ul></ul>

                </div>

                <h2 class="page-heading">Supplier Details</h2>



                <div class="row">

                  <div class="col-8">

                    <div class="d-flex align-items-center w-100">

                      <div class="input-field mt-4 w-100">

                        <input type="text" autocomplete="off" name="supplier_name" class="input-block" placeholder=" ">

                        <label for="search-bike" class="input-lbl">Supplier Name</label>

                      </div>

                    </div>




                    <div class="d-flex align-items-center w-100">

                      <div class="input-field mt-4 w-100">

                        <input type="text" autocomplete="off" name="supplier_address" class="input-block" placeholder=" ">

                        <label for="search-bike" class="input-lbl">Supplier Address</label>

                      </div>

                    </div>
                    <div class="d-flex align-items-center w-100">
                      <div class="dropzone flex-row p-3 justify-content-start position-relative mt-3 h-75" id="dropzone">
                        <div class="drop-icon mr-3"><i class="fa fa-file-image-o"></i></div>
                        <div class="drop-box-format  ">Drag and drop <span class="text-gray">or</span> <span class="text-danger">Select from Gallery</span></div>
                        <input type="file" class="input-block upload-group-detail h-100" required accept="image/*" name="supplier_image" id="supplier_image">


                      </div>


                    </div>
                    <div class="d-flex align-items-center w-100">

                      <div class="input-field mt-4 w-100">
                        <div class="row">
                          <div class="col-6">

                            <span class="rating-txt">Supplier Rating</span>

                          </div>

                          <div class="col-6">

                            <div class="star-rating-block">

                              <input type="radio" name="supplier_rating" value="5"><span class="star"> </span>

                              <input type="radio" name="supplier_rating" value="4"><span class="star"> </span>

                              <input type="radio" name="supplier_rating" value="3"><span class="star"> </span>

                              <input type="radio" name="supplier_rating" value="2"><span class="star"> </span>

                              <input type="radio" name="supplier_rating" value="1" checked><span class="star"> </span>

                            </div>

                          </div>
                        </div>
                      </div>

                    </div>

                  </div>

                </div>





                <div class="row">
                  <div class="col-12">
                    <h4 class="page-sub-heading mt-2 mb-2">Spare Part</h4>

                    <div class="d-flex align-items-center w-100 mt-4 border rounded p-3">
                      <div class="row">
                        <div class="col-6">
                          <div class="input-field  mb-0 w-100">
                            <input type="text" name="spare_part_name[]" class="input-block" placeholder=" ">
                            <label for="search-bike" class="input-lbl">Name</label>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="input-field  mb-0 w-100 ">
                            <input type="text" name="spare_part_number[]" class="input-block" placeholder=" ">
                            <label for="search-bike" class="input-lbl">Serial Number</label>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="input-field  mb-0 w-100 "></div>
                          <div class="dropzone flex-row p-3 justify-content-start position-relative mt-3 h-75" id="dropzone">
                            <div class="drop-icon mr-3"><i class="fa fa-file-image-o"></i></div>
                            <div class="drop-box-format  ">Drag and drop <span class="text-gray">or</span> <span class="text-danger">Select from Gallery</span></div>
                            <input type="file" name="spare_part_image[]" class="input-block upload-group-detail h-100" placeholder=" ">
                          </div>
                        </div>
                      </div>
                      <div class="add-via-btn"> <a href="#" id="more_spare_parts"><img src="{{ asset('public/rider/images/icons-clickable-add.svg')}}"></a></div>
                    </div>
                    
                  </div>
                </div>

                <div class="col-12">
                  <div class="row" id="spare_parts_div">
                  </div>
                </div>
                <!-- <div class="form-group" id="spare_parts_div"></div> -->







                <div class="row">

                  <div class="col-12">
                    <div class="input-field mb-0  mt-3 w-100">
                      <textarea class="input-block floating-textarea md-textarea  " name="supplier_description" id="description" placeholder=" " value="" style="height:100px"></textarea>

                      <label class="input-lbl">About Supplier</label>
                    </div>



                  </div>

                </div>



                <hr class="full-h-line my-4">

                <div class="text-right pb-3">

                  <button type="button" class="post-btn lg px-5" id="submitSupplier">Submit</button>

                </div>







              </form>
            </div>
          </div>



        </div>

      </div>
    </div>
  </div>

</section>

@stop