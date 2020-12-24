<?php
$user_data = $this->session->userdata('userdata');
$this->load->view('includes/header', array('user_data' => $user_data));
?>
<style>
	html {
		scroll-behavior: smooth;
	}
</style>

<?php
$matchedPinCodeRow = array();

foreach ($deliverydetails as $charge) {
	if ($charge->pincode == $pinCode) {
		$matchedPinCodeRow = $charge;
		break;
	}
}


?>
<script>
	let prepareCartItemArr = '<?= (count($this->cart->contents())) ? json_encode(array_values($this->cart->contents())) : json_encode(array())?>';
	let restaurantPinCodes = '<?= (count($deliverydetails)) ? json_encode(array_values($deliverydetails)) : json_encode(array())?>';
	let currentPinCodeRow = '<?= $this->input->cookie('delivery_type', true) == "delivery" ? json_encode($matchedPinCodeRow) : json_encode([]) ?>';
	let restaurantStatus = 1;
	let errorMessageInCaseOfPinCode = '<?=$errorMessageInCaseOfPinCode?>';
</script>

<div class="main-container">
	<div class="container-fluid px-0">
		<div class="mx-0">
			<div class="pizza-column">
				<div class="hero"><img src="<?php echo LOGOPATH . $profile->banner; ?>" class="img-fluid"></div>
				<div class="contianer-pizza">
					<div class="img-center text-center">
						<span><img src="<?php echo LOGOPATH . $profile->logo; ?>" class="img-fluid"></span>
					</div>
					<div class="container pt-2">
						<div class="row">
							<div class="col-md-9">
								<div class="food-name">
									<h3><?php echo $profile->name; ?></h3>
									<div class="d-flex star-rating">
										<div class="review-stars notranslate">
											<span class="review-stars-range"></span>
										</div>
										<span class="green-text" data-toggle="modal" data-target="#info-modal">(3.8k Bewertungen)</span>
									</div>
									<p><?php
										if (strlen($profile->aboutus) > 54) {
											echo substr($profile->aboutus, 0, 54); ?>
											<span id="dots">...</span><span
													id="more"><?php echo substr($profile->aboutus, 55, strlen($profile->aboutus)); ?></span>


											<a onclick="myFunction()" id="myBtn" href="javascript:void(0);"
											   class="green-text">Weiterlesen</a> <?php
										} else {
											echo $profile->aboutus;
										} ?>
									</p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="icon-right">
									<span class="info" data-toggle="modal" data-target="#info-modal"></span><span
											class="heart"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="slide-content">
					<div class="search-left">
						<i class="fa fa-search search-icon"></i>
						<input class="search-cstm form-control" placeholder="Suche nach Gerichten, usw...">
						<i class="fa fa-times close resetSearch"></i>
					</div>
					<div class="slide-sec">
						<div class="owl-carousel owl-theme" id="slide-carousel">
							<?php if (!empty($categories)) {
								$catcount = 1;
								foreach ($categories as $catrow) {
									?>
									<div class="item <?php if ($catcount == 1) echo 'active'; ?>">
										<a href="#<?php echo $catrow->catslug; ?>"><?php echo $catrow->category; ?></a>
									</div>
									<?php $catcount++;
								}
							} ?>

						</div>
					</div>
				</div>
				<div class="menu-main">
					<div class="container-fluid">
						<br>
						<?php if (!empty($main_products)) {
						$catcountpro = 1;
						$collepcount = 1;
						$productPrice = 0;
						foreach ($main_products

						as $resultrow) {
						?>
						<div class="menu-post fadeInUp wow <?= ($profile->status == 1 && $restaurant_status == 1) ? 'available' : 'unavailable' ?>"
							 id="<?php echo $resultrow->catslug; ?>">
							<?php if (!empty($resultrow->cimage)) { ?>
								<div class="post-img">
									<img src="<?php echo CATEGORYPATH; ?><?php echo $resultrow->cimage; ?>"
										 class="img-fluid">
								</div>
							<?php } ?>
							<div class="post-des">
								<h4 data-ref="<?php echo $resultrow->catslug; ?>"
									class="<?= sizeof($resultrow->products) == 0 ? 'no_product_to_cart' : '' ?>"
									data-has-product="<?= sizeof($resultrow->products) ?>">
									<?php echo ucfirst($resultrow->category); ?>
								</h4>
								<p><?php echo ucfirst($resultrow->description); ?></p>
								<span><?php if (!empty($resultrow->note)) {
										echo '<i class="fas fa-shipping-fast"></i> ' . ucfirst($resultrow->note);
									} ?></span>
							</div>
						</div>
						<!--End of post-->
						<?php if (!empty($resultrow->products)) {

						foreach ($resultrow->products as $prodcutrow) {
						$canOrder = true;

						$productNameWithSku= ($prodcutrow->sku !="") ? $prodcutrow->sku.". " : "";
						$productNameWithSku.= $prodcutrow->name;

						if (trim($prodcutrow->start_time) != "" && trim($prodcutrow->end_time) != "") {
							$currentTime = date("h:i");
							$start_time = date("h:i", strtotime($prodcutrow->start_time));
							$end_time = date("h:i", strtotime($prodcutrow->end_time));
							if (strtotime($currentTime) > strtotime($start_time) && strtotime($currentTime) < strtotime($end_time)) {
								$canOrder = true;
							} else {
								$canOrder = false;
							}
						}

						?>
						<?php if ($profile->status == 1 && $restaurant_status == 1) {

							?>
						<div
								class="<?= $prodcutrow->type_id && $canOrder ? '  ' : ' addToCartSimpleProduct '; ?> <?= ($canOrder) ? 'can_order' : ' bg-light can_not_order' ?> meal-des fadeInDown wow d-flex my-2 p-3 border rounded  <?= ($profile->status == 1 && $restaurant_status == 1) ? 'available' : 'unavailable' ?> <?php echo "productContainer" . $prodcutrow->id;
								if (!$prodcutrow->type_id) echo " addToCartSimpleProduct "; else echo " showProductOnTop variantProduct productRow" . $prodcutrow->id; ?>" <?php if ($prodcutrow->type_id && $canOrder) { ?> data-toggle="collapse" data-target="#collapseMeal<?php echo $collepcount; ?>" aria-expanded="false" aria-controls="collapseMeal<?php echo $collepcount; ?>"<?php } else { ?> data-product-ref="<?= $prodcutrow->id ?>"
							data-product-name="<?=$productNameWithSku ?>"
							data-product-slugname="<?= $prodcutrow->slugname ?>"
							data-product-price="<?= $prodcutrow->price ?>" <?php } ?>
								data-ref="<?= $prodcutrow->id ?>">
							<?php } else { ?>

							<div
									class=" <?= ($canOrder) ? 'can_order' : 'can_not_order' ?> meal-des fadeInDown wow d-flex my-2 p-3 border rounded  <?= ($profile->status == 1 && $restaurant_status == 1) ? 'available' : 'unavailable' ?>"
									data-product-name="<?=$productNameWithSku ?>"
									data-product-slugname="<?= $prodcutrow->slugname ?>"
									data-product-price="<?= $prodcutrow->price ?>"
									data-ref="<?= $prodcutrow->id ?>">

								<?php } ?>
								<div class="inner-des">
									<p class="desc-heading "

									   data-product-count="<?= sizeof($resultrow->products) ?>"> <span
												class="product_name"
												data-parent="<?php echo $resultrow->catslug; ?>"
												date-ref="productContainer<?= $prodcutrow->id ?>">
													<?php
														if(!empty($prodcutrow->sku)) {
															echo $prodcutrow->sku.'. ';
														}
														echo $prodcutrow->name;
													?>
													</span>

										<?php
										$openDescriptionModal = "d-none";
										if (isset($prodcutrow->more_info) && trim($prodcutrow->more_info) !="" ) {
											$openDescriptionModal = "d-inline-block";
										}

										?>
										<a href="javascript:void(0)"
										   class="green-text  <?=$openDescriptionModal?>" title="Product Information"
										   data-ref="<?= $prodcutrow->id ?>" onclick="showProductDescription(<?= $prodcutrow->id ?>)"> <i class="fa fa-info-circle"></i></i></a>
									</p>

									<div class="meal-description" id="product_description_<?= $prodcutrow->id ?>">
										<?php
											$description = json_decode($prodcutrow->description);
											if (is_array($description) && sizeof($description)) {
												if(sizeof($description) == 1) {
													$descriptionString = "<p class='product_description'>$description[0]</p>";
												}else{
													$descriptionString = '<ul class="product-discription">';
													foreach ($description as $key => $value) {
														$descriptionString .= '<li>' . $value . '</li>';
													}
													$descriptionString .= '</ul>';
												}
												?>

												<div class="product_description hasJson"
													 data-description="<?php echo htmlspecialchars(($prodcutrow->description), ENT_QUOTES, 'UTF-8'); ?>"
														<?php if (isset($prodcutrow->more_info)) { ?> data-more_info="<?php echo htmlspecialchars(($prodcutrow->more_info), ENT_QUOTES, 'UTF-8'); ?>" <?php } else { ?> data-more_info="" <?php } ?>
												>
													<?php echo $descriptionString ?>
												</div>

											<?php } else { ?>
												<p data-description=""
														<?php if (isset($prodcutrow->more_info)) { ?> data-more_info="<?php echo htmlspecialchars(($prodcutrow->more_info), ENT_QUOTES, 'UTF-8'); ?>" <?php } else { ?> data-more_info="" <?php } ?>
												   class="product_description hasJson"><?= $prodcutrow->description ?></p>
											<?php }
										 ?>
										<p class="product_chosen_of"
										   id="chosen_of_product__<?= $prodcutrow->id ?>">
											<?= trim($prodcutrow->choice) != "" ? $prodcutrow->choice : ''; ?>

										</p>
										<span class="meal-price green-text product_price_<?php echo $prodcutrow->id ?>"
											  data-product-price="<?php echo $prodcutrow->price; ?>"><?php if ($prodcutrow->type_id == 1) echo ""; else echo formatPrice($prodcutrow->price) . "  €"; ?></span>
									</div>
								</div>
								<div class="right-add">
									<a href="javascript:void(0)" <?php if (!$prodcutrow->type_id) { ?>

										data-product-ref="<?= $prodcutrow->id ?>"
										data-product-name="<?=$productNameWithSku ?>"
										data-product-price="<?= $prodcutrow->price ?>"
										<?php $productPrice += $prodcutrow->price;
									} ?> ><i
												class="fa fa-plus"></i></a>
								</div>
							</div>
							<?php if ($prodcutrow->type_id) { ?>
								<div class="meal meal__bottom-wrapper collapse"
									 id="collapseMeal<?php echo $collepcount; ?>">

									<div class="sidedishes" id="productVariantContainer<?php echo $prodcutrow->id ?>"
										 data-target="<?php echo $prodcutrow->id ?>"
										 data-product-ref="<?php echo $prodcutrow->id ?>"
										 data-product-name="<?=$productNameWithSku ?>"
										 data-product-slugname="<?php echo $prodcutrow->slugname; ?>"
										 data-product-price="<?php echo $prodcutrow->price ?>">
										<?php if (!empty($prodcutrow->product_variants)) {
											$chosenOf = '';
											foreach ($prodcutrow->product_variants as $provariants) {
												?>
												<div class="provariants">
													<?php if ($provariants->type == 1) { ?>
														<div class="header">
															<h3><?php echo $provariants->label; ?>:</h3>
														</div>
														<div class="form-group cstm-select">
															<?php $subToppings = '';
															?>
															<select
																	class="form-control varaintcallSub select_variant_type">
																<?php if (!empty($provariants->product_variant_maps)) {
																	$countmaps = 1;

																	foreach ($provariants->product_variant_maps as $kyyyy => $provariantMap) {

																		$chosenOf .= strip_tags($provariantMap->name . ', ');
																		if($kyyyy == 0){

																			$firstVariant = [
																				"name" => $provariantMap->name,
																				"info" =>  htmlspecialchars(($provariantMap->info), ENT_QUOTES, 'UTF-8'),
																				"ref" =>	$provariantMap->id
																			];
																		}

																		if (strlen($chosenOf) > 100) {
																			// truncate string
																			$chosenOfCut = substr($chosenOf, 0, 100);
																			$endPoint = strrpos($chosenOfCut, ' ');

																			//if the string doesn't contain any space then it will cut without word basis.
																			$chosenOf = $endPoint ? substr($chosenOfCut, 0, $endPoint) : substr($chosenOfCut, 0);
																			$chosenOf .= ' and more...';
																		}


																		?>
																		<option class="<?= $provariantMap->name ?>"
																				value="<?php echo $provariantMap->id; ?>"
																				data-label="<?php echo $provariants->id; ?>"
																				<?php if (isset($provariantMap->info)) { ?> data-more_info="<?php echo htmlspecialchars(($provariantMap->info), ENT_QUOTES, 'UTF-8'); ?>" <?php } else { ?> data-more_info="" <?php } ?>
																				data-product-ref="<?php echo $prodcutrow->id; ?>"
																				data-variant-price="<?php echo $provariantMap->price; ?>"
																				data-variant-name="<?php echo $provariantMap->name; ?>">
																			<?php echo $provariantMap->name;
																			if (!empty($provariantMap->price) && $provariantMap->price != '0.00' && $provariantMap->price != '0') {
																				echo ' (+' . formatPrice($provariantMap->price) . ' €)';
																			} ?></option>
																		<?php
																		if (!empty($provariantMap->variantMap)) {
																			$countsubcheck = 1;
																			$checkCount = '';
																			foreach ($provariantMap->variantMap as $kkkkey => $rowsubtoppings) {
																				$stringsubtop = '';
																				if ($countmaps != 1) {
																					$stringsubtop = 'style="display:none;"';
																				}
																				if ($countsubcheck == 1) {
																					$subToppings .= '<div class="meal-description subtoppingslabel' . $provariants->id . '"  id="subTopid' . $provariantMap->id . '" ' . $stringsubtop . '><h2>Extras:</h2><div class="meal-check"> ';
																				}

																				$checkCount = ($kkkkey > 2) ? "canHideShow d-none" : '';

																				$subToppings .= '<div class="custom-control custom-checkbox my-2 ' . $checkCount . '">
                                          <input type="checkbox" class="custom-control-input cart_variants_add_on "
                                          													id="subtoppings' . $rowsubtoppings->id . $prodcutrow->id . '"
                                          													data-ref="' . $rowsubtoppings->id . '"
                                          													data-type="variantMap"
                                          													data-kkkkey="' . $kkkkey . '"
																						   data-price="' . $rowsubtoppings->price . '"
																						   data-name="' . $rowsubtoppings->name . '"
																						   >
                                          <label class="custom-control-label" for="subtoppings' . $rowsubtoppings->id . $prodcutrow->id . '"> ' . $rowsubtoppings->name;
																				if (!empty($rowsubtoppings->price) && $rowsubtoppings->price != '0.00' && $rowsubtoppings->price != '0') {
																					$subToppings .= ' (+ €' . formatPrice($rowsubtoppings->price) . ')';
																				}
																				$rowsubtoppings_dnone = "";
																				if(trim($rowsubtoppings->info) == '' ) $rowsubtoppings_dnone = 'd-none';
																				$subToppings .= '</label>
																				<a href="javascript:void(0)" class="pull-right  more-info_product '.$rowsubtoppings_dnone.' "

																				data-more_info="'.htmlspecialchars(($rowsubtoppings->info), ENT_QUOTES, 'UTF-8').'"
																			   data-ref="' . $prodcutrow->id . '"><i class="green-text fa fa-info-circle"></i></a></div>';
																				$countsubcheck++;

																				if ($kkkkey == sizeof($provariantMap->variantMap) - 1 && trim($checkCount) != '') {
																					$subToppings .= '<div class="custom-checkbox my-2"><a class="see-more-options" href="javascript:void(0)" data-result-count="' . ($kkkkey - 2) . '"><i class="fa fa-chevron-down"></i>  Show ' . ($kkkkey - 2) . ' more</a></div>';
																				}
																			}
																			$subToppings .= '</div></div>';
																		}

																		$countmaps++;
																	}
																} ?>
															</select>
															<p class="mb-0 ml-0">
															<span class="currentVariant currentVariant_<?=$firstVariant['ref']?>" data-target=".currentVariant_<?=$firstVariant['ref']?>"><?=$firstVariant['name']?></span>
																<a data-more_info="<?=$firstVariant['info']?>"
																href="javascript:void(0);"
																class="more-info_product <?php if(trim($firstVariant['info']) == '' ) echo 'd-none';?> ">
																<i class="green-text fa fa-info-circle"></i>
																</a>
															</p>

														</div>

														<?php
														if (!empty($subToppings)) {
															echo $subToppings;
														}

													} else { ?>
														<div class="meal-description">
															<h2><?php echo $provariants->label; ?>:</h2>
															<div class="meal-check">
																<?php if (!empty($provariants->product_topping_maps)) {
																	foreach ($provariants->product_topping_maps as $iii => $protoppingsMap) {

																		$checkCount = $iii > 2 ? 'canHideShow d-none' : ''
																		?>
																		<div
																				class="custom-control custom-checkbox my-2 <?= $checkCount ?>">
																			<input type="checkbox"
																				   class="custom-control-input cart_variants_add_on"
																				   data-type="product_topping_maps"
																				   data-ref="<?php echo $protoppingsMap->id; ?>"
																				   data-price="<?php echo $protoppingsMap->price; ?>"
																				   data-name="<?php echo $protoppingsMap->name; ?>"
																				   id="variants_<?php echo $protoppingsMap->id . $prodcutrow->id ?>">
																			<label class="custom-control-label"
																				   for="variants_<?php echo $protoppingsMap->id . $prodcutrow->id ?>"><?php echo $protoppingsMap->name;
																				if (!empty($protoppingsMap->price) && $protoppingsMap->price != '0.00' && $protoppingsMap->price != '0') {
																					echo ' (+ €' . formatPrice($protoppingsMap->price) . ')';
																				} ?> </label>
																			<a href="javascript:void(0)"
																			   class="pull-right more-info_product <?php if(trim($protoppingsMap->info) == '' ) echo 'd-none';?>"
																			   data-more_info="<?=htmlspecialchars(($protoppingsMap->info), ENT_QUOTES, 'UTF-8')?>"
																			   data-ref="<?= $prodcutrow->id ?>"><i class="green-text fa fa-info-circle"></i></a>
																		</div>
																		<?php if ($iii == sizeof($provariants->product_topping_maps) - 1 && trim($checkCount) != '') {
																			echo '<div class="custom-checkbox my-2"><a class="see-more-options" href="javascript:void(0)" data-result-count="' . ($iii - 2) . '"> <i class="fas fa-chevron-up"></i> Show ' . ($iii - 2) . ' more</a></div>';
																		}
																	}
																} ?>


															</div>


														</div>
													<?php } ?>

												</div>
											<?php }
											if (isset($chosenOf))
												echo '<p class="chosen_of_text d-none" data-target="#chosen_of_product' . $prodcutrow->id . '">' . rtrim($chosenOf, ',') . '</p>';
										} ?>
										<div class="meal-description">
											<div class="container-fluid p-0">
												<div class="row">
													<div class="col-md-3">
														<div class="mb-2">
															<div class="input-group d-flex">
																<div class="input-group-btn">
																	<button id="down"
																			class="btn btn-default manageCartQty"
																			data-ref="down"
																			data-perform="1"
																	><span class="fa fa-minus"></span>
																	</button>
																</div>
																<input type="text"
																	   class="form-control manageCartQtyInput input-number"
																	   value="1"/>
																<div class="input-group-btn">
																	<button id="up"
																			class="btn btn-default manageCartQty"
																			data-ref="up"
																			data-perform="10"
																	><span class="fa fa-plus"></span>
																	</button>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-9">
														<button type="submit"
																class="btn btn-primary add_to_cart_button"
																data-product-ref="<?= $prodcutrow->id ?>"
																data-cart-item-price="<?= $prodcutrow->price ?>">
															<?php echo ($productPrice > 0) ? formatPrice($productPrice) : formatPrice($prodcutrow->price); ?>
															€
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php }
							$collepcount++;
							}
							} ?>
							<!--div class=" meal-des fadeInDown wow d-flex my-2 p-3 border rounded">
							   <div class="inner-des">
								  <p class="desc-heading">Mittags-Angebot - Indisch Lamb <a href="javascript:void(0);" class="green-text">Produktinfo</a></p>
								  <div class=" meal-description">
									 <p>Wahl aus: Calzone, Istanbul Pizza, Pizza ''UNO'', Pizza Americana, Pizza Hackfleisch-Bohnen (scharf) und mehr.</p>
									 <span class="meal-price green-text">9,90 €</span>
								  </div>
							   </div>
							   <div class="right-add">
								  <a href="javascript:void(0);"><i class="fa fa-plus"></i></a>
							   </div>
							</div-->
							<?php $catcountpro++;
							}
							} ?>
						</div>
					</div>
					<div class="menu-foot mt-3">
						<div class="container-fluid">
							<div class="content-foot">
								<h2 class="menucard-imprint__heading">Impressum</h2>
								<div class="info-tab-section menucard-imprint__section">
									<?php echo $profile->cname; ?>
									<br>
									<?php echo $profile->address; ?>
									<div>
										<br>
										E-Mail: <?php echo $profile->email; ?>
									</div>
									<div>
										Fax: <?php echo $profile->fax; ?>
									</div>
									<br>

									<?php if(!empty($profile->vat_no)) { ?>
										<div>
											VAT Number <?php echo $profile->vat_no; ?>
										</div>
									<?php } ?>
								
									<div class="menucard-resolution-url">
										<a href="javascript:void(0);" class="menucard-imprint" target="_blank">Plattform
											der
											EU-Kommission zur Online-Streitbeilegung</a>
									</div>
								</div>
							</div>
						</div>
					</div>
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
														<span class="cart-meal-name notranslate"><?= $item['name'] ?></span>

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
							<a href="javascript:void(0)" class="nav-link text-center"> <b>Add more items</b> </a>
						</div>

						<button data-target-url="<?php echo site_url($profile->slugname . '/place-order') ?>"
								href="<?php echo site_url($profile->slugname . '/place-order') ?>"
								class="basket__order-button btn-primary cartbutton-button cartButtonSubmit">
							Bestellen
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="productOverviewModal" role="dialog">
		<div class="modal-dialog modal-md  modal-dialog-centered">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Weitere Produktinformationen</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<h5>Allergene</h5>
					<div class="product_description my-4">

					</div>
					<p style="margin-top: 24px;font-size: 12px;color: #666;">Wir halten Dich stets zu relevanten Informationen über Essen auf dem Laufenden, die wir von Restaurant bezüglich ihrer Speisekarten erhalten. Es kann jedoch vorkommen, dass die angezeigten Informationen unvollständig sind bzw. automatisch generiert und/oder von den Restaurants noch nicht auf Korrektheit überprüft wurden. Bitte wende Dich an unsere Kundenservice, wenn Allergien oder Intoleranzen vorliegen oder Du Fragen zu bestimmten Speisen auf der Karte hast.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

	<?php $this->load->view('includes/footer', array('subtotal' => $subtotal, 'cartCount' => $cartCount, "pinCode" => $pinCode, 'pincodes' => $pincodes, 'user_data' => $user_data, 'profile' => $profile)); ?>
	<script>
		$(window).scroll(function() {
			if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
				if(!$('.cart-basket').hasClass('shop-with-footer')) {
					$('.cart-basket').addClass('shop-with-footer');
				}
				return false;
			} else {
				$('.cart-basket').removeClass('shop-with-footer');
				return false;
			}
		});

		$(document).ready(function () {
			if ($(".varaintcallSub").length) {
				$('.varaintcallSub').on('change', function (e) {
					var optionSelected = $("option:selected", this);
					var valueSelected = this.value;
					var labelSelected = optionSelected.attr('data-label');
					$('.subtoppingslabel' + labelSelected).hide();

					$('#subTopid' + valueSelected).show();
				});
			}
		});

	</script>

	<script>
		function myFunction() {
			var dots = document.getElementById("dots");
			var moreText = document.getElementById("more");
			var btnText = document.getElementById("myBtn");

			if (dots.style.display === "none") {
				dots.style.display = "inline";
				btnText.innerHTML = "Weiterlesen";
				moreText.style.display = "none";
			} else {
				dots.style.display = "none";
				btnText.innerHTML = "Weniger anzeigen";
				moreText.style.display = "inline";
			}
		}
	</script>
	<?php if ($this->session->flashdata('pin_code_not_found')) { ?>
		<script type="text/javascript">
			swal({title: "Error",text: '<?php echo $this->session->flashdata('pin_code_not_found');?>',icon: "error",buttons: false,timer: 3000});
		</script>
	<?php } ?>
