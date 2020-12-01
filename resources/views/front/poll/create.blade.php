@extends('layouts.frontLayout.front-layout')

@section('title', 'Add Poll')

@section('content')

<section class="left-main-bg  h-100">

	<div class="container  h-100">

		<div class="row h-100">
			<div class="col-md-4 d-none d-md-block  h-100">

				@include('layouts.frontLayout.profile-sidebar')

			</div>

			<div class="col-md-8">

				<div class="cust-left-block pt-5">



					<!-- <div class="d-flex align-items-center filter-details mb-4">

			                <span class="filter-block1"></span><br/>

                        </div>-->



					<div class="row">

						<div class="col-8 mb-3">

							<form id="pollForm" method="post">

								<h4 class="login-heading">Add New Poll<small>Add Poll for getting feedback</small></h4>

								<div class="alert alert-danger print-error-msg" style="display:none">

									<ul></ul>

								</div>

								<div class="login-input">
									<div class="input-field mb-0  mt-3 w-100">
										<select class="floating-select" name="group_id" onclick="this.setAttribute('value', this.value);" value="">

											<option value=""> </option>

											@foreach($groups as $group)

											<option value="{{$group['id']}}">{{$group['group_name']}}</option>

											@endforeach
										</select>

										<label class="input-lbl">Choose Group</label>
									</div>


									<div class="input-field  mb-0 w-100 mt-4 ">
										<input type="text" autocomplete="off" name="poll_title" id="poll_title" class="input-block" placeholder=" ">
										<label for="poll_title" class="input-lbl">Poll Title</label>
									</div>

									<div class="p-3 rounded border mt-4">
										<div class="d-flex align-items-center w-100 ">

											<div class="input-field  mb-0 w-100  ">
												<input type="text" autocomplete="off" name="question[]" id="search-bike" class="input-block" placeholder=" ">
												<label for="search-bike" class="input-lbl">Question Name</label>
											</div>
											<div class="add-via-btn"> <a href="#" class="add_more_questions" title="Add Question" id="btnAdd"><img src="{{ asset('public/rider/images/icons-clickable-add.svg')}}"></a></div>
										</div>

										<div class="col-11 pl-0 d-flex align-items-center w-100 mt-4">

											<div class="input-field  mb-0 w-100  ">
												<input type="text" autocomplete="off" name="options_0[]" id="search-bike" class="input-block" placeholder=" ">
												<label for="search-bike" class="input-lbl">Option Name</label>
											</div>
											<div class="add-via-btn"> <a href="#" title="Add Option" class="add_more_options" content="1"><img src="{{ asset('public/rider/images/icons-clickable-add.svg')}}"></a></div>
										</div>
										<div id="more_options_list_1"></div>
									</div>



									<div id="more_questions_list"></div>
									
									<hr class="full-h-line my-4">
									<div class="text-right pb-3">

										<button type="button" class="post-btn lg px-5" onclick="savePoll();">SUBMIT</button>

									</div>

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