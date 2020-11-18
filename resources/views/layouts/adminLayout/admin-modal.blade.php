<!---Add Past Experience--->
<div class="modal fade" id="statusChangeModal" data-backdrop="static" data-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
		  <div class="modal-content rounded-0" style="width:60%">			 
			<div class="modal-body p-0">
			  <button type="button" class="close login-close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			  <div class="row no-gutters">
				<div class="col-md-12">
				  <div class="login-block">
					<form id="changeStatusForm" method="post">
						<h4 class="login-heading">Change Status<small>To Approval, UnApproval, Rejected</small></h4>
						<input type="hidden" name="referer_id" id="is_valid">
						<input type="hidden" name="type" id="is_type">
						<div class="alert alert-danger print-error-msg" style="display:none">
							<ul></ul>
						</div>
						<div class="login-input">
							<div class="form-group">								
								<input type="radio" name="status" value="1"><span>Approve</span>
								<input type="radio" name="status" value="3"><span>UnApprove</span>
								<input type="radio" name="status"value="2"><span>Reject</span>
							</div>							
							<div class="form-group">
								<textarea class="md-textarea form-control" name="description"  rows="3" placeholder="Comment"></textarea>
							</div>
							<div class="form-group">						
								<button type="button" class="btn btn-danger w-100" onclick="saveChangeStatus()">SUBMIT</button>
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