<div class="page-footer">
	<div class="page-footer-inner">
		<?php echo date('Y');?> &copy;  {{config('constants.project_name')}}
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<script src="{{ asset('public/rider/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{ asset('public/rider/js/bootstrap.bundle.js')}}"></script>
<script src="{{ asset('public/rider/js/slick.js')}}"></script>
<script src="{{ asset('public/rider/js/sweetalert.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script>
(function () {
  'use strict'
  feather.replace()
})()

// $('#change_status').on('click', function(){
// 	var valid = $(this).attr('content');
// 	$('#is_valid').val(valid);
// 	$('input:radio[value="'+valid+'"]').attr('checked', 'checked');
// 	$('#statusChangeModal').modal('show');
// })

function changeStatus(id){
	var status = $('#change_status').attr('content');
	$('#is_valid').val(id);
	$('#is_type').val($('#change_status').attr('type'));
	$('input:radio[value="'+status+'"]').attr('checked', 'checked');
	$('#statusChangeModal').modal('show');
}

function saveChangeStatus() {
	var valid = $('#is_valid').val();
	$.ajaxSetup({
        headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"}
	});
	$.ajax({
		url: "{{route('admin.rider.status.save')}}",
		type: "POST",
		data: $('#changeStatusForm').serialize(),
		success: function( response ) {
			$(".print-error-msg").find("ul").html('');
			$(".print-error-msg").css('display','block');
			if(response.status==true) {
				$(".print-error-msg").find("ul").append('<li>'+response.msg+'</li>');
				$(".print-error-msg").removeClass('alert-danger').addClass('alert-success');
				setTimeout(function () {                            
					$('#statusChangeModal').modal('hide');
					location.reload();
				}, 3000);
			}
			else {
				$.each( response.error, function( key, value ) {
					$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
				});
				removeAlert();
			}
		}
	});
}
</script>