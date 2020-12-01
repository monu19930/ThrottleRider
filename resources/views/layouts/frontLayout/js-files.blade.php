<!-- JS FILES NOW -->
<script src="{{ asset('public/rider/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{ asset('public/rider/js/bootstrap.bundle.js')}}"></script>
<script src="{{ asset('public/rider/js/slick.js')}}"></script>
<script src="{{ asset('public/rider/js/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('public/rider/js/sweetalert.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{ asset('public/rider/js/jquery.multiselect.js')}}"></script>
<script src="{{ asset('public/rider/js/jquery-ui.min.js')}}" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script> 
<script src="{{ asset('public/rider/js/jquery.email.multiple.js')}}"></script>
<script src="{{ asset('public/rider/js/jquery.slimscroll.min.js')}}"></script>

@if(Route::currentRouteName()=='add-bike' || Route::currentRouteName()=='bikes.edit')
<script src="{{ asset('public/js/bike.js')}}"></script>
@endif

@if(Route::currentRouteName()=='my-rides.create' || Route::currentRouteName()=='my-groups.events.create')
<script src="{{ asset('public/js/bike.js')}}"></script>
@endif

@yield('javascript')
<script type="text/javascript">
    function registerRider () { 
        $(function() {
            $('#signup').html('Please Wait...').attr("disabled", true);
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')}
            });
            $.ajax({
                url: "{{route('rider-register')}}",
                type: "POST",
                data: $('#signupForm').serialize(),
                success: function( response ) {                    
                    if(response.status==true) {
                        var redirect = "{{ route('my-profile') }}";
                        successMessage(response.msg, 'signup', 'CREATE A NEW ACCOUNT', 'signupForm', redirect , 'form-group');
                    }
                },
                error: function(response) {
                    errorMessage(response.responseJSON.errors, 'signup', 'CREATE A NEW ACCOUNT', 'form-group');
                }
            });
        });
    }

    function signinRider() {
        $('#signinRiderBtn').text('Please wait...').attr('disabled', false);
        $(function() {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')}
            });
            $.ajax({
            url: "{{route('rider-login')}}",
            type: "POST",
            data: $('#loginForm').serialize(),
            success: function( response ) {                
                if(response.status==true) {
                    var redirect = "{{ route('my-profile') }}";
                    successMessage(response.msg, 'signinRiderBtn', 'LOGIN', 'loginForm', redirect , 'form-group');
                }
                else {
                    errorMessage(response.error, 'signinRiderBtn', 'LOGIN', 'form-group');
                }
            }
            });
        });
    }

    

    $(function() {
        //Update Rider Profile
        $('#updateProfile').on('click', function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('edit-profile')}}",
                type: "POST",
                data: new FormData($('#profileForm')[0]),
                processData: false,
                contentType: false,
                cache:false,
                success: function( response ) {
                    if(response.status==true) {
                        swal('Success', 'Profile updated successfully!', 'success');
                        setTimeout(function () {                            
                            location.replace("{{ route('my-profile') }}");
                        }, 3000);
                    }
                    else {
                        showErrorMessage(response.error);
                    }
                }
            });
        });

        //
        $("#invite_group_member_email").email_multiple({
            data: '',
            color:"#343a40",
            textColor:"#000000"
            // reset: true
        });

        
        $("#bike_list").autocomplete({ 
            source: function (request, response) {
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
                $.ajax({ 
                    url:"{{route('bike-search')}}", 
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
            select : getBikeDetails
        });

        //login 
        $('#loginForm').keypress((e) => {
            if (e.which === 13) { 
                signinRider();
            } 
        }) 

        //submit bike form step 1
        $('#submitBikeStep1').on('click', function(){
            var referer = this;
            $(this).text('Please Wait .....').attr('disabled', true);
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('bike-register1')}}",
                type: "POST",
                data: $('#addBikeForm1').serialize(),
                success: function( response ) {
                    $('#bike_tab2').show();
                    $('#bike_tab1').hide();
                    $('.input-field span.text-danger').remove();
                    $(referer).text('CONTINUE').attr('disabled', false);
                    $('#progressStep1').removeClass('active-list').addClass('selected-list');
                    $('#progressStep2').addClass('active-list');

                    $('#bikeProgress1').html('<i class="fa fa-check" aria-hidden="true"></i>');
                    $('#bikeProgress2').text('2');
                             
                },
                error: function(response) {                   
                    errorMessage(response.responseJSON.errors, 'submitBikeStep1', 'CONTINUE')
                } 
            });
        });


        //Submit Bike Form Step 2
        $('#submitBikeStep2').on('click', function(){
            $(this).text('Please wait....').attr('disabled', true);
            var referer = this;
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('bike-register2')}}",
                type: "POST",
                data: new FormData($('#addBikeForm2')[0]),
                processData: false,
                contentType: false,
                cache:false,
                success: function( response ) {
                    if(response.status==false) {
                        errorMessage(response.error, 'submitBikeStep2', 'CONTINUE');
                    }
                    else {
                        $('#bike_tab2').hide();
                        $('#bike_tab1').hide();
                        $('#review_bike').show();
                        $(referer).text('CONTINUE').attr('disabled', false);                    
                        $('#review_bike').html(response);

                        $('#progressStep1').removeClass('selected-list').addClass('selected-list');
                        $('#progressStep2').removeClass('active-list').addClass('selected-list');
                        $('#progressStep3').addClass('active-list')

                        $('#bikeProgress1').html('<i class="fa fa-check" aria-hidden="true"></i>');
                        $('#bikeProgress2').html('<i class="fa fa-check" aria-hidden="true"></i>');
                        $('#bikeProgress3').text('3');
                    }
                }
            });
        });
 
        //submit ride form step 1
        $('#rideStep1').on('click', function(){
            $(this).text('Please Wait...').attr("disabled", true);
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('my-rides.register1')}}",
                type: "POST",
                data: $('#addRideForm1').serialize(),
                success: function( response ) {
                    if(response.status == true) {
                        $('#rideStep1').text('CONTINUE').attr("disabled", false);
                        $('#tab2').show();
                        $('#tab1').hide();

                        $('#progressStep1').removeClass('active-list').addClass('selected-list');
                        $('#progressStep2').addClass('active-list');

                        $('#bikeProgress1').html('<i class="fa fa-check" aria-hidden="true"></i>');
                        $('#bikeProgress2').text('2');

                        if(response.days == 0){
                            $('#add').hide();
                        }
                        $('#start_location_0').val(response.start_location);
                        $('#first_day').attr('content', response.days);

                        $('.next_day').text('PROCEED TO DAY '+response.days);
                    } else {
                        errorMessage(response.error,'rideStep1', 'CONTINUE');

                    }
                }
            });
        });

        //post ride
        $('.post-ride').on('click', function(){
            var is_user = "{{Auth::user()}}";
            if(!is_user) {
                $('#loginmodal').modal('show');
            } else{
                location.replace("{{route('my-rides.create')}}");
            }
        })

        //Submit Ride Form Step 2
        $('#rideStep2').on('click', function(){
            var max_day = $('#first_day').attr('content');
            if($('input[name=end_location_'+max_day+']').val() == '') {                
                scroll();
                $(document).find('[name=end_location_'+max_day+']').after('<span class="text-strong text-danger">End location field is required</span>');
            }
            else{
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
                $.ajax({
                    url: "{{route('my-rides.register2')}}",
                    type: "POST",
                    data: new FormData($('#addRideForm2')[0]),
                    processData: false,
                    contentType: false,
                    cache:false,
                    success: function( response ) {
                        $('#tab2').hide();
                        $('#tab1').hide();                   
                        $('#review_ride').show();                        
                        $('#review_ride').html(response);

                        $('#progressStep1').removeClass('selected-list').addClass('selected-list');
                        $('#progressStep2').removeClass('active-list').addClass('selected-list');
                        $('#progressStep3').addClass('active-list')

                        $('#bikeProgress1').html('<i class="fa fa-check" aria-hidden="true"></i>');
                        $('#bikeProgress2').html('<i class="fa fa-check" aria-hidden="true"></i>');
                        $('#bikeProgress3').text('3');
                    }
                });
            }
        });

        //Event form step 1
        $('#eventStep1').on('click', function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('my-groups.events.add.step1')}}",
                type: "POST",
                data: $('#addEventForm1').serialize(),
                success: function( response ) {
                    if(response.status == true) {
                        $('#tab2').show();
                        $('#tab1').hide();
                        if(response.days == 0){
                            $('#add').hide();
                        }
                        $('#start_location_0').val(response.start_location);
                        $('#first_day').attr('content', response.days);
                    }
                }, error: function(response){                   
                    showErrorMessage(response.responseJSON.errors);
                }
            });
        });

        //Event Form Step 2
        $('#eventStep2').on('click', function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('my-groups.events.add.step2')}}",
                type: "POST",
                data: new FormData($('#addEventForm2')[0]),
                processData: false,
                contentType: false,
                cache:false,
                success: function( response ) {
                    $('#tab2').hide();
                    $('#tab1').hide();                   
                    $('#review_ride').show();                        
                    $('#review_ride').html(response);
                }
            });
        });

        //Add Group 
        $('#submitGroup').on('click', function(){
            var form_id = 'groupForm';
            var url = "{{route('my-groups.store')}}"; 
            var redirectUrl = "{{route('my-groups.index')}}"; 
            submitForm(form_id, url, redirectUrl, 'submitGroup', 'SUBMIT');
        });

        //social login
        $('.social_login').on('click', function(){
            var socialUrl = $(this).attr('data-content');
            $('#loginmodal').modal('hide');
            socialWindow = window.open(
                socialUrl, 'socialWindow', 'height=500,width=500,left=40,top=40,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes');
        
        });


        $(function() {
            var dateToday = new Date(); 
            $("#start_date").datepicker({
                dateFormat: 'yy-mm-dd',
                maxDate: dateToday,
                onSelect: function (selected) {
                    var dt = new Date(selected);
                    //var dt = new Date();
                    console.log(dt);
                    dt.setDate(dt.getDate() + 1);
                    $("#end_date").datepicker("option", "minDate", dt);
                }
            });

            $("#end_date").datepicker({
                dateFormat: 'yy-mm-dd',
                maxDate: dateToday,
                onSelect: function (selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() - 1);
                    $("#start_date").datepicker("option", "maxDate", dt);
                }
            });


            $("#estart_date").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: dateToday,
                onSelect: function (selected) {
                    var dt = new Date(selected);
                    //var dt = new Date();
                    console.log(dt);
                    dt.setDate(dt.getDate() + 1);
                    $("#eend_date").datepicker("option", "minDate", dt);
                }
            });

            $("#eend_date").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: dateToday,
                onSelect: function (selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() - 1);
                    $("#estart_date").datepicker("option", "maxDate", dt);
                }
            });

         });

        //Ride Submit Step
        $('#riderSubmit').on('click',function(){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('my-rides.store')}}",
                type: "POST",
                data: {status:true},
                processData: false,
                contentType: false,
                success: function( response ) {
                    //do nothing
                }
            });
        });

        //Ride Submit Step
        $('.group_past_experience').on('click',function(){
            $('.form-group span.text-danger').remove();
            $('#past_experience_id').val($(this).attr('content'));
            $('#pastExperienceModal').modal('show');
        });


        //show hide rideDays tabs

        $('.moreDays').on('click', function(){
            var newId = $(this).attr('href');
            newId = newId.replace('#','');

            if(newId == 'day1') {
                $('#dynamic_field .tab-pane').removeClass('show active');
                $('#'+newId).addClass('show active');
            }
            else {        
                $('#dynamic_field #'+newId).addClass('show active');
            }

            $('.moreDays').removeClass('active').attr('area-selected','fasle');
            $(this).addClass('active').attr('area-selected','true');
        });

        //Start Added Code For Add More Ride Day
        var i=0;
        $('#add').click(function(){
            var max = $('#first_day').attr('content');
            var end_loc = $('input[name=end_location_'+i+']').val();
            var start_location = $('input[name=start_location_'+i+']').val();
            
            var tab = 2+parseInt(i);
            var error = false;

            $('.input-field span.text-danger').remove();
            if(end_loc == ''){                
                var key = "end_location_"+i;
                $(document).find('[name='+key+']').after('<span class="text-strong text-danger">End location field is required</span>');
                error = true;
            }

            if(start_location == ''){              
                var key = "start_location_"+i;
                $(document).find('[name='+key+']').after('<span class="text-strong text-danger">Start location field is required</span>');
                error = true;
            }

            var nextDay = tab+parseInt(1);

            if(error == false) {

                if(i < max) {
                    i++;                
                    if(i == parseInt(max)) {
                        $(this).hide();                        
                        $('.next-day').hide();
                        $('#rideStep2').show();                      
                    }
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                    });
                    $.ajax({
                        url: "{{route('my-rides.add-day')}}",
                        type: "POST",
                        data: {val: i, end_location: end_loc},
                        success: function( response ) {
                            $('#myTab li a').removeClass('active')
                            $('#more_days').append('<li class="nav-item" role="presentation">'+
                            '<a class="moreDays nav-link active" onclick="showHideActiveTab()" id="day2-tab" data-toggle="tab" href="#day'+tab+'" role="tab" aria-controls="Day2" aria-selected="true"><span>Day '+tab+'</span></a>'
                        +'</li>');

                            $('#daysContent .tab-pane').removeClass('active show');
                            $('#dynamic_field').append(response);

                            $('#add').html('<i class="fa fa-plus"></i>&nbsp; Add Day'+nextDay);

                            $('.next-day').attr('onclick', 'moveToNextDay('+i+')').text('PROCEED TO DAY '+nextDay);
                        }
                    });                
                }
            }
        });

        $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#row'+button_id+'').remove();
            $('#add').show();
            i--;
        }); 
        //End Added Code For Add More Ride Day

        //multiselect
       
        //Add More Via Location
        var via = 1;
        $('#add_more_via').click(function(e){
            e.preventDefault(); 
            if(via < 5){
                via++;
                $('#via_location_more').append('<div class="d-flex align-items-center w-100  mt-4">'+
                "<div class='mr-2 pr-1'><img src='{{ asset('public/rider/images/icons-via.svg')}}' class='img-fluid img-icon'></div>"+
                '<div class="input-field  mb-0 w-100 left-seprater-dotted">'+
                    '<input type="text" class="input-block via_location" autocomplete="off" name="via_location[]" placeholder=" ">'+
                    '<label for="search-bike" class="input-lbl">Via</label>'+
                '</div><div class="add-via-btn remove_field">'+
                "<a href='javascript:void(0)'><img src='{{ asset('public/rider/images/icons-clickable-less.svg')}}'></a></div>"+            
            '</div>');
            } 
        }); 
        $('#via_location_more').on("click",".remove_field", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); via--; 
        })


        //Add More Spare Parts
        var max_spare_parts = 8;
        var k = 1;
        $('#more_spare_parts').click(function(e){
            e.preventDefault(); 
            if(k < max_spare_parts){
                k++;
                $('#spare_parts_div').append('<div class="col-12"><div class="d-flex align-items-center w-100 mt-4"><div class="input-field  mb-0 w-100 left-seprater-dotted">'+
                    '<input type="text" name="spare_part_name[]" class="input-block" placeholder=" "><label for="search-bike" class="input-lbl">Name</label></div>'+
                    '<div class="input-field  mb-0 w-100 left-seprater-dotted"><input type="text" name="spare_part_number[]" class="input-block" placeholder=" "><label for="search-bike" class="input-lbl">Serial Number</label></div>'+
                    '<div class="input-field  mb-0 w-100 left-seprater-dotted"><input type="file" name="spare_part_image[]" class="input-block" placeholder=" "></div>'+
                    "<div class='add-via-btn remove_field'><a href='javascript:void(0)'><img src='{{ asset('public/rider/images/icons-clickable-less.svg')}}'></a></div></div>"+
                    '</div>'
                );
            } 
        }); 
        $('#spare_parts_div').on("click",".remove_field", function(e){ 
            e.preventDefault(); $(this).parent('div').parent('div').remove(); 
            k--; 
        })


        //Add More Ride Luggage
        var max_fields_limit = 8;
        var m = 1;
        $('#add_more_ride_luggage').click(function(e){
            e.preventDefault(); 
            if(m < max_fields_limit){
                m++;
                $('#ride_luggage_list').append('<div class="d-flex align-items-center w-100 mt-4"><div class="input-field  mb-0 w-100">'+
                '<input type="text" autocomplete="off" class="input-block" name="ride_luggage[]" placeholder=" ">'+
                '<label for="search-bike" class="input-lbl">Add Your Point</label></div>'+
                '<a href="javascript:void(0)" class="remove_field">Remove</a></div>');
            } 
        }); 
        $('#ride_luggage_list').on("click",".remove_field", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); m--; 
        })


        //add more polls options
        $('.add_more_options').click(function(e){
            e.preventDefault();
            var queNum = $(this).attr('content');
            var option = $('#more_options_list_1 .quest_'+queNum+'_option').length;
            if(option < 3){    

                $('#more_options_list_'+queNum).append('<div class="col-11 pl-0 d-flex align-items-center w-100 mt-4 quest_'+queNum+'_opt_'+option+'">'+
                    '<div class="input-field  mb-0 w-100  ">'+
                        '<input type="text" autocomplete="off" name="options_0[]" id="search-bike" class="input-block quest_'+queNum+'_option" placeholder=" ">'+
                        '<label for="search-bike" class="input-lbl">Option Name</label>'+
                    '</div>'+
                    '<div class="add-via-btn">'+
                        '<a href="javascript:void(0)" title="Add Option" onclick="removeMoreOption('+queNum+','+option+')">'+
                            "<img src='{{ asset('public/rider/images/icons-clickable-less.svg')}}'>"+
                        '</a>'+
                    '</div>'+
                '</div>');
            } 
        }); 
        


        //Add more option for more questions
        $('#more_questions_list').on("click",".add_more_options", function(e){ 
            e.preventDefault(); 
            var queNum = $(this).attr('content');
            var option = $('#more_questions_list .quest_'+queNum+'_option').length;
            if(option < 4){
                

                $('#more_options_list_'+queNum).append('<div class="col-11 pl-0 d-flex align-items-center w-100 mt-4 quest_'+queNum+'_opt_'+option+'">'+
                    '<div class="input-field  mb-0 w-100  ">'+
                        '<input type="text" autocomplete="off" name="options_'+(queNum-1)+'[]" id="search-bike" class="input-block quest_'+queNum+'_option" placeholder=" ">'+
                        '<label for="search-bike" class="input-lbl">Option Name</label>'+
                    '</div>'+
                    '<div class="add-via-btn">'+
                        '<a href="javascript:void(0)" title="Add Option" onclick="removeMoreOption('+queNum+','+option+')">'+
                            "<img src='{{ asset('public/rider/images/icons-clickable-less.svg')}}'>"+
                        '</a>'+
                    '</div>'+
                '</div>');
            } 
        });

        //add more polls questions
        var quest = 1;
        $('.add_more_questions').click(function(e){
            e.preventDefault(); 
            //console.log(quest);
            if(quest < 10){
                quest++;
                

                $('#more_questions_list').append('<div class="p-3 rounded border mt-4">'+
					'<div class="d-flex align-items-center w-100 ">'+
						'<div class="input-field  mb-0 w-100  ">'+
							'<input type="text" autocomplete="off" name="question[]" id="search-bike" class="input-block" placeholder=" ">'+
							'<label for="search-bike" class="input-lbl">Question Name</label>'+
						'</div>'+
						'<div class="add-via-btn"> '+
                            '<a href="#" class="remove_field" title="Add Question" id="btnAdd">'+
                                "<img src='{{ asset('public/rider/images/icons-clickable-less.svg')}}'>"+
                            '</a>'+
                        '</div>'+
					'</div>'+
					'<div class="col-11 pl-0 d-flex align-items-center w-100 mt-4">'+
						'<div class="input-field  mb-0 w-100  ">'+
							'<input type="text" autocomplete="off" name="options_'+(quest-1)+'[]" id="search-bike" class="input-block quest_'+quest+'_option" placeholder=" ">'+
							'<label for="search-bike" class="input-lbl">Option Name</label>'+
						'</div>'+
                        '<div class="add-via-btn">'+
                            '<a href="#" title="Add Option" class="add_more_options" content="'+quest+'">'+
                                "<img src='{{ asset('public/rider/images/icons-clickable-add.svg')}}'>"+
                            '</a>'+
                        '</div>'+
				    '</div>'+
					'<div id="more_options_list_'+quest+'""></div>'+
				'</div>');
            } 
        }); 
        $('#more_questions_list').on("click",".remove_field", function(e){ 
            //e.preventDefault(); $(this).parent('div').remove(); quest--; 
            e.preventDefault(); $(this).parent('div').parent('div').parent('div').remove(); quest--; 
        })

        //Back Bike Step Event
        $('#backBikeStep1').on('click', function(){
            $('#bike_tab2').hide();
            $('#bike_tab1').show();

            $('#progressStep1').removeClass('selected-list').addClass('active-list');
            $('#progressStep2').removeClass('active-list');

            $('#bikeProgress1').text('1');
        })


        //Back Ride Step Event        
        $('#backRideStep1').on('click', function(){
            $('#tab2').hide();
            $('#tab1').show();

            $('#progressStep1').removeClass('selected-list').addClass('active-list');
            $('#progressStep2').removeClass('active-list');

            $('#bikeProgress1').text('1');
        })

        //Save Ride Luggage
        $('#rideLuggageSubmit').on('click', function(){
            var luggage = [];
            var inps = document.getElementsByName('ride_luggage[]');
            var ttl = inps.length;
            for (var n = 0; n < ttl; n++) {
                var inp=inps[n];
                if(inp.value != '') {
                    luggage.push(inp.value);
                }
            }

            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');

            if(luggage.length > 0) {
                $('#ride_luggage').attr('value', JSON.stringify(luggage));
                $(".print-error-msg").removeClass("alert-danger").addClass('alert-success');            
                $(".print-error-msg").find("ul").append('<li>Ride luggage added successfully</li>');
                setTimeout(function () {
                    if ($(".alert").is(":visible")){
                        $(".alert").fadeOut("fast");
                    }
                    $('#rideLuggageModal').modal('hide');
                }, 3000);
            } else {   
                $(".print-error-msg").removeClass("alert-success").addClass('alert-danger');            
                $(".print-error-msg").find("ul").append('<li>Field is required</li>');
                setTimeout(function () {
                    if ($(".alert").is(":visible")){
                        $(".alert").fadeOut("fast");
                    }
                }, 3000);
            }
            
            
        })

        //Add Supplier
        $('#submitSupplier').on('click', function(){
            //var form_id = 'supplierForm';
            var url = "{{route('suppliers.store')}}"; 
            var redirectUrl = "{{route('suppliers.index')}}"; 
            submitForm('supplierForm', url, redirectUrl, 'submitSupplier', 'SUBMIT', 'input-field');
        });       


        //Show feedbackPoll Modal
        $('.view-feedback-poll').on('click', function(){
            var group = $(this).attr('data-content');
            //console.log(group);return false;
            $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
            $.ajax({ 
                url:"{{route('get-group-polls')}}", 
                type: "POST",
                data: {group: group},                
                success: function (response) {
                    $('#feedbackPollModal').modal('show');
                    $('.pollFeedbackQuestions').html(response); 
                }, 
            });            
        })
        

        //search filter
        $("#search-input").autocomplete({ 
            source: function (request, response) {
                $('#submit-search').attr('content', request.term);
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
                $.ajax({ 
                    url:"{{route('search-location')}}", 
                    type: "POST",
                    format: "json",
                    data: {
                        limit: 8,
                        search: request.term
                    },
                    
                    success: function (data) {
                        response(data);
                    }, 
                }); 
            },
        });

        //search filter
        $("#search-input2").autocomplete({ 
            source: function (request, response) {
                $('#submit-search2').attr('content', request.term);
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
                $.ajax({ 
                    url:"{{route('search-location')}}", 
                    type: "POST",
                    format: "json",
                    data: {
                        limit: 8,
                        search: request.term
                    },
                    
                    success: function (data) {
                        response(data);
                    }, 
                }); 
            },
        });

        $("#btnAdd").on("click", function () {
            console.log('checkkk');
       
        });

    $("body").on("click", ".remove", function () {
        $(this).closest("div").parent("div").remove();
    });

        $('#submit-search2').on('click', function(){
            var search_keyword = $('#search-input2').val();
            var key = $('#submit-search2').attr('content');
            if(search_keyword!=''){
                $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                    });
                $.ajax({ 
                    url:"{{route('search-location-result')}}", 
                    type: "POST",
                    format: "json",
                    data: {
                        search: key,
                        search_type: search_keyword
                    },
                    
                    success: function (response) {
                        //response(data);
                        $('#search_res').html(response);  
                    }, 
                });
            }
            else{
                $('#search-input2').focus();
            }
        })

        $('#submit-search').on('click', function(){
            var search_keyword = $('#search-input').val();
            var key = $('#submit-search').attr('content');
            $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
            $.ajax({ 
                url:"{{route('search-location-result')}}", 
                type: "POST",
                format: "json",
                data: {
                    search: key,
                    search_type: search_keyword
                },
                
                success: function (response) {
                    //response(data);
                    $('#search_res').html(response);  
                }, 
            }); 
        })

        $(".number-data").keydown(function(event) {
            if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 ) {
            }
            else {
                if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                    event.preventDefault(); 
                }   
            }
        });


        //Rider Group Join
        $('.rider-group-join').on('click', function(){
            var newId = this;
            var is_user = "{{Auth::user()}}";
            if(!is_user) {
                $('#loginmodal').modal('show');
            }
            
            var group_id = $(this).attr('content');
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('join-group')}}",
                type: "POST",
                data: {group_id:group_id},
                success: function( response ) {
                    if(response.status==true) {                           
                        $(newId).replaceWith('<button class="join-btn flex-grow-1 mt-2 mr-1" ><i class="fa fa-send mr-2"></i>Joined</button>');               
                    }         
                }
            });
            
        })

        //add bike home
         $('.front-bike-add').on('click', function(){
            var is_user = "{{Auth::user()}}";
            if(!is_user) {
                $('#loginmodal').modal('show');
            }
            else {
                location.replace("{{route('add-bike')}}");
            }
        })

        //remove bike
        $('.ride-remove').on('click', function(){
            var id = $(this).attr('content');
            var url = "{{route('my-rides.destroy')}}";
            var cls = "ride-refferer";
            deleteRecord(id,url,cls);
        });

        //remove bike
        $('.bike-remove').on('click', function(){
            var id = $(this).attr('content');
            var url = "{{route('delete-bike')}}";
            var cls = "bike-refferer";
            deleteRecord(id,url,cls);            
        })

        $('.remove_record').on('click', function(){
            var url = $(this).attr('data-content');
            var cls = $(this).attr('id');
            deleteRecordSource(url,cls);            
        })


        //scroll poll listing div
        $('.scroll-div').slimScroll({
            allowPageScroll: true,
            //height: auto,
        });

        
    });

    function submitForm(form_id, url, redirect_url, btnId, btnText, fieldClass='form-group') {
        $('#'+btnId).text('Please wait...').attr('disabled', true);
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData($('#'+form_id)[0]),
            processData: false,
            contentType: false,
            cache:false,
            success: function( response ) {
                if(response.status == true) {
                    $('.'+fieldClass+' span.text-danger').remove();
                    $('#'+btnId).text(btnText).attr('disabled', false);
                   
                    document.getElementById(form_id).reset();
                    swal('Success', response.msg, 'success');
                    
                    setTimeout(function () {
                        location.replace(redirect_url);
                    }, 3000)
                } else {
                    errorMessage(response.error, btnId, btnText, fieldClass);
                }
            }, error: function(response) {
                errorMessage(response.responseJSON.errors, btnId, btnText, fieldClass);
            }
        });
    }

    function showErrorMessage(error,type='') {
        if(type=='') {
            scroll();
        }
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( error, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
        $(".print-error-msg").addClass('alert-danger').removeClass('alert-success');
        setTimeout(function () {
            if ($(".alert").is(":visible")){
                $(".alert").fadeOut("fast");
            }
        }, 3000);
    }

    function sendGroupInvitation() {

        var emails = [];
        $('.email-ids').each(function(){
            var email = $(this).text();
            emails.push(email);
        })
        var member = $('#group_member').val();

        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
        $.ajax({
            url: "{{route('invite-group-members')}}",
            type: "POST",
            data: {email: emails, member: member},
            success: function( response ) {
                if(response.status==true) {
                    $(".invite-error-msg").find("ul").html('');
                    $(".invite-error-msg").css('display','block');                 
                    $(".invite-error-msg").find("ul").append('<li>'+response.msg+'</li>');
                    $(".invite-error-msg").addClass("alert-success").removeClass('alert-danger');                    
                    setTimeout(function () {
                        if ($(".alert").is(":visible")){
                            $(".alert").fadeOut("fast");
                        }
                        document.getElementById("inviteGroupMembersForm").reset();
                        $('.all-mail span').remove();
                        $('#inviteMembersModal').modal('hide');
                    }, 3000);
                } 
                else {
                    $(".invite-error-msg").find("ul").html('');
                    $(".invite-error-msg").css('display','block');                 
                    $(".invite-error-msg").find("ul").append('<li>'+response.msg+'</li>');
                    $(".invite-error-msg").addClass("alert-danger").removeClass('alert-success');
                    setTimeout(function () {
                        if ($(".alert").is(":visible")){
                            $(".alert").fadeOut("fast");
                        }
                    }, 3000);
                }         
            }
        });
    }

    function inviteMembers(id) {
        $('#group_member').val(id);
        $('#inviteMembersModal').modal('show');
    }


    function reviewBikeDetails(){
        //$('.review-bike-selected').hide();
        $('.review-bike-selected').attr('style', 'display: none !important');
        $('#review_bike_change').show();


    }
    function cancelReviewBikeChange(){
        $('.review-bike-selected').show();
        $('#review_bike_change').hide();
    }

    function reviewBikeImagesDetails() {
        //$('.review-bike-image-selected').hide();
        $('.review-bike-image-selected').attr('style', 'display: none !important');
        $('#review_bike_images_change').show();
    }
    function cancelReviewBikeImagesChange() {
        $('.review-bike-image-selected').show();
        $('#review_bike_images_change').hide();
    }

    function reviewBikeMoreDetails() {
        //$('.review-bike-moredetails-selected').hide();
        $('.review-bike-moredetails-selected').attr('style', 'display: none !important');
        $('#review-bike-moredetails-change').show();
    }
    function cancelReviewBikeDetailsChange() {
        $('.review-bike-moredetails-selected').show();
        $('#review-bike-moredetails-change').hide();
    }

    function reviewBikeDescription() {
        //$('.review-bike-description-selected').hide();
        $('.review-bike-description-selected').attr('style', 'display: none !important');
        $('#review-bike-description-change').show();
    }
    function cancelReviewBikeDescChange() {
        $('.review-bike-description-selected').show();
        $('#review-bike-description-change').hide();
    }

    function reviewBikeStep1() {
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('bike-register1')}}",
            type: "POST",
            data: $('#addReviewBikeForm1').serialize(),
            success: function( response ) {
                $('.review-bike-selected').show();
                $('#review_bike_change').hide();               
            },
            error: function(response) {                    
                showErrorMessage(response.responseJSON.errors);
            } 
        });
    }

    function deleteRecord(id,url,cls) {
        swal({
            title: 'Are you sure?',
            text: 'This record and it`s details will be permanantly deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(isConfirm) {
            if (isConfirm) {                    
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {id:id},
                    success: function( response ) {
                        if(response.status==true) {
                            swal('Deleted', response.msg, 'success');                            
                            $('.'+cls+'-'+id).remove();                           
                        }         
                    }, error(){
                        swal('Failed', 'Something goes wrong, Please try again', 'error');                        
                    }
                });
            }
        }); 
    }


    function deleteRecordSource(url,cls) {
        swal({
            title: 'Are you sure?',
            text: 'This record and it`s details will be permanantly deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(isConfirm) {
            if (isConfirm) {                    
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
                $.ajax({
                    url: url,
                    type: "DELETE",
                    success: function( response ) {
                        if(response.status==true) {
                            swal('Deleted', response.msg, 'success');                            
                            $('.'+cls).remove();                           
                        }         
                    }, error(){
                        swal('Failed', 'Something goes wrong, Please try again', 'error');                        
                    }
                });
            }
        });         
    }

    function getBikeDetails(event, ui) { 
        $(function() {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
            });
            $.ajax({
                url: "{{route('search-bike-details')}}",
                type: "POST",
                data: {keyword:ui.item.label},
                success: function( response ) {
                    var img = "{{getImageUrl()}}/public/images/bike_models/"+response.image;
                    $('#bike-icon').hide();
                    $('.selected_bike').show();
                    $('#selected_bike').attr('src', img);
                    $('#model_name').text(ui.item.label);
                }
            });

        });
    }

    function submitRide(){
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{route('my-rides.store')}}",
                type: "POST",
                data: {status:true},
                processData: false,
                contentType: false,
                success: function( response ) {
                    if(response.status==true) {
                        location.replace(response.url);
                    }
                    else {
                        swal('Failed', response.msg, 'error');
                    }
                    
                }
            });

        });
    }

    function submitEvent(){
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{route('my-groups.events.store')}}",
                type: "POST",
                data: {status:true},
                processData: false,
                contentType: false,
                success: function( response ) {
                    if(response.status==true) {
                        swal('Success', response.msg, 'success');
                        setTimeout(function () {                            
                            location.replace(response.redirect);
                        }, 3000);                        
                    }
                    else {
                        swal('Failed', response.msg, 'error');
                    }
                    
                }
            });

        });
    }

    function submitBike(id=''){
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{route('bike-submit')}}",
                type: "POST",
                data: {id:id},
                success: function( response ) {
                    if(response.status==true) {
                        location.replace(response.url);                        
                    }
                    else {
                        swal('Failed', response.msg, 'error');
                    }
                    
                }
            });

        });
    }

    function bikeDetailsStep() {
        $(function(){
            $('#bike_tab2').show();
            $('#bike_tab1').hide();
            $('#review_bike').hide();


            $('#progressStep1').addClass('selected-list');
            $('#progressStep2').removeClass('selected-list').addClass('active-list');
            $('#progressStep3').removeClass('active-list')

            $('#bikeProgress1').html('<i class="fa fa-check" aria-hidden="true"></i>');
            $('#bikeProgress2').text('2');
            $('#bikeProgress3').text('3');


            
        });
    }

    
    function rideDetailsPage() {
        $(function(){
            $('#tab2').show();
            $('#tab1').hide();
            $('#review_ride').hide();

            $('#progressStep1').addClass('selected-list');
            $('#progressStep2').removeClass('selected-list').addClass('active-list');
            $('#progressStep3').removeClass('active-list')

            $('#bikeProgress1').html('<i class="fa fa-check" aria-hidden="true"></i>');
            $('#bikeProgress2').text('2');
            $('#bikeProgress3').text('3');
        });
    }

    function valueChanged(refer)
    {
        // if($('input[name="'+fieldId+'"').is(":checked"))   
        //     $("#checkbox-content").show();
        // else
        //     $("#checkbox-content").hide();


        //$('input[name="'+fieldId+'"]').click(function() {
            console.log(refer);
            var cls = $(refer).attr('name');
            console.log(cls);
            if($(refer).prop("checked") == true) {
                //alert("Checkbox is checked.");   
                             
                $("."+cls).attr('style', '');
            }
            else if($(refer).prop("checked") == false) {
                //alert("Checkbox is unchecked.");
                $("."+cls).attr('style', 'display:none !important');;
            }
        //});
    }

    function showHideField(val,field_key,content) {
        if(val==1) {
            $('.'+content+'_'+field_key).show();
        }
        else{
            $('.'+content+'_'+field_key).hide();
        }
    }

    //search result
    function findResult(keyword) {
        $(function(){
            var start_location = $('#dropdownMenuButton').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{route('search-result')}}",
                type: "POST",
                data: {search:keyword,start_location:start_location},
                success: function( response ) {
                    $('#search_res').html(response);                
                }
            });
        });
    }

    //get brand list   
    function showBikeModelList(id) {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('brand-list')}}",
            type: "POST",
            data: {brand_id:id},
            success: function( response ) {

                $('#bikeListModal').modal('show');
                $('#bike_models').html(response);         
            }
        });
    }

    //save poll
    function savePoll(){
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('polls.store')}}",
            type: "POST",
            data: $('#pollForm').serialize(),
            success: function( response ) { 
                if(response.status == true) {
                    swal('Success', response.msg, 'success');
                    var redirectUrl = "{{route('polls.index')}}";
                    location.replace(redirectUrl);
                }  
                else {
                    showErrorMessage(response.error);
                }             
            }, error: function(response){
                showErrorMessage(response.responseJSON.errors);
            }
        });
    }

    function saveTip(){
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('tips.store')}}",
            type: "POST",
            data: $('#tipForm').serialize(),
            success: function( response ) {
                if(response.status == true) {
                    document.getElementById('tipForm').reset();
                    $('.form-group span.text-danger').remove();
                    $("#submitTip").text('SUBMIT').attr("disabled", false);
                    $(".print-error-msg").css('display','block');
                    $(".print-error-msg").find("span").text(response.msg); 
                    setTimeout(function () {
                        if ($(".alert").is(":visible")){
                            $(".alert").fadeOut("fast");
                        }
                        location.reload();
                    }, 3000);
                } else {
                    $('.form-group span.text-danger').remove();
                    $.each( response.error, function( key, value ) {
                        $(document).find('[name='+key+']').after('<span class="text-strong text-danger">' +value+ '</span>');
                    });
                    $("#past_experience").text('SUBMIT').attr("disabled", false);
                }
            }
        });
    }

    function savePastExperience() {
        $("#past_experience").text('Please Wait...').attr("disabled", true);
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('my-groups.experience.store')}}",
            type: "POST",
            data: new FormData($('#pastExperienceForm')[0]),
            processData: false,
            contentType: false,
            cache:false,
            success: function( response ) {
                if(response.status == true) {
                    document.getElementById('pastExperienceForm').reset();
                    $('.form-group span.text-danger').remove();
                    $("#past_experience").text('SUBMIT').attr("disabled", false);
                    $(".print-error-msg").css('display','block');
                    $(".print-error-msg").find("span").text(response.msg); 
                    setTimeout(function () {
                        if ($(".alert").is(":visible")){
                            $(".alert").fadeOut("fast");
                        }
                    }, 3000);
                } else {
                    $('.form-group span.text-danger').remove();
                    $.each( response.error, function( key, value ) {
                        $(document).find('[name='+key+']').after('<span class="text-strong text-danger">' +value+ '</span>');
                    });
                    $("#past_experience").text('SUBMIT').attr("disabled", false);
                }
            }
        });
    }

    function showReviewBikeModelList(id) {
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('brand-list')}}",
            type: "POST",
            data: {brand_id:id},
            success: function( response ) {
                $('#reviewBikeListModal').modal('show');
                $('#review_bike_models').html(response);                         
            }
        });
    }

    function submitReviewBikeModel() {
        var model_name = $('#review_bike_models option:selected').val();
        var img = $('#review_bike_models option:selected').attr('data-content');
    
        $('#review_bike_list').val(model_name);
        $('#review_model_name').text(model_name);
        var model_image = "{{getImageUrl()}}/public/images/bike_models/"+img;

        if(img==undefined){
            model_image = "{{getImageUrl()}}/public/images/bike_models/not_found.jpg";
        }
        
        $('#reviewBikeListModal').modal('hide');
        $('#review_selected_bike').attr('src', model_image);
    }

    function submitReviewBikeChangeStep(){
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('bike-register1')}}",
            type: "POST",
            data: $('#addReviewBikeForm1').serialize(),
            success: function( response ) {

                $('.review-bike-name').text($('#review_bike_list').val());
                $('#review_bike_image').attr('src', $('#review_selected_bike').attr('src'));

                $('.review-bike-selected').show();
                $('#review_bike_change').hide();        
            },
            error: function(response) {
                showErrorMessage(response.responseJSON.errors);
            } 
        });
    }

    function submitReviewBikeMoreDetailsStep() {
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('review-bike-moredetails-save')}}",
            type: "POST",
            data: $('#addReviewBikeMoreDetailsForm1').serialize(),
            success: function( response ) {
                $('.review_total_km').text($('.rview_total_km').val());
                $('.review_total_rides').text($('.rview_total_rides').val());
                $('.review_comfortness').html('<i class="fa fa-star"></i> '+$('.rview_comfortness:checked').val());
                $('.review_visual_appeal').html('<i class="fa fa-star"></i> '+$('.rview_visual_appeal:checked').val());
                $('.review_reliability').html('<i class="fa fa-star"></i> '+$('.rview_reliability:checked').val());
                $('.review_performance').html('<i class="fa fa-star"></i> '+$('.rview_performance:checked').val());
                $('.review_service_experience').html('<i class="fa fa-star"></i> '+$('.rview_service_experience:checked').val());

                $('.review-bike-moredetails-selected').show();
                $('#review-bike-moredetails-change').hide();        
            },
            error: function(response) {
                showErrorMessage(response.responseJSON.errors);
            } 
        });
    }

    function submitReviewBikeDescriptionStep() {
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('review-bike-desc-save')}}",
            type: "POST",
            data: $('#addReviewBikeDescForm1').serialize(),
            success: function( response ) {
                $('.review_description').text($('.rview_description').val());
                $('.review-bike-description-selected').show();
                $('#review-bike-description-change').hide();        
            },
            error: function(response) {
                showErrorMessage(response.responseJSON.errors);
            } 
        });
    }

    function publishRideImages(formId) {
        $('#submitPublishRideImages'+formId).text('Please wait...').attr('disabled', true);
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('my-rides.publish-images')}}",
            type: "POST",
            data: $('#rideImagesPublishForm'+formId).serialize(),
            success: function( response ) {
                $(".print-error-msg").css('display','block');
                $(".print-error-msg").find("span").text(response.msg);
                document.getElementById('rideImagesPublishForm'+formId).reset();
                $('#submitPublishRideImages'+formId).text('Publish').attr('disabled', false);
                setTimeout(function () {
                    if ($(".alert").is(":visible")){
                        $(".alert").fadeOut("fast");
                    }
                    $('#publishRideImagesModal'+formId).modal('hide');
                }, 3000);
            }
        });
    }

    function submitReviewBikeImageStep() {
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('review-bike-image-save')}}",
            type: "POST",
            data: new FormData($('#addReviewBikeImageForm')[0]),
            processData: false,
            contentType: false,
            cache:false,
            success: function( response ) {
                updateReviewedSelectedFiles(response.img['image']);
                $('.review-bike-image-selected').show();
                $('#review_bike_images_change').hide();        
            },
            error: function(response) {
                showErrorMessage(response.responseJSON.errors);
            } 
        });
    }

    function updateReviewedSelectedFiles(images) {
        var html = '';
        var img_path = "{{ asset('public/images/rider/bikes/')}}";
        for (var i = 0; i < images.length; i++)
        {
            html += '<img src="'+img_path+'/'+images[i]+'" width="200" height="200">'
        }
        $('.review_bike_images_list').html(html);
    }

    function submitBikeModel() {
        var model_name = $('#bike_models option:selected').val();
        var img = $('#bike_models option:selected').attr('data-content');
        $('#bike_list').val(model_name);
        $('#model_name').text(model_name);
        var model_image = "{{getImageUrl()}}/public/images/bike_models/"+img;
        if(img==undefined){
            model_image = "{{getImageUrl()}}/public/images/bike_models/not_found.jpg";
        }
        $('#bikeListModal').modal('hide');
        $('#bike-icon').hide();
        $('#selected_bike').attr('src', model_image);
        $('.selected_bike').show();
    }


    function shareContact(group_id){
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('group_member-list')}}",
            type: "POST",
            data: {group_id:group_id},
            success: function( response ) {
                if(response.status == false){
                    swal('Failed', response.msg, 'error');
                }
                else{
                    $('#shareContactModal').modal('show');                   
                    $('#group_members').html(response.html);
                    $('#group_members').multiselect({
                        columns: 1,
                        placeholder: 'Select Group Members',
                        search: true,
                        searchOptions: {
                            'default': 'Search Group Members'
                        },
                        selectAll: true,
                    });
                }   
            }
        });
    }

    function sendContact() {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('send-contact-detail')}}",
            type: "POST",
            data: $('#shareContactForm').serialize(),
            success: function( response ) {
                if(response.status==true) {
                    $('#group_members').multiselect('reset');
                    showSuccessMessage(response.msg,'shareContactForm','shareContactModal');
                }
                else{
                    showErrorMessage([response.msg],'modal');
                }
            }
        });
    }

    function showSuccessMessage(message,form_id,modal_id,redirectUrl=''){
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');                 
        $(".print-error-msg").find("ul").append('<li>'+message+'</li>');
        $(".print-error-msg").addClass("alert-success").removeClass('alert-danger');                    
        setTimeout(function () {
            if ($(".alert").is(":visible")){
                $(".alert").fadeOut("fast");
            }
            document.getElementById(form_id).reset();            
            $('#'+modal_id).modal('hide');
            if(redirectUrl!=''){
                location.replace(redirectUrl);
            }

        }, 3000);
    }

    function saveRiderFeedback(){
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('save-rider-polls-feedback')}}",
            type: "POST",
            data: $('#pollFeedbackForm').serialize(),
            success: function( response ) {
                if(response.status==true) {                   
                    showSuccessMessage(response.msg,'pollFeedbackForm','feedbackPollModal');
                    $('.view-feedback-poll').remove();
                }
            }
        });
    }


    //remove more option of more quest
    function removeMoreOption(quest,opt) {
        $('.quest_'+quest+'_opt_'+opt).remove();
    }

    //show hide text
    function showHideBrands(){
        var x = document.getElementById("view_more_brands");
        if (x.innerHTML == 'Show more brands <i class="fa fa-angle-down ml-1"></i>') {
            x.innerHTML = 'Hide more brands <i class="fa fa-angle-up ml-1"></i>';
        } else {
            x.innerHTML = 'Show more brands <i class="fa fa-angle-down ml-1"></i>';
        }
    }

    function errorMessage(error, btn_id, btnText, fieldClass='input-field'){
        window.scrollTo(0, 0); 
        $('.'+fieldClass+' span.text-danger').remove();
        $.each(error, function( key, value ) {
            $(document).find('[name='+key+']').after('<span class="text-strong text-danger">' +value+ '</span>');
        });
        $("#"+btn_id).text(btnText).attr("disabled", false);
    }

    function successMessage(message, btnId, btnText, formId, redirectUrl, fieldClass='form-group'){
        $('.'+fieldClass+' span.text-danger').remove();
        $(".print-error-msg").css('display','block');
        $(".print-error-msg").find("span").text(message);
        document.getElementById(formId).reset();
        $('#'+btnId).text(btnText).attr('disabled', false);
        setTimeout(function () {
            if ($(".alert").is(":visible")){
                $(".alert").fadeOut("fast");
            }
            location.replace(redirectUrl);
        }, 1000);
    }

    function updateRiderDescription(){
        $('#update_rider_desc').text('Please wait...').attr('disabled', true);
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('my-profile.update-description')}}",
            type: "POST",
            data: $('#updateRiderDesc').serialize(),
            success: function( response ) {
                $(".print-error-msg").css('display','block');
                $(".print-error-msg").find("span").text(response.msg);                
                $('#update_rider_desc').text('Update').attr('disabled', false);
                setTimeout(function () {
                    if ($(".alert").is(":visible")){
                        $(".alert").fadeOut("fast");
                    }
                    $('#riderDescriptionModal').modal('hide');
                    location.reload();
                }, 3000);
            }
        });
    }

    function updateRiderDetails(){
        $('#update_rider_details').text('Please wait...').attr('disabled', true);
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('my-profile.update-detail')}}",
            type: "POST",
            data: new FormData($('#updateRiderDetail')[0]),
            processData: false,
            contentType: false,
            cache:false,
            success: function( response ) {
                if(response.status==true) {
                    $(".print-error-msg").css('display','block');
                    $(".print-error-msg").find("span").text(response.msg);                
                    $('#update_rider_desc').text('Update').attr('disabled', false);
                    setTimeout(function () {
                        if ($(".alert").is(":visible")){
                            $(".alert").fadeOut("fast");
                        }
                        $('#riderDetailsModal').modal('hide');
                        location.reload();
                    }, 3000);
                }
                else{
                    errorMessage(response.error, 'update_rider_details', 'Update', 'form-group');
                }
            }
        });
    }

    function updateRiderCoverImage(){
        $('#update_rider_coverImage').text('Please wait...').attr('disabled', true);
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('my-profile.update-cover-image')}}",
            type: "POST",
            data: new FormData($('#updateRiderCoverImage')[0]),
            processData: false,
            contentType: false,
            cache:false,
            success: function( response ) {
                if(response.status==true) {
                    $(".print-error-msg").css('display','block');
                    $(".print-error-msg").find("span").text(response.msg);                
                    $('#update_rider_coverImage').text('Update').attr('disabled', false);
                    setTimeout(function () {
                        if ($(".alert").is(":visible")){
                            $(".alert").fadeOut("fast");
                        }
                        $('#riderCoverImageModal').modal('hide');
                        location.reload();
                    }, 3000);
                }
                else{
                    errorMessage(response.error, 'update_rider_coverImage', 'Update', 'form-group');
                }
            }
        });
    }

    function showHideActiveTab(){
        $('#day1-tab').removeClass('active');
        $('#day1').removeClass('show active');
        $('#more_days li a').removeClass('active');
    }

    function addCommentField(fieldName){
        var length = $('#'+fieldName+' div.d-flex').length;
        if(length < 1) {
            var div = '<div class="d-flex align-items-center w-100 mt-4"><div class="mr-2 pr-1">'+
                        "<img src='{{ asset('public/rider/images/icons-via.svg')}}' class='img-fluid img-icon'></div>"+
                        '<div class="input-field  mb-0 w-100"><input type="text" name="'+fieldName+'" class="input-block" placeholder=" " >'+
                        '<label for="search-bike" class="input-lbl">Add Comment</label></div><div class="add-via-btn" ><a href="javascript:void(0)" onclick="removeCommentField('+fieldName+')" class="remove">'+
                        "<img src='{{ asset('public/rider/images/icons-clickable-less.svg')}}'></a></div></div>"+
                    '</div>';

            $("#"+fieldName).append(div);
        }
    }

    function removeCommentField(fieldName){
        $('#'+fieldName+' div.d-flex').remove();
    }

    function followRider(rider_id) {
        var is_user = "{{Auth::user()}}";
        if(!is_user) {
            $('#loginmodal').modal('show');
        }
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('follow-rider')}}",
            type: "POST",
            data: {rider_id:rider_id},
            success: function( response ) {
                if(response.status==true) {                            
                    $('.follow-rider-'+rider_id).replaceWith('<button class="follow-btn w-100 mt-2 un-follow-rider-'+rider_id+'" onclick="unFollowRider('+rider_id+')" ><i class="fa fa-minus mr-2"></i>UNFOLLOW</button>');
                }         
            }
        });
    }

    function unFollowRider(rider_id) {
        var is_user = "{{Auth::user()}}";
        if(!is_user) {
            $('#loginmodal').modal('show');
        }
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('un-follow-rider')}}",
            type: "POST",
            data: {rider_id:rider_id},
            success: function( response ) {
                if(response.status==true) {                            
                    $('.un-follow-rider-'+rider_id).replaceWith('<button class="follow-btn w-100 mt-2 follow-rider-'+rider_id+'" onclick="followRider('+rider_id+')"><i class="fa fa-plus mr-2"></i>FOLLOW</button>');
                }         
            }
        });        
    }

    function moveToNextDay(i){
        var max = $('#first_day').attr('content');
        var end_loc = $('input[name=end_location_'+i+']').val();
        var start_location = $('input[name=start_location_'+i+']').val();
            
        var tab = 2+parseInt(i);
        var error = false;

        $('.input-field span.text-danger').remove();
        if(end_loc == ''){                
            var key = "end_location_"+i;
            $(document).find('[name='+key+']').after('<span class="text-strong text-danger">End location field is required</span>');
            error = true;
        }

        if(start_location == ''){              
            var key = "start_location_"+i;
            $(document).find('[name='+key+']').after('<span class="text-strong text-danger">Start location field is required</span>');
            error = true;
        }

        var nextDay = tab+parseInt(1);

        if(error == false) {

            if(i < max) {
                i++;                
                if(i == parseInt(max)) {
                    $(this).hide();
                }
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
                });
                $.ajax({
                    url: "{{route('my-rides.add-day')}}",
                    type: "POST",
                    data: {val: i, end_location: end_loc},
                    success: function( response ) {
                        $('#myTab li a').removeClass('active')
                        $('#more_days').append('<li class="nav-item" role="presentation">'+
                        '<a class="moreDays nav-link active" onclick="showHideActiveTab()" id="day2-tab" data-toggle="tab" href="#day'+tab+'" role="tab" aria-controls="Day2" aria-selected="true"><span>Day '+tab+'</span></a>'
                    +'</li>');

                        $('#daysContent .tab-pane').removeClass('active show');
                        $('#dynamic_field').append(response);

                        $('.next-day').attr('onclick', 'moveToNextDay('+i+')').text('PROCEED TO DAY '+nextDay);

                        if(max == i){
                            $('.next-day').hide();
                            $('#rideStep2').show();
                            $('#add').hide();
                        }
                        $('#add').html('<i class="fa fa-plus"></i>&nbsp; Add Day'+nextDay);
                    }
                });                
            }
        }
        else{
            scroll();
        }
    }

    function followGroup(group_id){
        var is_user = "{{Auth::user()}}";
        if(!is_user) {
            $('#loginmodal').modal('show');
        }
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('follow-group')}}",
            type: "POST",
            data: {group_id:group_id},
            success: function( response ) {
                if(response.status==true) {                            
                    $('.follow-group-'+group_id).replaceWith('<button class="follow-btn flex-grow-1 mt-2 ml-1 unfollow-group-'+group_id+'" onclick="unFollowGroup('+group_id+')"><i class="fa fa-minus mr-2"></i>Unfollow</button>');
                }         
            }
        }); 
    }

    function unFollowGroup(group_id) {
        var is_user = "{{Auth::user()}}";
        if(!is_user) {
            $('#loginmodal').modal('show');
        }
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('unfollow-group')}}",
            type: "POST",
            data: {group_id:group_id},
            success: function( response ) {
                if(response.status==true) {                            
                    $('.unfollow-group-'+group_id).replaceWith('<button class="follow-btn flex-grow-1 mt-2 ml-1 follow-group-'+group_id+'" onclick="followGroup('+group_id+')"><i class="fa fa-plus mr-2"></i>Follow</button>');
                }         
            }
        });        
    }

    function joinGroup(group_id) {
        var is_user = "{{Auth::user()}}";
        if(!is_user) {
            $('#loginmodal').modal('show');
        }
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('join-group')}}",
            type: "POST",
            data: {group_id:group_id},
            success: function( response ) {
                if(response.status==true) {                            
                    $('.join-group-'+group_id).replaceWith('<button class="join-btn flex-grow-1 mt-2 mr-1 leave-group-'+group_id+'" onclick="leaveGroup('+group_id+')">'+
												'<i class="fa fa-minus mr-2"></i>Cancel</button>');     

                }   
            }
        });        
    }

    function leaveGroup(group_id) {
        var is_user = "{{Auth::user()}}";
        if(!is_user) {
            $('#loginmodal').modal('show');
        }
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
        });
        $.ajax({
            url: "{{route('leave-group')}}",
            type: "POST",
            data: {group_id:group_id},
            success: function( response ) {
                if(response.status==true) {                            
                    $('.leave-group-'+group_id).replaceWith('<button class="join-btn flex-grow-1 mt-2 mr-1 join-group-'+group_id+'" onclick="joinGroup('+group_id+')">'+
												'<i class="fa fa-send mr-2"></i>Join</button>');     

                }   
            }
        });        
    }

    function scroll(){
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 100;
    }
</script>