prepareCartItemArr = JSON.parse(prepareCartItemArr);
restaurantPinCodes = JSON.parse(restaurantPinCodes);
currentPinCodeRow = JSON.parse(currentPinCodeRow);
const _ = jQuery(document);

function checkIfInfoIconClicked(e){
	if(e.target)
	return false;
}
jQuery(document).ready(function () {

	setCheckoutButton();

	updateProductPrice();
	// event to add items to cart

	_.on('click', '.variantProduct', function (e) {
	   setCurrentProductActive($(this));
		// console.log({event:e});
		prepareCartPrice($(this));
	});

	_.on('click', '.showProductOnTop', function (e) {
		// here we need to close opened collasped
		var target = $(this).data("target");
		var acpanels = $(".container-fluid").find(".collapse.show").not(target);
		acpanels.collapse("hide");
		$(target).collapse("show");
		let $this = $(this);
		setTimeout(function () {
			smoothScrollToElement($this);
		}, 500)
	});

	_.on('click', '.cartButtonSubmit', function (e) {
		let cartURL = $(this).attr('data-target-url');
		location.href = cartURL;

	})

	_.on('change', '.varaintcallSub', function (e) {
		let productRef = $(this).find('option:selected').attr('data-product-ref');
		const $container = $('.productRow' + productRef);
		const closestContainer = $(this).closest(".sidedishes");
		closestContainer.find('.manageCartQtyInput').val(1);
		const currentSelectedVariant = $(this).find("option:selected").attr("data-variant-name");
		const currentSelectedMoreInfo = $(this).find("option:selected").attr("data-more_info");
		$(this).parent(".cstm-select").find(".currentVariant").html(currentSelectedVariant);
		$(this).parent(".cstm-select").find(".more-info-product ").attr("data-more_info",currentSelectedMoreInfo);


		prepareCartPrice($container);
	})

	showMinimumOrderAmountByPinCode(0);

	_.on('click', '.add_to_cart_button', function (event) {
	     $('.meal-des').removeClass('selected_current');
		const closestContainer = $(this).closest(".sidedishes");
		const response = prepareItemPriceByClosestElement(closestContainer);

		let canCreateNewItem = updateCartQtyInCaseOfDuplicateRequest(response);
		if (!canCreateNewItem) {
			prepareCartItemArrHTML(response);
			prepareCartItemArr.push(response);
		}
		// reset item
		if (closestContainer.length) {
			closestContainer.find('.cart_variants_add_on').each(function (e) {
				if ($(this).is(':checked')) {
					$(this).prop('checked', false);
				}
			});
			closestContainer.find('.manageCartQtyInput').val(1);
			closestContainer.find(".varaintcallSub").prop("selectedIndex", 0);
		}
		$('.productRow' + closestContainer.attr('data-target')).trigger('click');

		updateCartPrice();

		$(closestContainer).find('.canHideShow').removeClass('d-none');
		$(closestContainer).find('.canHideShow').addClass('d-none');


		$(closestContainer).find('.see-more-options').each(function (e) {
			$(this).html(` <i class="fas fa-chevron-down"></i> Show ${$(this).attr('data-result-count')} more`);
		});

		scrollCartScrollBar()
		// send current item here we need to add these items to server.
		sendCartItemToServer(prepareCartItemArr);

	})

	_.on('click', '.removeCartItem', function (e) {
		let $this = $(this);
		const cartReference = ($this.attr('data-cart-ref'));
		// let check = confirm("Are you sure you want to remove this cart item");
		let check = true
		if (check) {
			// here we need to remove this item from cart array
			let getIndexOfCartItem = prepareCartItemArr.findIndex((item) => {
				return cartReference.toString() === item.id.toString();
			});

			if (getIndexOfCartItem > -1) {
				// remove item from array
				prepareCartItemArr.splice(getIndexOfCartItem, 1);
				// we need to remove selected from product list
				sendCartItemToServer(prepareCartItemArr);
				// and remove the item from cart list as well
				$(document).find('#cartItem' + cartReference).remove();
			}
			setTimeout(() => {
				updateCartPrice();
			}, 100);

			// const response = prepareItemPriceByClosestElement(closestContainer);
		}

	});


	_.on('click', '.addToCartSimpleProduct', function (event) {
		setCurrentProductActive($(this));
		// here we need to add simple product to cart
		var acpanels = $(".container-fluid").find(".collapse.show");
		acpanels.collapse("hide");

		if ($(event.target).hasClass("fa-info-circle")) return false;
		let checkResponse = checkProductIsAvailble($(this));

		if (!checkResponse) {
			return checkResponse;
		}

		let $this = $(this);
		let response = {
			id: 'simpleProduct' + $this.attr('data-product-ref'),
			qty: 1,
			price: parseFloat($this.attr('data-product-price')).toFixed(2),
			name: ($this.attr("data-product-name")),
			options: {
				variants: null,
				product: {
					note: '',
					addOnsString: '',
					productSKU: $this.attr('data-product-slugname'),
					id: $this.attr('data-product-ref'),
				}
			}
		};

		let canCreateNewItem = updateCartQtyInCaseOfDuplicateRequest(response);
		if (!canCreateNewItem) {
			prepareCartItemArrHTML(response);
			prepareCartItemArr.push(response);
		}
		scrollCartScrollBar()
		updateCartPrice();
		// send current item here we need to add these items to server.
		sendCartItemToServer(prepareCartItemArr);
	});

	_.on('change', '.cart_variants_add_on', function (event) {
		const closestContainer = $(this).closest(".sidedishes");
		prepareItemPriceByClosestElement(closestContainer);
	});

	// event to increase decrease qty
	_.on('click', '.manageCartQty', function (event) {
		const closestContainer = $(this).closest(".sidedishes");
		const dataType = $(this).attr('data-ref');
		const dataPerform = parseInt($(this).attr('data-perform'));

		if (dataType === "down") {
			closestContainer.find(".manageCartQtyInput").val(parseInt(closestContainer.find(".manageCartQtyInput").val()) - 1);
			if (closestContainer.find(".manageCartQtyInput").val() <= dataPerform) {
				closestContainer.find(".manageCartQtyInput").val(dataPerform);
			}
		} else {
			closestContainer.find(".manageCartQtyInput").val(parseInt(closestContainer.find(".manageCartQtyInput").val()) + 1);
			if (closestContainer.find(".manageCartQtyInput").val() >= dataPerform) {
				closestContainer.find(".manageCartQtyInput").val(dataPerform);
			}
		}

		prepareItemPriceByClosestElement(closestContainer);
	});

	_.on('click', '.updateCartQty', function (e) {
		const $this = $(this);
		const itemSKU = $this.attr('data-ref');

		const findItemIndex = prepareCartItemArr.findIndex((item) => item.id === itemSKU);
		if (findItemIndex > -1) {
			if ($this.attr('data-type') === 'down') {
				if (prepareCartItemArr[findItemIndex].qty === 1) {
					$(this).parent('.cart-meal-edit-buttons').find('.removeCartItem').trigger("click");
					return;
				}
				prepareCartItemArr[findItemIndex].qty -= 1;
			} else {
				// if (prepareCartItemArr[findItemIndex].qty === 10) return;
				prepareCartItemArr[findItemIndex].qty += 1;
			}
			//update html here
			$(document).find('#cartItemQty' + itemSKU).html(prepareCartItemArr[findItemIndex].qty + 'x');
			let itemPrice = parseFloat(prepareCartItemArr[findItemIndex].qty * prepareCartItemArr[findItemIndex].price).toFixed(2);
			$(document).find('#cartItemPrice' + itemSKU).html(formatAmount(itemPrice) + ' €');
			updateCartPrice()
			sendCartItemToServer(prepareCartItemArr);
		} else {
			alert('invalid product you can not update the value.');
		}
	});

	_.on('click', '.editCartItemNote', function (e) {
		const $this = $(this);
		const itemSKU = $this.attr('data-ref');
		const findElement = $(document).find('.textarea' + itemSKU);
		const inputTextSpanfindElement = $(document).find('.item_note' + itemSKU);
		// console.log(findElement);
		if (!findElement.hasClass('d-none')) {
			findElement.addClass('d-none');
			findElement.find('.saveCartNote').trigger('click');
			inputTextSpanfindElement.removeClass('d-none').addClass("d-flex");
		} else {
			findElement.removeClass('d-none');
			inputTextSpanfindElement.addClass('d-none').removeClass("d-flex");
		}
	})

	_.on('click', '.saveCartNote', function (e) {
				const $this = $(this);
				const itemSKU = $this.attr('data-ref');
				const itemType = $this.attr('data-type');
				const findItemIndex = prepareCartItemArr.findIndex((item) => item.id === itemSKU);
				if (findItemIndex > -1) {
					const findElement = $(document).find('.textarea' + itemSKU);
					const inputTextSpanfindElement = $(document).find('.item_note' + itemSKU);
					prepareCartItemArr[findItemIndex].options.product.note = findElement.find('textarea').val();
					//update html here
					findElement.addClass('d-none');
					inputTextSpanfindElement.removeClass('d-none').addClass("d-flex");
					var shortText = truncateString(prepareCartItemArr[findItemIndex].options.product.note);
					$(document).find('.item_note' + itemSKU).html(shortText);
					shuffleProductNoteText(prepareCartItemArr[findItemIndex],itemSKU);
					sendCartItemToServer(prepareCartItemArr);
				} else {
					alert('invalid product you can not update the value.');
				}
		});

    _.on("click",'.cancel_note',function(e){
					const $this = $(this);
					const itemSKU = $this.attr('data-ref');
					const itemType = $this.attr('data-type');
					const findItemIndex = prepareCartItemArr.findIndex((item) => item.id === itemSKU);
					if (findItemIndex > -1) {
						const findElement = $(document).find('.textarea' + itemSKU);
						const inputTextSpanfindElement = $(document).find('.item_note' + itemSKU);
						if(itemType == "Delete") {
							 prepareCartItemArr[findItemIndex].options.product.note = "";
						}
						findElement.find('textarea').val(prepareCartItemArr[findItemIndex].options.product.note);
						findElement.addClass('d-none');
						inputTextSpanfindElement.removeClass('d-none').addClass("d-flex");
						shuffleProductNoteText(prepareCartItemArr[findItemIndex],itemSKU);
						var shortText = truncateString(prepareCartItemArr[findItemIndex].options.product.note);
						$(document).find('.item_note' + itemSKU).html(shortText);

						if(itemType == "Delete")
								sendCartItemToServer(prepareCartItemArr);
					}
			});

	/**
	 * Event to search products
	 */
	$(".search-cstm").on("keyup", function () {
		var value = $(this).val().toLowerCase().trim();

		if (value.length > 0) {
			$(document).find('.no_product_to_cart').closest('.menu-post').addClass('d-none');
		} else {
			$(document).find('.no_product_to_cart').closest('.menu-post').removeClass('d-none');
		}
		$(".product_name").filter(function () {
			console.log($(this).text().toLowerCase().indexOf(value))
			let categoryRow = $(this).attr('data-parent');
			let productRow = $(this).attr('date-ref');
			let productName = $(this).text().toLowerCase().trim();
			console.log(productName, value)
			if (productName.indexOf(value) > -1) {
				$('.' + productRow).addClass('d-flex');
				$(this).addClass('matched').removeClass('unmatched');
				$('#' + categoryRow).removeClass('d-none');
				$('.' + productRow).removeClass('d-none');

			} else {
				$(this).removeClass('matched').addClass('unmatched');
				$('.' + productRow).removeClass('d-flex');
				$('#' + categoryRow).addClass('d-none');
				$('.' + productRow).addClass('d-none');
			}

			_.find('.matched').each(function (e) {
				let categoryRow = $(this).attr('data-parent');
				let productRow = $(this).attr('date-ref');
				$('#' + categoryRow).removeClass('d-none');
				$('.' + productRow).removeClass('d-none');
			})
		});
	});

	_.on('click', '.unavailable', function (e) {
		const restaurantName = $(document).find('.food-name').find('h3').text().trim();
		let message = `${restaurantName} ist momentan geschlossen. Bitte versuche es morgen.`;
		if(errorMessageInCaseOfPinCode && errorMessageInCaseOfPinCode.length > 0) {
			message = errorMessageInCaseOfPinCode;
			swalAlert('Error', message, 3000);
			return false;
		}

		$('#not-accepting-orders-model').modal('show');

		setTimeout(function() {$('#not-accepting-orders-model').modal('hide')},2000)
	});

	_.on('click', '.see-more-options', function (e) {
		const container = $(this).closest('.meal-check');
		const resultCount = $(this).attr('data-result-count');
		if ($(container).find('.canHideShow').hasClass('d-none')) {
			$(container).find('.canHideShow').removeClass('d-none');
			$(this).html(` <i class="fas fa-chevron-up"></i> Show ${resultCount} less`);
		} else {
			$(container).find('.canHideShow').addClass('d-none');
			$(this).html(` <i class="fas fa-chevron-down"></i> Show ${resultCount} more`);
		}
	});


	setChosenOfProducts()




		$('.modal').on('hidden.bs.modal', function (e) {
				const modalId = $(this).attr('id');
				if(modalId == "productOverviewModal") {
					$(this).find(".product_description").html("");
				}
		})

	_.on('click', '.more-info-product', function (e) {
			// we need to open modal with product information
			let productDescriptionContainer = $(this).attr("data-more_info");

			let check = IsJsonString(productDescriptionContainer);

			if(check === false) {
				swalAlert("Error","No Description to show.");
				return;
			}else {
				productDescriptionContainer = JSON.parse(productDescriptionContainer);
			}

			const getData = async () => {
				let product_description = '<ul class="product-discription">';
				$.each(productDescriptionContainer, function (index, value) {
					product_description += '<li>' + value + '</li>';
				});

				return product_description += '</ul>';
			}
			getData().then(data => {
				$("#productOverviewModal").find(".product_description").html(data);
				$("#productOverviewModal").modal("show");
			});
	});


	_.on('click', '.open_cartModal', function (e) {
		const itemsContainer = $(".pizza-column");
		const cartContainer = $(".cart-basket");
		cartContainer.css({"z-index": 9999});
		cartContainer.addClass("d-flex");
		itemsContainer.addClass("d-none");
		$('.cart_mobile_icon').removeClass("d-none");
		$(this).addClass("d-none");
	});

	_.on('click', '.cart_mobile_icon', function (e) {
		const itemsContainer = $(".pizza-column");
		const cartContainer = $(".cart-basket");
		cartContainer.removeClass("d-flex");
		itemsContainer.removeClass("d-none");
		$('.open_cartModal').removeClass("d-none");
		$(this).addClass("d-none");
	});

	_.on('click', '.cartHeaderContainer', function (e) {
		if(!$(this).find(".cart_mobile_icon").hasClass("d-none")) {
			$(".cart_mobile_icon").trigger("click");
		}
	});


	_.on('click', '.resetSearch', function (e) {
		$(document).find('.search-cstm').val('');
		$(document).find('.search-cstm').trigger('keyup');
	});

	_.on('click', '.add_more_item_mobile', function (e) {
		$(document).find('.cart_mobile_icon').trigger('click');
	});

	_.on('change', '.deliveryTypeRadio', function (e) {
		const $this = $(this);
		if ($this.val().toString() === "delivery") {
			$(document).find('.pin_code_form').removeClass('d-none');
			$(document).find('.form-cstm').prop('disabled', false);
		} else {
			$(document).find('#pincodeFORM').submit();
			$(document).find('.pin_code_form').addClass('d-none');
			$(document).find('.form-cstm').prop('disabled', true);
		}
	});

	_.on('click', '.link-open ', function (e) {
		setTimeout(() => {
			$(this).removeClass('active');
		}, 100)
	})

	$(window).resize(function () {
		showMinimumOrderAmountByPinCode(0)
	});

	_.on('click','.info-pay-card',function(e) {
		_.find('.info-pay-card').removeClass("active");
		$(this).addClass("active");
		_.find(".payment_mode").val($(this).attr("data-ref"))
	});

	$("[data-toggle='collapse']").click(function(event) {
		if($(event.target).hasClass('fa-info-circle')) {
			event.stopPropagation();
		}
	});
})

