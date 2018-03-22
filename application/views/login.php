<div class="content_container">
	<div class="row">
		<div class="col"></div>
		<div class="col-6">
			<!--Modal: Contact form-->
			<div class="modal-dialog cascading-modal" role="document">

				<!--Content-->
				<div class="modal-content">

					<!--Header-->
					<div class="modal-header info-color white-text">
						<h4 class="title">
							<i class="fa fa-pencil"></i> Admin login
						</h4>
					</div>
					<!--Body-->
					<div class="modal-body">
						<!-- input username -->
						<label for="inpUsername">Username</label>
						<input type="text" id="inpUsername" class="form-control form-control-sm">

						<br>

						<!-- input password -->
						<label for="inpPass">Password</label>
						<input type="password" id="inpPass" class="form-control form-control-sm">

						<br>

						<div class="text-center mt-4 mb-2">
							<button id="btnSend" class="btn btn-info">Send
								<i class="fa fa-send ml-2"></i>
							</button>
						</div>

					</div>
				</div>
				<!--/.Content-->
			</div>
			<!--/Modal: Contact form-->
		</div>
		<div class="col"></div>
	</div>
</div>

<script>
	$('#btnSend').click(function () {
		$.get('<?php echo base_url(); ?>index.php/admin/login/' + $('#inpUsername').val() + '/' + $('#inpPass').val(), function (data) {
			if(data != ''){
				window.location.href = '<?php echo base_url(); ?>index.php/admin/dash/';
			}
		});
	});
</script>