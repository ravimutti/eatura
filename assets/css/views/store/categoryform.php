<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Category</li>
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
                <h3 class="card-title">Update<small> Category</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo base_url();?>/Store/updatecategory/<?php echo $category->id; ?>" method="post" id="updatecategory" enctype="multipart/form-data">
                <div class="card-body">
				<?php //echo validation_errors("<p><span style='color:red'>","</span></p>"); ?>
				  <div class="form-group">
					<label for="Category">Category Name:</label>
					<input type="text" name="name" class="form-control" id="Category" value="<?php echo $category->category; ?>" placeholder="Enter Category name">
					<input type="hidden" name="id" value="<?php echo $category->id; ?>" />
				  </div>
				  
				  <div class="form-group">
				<label for="customFile">Category Banner Image:</label>

				<div class="custom-file">
				  <input type="file" class="custom-file-input" name="bannerimage" id="customFile" accept="image/*">
				  <label class="custom-file-label" for="customFile">Choose file</label>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="Category">Note</label>
				<input type="text" name="note" class="form-control" value="<?php echo $category->note; ?>" id="note">
			  </div>
			  
			  <div class="form-group">
				<label for="Category">Description</label>
				<textarea class="form-control" id="description" value="<?php echo $category->description; ?>" name="description"><?php echo $category->description; ?></textarea>
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
  $('#updatecategory').validate({
    rules: {
			bannerimage: {
                required: true,
                extension: "jpg,jpeg, png"
            },
			
			name: {
				required: true
			}
			
    },
    messages: {
			name: {
				required: "Please enter Store name."
			},
			bannerimage: {
				required: "Please select image.",
				extension: "You're only allowed to upload jpg or png images."
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