function setCheckoutButton(flag = 0) {
	if (prepareCartItemArr.length === 0) {
		// $('.cartbutton-button').attr("href", 'javascript:void(0)');
		// $('#responsive-cart-items .btn-primary').attr("href", 'javascript:void(0)');
		$('.cartButtonSubmit').attr("disabled", true);
		$('.responsive-menu').addClass("d-none");
	} else {
		// $('.cartbutton-button').attr("href", $('.cartbutton-button').attr('data-target-url'));
		// $('#responsive-cart-items .btn-primary').attr("href", $('#responsive-cart-items .btn-primary').attr('data-target-url'));
		$('.cartButtonSubmit').removeAttr("disabled");
		$('.responsive-menu').removeClass("d-none");

	}

	if (flag === 1) {
		$('.cartButtonSubmit').attr("disabled", true);
	}

	if (flag === 2) {
		$('.cartButtonSubmit').removeAttr("disabled");
	}
}

/*This file can handle functionality of cart*/
function updateProductPrice() {
	$(document).find('.variantProduct').each(function (e) {
		prepareCartPrice($(this));
	});
}

const truncateString = (string, maxLength = 50) => {
	if (!string) return '';
	if (string.length <= maxLength) return string;
	return `${string.substring(0, maxLength)}...`;
};

