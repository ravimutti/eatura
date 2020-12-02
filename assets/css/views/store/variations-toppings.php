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
            <h1>Variation & Toppings List</h1>
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
          <div class="col-6">
            <div class="card" >
              <div class="card-header">
			   <h3 class="card-title">Variation list table</h3>
                <button type="button" class="btn btn-block bg-gradient-primary btn-sm" style="width: 20%;float: right;" data-toggle="modal" data-target="#modal-default">Add New</button>
				
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" width="40%">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Variation Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
						<?php
						if(!empty($variations)){
							$count=1;
							foreach($variations as $row){
								?>
								<tr>
								<td><?=$count;?></td>
								<td><?=ucfirst($row->variationname);?></td>
								
								<td>
									
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
            </div>
            <!-- /.card -->
			 <div class="col-6" >
			 <div class="card" >
              <div class="card-header">
			   <h3 class="card-title">Toppings list table</h3>
                <button type="button" class="btn btn-block bg-gradient-primary btn-sm" style="width: 20%;float: right;" data-toggle="modal" data-target="#modal-toppings">Add New</button>
				
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped" width="40%">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Topping Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
						<?php
						if(!empty($toppings)){
							$count=1;
							foreach($toppings as $row){
								?>
								<tr>
								<td><?=$count;?></td>
								<td><?=ucfirst($row->toppingname);?></td>
								
								<td>
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
              <h4 class="modal-title">Add Variation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			  <div class="form-group">
					<label for="Variation">Variation Name</label>
					<input type="text" name="vname" class="form-control" id="Variation" placeholder="Enter Variation name">
				  </div>
             
            </div>
            <div class="modal-footer justify-content-between">
              
              <button type="submit" name="variation" value="addnew" class="btn btn-primary">Add</button>
            </div>
			</form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
	   <div class="modal fade" id="modal-toppings">
        <div class="modal-dialog">
          <div class="modal-content">
		  <form action="" method="post" id="quickForm2" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">Add Topping</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			  <div class="form-group">
					<label for="topCategory">Topping Name</label>
					<input type="text" name="tname" class="form-control" id="topCategory" placeholder="Enter Topping name">
				  </div>
             
            </div>
            <div class="modal-footer justify-content-between">
              
              <button type="submit" name="topping" value="addnew" class="btn btn-primary">Add</button>
            </div>
			</form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
  
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
});
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
</script>
<script type="text/javascript">
$(document).ready(function () {
  $('#quickForm2').validate({
    rules: {
			tname: {
				required: true
			}
			
    },
    messages: {
			tname: {
				required: "Please enter Topping name."
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
   $('#quickForm').validate({
    rules: {
			vname: {
				required: true
			}
			
    },
    messages: {
			vname: {
				required: "Please enter Variation name."
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