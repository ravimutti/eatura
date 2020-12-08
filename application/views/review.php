<?php
$user_data = $this->session->userdata('userdata');
$this->load->view('includes/header', array('user_data' => $user_data));
?>
<style>
	*{
    margin: 0;
    padding: 0;
}
.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}

/* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */
</style>

<div class="main-container">
	<div class="container-fluid px-0">
		<div class="row mx-0">
				<div class="container text-center" >
					<div style="margin: 150px">
						<form id="rating" method="post" action="<?php echo base_url(); ?>store/orderreview" >
							<div class="form-group has-success">
								<label>Ranking </label>
								<input type="hidden" name="order_id" value="<?=$data->order_id?>" />
								<div class="rate">
									<input type="radio" id="star5" name="rating" value="5" />
									<label for="star5" title="text">5 stars</label>
									<input type="radio" id="star4" name="rating" value="4" />
									<label for="star4" title="text">4 stars</label>
									<input type="radio" id="star3" name="rating" value="3" />
									<label for="star3" title="text">3 stars</label>
									<input type="radio" id="star2" name="rating" value="2" />
									<label for="star2" title="text">2 stars</label>
									<input type="radio" id="star1" name="rating" value="1" />
									<label for="star1" title="text">1 star</label>
								  </div>
								
							</div>
							<br>
							
							<div class="form-group has-success">
								
								<label>Comment </label>
								<textarea id="review" name="review" rows="4" cols="50" class="form-control">
										
								</textarea>
							</div>
							
							<div class="form-group has-success">
								<input type="submit" class="form-control btn-success" />
							</div>
						</form>
					</div>

				</div>

		</div>
	</div>
</div>

	<!-- Modal -->
	
<script src="<?php echo base_url() ?>assets/js/jquery.toast.js"></script>
	<?php $this->load->view('includes/footer',array('subtotal' => 0,'cartCount' =>0)); ?>
	
	<script type="text/javascript">
  $(function() {
<?php 
if($this->session->flashdata('success')) {
	?>
	toaster('success', '<?php echo $this->session->flashdata("success");?>', 3000);
	<?php
}
if($this->session->flashdata('error')) {
	?>
	toaster('error', '<?php echo $this->session->flashdata("error");?>', 3000);
	<?php
}
?>
  });

</script>
	
<script>

	$(document).ready(function() {
		
		
		
		$('#rating').validate({
			rules: {
		
				rating: {
					required: true
				}
					
			},
			messages: {
					rating: {
						required: "Please select rating"
					},
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
	
