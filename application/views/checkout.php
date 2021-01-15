<?php
$user_data = $this->session->userdata('userdata');
$this->load->view('includes/header', array('user_data' => $user_data));
$delivery_type = "self";
if($this->input->cookie('delivery_type', true) != "")
	$delivery_type = $this->input->cookie('delivery_type', true);


?>
<script>
	let prepareCartItemArr = '<?= (count($this->cart->contents())) ? json_encode(array_values($this->cart->contents())) : json_encode(array())?>';
	let restaurantPinCodes = '<?= json_encode(array())?>';
	let currentPinCodeRow = '<?= $this->input->cookie('delivery_type', true) == "delivery" ? json_encode($matchedPinCodeRow) : json_encode([]) ?>';
	let restaurantStatus = 1;
	let errorMessageInCaseOfPinCode = '';
	let updateCart = true;
</script>
<style>
	.has-error .form-control {
		border-color: #f25961 !important;
		color: #f25961 !important;
	}

	label.error {
		color: #f25961 !important;
		font-size: 80% !important;
		margin-top: .5rem;
	}
</style>
<div class="main-container payment-div">
	<div class="container-fluid px-0">
		<div class="row mx-0">

			<div class="col-xl-9 col-md-8 px-0 pizza-column">
				<form action="<?= site_url('checkout') ?>" method="post" id="checkout-form">
					<div class="banner-pay-sec">
						<img src="<?php echo LOGOPATH . $profile->banner; ?>" class="img-fluid">
					</div>
					<div class="shoping-cart-banner">
						<button type="button" class="btn btn-primary open_cartModal d-block">
							<span class="noti fa fa-shopping-bag">
							 <em id="mobileCartItemsCount"><?= count($this->cart->contents()); ?>></em></span>
							Shopping cart (<span id="mobileCartPrice"> 0,0</span> €)
						</button>
					</div>

                    <?php
						$name = $telefonnummer = $email = $firmename = $address = $pincode = $floor = $city = '';
						$pincode = $this->input->cookie('pincode', true);
						if(isset($this->session->userdata('userdata')['user']->userId)) {
							$name = $this->session->userdata('userdata')['user']->name;
							$email = $this->session->userdata('userdata')['user']->email;
							if(isset($this->session->userdata('userdata')['user']->mobile)) {
								$telefonnummer = $this->session->userdata('userdata')['user']->mobile;
							}
							$addressObj = getAddressByUserId(array('user_id' => $this->session->userdata('userdata')['user']->userId));
							if($addressObj->error == 202) {
								$address = $addressObj->data->address;
								$pincode = $addressObj->data->pincode;
								$floor = $addressObj->data->floor;
								$city = $addressObj->data->city;
							}
						}
					?>

					<div class="container-fluid">
						<div class="payment-head mt-3">
							<h2>Auf geht's!</h2>
							<h4><?= @$profile->name ?></h4>

						</div>
						<div class="mt-3 payment-head">
							<p>Wie können wir Dich erreichen?</p>

							<div class="alert alert-warning my-2 no_items_found_on_checkout <?php if(!$no_cart_item) { ?> d-none <?php } ?>" role="alert">
						  	Es befindet sich kein Produkt im Warenkorb. Klicke <a style="color:#007bff" href="<?=site_url().$this->input->cookie('currentRestaurant', TRUE)?>">hier</a> um zurück zur Menükarte des Restaurants zu gelangen, sodass Du Produkte zu Deinem Warenkorb hinzufügen kannst.
							</div>

							<div class="alert alert-warning my-2 no_items_found_on_checkout <?php if(count($profile->paymode) > 0) { ?> d-none <?php } ?>" role="alert">
						  	Zahlungsmethode nicht vom Restaurant zur Verfügung gestellt bitte nach einiger Zeit
							</div>

							<hr>
							<div class="row">
								<div class="col-md-12 col-xl-6">
									<div class="form-group mendatory">
										<label>Name</label>
										<input type="text" name="order_user_details[full_name]" placeholder=""
											   class="form-control" value="<?=$name?>">
									</div>
									<div class="form-group mendatory">
										<label>Telefonnummer</label>
										<input type="text" name="order_user_details[phone]" placeholder=""
											   class="form-control" value="<?=$telefonnummer?>">
									</div>
								</div>
								<div class="col-md-12 col-xl-6">
									<div class="form-group mendatory">
										<label>Email</label>
										<input type="email" name="order_user_details[email]" placeholder=""
											   class="form-control" value="<?=$email?>">
									</div>
									<div class="form-group">
										<label>Firmename</label>
										<input type="text" name="order_user_details[company_name]" placeholder=""
											   class="form-control">
									</div>
								</div>
							</div>
						</div>

						<?php if($this->input->cookie('delivery_type', true) !="self") { ?>
							<p>Wohin soll Deine Bestellung geliefert werden?</p>
							<hr>
							<div class="row">
							<div class="col-md-12 col-xl-6">
								<div class="form-group mendatory">
									<label>Adresse</label>
									<input type="text" name="order_user_details[address]" placeholder=""
											 class="form-control" value="<?=$address?>">
								</div>
								<div class="form-group">
									<label>Etage</label>
									<input type="text" name="order_user_details[floor]" placeholder=""
											 class="form-control" value="<?=$floor?>">
								</div>
							</div>
							<div class="col-md-12 col-xl-6">
								<div class="row">
									<div class="col-md-12 col-xl-6">
										<div class="form-group mendatory">
											<label>Postleitzahl</label>
											<input type="text" name="order_user_details[pincode]" placeholder=""
													 class="form-control"
													 readonly
													 value="<?=$pincode?>"
											>
											<a class="pull-right" href="#" data-toggle="modal"
												 data-backdrop="static" data-keyboard="false"
												 data-target="#search-pop-header"> <u><small>Veränderung Postleitzahl</small></u>  </a>
										</div>
									</div>
									<div class="col-md-12 col-xl-6">
										<div class="form-group mendatory">
											<label>Stadt</label>
											<input type="text" name="order_user_details[city]" placeholder=""
													 class="form-control" value="<?=$city?>">
										</div>
									</div>

									<div class="col-12">
										<div class="form-group">
											<label>Anmerkungen für das Restaurant</label>
											<textarea class="form-control" name="order[order_note]" rows="4"
													  cols="100"></textarea>
											<div class="payment-check">
												<div class="custom-control custom-checkbox mt-3">
													<input type="checkbox" name="order[order_note_is_for_next_order]"
														   class="custom-control-input" id="remember">
													<label class="custom-control-label" for="remember">
														<!--Diese Bemerkung für die nächste Be-->
														Diese Bestellung für die nächste Bestellung speichern
													</label>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<?php }?>
						<div class="mt-3 payment-head">
							<!-- <p>Wann möchtest Du Deine Bestellung erhalten?</p> -->
							<!-- <hr> -->
							<div class="row">
								<div class="col-md-12 col-xl-6 d-none">
									<div class="form-group">
										<label>Gewünschte Lieferzeit <i style="font-size: 10px;color: #bebebe;" class="fa fa-asterisk" aria-hidden="true"></i></label>
										<div class="cstm-select">
											<select class="form-control" name="order[desired_delivery_time]">
												<!-- <option value="" selected>Lieferzeitpunkt wählen </option> -->
												<?php
												if(sizeof($profile->time_slots) > 0)
												//	echo '<option value="So schnell wie möglich">So schnell wie möglich</option>';
												foreach ($profile->time_slots as $slot) { ?>
													<option value="<?= $slot ?>"><?= $slot ?></option>
												<?php } ?>
											</select>
										</div>
									</div>

								</div>

									<input type="hidden" name="order[order_pick_up]" value="<?=$this->input->cookie('delivery_type', true)?>">
									<input type="hidden" name="order[desired_delivery_time]" value="ASAP">

								<!-- <div class="col-md-12 col-xl-6">
									<div class="form-group">
										<label>Anmerkungen für das Restaurant</label>
										<textarea class="form-control" name="order[order_note]" rows="4"
												  cols="100"></textarea>
										<div class="payment-check">
											<div class="custom-control custom-checkbox mt-3">
												<input type="checkbox" name="order[order_note_is_for_next_order]"
													   class="custom-control-input" id="remember">
												<label class="custom-control-label" for="remember">
													<!--Diese Bemerkung für die nächste Be--
													Diese Bestellung für die nächste Bestellung speichern
												</label>
											</div>
										</div>
									</div>
								</div> -->
							</div>
						</div>
						<div class="mt-3 payment-head">
							<p>Wie möchtest Du bezahlen?</p>
							<hr>
							<div class="payment-way info-tab-section">
								<div class="info-pay-card-list">

									<?php
										$default = "Cash";
										$default_mode = "live";
										foreach ($profile->paymode as $key => $mode): ?>
										<?php if($key == 0 ) {
											$default = $mode->name;
											$default_mode = strtolower($mode->mode);
										} ?>
										<div class="info-pay-card text-center <?=$key ==0 ?'active' :''?>" data-ref="<?=$mode->name?>">
											<img src="<?php echo base_url(); ?>assets/images/<?=$mode->icon?>"
												 class="embedleft" alt="<?=$mode->name?>" title="<?=$mode->name?>">
											<span><?=$mode->name?></span>
											<input type="hidden" name="<?=strtolower($mode->name)?>[parnterid]" value="<?=strtolower($mode->parnterid)?>">
											<input type="hidden" class="gateway_mode" name="<?=strtolower($mode->name)?>[mode]" value="<?=strtolower($mode->mode)?>">
										</div>


									<?php endforeach; ?>

									<input type="hidden" class="payment_mode" name="order[payment_mode]" value="<?=$default?>">
									<input type="hidden" class="order_gateway_mode" name="order[gateway_mode]" value="<?=$default_mode?>">

									<input type="hidden" name="order[delivery_charge]"
										   value="<?= @$matchedPinCodeRow->deliverycharges ? @$matchedPinCodeRow->deliverycharges : 0.00  ?>">
									<input type="hidden" name="order[restaurant_id]" value="<?= @$profile->userId ?>">
									<!--								<div class="info-pay-card text-center">-->
									<!--									<img src="images/payment_15.png" class="embedleft" alt="Klarna" title="Klarna">-->
									<!--									<span>Klarna</span>-->
									<!--								</div>-->
									<!--								<div class="info-pay-card text-center">-->
									<!--									<img src="images/payment_21.png" class="embedleft" alt="GiroPay" title="GiroPay">-->
									<!--									<span>GiroPay</span>-->
									<!--								</div>-->
									<!--								<div class="info-pay-card text-center">-->
									<!--									<img src="images/payment_61.png" class="embedleft" alt="Visa" title="Visa">-->
									<!--									<span>Visa</span>-->
									<!--								</div>-->
									<!--								<div class="info-pay-card text-center">-->
									<!--									<img src="images/payment_62.png" class="embedleft" alt="Mastercard"-->
									<!--										 title="Mastercard">-->
									<!--									<span>Mastercard</span>-->
									<!--								</div>-->
									<!--								<div class="info-pay-card text-center">-->
									<!--									<img src="images/payment_63.png" class="embedleft" alt="American Express"-->
									<!--										 title="American Express">-->
									<!--									<span>American Express</span>-->
									<!--								</div>-->
									<!--								<div class="info-pay-card text-center">-->
									<!--									<img src="images/payment_18.png" class="embedleft" alt="PayPal" title="PayPal">-->
									<!--									<span>PayPal</span>-->
									<!--								</div>-->
									<!--								<div class="info-pay-card text-center">-->
									<!--									<img src="images/payment_24.png" class="embedleft" alt="Bitcoin" title="Bitcoin">-->
									<!--									<span>Bitcoin</span>-->
									<!--								</div>-->

								</div>
							</div>
							<!--							<div class="row">-->
							<!--								<div class="col-md-4 col-sm-12 col-xl-3">-->
							<!--									<div class="form-group">-->
							<!--										<label>You pay(with):</label>-->
							<!--										<div class="cstm-select">-->
							<!--											<select class="form-control">-->
							<!--												<option selected>Matching: 19.50$</option>-->
							<!--												<option>By today</option>-->
							<!--											</select>-->
							<!--										</div>-->
							<!--									</div>-->
							<!--								</div>-->
							<!--							</div>-->
						</div>
						<div class="my-5 payment-head">
							<!-- <p>Gutschein</p> -->
							<hr>
							<div class="row">
								<!-- <div class="col-xl-6 col-md-12">
									<div class="mb-2 vou-select">
										<a href="javascript:void(0);" data-toggle="collapse" data-target="#voucher"
										   class="d-block">Hast du einen Gutschein?</a>
									</div>
									<div class="collapse" id="voucher">
										<div class="d-flex mb-3 justify-content-between">
											<div class="form-group mb-0">
												<input class="form-control" type="text" placeholder="Gutscheincode">
											</div>
											<button class="voucher-add-check btn btn-primary">Hinzufügen</button>
										</div>
									</div>
								</div> -->
								<div class="col-md-12">
									<!-- <p class="msg-review">Nachdem Sie eine Bestellung aufgegeben haben, erhalten Sie eine Bestellbestätigung, eine Statusmeldung vom Food Tracker und einen Bewertungslink auf andere Weise (z. B. Push-Nachrichten).</p>
									<div class="payment-check">
										<div class="custom-control custom-checkbox mt-3">
											<input type="checkbox" name="offers_enabled" class="custom-control-input"
												   id="discount-check">
											<label class="custom-control-label" for="discount-check">Um Rabatte, Treueangebote oder andere Updates zu erhalten, klicken Sie bitte auf das Kontrollkästchen.</label>
										</div>
									</div> -->
									<div class="note-war my-4">
										<span>Für kontaktlose Lieferung: Bitte wählen Sie eine Online-Zahlungsmethode</span>
									</div>
									<div class="btn-sec">
										<button <?php if($no_cart_item || count($profile->paymode) == 0 ) echo "disabled";?> type="submit" class="checkoutFormSubmit btn btn-primary">
											Zahlungspflichtig bestellen
										</button>
									</div>
									<p class="conditions"><!--Durch Klicken auf Jetzt bestellen bestätigen Sie den Warenkorb und die
