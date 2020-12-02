   <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categories List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-block bg-gradient-primary btn-sm" style="width: 8%;float: right;" data-toggle="modal" data-target="#modal-default">Add New</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Categories Name</th>
                    <th>Banner Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
						<?php
						if(!empty($storelist)){
							$count=1;
							foreach($storelist as $row){
								?>
								<tr>
								<td><?=$count;?></td>
								<td><?=ucfirst($row->category);?></td>
								<td><img src="<?=base_url().'assets/uploads/category/'.$row->cimage;?>" width="500px" height="100px"></td>
								<td>
									<a href="<?=base_url().'store/updatecategory/'.$row->id;?>" class="btn btn-success editform" data-id="<?=$row->id?>">
										<i class="fas fa-edit"></i>
										</a>
										<a href="#" class="btn btn-danger  ">
										<i class="fas fa-trash"></i>
										</a>
								</td>
								</tr>
								<?php
								$count++;
							}
						
						}
						?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
		  <form action="" method="post" id="quickForm" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">Add Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			  <div class="form-group">
					<label for="Category">Category Name</label>
					<input type="text" name="name" class="form-control" id="Category" placeholder="Enter Category name">
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
					<input type="text" name="note" class="form-control" id="note">
				  </div>
				  
				  <div class="form-group">
					<label for="Category">Description</label>
					<textarea class="form-control" id="description" name="description"></textarea>
				  </div>
				  
            </div>
            <div class="modal-footer justify-content-between">
              
              <button type="submit" name="submit" value="addnew" class="btn btn-primary">Save</button>
            </div>
			</form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
	  
	  
	  <div class="modal fade" id="commonmodal">
        <div class="modal-dialog">
          <div class="modal-content">
		  
            <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
			<div class="loadermodal"> </div>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  
  <!-- DataTables -->
<script src="<?php echo base_url();?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?php echo base_url();?>assets/admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
 <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/toastr/toastr.min.css">
<!-- Toastr -->
<script src="<?php echo base_url();?>assets/admin/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/script.js"></script>

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
  bsCustomFileInput.init();
 // CategoryManager.init('<?=base_url()?>');
});
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript">
$(document).ready(function () {
  $('#quickForm').validate({
    rules: {
			name: {
				required: true
			},
			bannerimage: {
				required: true
			},
    },
    messages: {
			name: {
				required: "Please enter Store name."
			},
			bannerimage: {
				required: "Please select banner image."
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