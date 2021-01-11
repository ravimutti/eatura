<footer class="footer">
	<button id="myBtntoptobottom" title="Go to top"><i class="fa fa-angle-up"></i></button>
	<?php if (isset($profile)) { ?>
		<div class="responsive-menu d-none" id="responsive-cart-items">
			<button data-target-url="<?php echo site_url($profile->slugname . '/place-order') ?>"
					href="<?php echo site_url($profile->slugname . '/place-order') ?>" type="button"
					class="btn btn-primary open_cartModal">
				  <span class="noti fa fa-shopping-bag">
                <em id="mobileCartItemsCount"><?= $cartCount ?></em>
				  </span> Warenkorb (<span id="mobileCartPrice"><?= number_format($subtotal, 2) ?></span> €)
			</button>
		</div>
	<?php } ?>
	<div class="main-footer py-5">
		<div class="container">
			<ul class="text-center">
				<li><a href="javascript:void(0);">Ein Restaurant empfehlen</a></li>
				<li><a href="javascript:void(0);">Ein Restaurant anmelden</a></li>
				<li><a href="javascript:void(0);">Jobs</a></li>
				<li><a href="javascript:void(0);">AGB</a></li>
				<li><a href="javascript:void(0);">Datenschutzerklärung</a></li>
				<li><a href="javascript:void(0);">Impressum</a></li>
				<li><a href="javascript:void(0);">Verwendung von Cookies</a></li>
				<li><a href="javascript:void(0);">Bug Bounty</a></li>
			</ul>
			<div class="copyright">&copy; 2020 <a href="javascript:void();">Dummy.com</a></div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>

	<!--	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!--		  popup-->
	<div class="modal fade rounded-0 show" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
		 aria-hidden="true" id="pro-info">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title">Weitere Produktinformationen</h2>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<h3>Allergene</h3>
					<ul>
						<li>Enthält glutenhaltige/s Getreide/-Erzeugnisse</li>
						<li>Enthält Ei/-Erzeugnisse</li>
						<li>Enthält Sojabohnen/-Erzeugnisse</li>
						<li>Enthält Milch/-Erzeugnisse (laktosehaltig)</li>
						<li>Weizen</li>
					</ul>
				</div>
				<div class="modal-footer">
					<p class="mb-0">Bitte kontaktiere unseren <a href="javascript:void(0);">Kundenservice</a> bezüglich
						etwaiger Allergien oder Unverträglichkeiten</p>
				</div>
			</div>
		</div>
	</div>
	<!--		  end of popup-->
	<!--		Info Tab  popup-->
	<div class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true" id="info-modal">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title">Über das Restaurant</h2>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body p-0">
					<ul class="nav nav-tabs w-100" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" data-toggle="tab" href="#reviews" role="tab"
							   aria-selected="true">Bewertungen </a>
						</li>
						<li class="nav-item text-center" role="presentation">
							<a class="nav-link" data-toggle="tab" href="#info" role="tab" aria-selected="false">info</a>
						</li>
						<li class="nav-item text-center" role="presentation">
							<a class="nav-link" data-toggle="tab" href="#Rabatte" role="tab" aria-selected="false">Rabatte</a>
						</li>
					</ul>
					<div class="modal-tab">
						<div class="tab-content" id="modalTabContent">
							<div class="tab-pane fade show active" id="reviews" role="tabpanel" aria-labelledby="">

								<div class="content-review">
									<h3>Allgemeine Bewertung</h3>
									<section class="pt-2 review-data d-flex">
										<div class="rating-number-container">
											<span>0.0</span>
										</div>
										<div class="review-stars-container">
											<div class="review-rating">
												<div class="review-stars1">
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
												</div>
											</div>
											<div class="overviewstar">
												<span class="text">Von 0 Bewertungen</span>
											</div>
										</div>
									</section>

								</div>

								<?php /*
								<div class="content-review">
									<h3>Allgemeine Bewertung</h3>
									<section class="pt-2 review-data d-flex">
										<div class="rating-number-container">
											<span>0.0</span>
										</div>
										<div class="review-stars-container">
											<div class="review-rating">
												<div class="review-stars">
													<span class="review-stars-range"></span>
												</div>
											</div>
											<div class="overviewstar">
												<span class="text">Von 3519 Bewertungen</span>
											</div>
										</div>
									</section>
								</div>
								<div class="restaurant-reviews-container px-3">
									<div class="restaurantreview">
										<section class="review-head mb-2">
											<div class="reviewauthor" itemprop="about" content="Mamas Pizza-Place">
												<span class="notranslate">Ute Kohl</span>
											</div>
											<div class="review-date">
												<span itemprop="datePublished" class="reviewdate" content="2020-08-18"> Dienstag, 18. August 2020 </span>
											</div>
										</section>
										<section class="ratingscontainer d-flex flex-column">
											<div class="review-rating d-flex flex-row flex-space-between">
												<span> Essen  </span>
												<div class="review-stars notranslate">
													<span style="width: 100%;" class="review-stars-range"></span>
												</div>
											</div>
											<div class="review-rating d-flex">
												<span> Lieferung </span>
												<div class="review-stars notranslate">
													<span style="width: 100%;" class="review-stars-range"> </span>
												</div>
											</div>
										</section>
										<section class="review-body"><span>The driver was totally rude</span></section>
									</div>
									<div class="restaurantreview">
										<section class="review-head mb-2">
											<div class="reviewauthor" itemprop="about" content="Mamas Pizza-Place">
												<span class="notranslate">Mantas Sakalis</span>
											</div>
											<div class="review-date">
												<span itemprop="datePublished" class="reviewdate" content="2020-08-18"> Tuesday, August 18, 2020 </span>
											</div>
										</section>
										<section class="ratingscontainer d-flex flex-column">
											<div class="review-rating d-flex flex-row flex-space-between">
												<span> eat </span>
												<div class="review-stars notranslate">
													<span style="width: 100%;" class="review-stars-range"></span>
												</div>
											</div>
											<div class="review-rating d-flex">
												<span> delivery </span>
												<div class="review-stars notranslate">
													<span style="width: 100%;" class="review-stars-range"> </span>
												</div>
											</div>
										</section>
										<section class="review-body"><span>Unfortunately, food would be delivered incorrectly. Right for my wife, unfortunately wrong for me. After a complaint, not only my pizza but also my wife's was delivered quickly without any problems. I was hungry, but mistakes happen. Great service
                                    </span>
											<span class="note-review"><em>This order was placed on a Sunday. Therefore the delivery may have taken longer due to the high demand.</em></span>
										</section>
									</div>
									<div class="restaurantreview">
										<section class="review-head mb-2">
											<div class="reviewauthor">
												<span class="notranslate">Anonym</span>
											</div>
											<div class="review-date">
												<span itemprop="datePublished" class="reviewdate" content="2020-08-18"> Tuesday, August 18, 2020 </span>
											</div>
										</section>
										<section class="ratingscontainer d-flex flex-column">
											<div class="review-rating d-flex flex-row flex-space-between">
												<span> eat </span>
												<div class="review-stars notranslate">
													<span style="width: 80%;" class="review-stars-range"></span>
												</div>
											</div>
											<div class="review-rating d-flex">
												<span> delivery </span>
												<div class="review-stars notranslate">
													<span style="width: 50%;" class="review-stars-range"> </span>
												</div>
											</div>
										</section>
										<section class="review-body"><span>The driver was totally rude</span></section>
									</div>
								</div>
								*/?>
							</div>
							<div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="">
								<div class="info-container">
									<div class="location">
										<img src="<?php echo base_url(); ?>assets/images/location.jpg"
											 class="img-fluid">
									</div>
									<div class="location-address">
									</div>
									<div class="main-card-info px-3">
										<div class="info-card restaurant-info__opening-times">
											<h2 class="restaurantInfoTitle">
												<i class="fa fa-truck"></i>
												Lieferzeiten
											</h2>
											<?php if (isset($ordertimes)) { ?>
											<div class="info-tab-section">
												<table class="table">
													<tbody>
													<?php
														$daysArr = [
															"Monday" => "Montag",
															"Tuesday" => "Dienstag",
															"Wednesday" => "Donnerstag",
															"Thursday" => "Mittwoch",
															"Friday" => "Freitag",
															"Saturday" => "Samstag",
															"Sunday" => "Sonntag",
														];
														function setStartEndTime($ordertime) {

															if($ordertime->start_time == $ordertime->after_lunch) {
																echo $ordertime->before_lunch.' - '.$ordertime->end_time;
															}else{
																echo $ordertime->before_lunch.' - '.$ordertime->start_time .'<br>'.$ordertime->after_lunch.' - '.$ordertime->end_time;
															}
														}
														if(!empty($ordertimes)) {
														foreach($ordertimes as $ordertime) { ?>
													<tr>
														<td valign="top">
															<?=$daysArr[$ordertime->day]?>
														</td>
														<td valign="center" align="right">
															<?php if($ordertime->mark == 0) { echo 'Closed'; } else {  ?>
															<?=setStartEndTime($ordertime)?>
															<?php } ?>
														</td>
													</tr>
														<?php } } ?>
													<!--<tr>
														<td valign="top">
															Sonntag
														</td>
														<td valign="center" align="right">11:00 - 23:00</td>
													</tr>-->
													</tbody>
												</table>
											</div>
											<?php } ?>
										</div>
										<div class="info-card restaurant-info__opening-times">
											<h2 class="restaurantInfoTitle">
												<i class="fa fa-bicycle"></i>
												Lieferkosten
											</h2>
											<div class="info-tab-section">
												<table class="table">
													<tbody>
													<tr>
														<td valign="top">
															Mindestbestellwert
														</td>
														<td valign="center" align="right"><?=formatPrice($profile->minimum_order_amount);?> €</td>
													</tr>
													<tr>
														<td valign="top">
															Lieferkosten
														</td>
														<td valign="center" align="right"><?=formatPrice($profile->delivery_charges);?> €</td>
													</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="info-card restaurant-info__opening-times">
											<h2 class="restaurantInfoTitle">
												<i class="fa fa-home"></i>
												Website
											</h2>
											<div class="info-tab-section">
												<table class="table">
													<tbody>
													<tr>
														<td valign="top">
															<?php
															if(isset($profile->website) && trim($profile->website) !="" ) {
																echo "<a target='_blank' href=".$profile->website.">$profile->website</a>";
															}else{
																echo "Not provided";
															}?>

														</td>
													</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="info-card restaurant-info__opening-times">
											<h2 class="restaurantInfoTitle">
												<i class="fa fa-credit-card"></i>
												Bezahlmethoden
											</h2>
											<div class="info-tab-section">
												<div class="info-pay-card-list">
												<div class="info-pay-card">
														<img src="<?php echo base_url(); ?>assets/images/payment_0.png"
															 class="embedleft" alt="Barzahlung" title="Barzahlung">
													</div>
													<?php /* ?>
													<div class="info-pay-card">
														<img src="<?php echo base_url(); ?>assets/images/payment_0.png"
															 class="embedleft" alt="Barzahlung" title="Barzahlung">
													</div>
													<div class="info-pay-card">
														<img src="<?php echo base_url(); ?>assets/images/payment_15.png"
															 class="embedleft" alt="Klarna" title="Klarna">
													</div>
													<div class="info-pay-card">
														<img src="<?php echo base_url(); ?>assets/images/payment_21.png"
															 class="embedleft" alt="GiroPay" title="GiroPay">
													</div>
													<div class="info-pay-card">
														<img src="<?php echo base_url(); ?>assets/images/payment_61.png"
															 class="embedleft" alt="Visa" title="Visa">
													</div>
													<div class="info-pay-card">
														<img src="<?php echo base_url(); ?>assets/images/payment_62.png"
															 class="embedleft" alt="Mastercard" title="Mastercard">
													</div>
													<div class="info-pay-card">
														<img src="<?php echo base_url(); ?>assets/images/payment_63.png"
															 class="embedleft" alt="American Express"
															 title="American Express">
													</div>
													<?php */ ?>
													<div class="info-pay-card">
														<img src="<?php echo base_url(); ?>assets/images/payment_18.png"
															 class="embedleft" alt="PayPal" title="PayPal">
													</div>
													<?php /* ?>
													<div class="info-pay-card">
														<img src="<?php echo base_url(); ?>assets/images/payment_13.png"
															 class="embedleft" alt="Gutschein" title="Gutschein">
													</div>
													<div class="info-pay-card">
														<img src="<?php echo base_url(); ?>assets/images/payment_24.png"
															 class="embedleft" alt="Bitcoin" title="Bitcoin">
													</div>
													<?php */ ?>
												</div>
											</div>
										</div>
										<?php if (isset($profile)) { ?>
										<div class="info-card restaurant-info__opening-times">
											<h2 class="restaurantInfoTitle">
												<i class="fa fa-building"></i>
												Impressum
											</h2>
											<div class="info-tab-section menucard-imprint__section">
												<?php echo $profile->cname; ?>
												<br>
												<?php echo $profile->address; ?>
												<br>
												<div>
													<br>
													E-Mail: <?php echo $profile->email; ?>
												</div>
												<div>
													Fax: <?php echo $profile->fax; ?>
												</div>
												<br>
												<div class="info-resolution-url">
													<!--Plattform der EU-Kommission zur Online-Streitbeilegung: <a href="#"
																											   class="menucard-imprint__link"
																											   target="_blank">https://ec.europa.eu/consumers/odr</a>.-->
													<?php if(!empty($profile->vat_no)) { ?>
														<div>
															VAT Number <?php echo $profile->vat_no; ?>
														</div>
													<?php } ?>
												</div>
												<div class="menucard-resolution-url">
													<a href="#" class="menucard-imprint__link" target="_blank">Plattform
														der EU-Kommission zur Online-Streitbeilegung</a>
												</div>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="Rabatte" role="tabpanel" aria-labelledby="">
								<div class="rabette-content px-3">
									<div class="discount-category">Nur Abholung</div>
									<div class="discount-item disabled">
										<section class="d-flex d-flex-row">
											<section class="discount-icon">
												<img src="<?php echo base_url(); ?>assets/images/payment_13.png"
													 class="img-fluid">
											</section>
											<section class="d-flex flex-column">
												<div class="discount-title">Selbstabholer Rabatt</div>
												<div class="discount-text">Bei Abholung Ihrer Bestellung erhalten Sie
													15% Rabatt auf alle Hauptgerichte (außer Angebote)!
												</div>
											</section>
										</section>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--		  end of Info Tab popup-->
	<!--		Header search  popup-->
	<div class="modal fade rounded-0 show" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
		 aria-hidden="true" id="search-pop-header">
		<div class="modal-dialog modal-md  modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header my-4 text-center">
					<h2 class="">Bitte wählen Sie aus</h2>
				</div>
				<div class="modal-body">
					<form id="pincodeFORM" action="<?php echo base_url('/'); ?>" method="post" autocomplete="off">
						<div class="popUpOptions">
							<div class="row">
								<div class="col-md-6">
									<div class="form-check">
										<input class="form-check-input deliveryTypeRadio" type="radio" name="delivery"
											   value="self"
											   id="self_pickup"
										>
										<label class="form-check-label" for="self_pickup">Abholen</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-check">
										<input class="form-check-input deliveryTypeRadio" type="radio" name="delivery"
											   value="delivery"
											   required
											   id="delivery_pickup" <?= $this->input->cookie('delivery_type', true) === "delivery" ? "checked" : '' ?>>
										<label class="form-check-label" for="delivery_pickup">
											Lieferung
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="pin_code_form <?= in_array($this->input->cookie('delivery_type', true), ["self",""]) ? "d-none" : ' ' ?>">
							<div class="search-location form-group mb-0"><i class="fa fa-map-marker-alt"></i>
								<input
										class="form-control form-cstm" id="myInput" type="text"
										autocomplete="off"
										placeholder="PLZ eingeben"
										<?= $this->input->cookie('delivery_type', true) === "self" ? "disabled" : '' ?>
										value="<?= $this->input->cookie('pincode', true) ?>">
							</div>

							<button type="submit" class="btn btn-search">Anzeigen</button>
							<label class="invalid-pincode text-danger d-none" for="">Bitte geben Sie die gültige Postleitzahl ein</label>
						</div>
						<input type="hidden" id="input_pincode" name="pincode"
							value="<?= $this->input->cookie('pincode', true) ?>">
					</form>

				</div>
			</div>
		</div>
	</div>
	<!--		  end of Header search popup-->

	<div class="modal fade rounded-0 show" tabindex="-1" role="dialog"
		 aria-hidden="true" id="not-accepting-orders-model">
		<div class="modal-dialog modal-md modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body border border-warning">
					<div class="my-4 text-center">
						<p id="not-accepting-orders-model-text">Bitte beachten Sie: Derzeit akzeptieren wir keine Bestellungen. Bitte versuchen Sie es nach einiger Zeit. Danke.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--		Header menu  popup-->
	<div class="modal fade rounded-0 " tabindex="-1" role="dialog" aria-hidden="true" id="menu-pop">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="topacco tab-content">
					    <div class="tab-pane container myoderdlist p-0">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<section class="top-content d-flex">
								<div class="modal-avatar default-image"
									 style="background-image: url('<?php echo base_url(); ?>assets/images/profile.png')"></div>
								<div class="profile flex flex-column">
									<?php
									$name = "Mein Account";
									if (is_array($user_data) && sizeof($user_data)) {
										$name = $user_data['user']->name;
									} ?>

									<span class="name"><?= $name ?></span>
									<a href="<?= site_url() . 'profile' ?>">
										<span class="personal-information">Persönliche Daten anzeigen</span>
									</a>
								</div>
							</section>

							<section class="bottom-content listdata">
								<?php if(isset($this->session->userdata('userdata')['user']->userId)) {
									$myorder = getMyOrders(array('userId' => $this->session->userdata('userdata')['user']->userId));
									if($myorder->error == 202) {
									    echo '<ul class="atom-list-link userpanel-list-link">
													<li class="has-icon">
														<a class="js-order-history-menu orlistshow" href="#">
															<i class="fas fa-shopping-bag"></i> Back </a>
													</li>
												</ul>';
										foreach($myorder->data as $myOrderObj) {
									?>
											<div class="card userordercard" style="padding:15px">
											    <div class="order_detail_popup">
												<?php if($myOrderObj->logo != null) { ?>
													<a href="http://harjassinfotech.com/eatura/order/tracking/<?php echo $myOrderObj->order_id; ?>" class="order_detail_img" ><img class="card-img-top" src="<?php echo LOGOPATH.$myOrderObj->logo?>" /></a>
												<?php } ?>
											  <div class="card-body">
												<h5 class="card-title"><?=$myOrderObj->name?></h5>
										<p class="card-text"><?=$myOrderObj->address?></p>
												<span class="card-price"><?=$myOrderObj->total_price+$myOrderObj->delivery_charge.' €'?></span>

											  </div>
											  </div>
											</div>

										<?php }
										} else if($myorder->error == 404) {
											echo '<div class="card" style="padding:15px"><div class="card" style="padding:15px">'.$myorder->message.'</div></div>';
								} } ?>
							</section>

						</div>

						<div class="tab-pane container authcontainer <?php if($this->pageParam->isAuth == true) { ?> active <?php } ?> p-0" id="logintab">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<section class="top-content d-flex">
								<div class="modal-avatar default-image"
									 style="background-image: url('<?php echo base_url(); ?>assets/images/profile.png')"></div>
								<div class="profile flex flex-column">
									<?php
									$name = "Mein Account";
									if (is_array($user_data) && sizeof($user_data)) {
										$name = $user_data['user']->name;
									} ?>

									<span class="name"><?= $name ?></span>
									<a href="<?= site_url() . 'profile' ?>">
										<span class="personal-information">Persönliche Daten anzeigen</span>
									</a>
								</div>
							</section>

							<section class="bottom-content">
								<?php

								if (is_array($user_data) && sizeof($user_data) === 0) {
									?>
									<section class="login-signup-container d-flex flex-space-between">
										<a class="button_form button-cta-small-inveted" data-toggle="tab" href="#login">
											Einloggen </a>
										<a class="button_form button-cta-small" data-toggle="tab" href="#register">
											Account erstellen </a>
									</section>
								<?php } ?>
								<ul class="atom-list-link userpanel-list-link">
									<li class="has-icon">
										<a class="js-order-history-menu ordertarget" href="#">
											<i class="fas fa-shopping-bag"></i> Bestellungen </a>
									</li>
									<!--
									<li class="has-icon">
										<a class="js-my-favorites-menu" href="#">
											<i class="fas fa-heart"></i> Favoriten </a>
									</li>-->
								</ul>
								<ul class=" atom-list-link userpanel-list-link">
								    <!--
									<li class=" has-icon loyaltyPointsMenuItem">
										<a href="#">
											<i class="fa fa-medal"></i>Prämienshop<span class="right-part"></span>
										</a>
									</li>
									<li class=" has-icon js-stampcards-link">
										<a href="#" data-click="stampcards">
											<i class="fa fa-percent"></i>Stempelkarten<span
													class="right-part"></span>
										</a>
									</li>
									-->
									<li class=" has-icon ">
										<a href="#">
											<i class="fa fa-info-circle"></i>Brauchst Du Hilfe?<span
													class="right-part"></span>
										</a>
									</li>
									<li class="has-icon ">
										<a href="<?= site_url() . 'logout' ?>">
											<i class="fas fa-home"></i>
											Logout
										</a>
									</li>
								</ul>
							</section>

						</div>
						<section class="login-tab p-3 tab-pane <?php if($this->pageParam->isAuth == false) { ?>active <?php } ?> p-0" id="register">
							<form action="<?php echo site_url() . 'register' ?>" id="register-form" method="post">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h2 class="text-captialize">Anmelden</h2>
								<div class="login_social">
								    <div class="row">
								        <div class="col-md-6">
								            <a href="#" class="btn btn-gb"><span><i class="fab fa-google"></i></span>Login with Google</a>
								        </div>
								        <div class="col-md-6">
								            <a href="#" class="btn btn-fb"><span><i class="fab fa-facebook"></i></span>Login with Facebook</a>
								        </div>
								    </div>
								</div>
								<div class="button-login">

								</div>
								<div class="separator">
									<span>oder</span>
								</div>

								<div class="form_panel">
								    <div class="row">
								        <div class="col-md-6">
								            <div class="form-group">
								                <label>Name</label>
								                <input type="text" name="name" value="" tabindex="1"
										   class="textfield-form form-control" maxlength="100">
								            </div>
								        </div>
								        <div class="col-md-6">
								            <div class="form-group">
								                <label>Telefonnummer </label>
									<input type="text" name="phone" value="" tabindex="1"
										   class="textfield-form form-control" maxlength="100">
								            </div>
								        </div>
								    </div>
								    <div class="row">
								        <div class="col-md-6">
								            <div class="form-group">
								                <label>E-Mail-Adresse </label>
									<input type="text" name="email" value="" tabindex="1"
										   class="textfield-form form-control" maxlength="100">
								            </div>
								        </div>
								        <div class="col-md-6">
								            <div class="form-group">
								                <label>Password</label>
								                <input type="password" name="password" class="textfield-form form-control"
										   maxlength="100"/>
								            </div>
								        </div>
								    </div>
								</div>
								<div class="form-group">
									<button class="btn btn-primary">Register</button>
								</div>
								<a data-toggle="tab" href="#login" aria-controls="login" role="tab" class="link-open p-2 tlogin">Einloggen</a>
							</form>

						</section>

						<section class="login-tab p-3 tab-pane p-0 forget-password-form" id="for">
							<form action="<?php echo site_url() . 'forgotsendlink' ?>" id="forget-form" method="post">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h3>Anmelden</h3>
								<div class="button-login">
									<a href="#" class="btn btn-fb">Anmelden</a>
								</div>
								<div class="textarea-label form-group">
									<label>E-Mail-Adresse </label>
									<input type="text" name="email" value="" tabindex="1"
										   class="textfield-form form-control" maxlength="100">
								</div>

								<div class="form-group">
									<button class="btn btn-primary">Send</button>
								</div>
								<a data-toggle="tab" href="#login" aria-controls="login" role="tab" class="link-open p-4">Account
								erstellen</a>
							</form>
						</section>

						<section class="login-tab p-3 tab-pane fade p-0 login-fm" id="login">
							<form action="<?php echo site_url() . 'login' ?>" id="login-form" method="post">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<h3>Anmelden</h3>
								<div class="button-login">
									<a href="#" class="btn btn-fb">Anmelden</a>
								</div>
								<div class="separator">
									<span>oder</span>
								</div>
								<div class="textarea-label form-group">
									<label>E-Mail-Adresse </label>
									<input type="text" name="email" value="" tabindex="1"
										   class="textfield-form form-control" maxlength="100">
								</div>
								<div class="textarea-label form-group">
									<label>Passwort <a href="#" class="float-right forget-password tforget">forget password?</a></label>
									<input type="password" name="password" class="textfield-form form-control"
										   maxlength="100">
								</div>
								<div class="form-group">
									<button class="btn btn-primary">Login</button>
								</div>
							</form>
							<a data-toggle="tab" href="#register" aria-controls="register" role="tab"
							   class="link-open p-4 tregister">Account erstellen</a>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--		  end of menu search popup-->
	<script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/form-handler.js"></script>
	<script src="<?php echo base_url() ?>assets/js/cart.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery.toast.js"></script>
	<script>
		$(document).ready(function () {
		    $('.tlogin').click(function () {
				$('#register-form')[0].reset();
			});
			$('.tregister').click(function () {
				$('#login-form')[0].reset();
			});
			$('.tforget').click(function () {
				$('#login-form')[0].reset();
				$('#forget-form')[0].reset();
			});

		    $('.ordertarget').click(function () {
			   $('.authcontainer').removeClass('active').addClass('fade');
			   $('.myoderdlist').addClass('active');
			});

			$('.orlistshow').click(function () {
			   $('.myoderdlist').removeClass('active');
			   $('.authcontainer').removeClass('fade').addClass('active');
			});

			$('.forget-password').click(function () {
				 $('.login-fm').removeClass('active').addClass('fade');
				$('.forget-password-form').addClass('active');
			});

			$('.search-icon').click(function () {
				$('.slide-content').addClass('active');
			});
			$('.slide-content .close').click(function () {
				$('.slide-content').removeClass('active');
			});
		});
		jQuery(document).ready(function () {
			jQuery(window).scroll(function () {
				var sticky = jQuery('div#ibasket'),
						scroll = jQuery(window).scrollTop();

				if (scroll >= 70) sticky.addClass('fixed');
				else sticky.removeClass('fixed');
			});
		});

	</script>

		<script>
		var owl = $('#slide-carousel');
		owl.owlCarousel({
		    center: false,
			// loop: true,
			// margin: 5,
			nav: true,
			dots: false,
			autoWidth: true,
			responsive: {
				0: {items: 1},
				600: {items: 3},
				1000: {items: 5}
			},
			URLhashListener:true,
			startPosition: 'URLHash'
		});
	</script>

	<script>

		$(document).ready(function () {
				let userHasScrolled = false;
			let refIds = [];
			// Cache selectors
			var lastId,
				topMenu = $("#slide-carousel"),
				topMenuHeight = topMenu.outerHeight()+15,
				// All list items
				menuItems = topMenu.find(".owl-item a"),
				// Anchors corresponding to menu items
				scrollItems = menuItems.map(function(){
					var item = $($(this).attr("href"));
					if (item.length) { if(!refIds.includes($(this).attr("href"))){
						refIds.push($(this).attr("href"));
						return item;
					}}
				});
			// Bind click handler to menu items
			// so we can get a fancy scroll animation


			$('.slide-sec a').on('click', function (e) {
				e.preventDefault(); // prevent hard jump, the default behavior
				var target = $(this).attr("href"); // Set the target as variable
				// perform animated scrolling by getting top-position of target-element and set it as scroll target
				smoothScrollToElement($(target));
				location.hash = target;
				$(document).find(".owl-item .item").removeClass("active");
				$(this).parent(".item").addClass("active");
				let cEle = $('a[href="'+target+'"]').parents(".owl-item");
				let current = $('.owl-item').index(cEle);
				owl.trigger('to.owl.carousel',[current, 100]);
				userHasScrolled = true;
				return false;
			});
			/** Catch the value from URL */
			if(window.location.hash) {
				var chref = window.location.hash,
					offsetTop = chref === "#" ? 0 : $(chref).offset().top-topMenuHeight+1;
				$('html, body').stop().animate({scrollTop: offsetTop}, 300);
				$(document).find(".owl-item .item").removeClass("active");
				$('a[href="'+chref+'"]').parent(".item").addClass("active");
				let cEle = $('a[href="'+chref+'"]').parents(".owl-item");
				let current = $('.owl-item').index(cEle);
				owl.trigger('to.owl.carousel',[current, 100]);
				userHasScrolled = true;
				// return false;
			}

			var lastScrollTop = 0;
			// Bind to scroll
			$(window).scroll(function(e){
			clearTimeout( $.data( this, "scrollCheck" ) );
			$.data( this, "scrollCheck", setTimeout(function() { userHasScrolled = false;}, 250) );

			if(userHasScrolled === true) return;

			// Get container scroll position
			var fromTop = $(this).scrollTop() + topMenuHeight;

			// Get id of current scroll item
			var cur = scrollItems.map(function(){
				if ($(this).offset().top < fromTop){
					return this;
				}
			});
			// console.log(cur);
			// Get the id of the current element
			cur = cur[cur.length-1];
			var id = cur && cur.length ? cur[0].id : "";

			if (lastId !== id) {
				if(id) {
					let cEle = $('a[href="#'+id+'"]').parents(".owl-item");
					if(!cEle.find(".owl-item").hasClass("active")) {
						let current = $('.owl-item').index(cEle);
						owl.trigger('to.owl.carousel',[current, 100]);
					}
					window.location.hash    = `${id}`;
				}
				lastId = id;
				// Set/remove active class
				menuItems
					.parent()
					.removeClass("active")
					.end()
					.filter("[href='#"+id+"']")
					.parent()
					.addClass("active");
			}
			});

			// When the user clicks on the button, scroll to the top of the document
			$(document).on('click',"#myBtntoptobottom",function(e) {
				userHasScrolled = true;
				window.scroll(0,0);
				owl.trigger('to.owl.carousel',[0, 100]);

				$(document).find('.owl-stage').find('.owl-item').find('.item').removeClass("active");
			})

		});


	</script>

	<script>
		new WOW().init();
	</script>
	<script>
		function up(max) {
			document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) + 1;
			if (document.getElementById("myNumber").value >= parseInt(max)) {
				document.getElementById("myNumber").value = max;
			}
		}

		function down(min) {
			document.getElementById("myNumber").value = parseInt(document.getElementById("myNumber").value) - 1;
			if (document.getElementById("myNumber").value <= parseInt(min)) {
				document.getElementById("myNumber").value = min;
			}
		}
	</script>

	<script>
		function autocomplete(inp, arr) {
			/*the autocomplete function takes two arguments,
			the text field element and an array of possible autocompleted values:*/
			var currentFocus;
			/*execute a function when someone writes in the text field:*/
			inp.addEventListener("input", function (e) {
				var a, b, i, val = this.value;
				$(document).find("#input_pincode").val('');
				/*close any already open lists of autocompleted values*/
				closeAllLists();
				if (!val) {
					return false;
				}
				currentFocus = -1;
				/*create a DIV element that will contain the items (values):*/
				a = document.createElement("DIV");
				a.setAttribute("id", this.id + "autocomplete-list");
				a.setAttribute("class", "autocomplete-items");
				/*append the DIV element as a child of the autocomplete container:*/
				this.parentNode.appendChild(a);
				/*for each item in the array...*/
				for (i = 0; i < arr.length; i++) {
					/*check if the item starts with the same letters as the text field value:*/
					if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
						/*create a DIV element for each matching element:*/
						b = document.createElement("DIV");
						b.classList.add("autocomplete-item");
						/*make the matching letters bold:*/
						b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
						b.innerHTML += arr[i].substr(val.length);
						/*insert a input field that will hold the current array item's value:*/
						b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
						/*execute a function when someone clicks on the item value (DIV element):*/
						b.addEventListener("click", function (e) {
							/*insert the value for the autocomplete text field:*/
							inp.value = this.getElementsByTagName("input")[0].value;
							$(document).find("#input_pincode").val( this.getElementsByTagName("input")[0].value );
							$(document).find(".invalid-pincode").addClass("d-none");
							/*close the list of autocompleted values,
							(or any other open lists of autocompleted values:*/
							closeAllLists();
						});
						a.appendChild(b);
					}
				}
			});
			/*execute a function presses a key on the keyboard:*/
			inp.addEventListener("keydown", function (e) {
				var x = document.getElementById(this.id + "autocomplete-list");
				if (x) x = x.getElementsByTagName("div");
				if (e.keyCode == 40) {
					/*If the arrow DOWN key is pressed,
					increase the currentFocus variable:*/
					currentFocus++;
					/*and and make the current item more visible:*/
					addActive(x);
				} else if (e.keyCode == 38) { //up
					/*If the arrow UP key is pressed,
					decrease the currentFocus variable:*/
					currentFocus--;
					/*and and make the current item more visible:*/
					addActive(x);
				} else if (e.keyCode == 13) {
					/*If the ENTER key is pressed, prevent the form from being submitted,*/
					e.preventDefault();
					if (currentFocus > -1) {
						/*and simulate a click on the "active" item:*/
						if (x) x[currentFocus].click();
					}
				}
			});

			function addActive(x) {
				/*a function to classify an item as "active":*/
				if (!x) return false;
				/*start by removing the "active" class on all items:*/
				removeActive(x);
				if (currentFocus >= x.length) currentFocus = 0;
				if (currentFocus < 0) currentFocus = (x.length - 1);
				/*add class "autocomplete-active":*/
				x[currentFocus].classList.add("autocomplete-active");
			}

			function removeActive(x) {
				/*a function to remove the "active" class from all autocomplete items:*/
				for (var i = 0; i < x.length; i++) {
					x[i].classList.remove("autocomplete-active");
				}
			}

			function closeAllLists(elmnt) {
				/*close all autocomplete lists in the document,
				except the one passed as an argument:*/
				var x = document.getElementsByClassName("autocomplete-items");
				for (var i = 0; i < x.length; i++) {
					if (elmnt != x[i] && elmnt != inp) {
						x[i].parentNode.removeChild(x[i]);
					}
				}

				$(document).find(".autocomplete-item").length
			}

			/*execute a function when someone clicks in the document:*/
			document.addEventListener("click", function (e) {
				closeAllLists(e.target);
			});

		}


	</script>

</footer>
<script>
	//Get the button
	var mybutton = document.getElementById("myBtntoptobottom");

	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function () {
		scrollFunction()
	};

	function scrollFunction() {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			mybutton.style.display = "block";
		} else {
			mybutton.style.display = "none";
		}
	}


</script>
<script>
	/*An array containing all the pincode:*/
	<?php if(!empty($pincodes)){?>
	var countries =<?php echo json_encode($pincodes) . ';';
	}else{?>
	var countries = ['No pincode found.'];
	<?php }?>

	autocomplete(document.getElementById("myInput"), countries);
</script>
<!--	End of Footer section-->
