<?php
$user_data = $this->session->userdata('userdata');
$this->load->view('includes/header', array('user_data' => $user_data));
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>

	<!--	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<style>
	html {
		scroll-behavior: smooth;
	}
</style>
<style>
.tabs-section {
    overflow: hidden;
    padding: 60px 0px;
}
.tabs-section .feature-img {
    max-height: 255px;
    overflow: hidden;
    border-radius: 10px;
    border: 3px solid #fff;
}
.tabs-section .nav-tabs {
    border: 0;
}
.tabs-section .nav-link {
    border: 0;
    padding: 11px 15px;
    transition: 0.3s;
    color: #000;
    border-radius: 0;
    border-right: 2px solid #cddc39 !important;
    font-weight: 600;
    font-size: 15px;
}
.tabs-section .nav-link:hover {
    color: #cddc39;
}
</style>


<div class="main-container">
	<div class="container-fluid px-0">
		<div class="mx-0">
			<div class="pizza-column">
				
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							
							<section class="tabs-section text-white">
         <div class="container">
            <div class="row">
               <div class="col-sm-5 col-lg-3">
                  <ul class="nav nav-tabs flex-column mb-3">
                     <!--<li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#tab-1">Address</a>
                     </li>-->
                     <li class="nav-item">
                        <a class="nav-link active show" data-toggle="tab" href="#tab-2">Personal Detail</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-3">Change Password</a>
                     </li>
                     <li class="nav-item">
                        <a href="<?= site_url() . 'logout' ?>" class="nav-link">Logout</a>
                     </li>
                  </ul>
               </div>
               <div class="col-sm-7 col-lg-9">
                  <div class="tab-content">
                     <!--<div class="tab-pane active show" id="tab-1">
                        <div class="row">
                           <div class="col-lg-4">
                             
                           </div>
                           <div class="col-lg-8 details">
                              <h3 class="mt-3">Address</h3>
                              <p></p>
                           </div>
                        </div>
                     </div>-->
                     <div class="tab-pan active showe" id="tab-2">
                        <div class="row">
                           <div class="col-lg-4">
                              
                           </div>
                           <div class="col-lg-8 details">
                              <h3 class="mt-3">Personal Detail</h3>
                              
							  <form action="<?php echo base_url(); ?>updateprofile" id="updateprofile" method="post" novalidate="novalidate">
								<div class="textarea-label form-group">
									<label>Name </label>
									<input type="text" name="name" value="<?=$this->session->userdata('userdata')['user']->name?>" tabindex="1" class="textfield-form form-control" maxlength="100">
									<input type="hidden" name="id" value="<?=$this->session->userdata('userdata')['user']->userId?>" />
								</div>
								<div class="textarea-label form-group">
									<label>E-Mail-Adresse </label>
									<input type="text" name="email" value="<?=$this->session->userdata('userdata')['user']->email?>" tabindex="1" class="textfield-form form-control" maxlength="100">
								</div>
								<div class="form-group">
									<button class="btn btn-primary">Update</button>
								</div>
							</form>
							  
							  
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane" id="tab-3">
                        <div class="row">
                           <div class="col-lg-4">
                              
                           </div>
                           <div class="col-lg-8 details">
                              <h3 class="mt-3">Change Passowrd</h3>
                              <form action="<?php echo base_url(); ?>changepassword" id="changepassword-form" method="post" novalidate="novalidate">
							  
								<div class="textarea-label form-group">
									<label>Password </label>
									<input type="password" name="oldpassword" tabindex="1" class="textfield-form form-control">
									<input type="hidden" name="id" value="<?=$this->session->userdata('userdata')['user']->userId?>" />
								</div>
								<div class="textarea-label form-group">
									<label>New Password</label>
									<input type="password" name="newpassword" id="newpassword" class="textfield-form form-control">
								</div>
								<div class="textarea-label form-group">
									<label>Confirm Password</label>
									<input type="password" name="password_confirm" class="textfield-form form-control">
								</div>
								<div class="form-group">
									<button class="btn btn-primary">Update</button>
								</div>
							</form>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane" id="tab-4">
                        <div class="row">
                           <div class="col-lg-4">
                              <div class="feature-img">
                                 <img src="/images/user-img-3.jpg" alt="" class="img-fluid">
                              </div>
                           </div>
                           <div class="col-lg-8 details">
                              <h3 class="mt-3">Where does it come from?</h3>
                              <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old</p>
                           </div>
                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
         </div>
      </section>
							
						</div>
					</div>
				</div>
				
				
			</div>
		</div>
	</div>
</div>


<?php //$this->load->view('includes/footer',array('subtotal' => 0,'cartCount' =>0)); ?>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/form-handler.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.toast.js"></script>