/**
 * @purpose to update qty of cart if duplicate request
 * @param response
 * @returns {boolean}
 */
function updateCartQtyInCaseOfDuplicateRequest(response) {
	// we need to check duplicate item
	let checkDuplicate = prepareCartItemArr.findIndex((item) => {
		return (item.id).toString() === (response.id).toString();
	});
	let isCartUpdated = false;
	if (checkDuplicate > -1) {
		// increase qty
		// if (prepareCartItemArr[checkDuplicate].qty < 10)
		prepareCartItemArr[checkDuplicate].qty += response.qty;
		response.qty = prepareCartItemArr[checkDuplicate].qty;
		// update qty
		$(document).find('#cartItemQty' + response.id).html(response.qty + 'x');
		let itemPrice = parseFloat(response.qty * response.price).toFixed(2);
		$(document).find('#cartItemPrice' + response.id).html(formatAmount(itemPrice) + ' €');
		isCartUpdated = true;
	}
	return isCartUpdated;
}

/**
 * @purpose to build html of cart item
 * @param response
 */
function prepareCartItemArrHTML(response) {
	const cartContainer = $(document).find('#items');
	let addOnString = response.options.product.addOnsString;

	let cartItemHTML = `<div id="cartItem${response.id}">
							<div class="add-meal">
								<span class="cart-meal-amount notranslate"
								  id="cartItemQty${response.id}">${response.qty}x</span>
								<span class="cart-meal-name notranslate">${response.name}</span>
								<div class="cart-meal-edit-buttons">
										<button type="button"
										class="cart-meal-edit-delete updateCartQty" data-ref="${response.id}" data-type="down">
											<i class="fa fa-minus"></i>
										</button>
										<button type="button" class="cart-meal-edit-add updateCartQty" data-ref="${response.id}" data-type="up">
											<i class="fa fa-plus"></i>
										</button>
										<button type="button" class="cart-meal-edit-comment editCartItemNote" data-ref="${response.id}">
											<i class="fas fa-pencil-alt"></i>
										</button>
										<span id="cartItemPrice${response.id}" class="cart-meal-price notranslate">${formatAmount(parseFloat(response.price * response.qty).toFixed(2))} €</span>
										<button type="button" class="cart-meal-delete removeCartItem" data-cart-ref="${response.id}">
											<i class="fas fa-trash-alt"></i>
										</button>
								</div>
							</div>
							<div class="textarea${response.id} d-none">
								<div class="form-group mb-0">
								<textarea class="form-control"
								  placeholder="Write item notes..."></textarea>
								</div>
								<div class="SaveCancelNote">
									<a href="javascript:void(0)"
									   style="float: right;color: #333;"
									   data-ref=""
									   class="cancel_note">Cancel</a>
									<a href="javascript:void(0)"
									   style="float: right;color: #1474f5;"
									   data-ref="${response.id}"
									   class="saveCartNote">Save</a>
								</div>
							</div>
							<small class="subAddOns">${addOnString}</small>
							<span class="note_box font-italic d-flex cart-meal-name notranslate item_note${response.id}"></span>
						</div>`;
	cartContainer.append(cartItemHTML);
}

