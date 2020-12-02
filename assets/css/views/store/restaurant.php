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
            <h1>Restaurant List</h1>
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
                <a href="<?php echo base_url(); ?>store/addnew" class="btn btn-block bg-gradient-primary btn-sm" style="width: 8%;float: right;" >Add New</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
					 <th>Email</th>
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
								<td><?=ucfirst($row->name);?></td>
								<td><?=$row->email?></td>
								
								<td>
									<a href="<?php echo base_url().'user/updaterestaurant/'.$row->userId; ?>" class="btn btn-success" data-id="<?=$row->userId?>">
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
  RestaurantManager.init('<?=base_url()?>');
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