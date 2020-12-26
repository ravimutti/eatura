/**
 * File For Handling form Submission and submit forms.
 * Custom Rule for validation with lib Form Validator.
 * Extend Form Validator Lib methods.
 * File Name : form-handler.js
 */
jQuery(document).ready(function () {
	/**
	 * Set of Custom Rules
	 */
	var minPhoneLen = 10;
	var maxPhoneLen = 15;
	$.validator.addMethod("noSpace", function (value, element, param) {
		return $.trim(value).length >= param;
	}, "No space please and don't leave it empty");
	$.validator.addMethod("valueNotEquals", function (value, element, arg) {
		return arg !== value;
	}, "Value must not equal arg.");
	$.validator.addMethod("notEqual", function (value, element, param) {
		return this.optional(element) || value != param;
	}, "This field is required");
	$.validator.addMethod("greaterThanZero", function (value, element) {
		return this.optional(element) || (parseFloat(value) > 0);
	}, "* Amount must be greater than zero");
	$.validator.addMethod("mobile", function (value, element) {
		return this.optional(element) || value.match(/^(\+\d{1,2})\d{10}$/);
	}, "* Invalid Phone Number");

	$.validator.addMethod("noSpaceAllowed", function (value, element) {
		return value.indexOf(" ") < 0 && value != "";
	}, "No space please and don't leave it empty");

	jQuery.validator.addMethod("alphanumeric", function (value, element) {
		var regex = /\d/g;
		return this.optional(element) || regex.test(value);
	}, "Letters, numbers, and underscores only please");

	/****************************************************/


	/******* checkout form Validation ***/
	$("#checkout-form").validate({
		rules: {
			"order_user_details[address]": {
				alphanumeric: true,
				noSpace: true,
			},
			// "order_user_details[floor]": {
			// 	required: true,
			// 	noSpace: true,
			// },
			"order_user_details[pincode]": {
				required: true,
				noSpace: true,
			},
			"order_user_details[city]": {
				required: true,
				noSpace: true,
			},
			"order_user_details[full_name]": {
				required: true,
				noSpace: true,
			},
			"order_user_details[phone]": {
				required: true,
				noSpace: true,
				number: true,
			},
			"order_user_details[email]": {
				required: true,
			},
			"order[desired_delivery_time]": {
				required: true,
				noSpace: true,
			},
			"order[order_pick_up]": {
				required: true,
				noSpace: true,
			},
			// "order[order_note]": {
			// 	required: true,
			// 	noSpace: true,
			// },
		},
		messages: {
			"order_user_details[full_name]": {
				required: "Bitte geben Sie Ihren Namen an"
			},
			"order_user_details[email]": {
				required: "Bitte geben Sie Ihre E-Mail an"
			},
			"order_user_details[phone]": {
				required: "Bitte geben Sie Ihre Telefonnummer an"
			},
			"order[desired_delivery_time]": {
				required: "Bitte geben Sie an, wann Ihre Bestellungen geliefert werden soll"
			},
			"order_user_details[city]": {
				required: "Bitte geben Sie die Stadt an"
			},
			"order_user_details[address]": {
				noSpace: "Bitte geben Sie Ihre Lieferadresse an",
				alphanumeric: "Please fill in your house number."
			},
		},
		highlight: function (element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function (element) {
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		},
		submitHandler: function (form) {
			if($(document).find('.payment_mode').val().trim() == "Paypal"){
				form.submit();
			}else{
				formSubmit(form);
			}
		}
	});
	/*******************************************/

	/******* Forgot password Validation ***/
	$("#forget-form").validate({
		rules: {
			email: {
				required: true,
				email: true,
				noSpace: true,
			},
		},
		highlight: function (element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function (element) {
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		},
		submitHandler: function (form) {
			formSubmit(form);
		}
	});
	/*******************************************/
	/******* Forgot password Validation ***/

    /******* Profile Validation ***/
	$("#updateprofile").validate({
		rules: {
			name: {
				required: true,
				noSpace: true,
			},
			email: {
				required: true,
				email: true,
				noSpace: true,
			}
		},
		highlight: function (element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function (element) {
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		},
		submitHandler: function (form) {
			formSubmit(form);
		}
	});
	/*******************************************/
	/******* Profile Validation ***/


	/******* changepassword Validation ***/
	$("#changepassword-form").validate({
		rules: {
			oldpassword: {
				required: true,
			},
			newpassword: {
				required: true,
				minlength: 5
			},
			password_confirm : {
				required: true,
				minlength : 5,
				equalTo : "#newpassword"
			},
		},
		highlight: function (element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function (element) {
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		},
		submitHandler: function (form) {
			formSubmit(form);
		}
	});
	/*******************************************/
	/******* changepassword Validation ***/

	/******* Register Validation ***/
	$("#register-form").validate({
		rules: {
			name: {
				required: true,
				noSpace: true,
			},
			phone: {
				required: true,
				noSpace: true,
			},
			email: {
				required: true,
				email: true,
				noSpace: true,
			},
			password: {
				required: true,
			},
		},
		highlight: function (element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function (element) {
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		},
		submitHandler: function (form) {
			formSubmit(form);
		}
	});
	/*******************************************/
	/******* Register Validation ***/
	$("#login-form").validate({
		rules: {
			email: {
				required: true,
				email: true,
				noSpace: true,
			},
			password: {
				required: true,
			},
		},
		highlight: function (element) {
			$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function (element) {
			$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		},
		submitHandler: function (form) {
			formSubmit(form);
		}
	});

	/*******************************************/
  $("#pincodeFORM").validate({
		submitHandler: function (form) {
			let deliveryType = $('input[name="delivery"]:checked').val();

      if(deliveryType == "delivery") {
        let pincodeValue = $(document).find("#input_pincode").val();
        let myInput = $(document).find("#myInput").val();
        // match value in array
        if(countries.includes(myInput)){
          $(document).find("#input_pincode").val(myInput);
        }else{
          if(pincodeValue.length == 0) {
            // we need to show error
            $(document).find(".invalid-pincode").removeClass("d-none");
            return false;
          }
        }
      }
      form.submit();
		}
	});

});


function formSubmit(form) {
	$.ajax({
		url: form.action,
		type: form.method,
		data: new FormData(form),
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			"timezone": Intl.DateTimeFormat().resolvedOptions().timeZone

		},
		contentType: false,
		cache: false,
		processData: false,
		dataType: "json",
		beforeSend: function () {
			$("input[type=submit]").prop("disabled", true);
			$("button[type=submit]").prop("disabled", true);
			$(".loader_div").show();
		},
		complete: function () {
			$(".loader_div").hide();
		},
		success: function (response) {
			var delayTime = 3000;
			if (response.delayTime)
				delayTime = response.delayTime;

			if (parseInt(response.error) === 202) {

			    if(form.id == 'register-form') {
					$('#register').removeClass('active');
					$('#login').addClass('active');
					$('#login').addClass('show');
				}

				// Success Response show alert
				if(response.success_message) {
					swalAlert('Success', response.success_message, delayTime);
				}else{
					swalAlert('Success', response.message, delayTime);
				}

				setInterval(function () {
					$("input[type=submit]").prop("disabled", false);
					$("button[type=submit]").prop("disabled", false);
				}, delayTime);

				if (response.updateRecord) {
					$.each(response.data, function (index, value) {
						$('#tableRow_' + response.data.id).find("td[data-name='" + index + "']").html(value);
					});
				}

				if (response.modelhide) {
					if (response.delay)
						setTimeout(function () {
							$(response.modelhide).modal('hide')
						}, response.delay);
					else
						$(response.modelhide).modal('hide')
				}

				if (response.isFileExport) {
					var link = document.createElement('a'),
						filename = response.fileName;
					link.href = response.filePath;
					link.download = filename;
					link.click();
					link.remove();
				}
			} else {
				$("input[type=submit]").prop("disabled", false);
				$("button[type=submit]").prop("disabled", false);
				if (response.formErrors) {
					var i = 0;
					$(document).find(".temp-use").remove();
					$.each(response.errors, function (index, value) {
						if (i == 0) {
							$("input[name='" + index + "']").focus();
						}
						$("input[name='" + index + "']").parents('.form-group').addClass('has-error');
						$("input[name='" + index + "']").after('<label id="' + index + '-error" class="error temp-use" for="' + index + '">' + value + '</label>');

						$("select[name='" + index + "']").parents('.form-group').addClass('has-error');
						$("select[name='" + index + "']").after('<label id="' + index + '-error" class="error temp-use" for="' + index + '">' + value + '</label>');
						i++;
					});

				} else {
					// show error
					if(response.error_message) {
						swalAlert('Error', response.error_message, delayTime);
					}else{
						swalAlert('Error', response.message, delayTime);
					}
				}
			}


			if (response.resetform) {
				document.getElementById(response.resetform).reset();
			}
			if (response.submitDisabled) {
				$("input[type=submit]").attr("disabled", "disabled");
				$("button[type=submit]").attr("disabled", "disabled");
			}
			if (response.url) {
				if (response.delayTime)
					setTimeout(function () {
						window.location.href = response.url;
					}, response.delayTime);
				else
					window.location.href = response.url;
			}

			if (response.locationReload) {
				if (response.delayTime)
					setTimeout(function () {
						location.reload();
					}, response.delayTime);
				else
					location.reload();
			}
			if (response.reload) {
				setTimeout(function () {
					location.reload();
				}, response.delayTime)
			}
		},
		error: function (response) {
			var delayTime = 3000;
			var jsonResponse = response.responseJSON;
			var jsonErrors = jsonResponse.errors || [];
			var size = Object.keys(jsonErrors).length;

			$("input[type=submit]").prop("disabled", false);
			$("button[type=submit]").prop("disabled", false);
			//INSUFFICIENT_PERMISSIONS
			if (response.status == 401) {
				swalAlert('Info', jsonResponse.error.description, delayTime);
				return;
			}
			//checking response code
			if (response.status == 400) {
				swalAlert('Error', jsonResponse.message, delayTime);
			}

			if (size > 0) {
				$.each(jsonErrors, function (index, value) {
					swalAlert('Error', value, delayTime);
				})
			}
		}
	});
}

function toaster(type, message, delayTime = 2000) {
	$.toast({
		heading: type,
		text: message,
		loader: true,
		loaderBg: '#fff',
		showHideTransition: 'fade',
		icon: type.toLowerCase(),
		hideAfter: delayTime,
		position: 'top-right'
	});
}

function swalAlert(type, message, delayTime = 2000) {
	swal({title: type,text: message,icon: type.toLowerCase(),buttons: false,timer: delayTime,});
}
// $2y$10$mwAKHl2WIwNw/tF.g6cLNOBm6Z/ZDopEuHLCFLN9ua099jT6T6lja
// $2y$10$7W7yURnpU8yLai2aK1seUuSWLJoWIiEw6FDzNbIM2B75um.Gpmv26