/**
 * @purpose to update cart price in case of adding item or removing item
 */
function updateCartPrice() {
	// here we need to update cart price or make cart price
	let subTotal, deliveryCosts = 0;

	// here we need to check pincode charge
	if (currentPinCodeRow) {
		deliveryCosts = parseFloat(currentPinCodeRow.deliverycharges);
	}
	if (deliveryType.toString() === "self") {
		deliveryCosts = parseFloat(0);
	}
	if (prepareCartItemArr.length === 0) {
		deliveryCosts = 0;
		_.find('.delivery_costs_container').addClass('d-none').removeClass('d-flex');
	} else {
		_.find('.delivery_costs_container').removeClass('d-none').addClass('d-flex');
	}

	subTotal = prepareCartItemArr.reduce(function (sum, amount) {
		return sum + (parseFloat(amount.price) * amount.qty);
	}, 0);
	let totalPrice = subTotal + deliveryCosts;

	if (prepareCartItemArr.length === 0) {
		_.find('.basket-empty').removeClass('d-none');
	} else {
		if (!_.find('.basket-empty').hasClass('d-none'))
			_.find('.basket-empty').addClass('d-none');
	}


	$(document).find('#subTotal').html(formatAmount(subTotal.toFixed(2)) + ' €');
	if (deliveryType.toString().toLowerCase() === "delivery") {
		$(document).find('#deliveryCosts').html(formatAmount(deliveryCosts.toFixed(2)) + ' €');
	}
	$(document).find('#totalPrice').html(formatAmount(totalPrice.toFixed(2)) + ' €');

	setCheckoutButton();
	showMinimumOrderAmountByPinCode(subTotal);
	setMobilePriceOnCheckoutButton()
}

