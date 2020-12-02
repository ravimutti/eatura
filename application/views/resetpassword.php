<?php
$user_data = $this->session->userdata('userdata');
$this->load->view('includes/header', array('user_data' => $user_data));
?>
<style>
	html {
		scroll-behavior: smooth;
	}
</style>

<div class="main-container">
	<div class="container-fluid px-0">
		<div class="mx-0">
			<div class="pizza-column">
				
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<form action=<?php echo site_url() . 'updateresetpassword' ?> method="post" id="reset-form-update">
							  <div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" name="password" class="form-control" id="password">
								<input type="hidden" name="token" value="<?=$obj->token?>" />
							  </div>
							  <div class="form-group">
								<label for="exampleInputPassword1">Confirm Password</label>
								<input type="password" name="password_confirm" class="form-control" id="confirmpassword">
							  </div>
							  <button type="submit" name="resetpassword" class="btn btn-primary">Submit</button>
							</form>
						</div>
					</div>
				</div>
				
				
			</div>
		</div>
	</div>


	<!-- Modal -->
	

	<?php //$this->load->view('includes/footer', array('subtotal' => $subtotal, 'cartCount' => $cartCount, "pinCode" => $pinCode, 'pincodes' => $pincodes, 'user_data' => $user_data)); ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>

	<!--	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/form-handler.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery.toast.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
		$('#reset-form-update').validate({
			rules: {
		
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength: 5
			},
			password_confirm : {
				required: true,
				minlength : 5,
				equalTo : "#password"
			}
			
    },
    messages: {
			
			email: {
				required: "Please enter a email address",
				email: "Please enter a vaild email address"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			password_confirm : {
				required: "Please provide a  confirm password",
				minlength : "Your password must be at least 5 characters long",
				equalTo : "Confirm password not match with password."
			}
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
		
	});
</script>