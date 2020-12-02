<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add new Restaurant</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add new Restaurant</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
			
              <div class="card-header">
                <h3 class="card-title">Add<small> Restaurant</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form"  action="<?php echo base_url();?>/User/addNewUser" id="quickForm" method="post" enctype='multipart/form-data'>
                <div class="card-body">
				<?php //echo validation_errors("<p><span style='color:red'>","</span></p>"); ?>
				  <div class="form-group">
					<label for="storename">Restaurant Name</label>
					<input type="text" name="name" class="form-control" id="storename" value="" placeholder="Enter Restaurant name">
				  </div>
				  <div class="form-group">
					<label for="storename">Logo</label>
					<input type="file" name="logo" class="form-control" id="logo">
				  </div>
				  <div class="form-group">
					<label for="storename">Banner</label>
					<input type="file" name="banner" class="form-control" id="banner">
				  </div>
				  <div class="form-group">
					<label for="ownermanager">Owner/Manager</label>
					<input type="text" name="oname" class="form-control" id="ownermanager" value="" placeholder="Enter Owner/Manager">
				  </div>
                  <div class="form-group">
                    <label for="emailaddress">Email address</label>
                    <input type="email" name="email" class="form-control" id="emailaddress" value="" placeholder="Enter email">
                  </div>
				  <div class="form-group">
                    <label for="phonenumber">Phone Number</label>
                    <input type="number" name="phone" class="form-control" id="phonenumber" value="" placeholder="Enter phone number">
                  </div>
				  <div class="form-group">
                    <label for="aboutus">Description</label>
					<textarea name="description" class="form-control" id="aboutus" value="" placeholder="Enter description"></textarea>
                    
                  </div>
				  
				   <div class="form-group">
                     <label for="role">User Type</label>
                                            <select class="form-control" id="role" name="role" required>
                                                <option >Choose Type....</option>
												 <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $rl)
                                                {
													if($rl->roleId!=ROLE_ADMIN)
													{
                                                    ?>
                                                    <option value="<?php echo $rl->roleId; ?>">
                                                        <?php echo $rl->role ?>
                                                    </option>
                                                    <?php
													}
                                                }
                                            }
                                            ?>
                                            </select>
                  </div>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/toastr/toastr.min.css">
<!-- Toastr -->
<script src="<?php echo base_url();?>assets/admin/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
  $(function() {
<?php if(!empty(validation_errors())){?>
 <?php echo validation_errors("toastr.error('" ,"');"); ?>
<?php } ?>

<?php 
if($this->session->flashdata('success')) {
	?>
	 toastr.success('<?php echo $this->session->flashdata("success");?>');
	<?php
}
if($this->session->flashdata('error')) {
	?>
	 toastr.error('<?php echo $this->session->flashdata("error");?>');
	<?php
}
?>
  });

</script>
<script type="text/javascript">
$(document).ready(function () {
 $.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg !== value;
 }, "Value must not equal arg.");
  $('#quickForm').validate({
    rules: {
			logo: {
                required: true,
                extension: "jpg,jpeg, png"
            },
			banner: {
                required: true,
                extension: "jpg,jpeg, png"
            },
			name: {
				required: true
			},
			oname: {
				required: true
			},
			email: {
				required: true,
				 remote: {
                    url: "<?php echo base_url();?>User/checkEmailExists",
                    type: "post"
                 },
				email: true
			},
			description: {
				required: true
			},
			phone: {
				digits: true,
				required: true
			},
			password: {
				required: true,
				minlength: 5
			},
			password_confirm : {
				required: true,
				minlength : 5,
				equalTo : "#password"
			},
			role: {
			 valueNotEquals: "default"
			},
			terms: {
			required: true
			},
			
    },
    messages: {
			name: {
				required: "Please enter Store name."
			},
			oname: {
				required: "Please enter Owner/Manager."
			},
			logo: {
				required: "Please select logo.",
				extension: "You're only allowed to upload jpg or png images."
			},
			banner: {
				required: "Please select banner.",
				extension: "You're only allowed to upload jpg or png images."
			},
			phone: {
				digits: "Please enter numbers only.",
				required: "Please enter phone number."
			},
			description: {
				required: "Please enter description."
			},
			email: {
				required: "Please enter a email address",
				remote: "Email already in use!",
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
			},
			role: {
				 valueNotEquals: "Please select user type!",
			},
			terms: "Please accept our terms"
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