function setMobilePriceOnCheckoutButton() {
	let subTotal = prepareCartItemArr.reduce(function (sum, amount) {
		return sum + (parseFloat(amount.price) * amount.qty);
	}, 0);

	let cartQty = prepareCartItemArr.reduce(function (sum, amount) {
		return sum + amount.qty;
	}, 0);

	subTotal = subTotal.toFixed(2);

	_.find('#mobileCartItemsCount').html(`${cartQty}`);
	_.find('#mobileCartPrice').attr('data-cart-item-price', subTotal).html(`${formatAmount(subTotal)}`);
}

setMobilePriceOnCheckoutButton();

function showWarningClassOnMobileButton() {
	$('.open_cartModal').toggleClass('btn-warning');
	setTimeout(function () {
		$('.open_cartModal').toggleClass('btn-warning');
	}, 1000);
}

/**
 * @purpose send cart items to server to build server side cart
 * @param cartItem
 */
function sendCartItemToServer(cartItem) {
	// add class on mobile button
	showWarningClassOnMobileButton();
	$.ajax({
		url: siteURL + 'save-cart-item',
		type: "POST",
		data: {postData: JSON.stringify(cartItem), deliveryCharge: JSON.stringify(currentPinCodeRow)},
		dataType: "json",
		beforeSend: function (x) {
			if (x && x.overrideMimeType) {
				x.overrideMimeType("application/j-son;charset=UTF-8");
			}
		},
		success: function (result) {
			//Write your code here
		}
	});
}

