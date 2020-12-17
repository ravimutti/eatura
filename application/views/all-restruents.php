<?php
$user_data = $this->session->userdata('userdata');
$this->load->view('includes/header', array('user_data' => $user_data));
?>
<style>
	html {
		scroll-behavior: smooth;
	}
</style>
<script>
let byPassPickupCookie = 1;
</script>

<div class="main-container">
	<div class="container-fluid px-0">
			<?php 
				if(isset($profile) && sizeof($profile) > 0) {
					foreach ($profile as $key => $value) {
						if($value->slugname !="") {
					
			?>
			<div class="card">
				<div class="card-body text-center">
					<a href="<?=site_url().$value->slugname?>"><?=$value->name?></a>
				</div>
			</div>

				<?php } } } else {?>
				<div class="card">
					<div class="card-body">
						<a href="http://"></a>
					</div>
				</div>
			<?php } ?>
	</div>
</div>
