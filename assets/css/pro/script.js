var CommonManager = {
	
	ajax : function(url, callback, type, data, dataType, extraData, beforeLoad) {
		dataType = dataType || 'json';
		type = type || 'GET';
		data = data || {};
		extraData = extraData || {};
		var request = $.ajax({
			url: url,
			cache: false,
			async: false,
			type: type,
			data: data,
			dataType: dataType
		});
		
		request.done(function(data) {
			callback(data, extraData);
		});
		request.fail(function(jqXHR, exception) {
			CommonManager.ajaxFailResponse(jqXHR, exception);
		});
	},
	
	ajaxFailResponse: function(jqXHR, exception) {
		if(jqXHR.status == 422) {
			$('.error_msg').html('');
			var errors = jqXHR.responseJSON.errors;
			console.log(errors);
			$.each(errors, function (key, value) {
				$('.error_'+key+'_msg').html(value);
			});
			return false;
		} else {
			if(jqXHR.status === 0) {
				alert("Not connect.\n Verify Networks.");
			}
		}
	},
	
	commonCallbackModalData: function(data, extraData) {
		$(extraData.target).html(data);
		$(extraData.id).modal('show');
	},
	
	validPrice: function(evt, element) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (
            (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // Check minus and only once.
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // Check dot and only once.
            (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
	
}

var RestaurantManager = {
	init: function() {
		
	}
}

var CategoryManager = {
	
	updateCategoryResponse: function(response) {
		if(response.status == 'success') {
			$('.loadermodal', $('#commonmodal')).html('');
			$('#commonmodal').hide();
			alert('Successfully Udate');
			location.reload();

		} else if(response.status == 'error') {
			alert(response.error);
		}
	},
	
	init: function(url) {
		$('body').on('click', '.editform', function() {
			var id = $(this).attr('data-id');
			$('.modal-title', $('#commonmodal')).html('Update Category');
			CommonManager.ajax(url+'store/update', CommonManager.commonCallbackModalData, 'get', {'id': id},'html', {'target': '.loadermodal', 'id': '#commonmodal'});
			return false;
		});
		
		$('body').on('submit', '#updatecategory', function(event) {
			event.stopPropagation();
			var data = $(this).serialize();
			CommonManager.ajax(url+'store/update', CategoryManager.updateCategoryResponse, 'post', data, 'json', {});
			return false;
		});
	}
}

var ProductManager = {
	init: function() {
		$('body').on('submit', '#productform', function() {
			var flag = true;
			$('.errors').remove();
			$(".labelfield").each(function(event){
				if($(this).val() == '') {
					$(this).after('<span style="color:red" class="errors">Please enter label name</span>');
					flag = false;
				}
			});
			
			$(".priceformateach").each(function(event){
				if($(this).val() == '') {
					$(this).after('<span style="color:red" class="errors">Please enter Price</span>');
					flag = false;
				}
			});
			return flag;
		});
		
		
		$('body').on('keypress', '.priceformat', function(event) {
			return CommonManager.validPrice(event, this);
		});
		
		$('body').on('click', '.tragetclosetr', function(event) {
			$(this).closest("tr").remove();
		});
		
		$('body').on('click', '#addtoppingattributesub', function() {
			 var pkid = $(this).attr('pkid');
			 var html = '';
			  var flag=0;
			  var row = $(this).attr('data-row');
			  $('.variation-child-row-'+pkid+'-'+row).remove();
			 $(".toppingssearch:checked").each(function(event){
				 var id = $(this).attr('data-id');
				 var priceval = $('.toppingstext-'+id).val();
				 if(priceval != '') {
					 html += '<tr class="variation-child-row-'+pkid+'"><td>'+$(this).val()+'</td><td>Price: '+priceval+'<input type="hidden" name="price[1]['+row+']['+pkid+']['+id+']" class="form-control" value="'+priceval+'"></td><td><a href="javascript:void(0);" style="color:red;" class="danger tragetclosetr"><i class="fas fa-trash"></i> </a></td></tr>';
					 flag++;
				 }
			 });
			 
			 $('#variation-'+pkid+'-'+row).after(html);
			 $('#toppingsmodalsub').modal('hide');
		});
		
		$('body').on('click', '.varationmodal', function() {
			$('#addvarationattribute').attr('data-type', $(this).attr('data-type'));
			$('#varationmodal').modal('show');
		});
		
		$('body').on('click', '.toppingsmodalsubbutton', function() {
			$('#addtoppingattributesub').attr('pkid', $(this).attr('data-id'));
			$('#addtoppingattributesub').attr('data-row', $(this).attr('data-row'));
			
			$(".toppingssearch:checked").each(function(){
				$(this).prop( "checked", false );
				$('.toppingstext-'+$(this).attr('data-id')).val('');
			});
			$('#toppingsmodalsub').modal('show');
		});
		
		$('body').on('click', '.toppingsbutton', function() {
			$('#addtoppingattribute').attr('data-type', $(this).attr('data-type'));
			$('#toppingsmodal').modal('show');
		});
	}
}