/**
 * @purpose build cart items for variants products
 * @param closestContainer
 * @returns {{price: string, qty: number, name: (null|jQuery|undefined), options: [], id: string}}
 */
function prepareItemPriceByClosestElement(closestContainer) {
	let defaultPrice = parseFloat(closestContainer.find('.add_to_cart_button').attr("data-cart-item-price"));

	let addOnPrice = 0;
	let addOnArr = [];
	let variantWithToppings = [];
	let makingProductSlug = `${closestContainer.attr("data-product-ref")}x`;
	let cartVariantsAddOnSlug = '';
	let addOnsString = '';

	closestContainer.find('.provariants').each(function (item) {
		const selected_option = $(this).find(".varaintcallSub").find("option:selected");
		const _option = $(this).find(".varaintcallSub option:selected");
		if (selected_option.length) {
			addOnsString += _option.attr('data-variant-name') + ', ';
			closestContainer.find(".cart_variants_add_on").each(function (item) {
				let checkVisible = $(this).closest('.meal-description ').is(":visible");
				if ($(this).is(':checked') && checkVisible) {
					// need to push addon if not already exits
					let prepareObj = {
						name: $(this).attr('data-name'),
						type: $(this).attr('data-type'),
						price: $(this).attr('data-price'),
						id: parseInt($(this).attr('data-ref')),
					}
					let checkExits = addOnArr.findIndex((item) => {
						return item.id === prepareObj.id;
					});
					if (checkExits < 0) {
						cartVariantsAddOnSlug += `${prepareObj.id}x`;
						addOnsString += `${prepareObj.name}, `;
						addOnPrice += parseFloat($(this).attr('data-price'));
						addOnArr.push(prepareObj);
					}
				}
			});

			makingProductSlug += `${_option.val()}x${cartVariantsAddOnSlug}`
			variantWithToppings.push({
				variantArr: {
					toppings: false,
					variant: true,
					name: _option.attr('data-variant-name'),
					id: _option.val(),
					price: _option.attr("data-variant-price"),
					addOns: addOnArr,
				}
			});
		} else {
			//	case only toppings
			closestContainer.find(".cart_variants_add_on").each(function (item) {
				let checkVisible = $(this).closest('.meal-description ').is(":visible");
				if ($(this).is(':checked') && checkVisible) {
					// need to push addon if not already exits
					let prepareObj = {
						name: $(this).attr('data-name'),
						type: $(this).attr('data-type'),
						price: $(this).attr('data-price'),
						id: parseInt($(this).attr('data-ref')),
					}

					let checkExits = addOnArr.findIndex((item) => {
						return item.id === prepareObj.id;
					});
					if (checkExits < 0) {
						cartVariantsAddOnSlug += `${prepareObj.id}x`;
						addOnsString += `${prepareObj.name}, `;
						addOnPrice += parseFloat($(this).attr('data-price'));
						addOnArr.push(prepareObj);
					}

					// console.log(addOnArr)
				}
			});

			makingProductSlug += `${cartVariantsAddOnSlug}`
			variantWithToppings.push({
				variantArr: {
					toppings: true,
					variant: false,
					addOns: addOnArr,
				}
			});
		}
	});
	// add addons price to default price
	defaultPrice += addOnPrice;

	//multiply by qty

	defaultPrice = defaultPrice * parseInt(closestContainer.find('.manageCartQtyInput').val());
	// modify product price
	closestContainer.find('.add_to_cart_button').html(`${formatAmount(defaultPrice.toFixed(2))} €`);

	const response = {
		id: makingProductSlug,
		qty: parseInt(closestContainer.find('.manageCartQtyInput').val()),
		price: parseFloat(defaultPrice).toFixed(2),
		name: (closestContainer.attr("data-product-name")),
		options: {
			variants: variantWithToppings,
			product: {
				note: '',
				addOnsString: addOnsString.replace(/,\s*$/, ""),
				productSKU: closestContainer.attr("data-product-slugname"),
				id: closestContainer.attr("data-product-ref"),
			}
		}
	};
	// console.log(response)
	return response
}

function smoothScrollToElement(el) {
	window.scroll({
		top: parseFloat(el.offset().top) - 65,
		left: 0,
		behavior: 'smooth'
	});
}

