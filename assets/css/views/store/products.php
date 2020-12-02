 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">create product</li>
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
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="<?php echo base_url();?>/store/handleProduct" id="productform" method="post" enctype='multipart/form-data'>
			   
                <div class="card-body">
				<div class="row">
				<div class="col-md-5">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name">
                  </div>
				  <div class="form-group">
					<label for="storename">Image</label>
					<input type="file" name="image" class="form-control" id="image">
				  </div>
				  <!--<input type="hidden" name="variation[]" />-->
                  <div class="form-group">
                    <label for="exampleInputPassword1">Description </label>
                    <textarea class="form-control" id="description" name="description" placeholder="Enter product description..."></textarea>
                  </div>
                    <div class="form-group">
                        <label>Categories</label>
                        <select class="form-control" name="category_id" id="category_id">
                          <option value="">select category...</option>
                         <?php
						 if(!empty($categories)){
							 foreach($categories as $cat){
								 ?>
								 <option value="<?php echo $cat->id;?>"><?php echo $cat->category;?></option>
								 <?php
								 
							 }
						 }
						 ?>
                        </select>
                      </div>
						<div class="form-group">
							<label>Price</label>
								
									<input type="text" name="productprice" id="price" class="form-control priceformat" placeholder="Enter price...">
								
						</div>
						<div class="form-group">
							<label>Product type</label>
							<select class="form-control" id="type" name="type_id">
								<option value="">select type...</option>
								<option value="0">Simple</option>
								<option value="1">Variation</option>
							</select>
						</div>
                  
                </div>
				<div class="col-md-7" id="variations"  style="display:none;">
               <div class="card card-success">
              <div class="card-header">
					<h3 class="card-title">Create Variations & Toppings</h3>
				</div>
				<div class="card-body">
					<button type="button" id="createv" data-type="1" class="btn btn-info">Create Variation</button>
					<button type="button" id="createt" data-type="2" class="btn btn-info">Create Topping</button>
				</div>
            </div>
				<div id="append">
				</div>
				
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
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <div class="modal fade varationmodal" id="varationmodal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Variations</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<div class="row">
			<div class="col-md-12">
			<div class="form-group">
							<input type="hidden" value="" id="feildsidv">
								
									<input type="text" name="searchColumn" id="searchColumn" class="form-control" placeholder="Search...">
						
						</div>
               
				</div>
				<?php if(!empty($variations)){
					foreach($variations as $vrow){?>
<div class="col-md-4"><input type="checkbox" class="varationcheckbox" value="<?php echo $vrow->variationname;?>" data-id="<?php echo $vrow->id;?>"> <?php echo $vrow->variationname;?></div>
					<?php  } } ?>

             </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="addvarationattribute">Add</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
	     <div class="modal fade toppingsmodal" id="toppingsmodal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Toppings</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<div class="row">
			<div class="col-md-12">
			<div class="form-group">
							
								<input type="hidden" value="" id="feildsidt">
									<input type="text" name="searchColumntop" id="searchColumntop" class="form-control" placeholder="Search...">
						
						</div>
               
				</div>
				<?php if(!empty($toppings)){
					foreach($toppings as $trow){?>
						<div class="col-md-4">
							<input type="checkbox"  class="toppingssearch" value="<?php echo $trow->toppingname;?>" data-id="<?php echo $trow->id;?>"> <?php echo $trow->toppingname;?>
						</div>
					<?php  } } ?>
             </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="addtoppingattribute">Add</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
	  <div class="modal fade toppingsmodalsub" id="toppingsmodalsub">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Toppings Sub selections</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
			<div class="row">
			<div class="col-md-12">
			<div class="form-group">
							
								<input type="hidden" value="" id="feildsidt">
									<input type="text" name="searchColumntop" id="searchColumntop" class="form-control" placeholder="Search...">
						
						</div>
               
				</div>
				<?php if(!empty($toppings)){
					foreach($toppings as $trow){?>
						<div class="col-md-4">
							<input type="checkbox"  class="toppingssearch" value="<?php echo $trow->toppingname;?>" data-id="<?php echo $trow->id;?>"> <strong><?php echo $trow->toppingname;?><input class="priceformat toppingstext-<?php echo $trow->id;?>" data-id="<?php echo $trow->id;?>" type="text" placeholder="Price if you have."></strong>
						</div>
					<?php  } } ?>
             </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="addtoppingattributesub">Add</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
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
	  <script>
            