Daten, die Sie eingegeben haben und mit unseren einverstanden sind
										<a href="javascript:void();">Datenschutzbestimmungen</a> und
										<a href="javascript:void();">Begriffe </a> und
										<a href="javascript:void();">Bedingungen</a>-->
										Durch Anklicken von Zahlungspflichtig bestellen bestätigst Du den Warenkorb und Deine eingegebenen Daten und stimmst unseren 
										<a href="javascript:void();">Datenschutzbestimmungen</a> sowie <a href="javascript:void();">AGB</a> zu.
									</p>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="cart-basket">
				<div class="basket-container js-basket-container <?php if(trim($this->input->cookie('delivery_type', true))!="self"){ echo "customclassbasket";}?>" id="ibasket">
					<div class="cartHeaderContainer basket-button basket-button--secondary">
						<p class="basket-button__label">
							<span class="basket-button__label-title">Warenkorb</span>
							<span class="text-right cart_mobile_icon d-none"
									style="margin-left: 32%;position: absolute;">
								<i class="fa fa-minus"></i>
							</span>
						</p>
					</div>
					<div class="basket basket-container__scroller">
						<div class="basket__content js-basket-container__scroller">
							<div id="empty"
								 class="basket-empty <?php if (count($this->cart->contents())) { ?> d-none <?php } ?>">
								<i class="fas fa-shopping-bag"></i>
								<span class="basket-empty__text">Wähle leckere Gerichte aus der Karte und bestelle Dein Menü.</span>
							</div>
							<div class="cart-item border-top" id="cartItems">

								<div id="items">
									<div class="cart_item_box">
										<?php
										$subtotal = 0;
										$cartCount = 0;
										foreach ($this->cart->contents() as $item): ?>
											<div id="cartItem<?= $item['id'] ?>">
												<?php $subtotal += $item['subtotal'];
												++$cartCount; ?>
												<div class="add-meal">
											<span class="cart-meal-amount notranslate"
													id="cartItemQty<?= $item['id'] ?>"><?= $item['qty'] ?>x</span>
													<span class="cart-meal-name notranslate">
														<?php if(trim($item['options']['product']->sku) !="") {?>
															<span class="product_sku"><?= $item['options']['product']->sku; ?></span>
														<?php } ?>

														<?= $item['name'] ?>
													</span>

													<div class="cart-meal-edit-buttons">
														<button type="button"
																class="cart-meal-edit-delete updateCartQty"
																data-ref="<?= $item['id'] ?>" data-type="down"><i
																	class="fa fa-minus"></i></button>
														<button type="button" class="cart-meal-edit-add updateCartQty"
																data-ref="<?= $item['id'] ?>" data-type="up"><i
																	class="fa fa-plus"></i></button>
														<button type="button"
																class="cart-meal-edit-comment editCartItemNote"
																data-ref="<?= $item['id'] ?>"><i
																	class="fas fa-pencil-alt"></i>
														</button>
														<span id="cartItemPrice<?= $item['id'] ?>"
																class="cart-meal-price notranslate"><?= formatPrice($item['subtotal']) ?> €</span>
														<button type="button" class="cart-meal-delete removeCartItem"
																data-cart-ref="<?= $item['id'] ?>">
															<i class="fas fa-trash-alt"></i></button>
													</div>
												</div>

												<div class="textarea<?= $item['id'] ?> d-none">
													<div class="form-group mb-0">
													<textarea class="form-control"
																placeholder="Write item notes..."><?= $item['options']['product']->note; ?></textarea>
													</div>

													<?php
													if( strlen(trim( $item['options']['product']->note)) == 0){
														$save = "Hinzufügen";
														$cancel = "Abbrechen";
													}else{
														$save = "Bearbeiten";
														$cancel = "Löschen";
													}
													?>
													<div class="SaveCancelNote">
														<a href="javascript:void(0)"
															 style="float: right;color: #1474f5;"
															 data-type="<?=$save ?>"
															 data-ref="<?=$item['id'] ?>"
															 class="saveCartNote"><?=$save ?>
														 </a>
														 <a href="javascript:void(0)"
															 style="float: right;color: #333;"
															 data-type="<?=$cancel ?>"
															 data-ref="<?=$item['id'] ?>"
															 class="cancel_note"><?=$cancel ?>
														 </a>
													</div>
												</div>
												<small class="subAddOns"><?= $item['options']['product']->addOnsString ?></small>
												<span class="note_box font-italic d-flex cart-meal-name notranslate item_note<?= $item['id'] ?>"><?= substrwords($item['options']['product']->note, 50); ?></span>
											</div>
										<?php endforeach; ?>
									</div>


								</div>

								<div class="cart-sum border-top">
									<div class="d-flex cart-data pt-3">
										<span class="pr-name">Zwischensumme</span>
										<span class="cart-price"
												id="subTotal"><?= formatPrice($subtotal) ?> €</span>
									</div>
									<div
											class=" cart-data delivery_costs_container pt-3 <?php if (count($this->cart->contents())) { ?> d-flex <?php } else echo 'd-none'; ?>">
										<span class="pr-name">Lieferkosten</span>
										<?php
										$total = $subtotal;
										if (isset($matchedPinCodeRow->deliverycharges) && count($this->cart->contents())) {
											$total += $matchedPinCodeRow->deliverycharges;
											?>
											<span class="cart-price"
													id="deliveryCosts"> <?= formatPrice($matchedPinCodeRow->deliverycharges) ?> €</span>
										<?php } else {
											?>
											<span class="cart-price" id="deliveryCosts"> Gratis</span>
										<?php }
										?>

									</div>
									<div class="d-flex cart-data total-sum pt-2">
										<span class="pr-name">Gesamt</span>
										<span class="cart-price"
												id="totalPrice"><?= formatPrice($total) ?> €</span>
									</div>
									<?php
									if(isset($matchedPinCodeRow->minimum_amount)) {
									?>
									<div
											class=" cart-data total-sum pt-2 minimum_cart_amount_container <?= (isset($matchedPinCodeRow->minimum_amount) && $matchedPinCodeRow->minimum_amount > $subtotal && count($this->cart->contents())) ? 'd-flex' : 'd-none' ?>"
											style="color: #380">
										<span class="pr-name">Benötigter Betrag, um den Mindestbestellwert zu erreichen.</span>
										<span
												class="cart-price minimum_cart_amount"
												data-minimum-cart-amount="<?= $matchedPinCodeRow->minimum_amount ?>"><?= formatPrice(isset($matchedPinCodeRow->minimum_amount) ? $matchedPinCodeRow->minimum_amount - $subtotal : 0) ?> €</span>
									</div>
								</div>

								<div class="orderamount no_items_in_cart <?php if ((isset($matchedPinCodeRow->minimum_amount) && $matchedPinCodeRow->minimum_amount > $subtotal)) { ?>  <?php } else echo 'd-none'; ?>">
									Leider kannst Du noch nicht bestellen. <?php echo $profile->name; ?> liefert erst ab einem Mindestbestellwert von <?= formatPrice(isset($matchedPinCodeRow->minimum_amount) ? $matchedPinCodeRow->minimum_amount : 0) ?>
									€ (exkl. Lieferkosten).
								</div>

								<div
										class="orderamount <?= (isset($matchedPinCodeRow->minimum_amount) && $matchedPinCodeRow->minimum_amount < $subtotal) ? '' : 'd-none' ?>  valid_cart_minimum_order"
										style="color: #380">
									Du hast den Mindestbestellwert von <span
										class="amount minimum_cart_amount"> <?= formatPrice(isset($matchedPinCodeRow->minimum_amount) ? $matchedPinCodeRow->minimum_amount : 0) ?> €</span>
								erreicht und kannst jetzt fortfahren
								</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>

					<div class="add_more_item_mobile d-none ">
						<a href="<?= site_url() . $profile->slugname ?>" class="nav-link text-center"> <b>Weitre Produkte hinzufügen</b> </a>
					</div>

					<!--					<button data-target-url="-->
					<?php //echo site_url($profile->slugname . '/place-order') ?><!--"-->
					<!--							href="-->
					<?php //echo site_url($profile->slugname . '/place-order') ?><!--"-->
					<!--							class="basket__order-button btn-primary cartbutton-button cartButtonSubmit">-->
					<!--						To order-->
					<!--					</button>-->
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('includes/footer', array(
	'subtotal' => $subtotal,
	'cartCount' => $cartCount,
	'delivery_type' => $delivery_type,
	'pincodes' => $pincodes,
	'user_data' => $user_data)); ?>
<script>
	$(document).find('#responsive-cart-items').hide();
</script>