function prepareCartPrice(container) {
	const productRef = container.attr('data-ref');
	// console.log("fired")
	let defaultProductPrice = container.find('.product_price_' + productRef).attr('data-product-price');
	defaultProductPrice = parseFloat(defaultProductPrice);
	let variantCallSubPrice = 0;
	const $parentContainer = $(container.attr('data-target'));
	// here we need to check if there is any variant price then we consider it product price
	$parentContainer.find('.varaintcallSub').each(function (e) {
		let _selectedOption = $(this).find('option:selected');
		variantCallSubPrice += parseFloat(_selectedOption.attr('data-variant-price'));
	});
	// we also need to check if there is any subtopping selected
	let subToppingPrice = 0;
	$parentContainer.find('.cart_variants_add_on').each(function (e) {
		// here we need to check if container is visible then we need to add price
		let checkVisible = $(this).closest('.meal-description ').is(":visible");
		if ($(this).is(':checked') && checkVisible) {
			subToppingPrice += parseFloat($(this).attr('data-price'));
		}
	});
	// here we need to price to cart button
	let replacePrice = variantCallSubPrice > 0 ? variantCallSubPrice : defaultProductPrice;
	replacePrice += subToppingPrice;
	replacePrice = parseFloat(replacePrice).toFixed(2);

	// console.log(replacePrice)
	$parentContainer.find('.add_to_cart_button').attr('data-cart-item-price', replacePrice).html(`${formatAmount(replacePrice)} €`);

	$('.product_price_' + productRef).html(formatAmount(replacePrice) + ' €');
	$('.product_price_' + productRef).attr('data-product-price', replacePrice);
}

function scrollCartScrollBar() {
	$("#items").scrollTop($("#items")[0].scrollHeight);
}

function setChosenOfProducts() {
	_.find('.chosen_of_text').each(function (e) {
		const replaceContainer = $(this).attr('data-target');
		$(replaceContainer).html('Choice of: ' + $(this).text().trim()).removeClass('d-none');
	})
}

function formatAmount(replacePrice) {
	return replacePrice.toString().replace(".", ",");
}

function checkProductIsAvailble(container) {

	if (container.hasClass('can_not_order')) {
		swalAlert('Error', "This product cannot be ordered at this time.", 3000);
		return false;
	}
	return true;
}

/**
 * This function for handling cart messages in case min max price for pin code
 * @param replacePrice
 */
function showMinimumOrderAmountByPinCode(replacePrice) {
	if (replacePrice === 0) {
		replacePrice = prepareCartItemArr.reduce(function (sum, amount) {
			return sum + (parseFloat(amount.price) * amount.qty);
		}, 0);
	}

	// we need to check minimum cart price according to pin code
	const minimumCartAmountContainer = _.find('.minimum_cart_amount_container');
	const valid_cart_minimum_order = _.find('.valid_cart_minimum_order');
	const no_items_in_cart = _.find('.no_items_in_cart');
	const add_more_item_mobile = _.find('.add_more_item_mobile');
	// if minimum order value is greater than current order value

	if($(window).width() > 1000) {
		$(".pizza-column").removeClass("d-none");
		$(".cart_mobile_icon").addClass('d-none');
	}else if ($(window).width() < 1000) {
		$(".cart_mobile_icon").removeClass('d-none');
	}

	if (currentPinCodeRow && parseFloat(currentPinCodeRow.minimum_amount) > parseFloat(replacePrice) && prepareCartItemArr.length) {
		$("#ibasket").addClass("custom_class_basket");
		minimumCartAmountContainer.removeClass('d-none').addClass('d-flex').find('.minimum_cart_amount').html('€' + parseFloat(currentPinCodeRow.minimum_amount).toFixed(2));
		// we need to hide minimum order container
		valid_cart_minimum_order.addClass('d-none');
		no_items_in_cart.removeClass('d-none');


		if ($(window).width() < 770){
			add_more_item_mobile.removeClass('d-none');
		}
		else {
			add_more_item_mobile.addClass('d-none');
			$('.cartButtonSubmit').removeClass('d-none');
		}
		if ($('.add_more_item_mobile').is(':visible') || $(window).width() < 770) {
			$('.cartButtonSubmit').addClass('d-none')
		}
		// we need mark button as disabled
		const minimumCartPrice = parseFloat(minimumCartAmountContainer.find('.minimum_cart_amount').attr('data-minimum-cart-amount'));
		if (minimumCartPrice > replacePrice) {
			const prepareMinPrice = minimumCartPrice - replacePrice;
			minimumCartAmountContainer.find('.minimum_cart_amount').html('€' + formatAmount(prepareMinPrice.toFixed(2)));
		}
		// here we need to show message
		setCheckoutButton(1)
	} else {
		$("#ibasket").removeClass("custom_class_basket");
		valid_cart_minimum_order.removeClass('d-none');
		minimumCartAmountContainer.addClass('d-none').removeClass('d-flex');
		no_items_in_cart.addClass('d-none').removeClass('d-flex');
		add_more_item_mobile.addClass('d-none').removeClass('d-block d-sm-none');

		if (!$('.add_more_item_mobile').is(':visible')) {
			$('.cartButtonSubmit').removeClass('d-none')
		}
		if (prepareCartItemArr.length)
			setCheckoutButton(2)
	}

	if (prepareCartItemArr.length === 0) {
		valid_cart_minimum_order.addClass('d-none');
	}
}