$(document).ready(function(){
    ProductManager.init('<?=base_url()?>');
	$('#productform').validate({
		rules: {
			name: {
				required: true,
				remote: {
                    url: "<?php echo base_url();?>store/checkProductExists",
                    type: "post"
                 },
			},
			image: {
				required: false,
				extension: "jpg,jpeg, png"
			},
			description: {
				required: true
			},
			category_id: {
				required: true,
				digits: true
			},
			productprice: {
				required: true
			},
			type_id: {
				required: true,
				digits: true
			}
		},
		messages: {
			name: {
				required: "Please enter Product name.",
				remote: "The product already use.",
			},
			description: {
				required: "Please enter Description."
			},
			image: {
				extension: "You're only allowed to upload jpg or png images."
			},
			category_id: {
				required: "Please enter Category."
			},
			productprice: {
				required: "Please enter Price."
			},
			type_id: {
				required: "Please select type."
			},
		},
		//submitHandler: function(form) {},
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
	
	
    $("#searchColumn").on("input",function(){
        
        var searchTxt = $(this).val();
        searchTxt = searchTxt.replace(/[.()+]/g,"\\$&");

        var patt = new RegExp("^" + searchTxt,"i");
        
        $(":checkbox").each(function(){
            
            if(patt.test($(this).val())) 
                $(this).closest("div").show(500);
                    
            else 
                $(this).closest("div").hide(500);
                    
        })
    });
	    $("#searchColumntop").on("input",function(){
        
        var searchTxt = $(this).val();
        searchTxt = searchTxt.replace(/[.()+]/g,"\\$&");

        var patt = new RegExp("^" + searchTxt,"i");
        
        $(".toppingssearch").each(function(){
            
            if(patt.test($(this).val())) 
                $(this).closest("div").show(500);
                    
            else 
                $(this).closest("div").hide(500);
                    
        })
    });
});
    </script>
  <script>
  $(function() {
	 // $('#variations').hide(); 
    $('#type').change(function(){
        if($('#type').val() == '0') {
			$('#variations').hide(); 
        } else {
            $('#variations').show(); 
        } 
    });
});

$(document).ready(function () {
    //@ravi action dynamic childs
    var next = 0;
    $("#createv").click(function(e){
        e.preventDefault();
        var addto = "#append";
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = ' <div class="field'+ next +'" name="field'+ next +'"><div class="card"><div class="card-header"><h3 class="card-title">Variation </h3>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="remove" style="color:red;" class="danger remove-me"  data-fid="field'+ next +'" ><i class="fas fa-trash"></i> </a></div><div class="card-body table-responsive pad"><div class="form-group"><label>Label Name:</label><div class="col-6"><input type="text" class="form-control labelfield" name="label[1]['+ next +']" placeholder="Enter Label name..."></div></div><div class="dfield'+ next +'" style="display:none;"><table class="table tablevar'+ next +'"><tr><th>Varation Name</th><th>Price</th><th>Action</th></tr></table></div><input type="hidden" name="type" ><button type="button" data-toggle="modal" class="varationmodal btn btn-primary selectvar" data-type="1" data-id="'+ next +'" style="margin-right: 5px;"><i class="fas fa-plus"></i> Select variation</button></div></div></div>';
        var newInput = $(newIn);
        $(addto).append(newInput);
    });
    $("#createt").click(function(e){
        e.preventDefault();
        var addto = "#append";
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = ' <div class="field'+ next +'" name="field'+ next +'"><div class="card"><div class="card-header"><h3 class="card-title">Topping </h3>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="remove" style="color:red;" class="danger remove-me"  data-fid="field'+ next +'" ><i class="fas fa-trash"></i> </a></div><div class="card-body table-responsive pad"><div class="form-group"><label>Label Name:</label><div class="col-6"><input type="text" class="form-control labelfield" name="label[2]['+ next +']" placeholder="Enter Label name..."></div></div><div class="dfield'+ next +'" style="display:none;"> <table class="table tabletop'+ next +'"><tr><th>Topping Name</th><th>Price</th><th>Action</th></tr></table></div><input type="hidden" name="type" ><button type="button" class="btn btn-primary selecttop toppingsbutton" data-type="2" data-id="'+ next +'"  style="margin-right: 5px;"><i class="fas fa-plus"></i> Select Toppings</button></div></div></div>';
        var newInput = $(newIn);
        $(addto).append(newInput);
		
    });
	$('body').on('click', '.remove-me', function() {
				var feildsid=$(this).attr('data-fid');
                $('.'+feildsid).remove();
				$(this).remove();
            });
	$('body').on('click', '.selecttop', function() {
		var feildsid=$(this).attr('data-id');
		$('#feildsidt').val(feildsid);
		$(".toppingssearch").prop("checked", false);
	});
	$('body').on('click', '.selectvar', function() {
		var feildsid=$(this).attr('data-id');
		$('#feildsidv').val(feildsid);
		$(".varationcheckbox").prop("checked", false);
	});
	  $("#addvarationattribute").click(function(e){
		  var flag=0;
		 var fid= $('#feildsidv').val();
		 var type = $(this).attr('data-type');
			$(".varationcheckbox:checked").each(function(){
					$('.dfield'+fid).show();
					var trdata='';
					 trdata='<tr id="variation-'+ $(this).attr('data-id')+'-'+fid+'"><td><input type="hidden" name="varationseleted[]" value="'+ $(this).attr('data-id')+'" ><strong>'+ $(this).val()+'</strong></td><td><input type="text" name="variation[1]['+fid+']['+$(this).attr('data-id')+']" class="form-control priceformateach" placeholder="Enter price if you need otherwies leave blank"></td><td><button type="button" class="btn btn-warning toppingsmodalsubbutton" data-row='+fid+' data-id='+ $(this).attr('data-id')+'>Add toppings</button> </td></tr>';
					$('.tablevar'+ fid).append(trdata);
					flag++;
			});
			if(flag ==0){
				toastr.error('Please select any one varation for add.')
			}else{
				 $('#varationmodal').modal('hide');
			}
	  });
	  $("#addtoppingattribute").click(function(e){
		  var flag=0;
		 var fid= $('#feildsidt').val();
			$(".toppingssearch:checked").each(function(){
					$('.dfield'+fid).show();
					var trdata='';
					 trdata='<tr><td><input type="hidden" name="toppingelected[]" value="'+ $(this).attr('data-id')+'" >'+ $(this).val()+'</td><td><input type="text" class="form-control priceformat priceformateach" name="variation[2]['+fid+']['+$(this).attr('data-id')+']" placeholder="Enter price if you need otherwies leave blank"></td><td><a href="javascript:void(0);" style="color:red;" class="danger tragetclosetr"><i class="fas fa-trash"></i> </a></td></tr>';
					$('.tabletop'+ fid).append(trdata);
					flag++;
			});
			if(flag ==0){
				toastr.error('Please select any one topping for add.')
			}else{
				 $('#toppingsmodal').modal('hide');
			}
	  });
});


  </script>