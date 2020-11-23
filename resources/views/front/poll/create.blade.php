@extends('layouts.frontLayout.front-layout')
@section('title', 'Add Poll')
@section('content')
<section class="main-bg">
	<div class="container ">
	    <div class="row">
		    <div class="col-md-8">
		            <div class="cust-left-block">
                        <a href="{{route('polls.index')}}">< Back To Poll Page</a>
			            <div class="d-flex align-items-center filter-details mb-4">
			                <span class="filter-block1"></span><br/>
                        </div>
                        <div class="row" id="tab1">
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-8 mb-3">                        
                                        <form id="pollForm" method="post">
                                            <h4 class="login-heading">Add New Poll<small>Add Poll for getting feedback</small></h4>
                                            <div class="alert alert-danger print-error-msg" style="display:none">
                                                <ul></ul>
                                            </div>
                                            <div class="login-input">
                                                <div class="form-group">
                                                    <select name="group_id" class="form-control">
                                                        <option value="">Choose Group </option>
                                                        @foreach($groups as $group)
                                                        <option value="{{$group['id']}}">{{$group['group_name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" autocomplete="off" name="question[]" class="form-control" placeholder="Question Name">
                                                    <button class="btn btn-outline-success btn-sm add_more_questions">+ Add Question</button>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" autocomplete="off" name="options_0[]" class="form-control" placeholder="Option Name">
                                                    <!-- <input type="checkbox" name="right_option[]" value="1"> Correct -->
                                                    <i class="fa fa-plus add_more_options" content="1"></i>
                                                    <div id="more_options_list_1"></div>
                                                </div>                                                
                                                <div id="more_questions_list"></div>
                                                <div class="form-group">						
                                                    <button type="button" class="btn btn-danger w-100" onclick="savePoll();">SUBMIT</button>
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
        </div>
	</div>
</section>
@stop