if (deliveryType.length == 0 && typeof byPassPickupCookie === 'undefined') {
	// we need to open model
	$('#search-pop-header').modal({
		backdrop: 'static',
		keyboard: false
	});
}

if (parseInt(restaurantStatus) === 0) {
	$('#not-accepting-orders-model').modal({
		backdrop: 'static',
		keyboard: false
	});
}


function IsJsonString(str) {
	try {
			JSON.parse(str);
	} catch (e) {
			return false;
	}
	return true;
}

function showProductDescription(productRef) {
	// we need to open modal with product information
		const productDescriptionContainer = _.find('#product_description_' + productRef);
		let hasJson = productDescriptionContainer.find('.product_description').hasClass('hasJson');

		if (hasJson) {
			// let prepareJSON = JSON.parse(productDescriptionContainer.find('.product_description').attr('data-description'));
			let hasMoreInfoJson = "";
			const _product = productDescriptionContainer.find('.product_description');
			// console.log(_product.attr('data-more_info').trim());

			let check = IsJsonString(_product.attr('data-more_info'));

			if(check === false) {
				swalAlert("Error","No Product Description to show.");
				return;
			}else {
				hasMoreInfoJson = JSON.parse(_product.attr('data-more_info'));
			}


			const getData = async () => {
				let product_description = '<ul class="product-discription">';
				// $.each(prepareJSON, function (index, value) {
				// 	product_description += '<li>' + value + '</li>';
				// });
				$.each(hasMoreInfoJson, function (index, value) {
					product_description += '<li>' + value + '</li>';
				});

				if (hasMoreInfoJson.length === 0)
					product_description += '<li>No description for this product.</li>';

				return product_description += '</ul>';
			}
			getData().then(data => {
				$("#productOverviewModal").find(".product_description").html(data);
				$("#productOverviewModal").modal("show");
			});
		} else {
			let product_description = productDescriptionContainer.find('.product_description').attr('data-description');
			if(product_description) {
				$("#productOverviewModal").find(".product_description").html(product_description.trim());
				$("#productOverviewModal").modal("show");
				return false;
			}
			swalAlert("Error","No Product Description to show.");
		}
}

function setCurrentProductActive(current) {
		$('.variantProduct').removeClass('selected_current');
		$('.addToCartSimpleProduct').removeClass('selected_current');
		current.addClass('selected_current');
}

function shuffleProductNoteText(arr,itemSKU) {
		const noteVal = arr.options.product.note;
		let save = "Save";let cancel = "Delete";
		if (noteVal.trim() == "") {save = "Add";cancel = "Cancel";}
		const findElement = $(document).find('.textarea' + itemSKU);
		findElement.find(".SaveCancelNote").find(".saveCartNote").attr("data-type",save).html(save);
		findElement.find(".SaveCancelNote").find(".cancel_note").attr("data-type",cancel).html(cancel);
}

if( typeof updateCart !== 'undefined') {
	sendCartItemToServer(prepareCartItemArr);
}
/*
Changes have been made
1. Only one collapsed open at the same time (If clicked on new product,  previous product expansion not closed).
2. Scroll current variant product on top when click on it scroll item to the top (Product expansion happening in the centre of the screen ).
3. On mobile cart button show when item added in cart. show when item add if item removed from cart and there is no item in cart button hide that time(Shopping cart position display after first product added to the cart).
4. When qty 1, if Clicking on “–” it should delete product
5. Delivery timing options
issues resolved
1. Price showing () space.
2. Validation required for house number, Etage Should not be mandatory and Add Note – should not be mandatory

Query
Remove product order qty. limit from 10 pcs. Only
Explain the behavior
 */


 (function($) {
  $.fn.nodoubletapzoom = function() {
      $(this).bind('touchstart', function preventZoom(e) {
        var t2 = e.timeStamp
          , t1 = $(this).data('lastTouch') || t2
          , dt = t2 - t1
          , fingers = e.originalEvent.touches.length;
        $(this).data('lastTouch', t2);
        if (!dt || dt > 500 || fingers > 1) return; // not double-tap

        e.preventDefault(); // double tap - prevent the zoom
        // also synthesize click events we just swallowed up
        $(this).trigger('click').trigger('click');
      });
  };
})(jQuery);
