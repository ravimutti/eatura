<?php 
$user_data = $this->session->userdata('userdata');
$this->load->view('includes/header', array('user_data' => $user_data));?>
<script>
	let prepareCartItemArr = '<?= (count($this->cart->contents())) ? json_encode(array_values($this->cart->contents())) : json_encode(array())?>';
</script>
<div class="main-container">
	<div class="container-fluid px-0">
		<div class="row mx-0">
				<div class="container text-center my-4" >
					<div style="margin: 200px">
						<h1 class="text-center">Thank you!</h1>
						<p>Your order is confirmed.</p>
					</div>

				</div>

		</div>
	</div>
</div>

<?php $this->load->view('includes/footer',array('subtotal' => 0,'cartCount' =>0)); ?>
