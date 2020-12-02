<?php
$this->load->view('includes/header'); ?>

<div class="banner-home">
	<div class="container">
		<h2>Zeit, Essen zu bestellen</h2>
		<p>Jetzt Restaurants in Deiner Umgebung finden</p>
		<form action="<?php echo base_url('/'); ?>" method="post" autocomplete="off">
			<div class="search-home autocomplete"><i class="fa fa-map-marker-alt"></i><input
						class="form-control form-cstm" id="myInput" type="text" name="pincode"
						autocomplete="off"
						placeholder="Enter Your Pincode"
						value="<?= $this->input->cookie('pincode', true) ?>"
						required>
				<button type="submit" class="btn btn-search">Anzeigen</button>
			</div>
		</form>
	</div>
</div>
<div class="subheader">
	<div class="subheader__slope"></div>
	<div class="subheader__image">
	</div>
</div>
<div class="Restaurant-sec py-60">
	<div class="container">
		<div class="head-res text-center">
			<span>So funktioniert Lieferando.de</span>
			<h3>So einfach geht es!</h3>
		</div>
		<div class="row">
			<div class="owl-carousel owl-theme slider-div-cs" id="slide-deliver">
				<div class="item">
					<div class="bx-contain text-center fadeInDown wow">
						<div class="res-icon">
							<img src="<?php echo base_url(); ?>assets/images/location.png" class="img-fluid">
							<span class="ic-no">1.</span>
						</div>
						<h3>Gib Deinen Standort an</h3>
						<p>Gib Deine Adresse ein oder lasse uns Deine Position bestimmen.</p>
					</div>
				</div>
				<div class="item">
					<div class="bx-contain text-center bx-2 fadeInDown wow" data-wow-delay="0.4s">
						<div class="res-icon">
							<img src="<?php echo base_url(); ?>assets/images/food.png" class="img-fluid">
							<span class="ic-no">2.</span>
						</div>
						<h3>Restaurant und Speisen auf Eatura auswählen</h3>
						<p>Was trifft Deinen Geschmack? Klicke Dich durch zahlreiche Menüs und Bewertungen.</p>
					</div>
				</div>
				<div class="item">
					<div class="bx-contain text-center bx-3 fadeInDown wow" data-wow-delay="0.6s">
						<div class="res-icon">
							<img src="<?php echo base_url(); ?>assets/images/delivery.png" class="img-fluid">
							<span class="ic-no">3.</span>
						</div>
						<h3>Bezahlen und liefern lassen</h3>
						<p>Bezahle bar oder online mit Kreditkarte, Klarna, PayPal, Bitcoin. Guten Appetit! </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="app-sec">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<span class="respan">Die Eatura App herunterladen</span>
				<span class="respan-2">immer und überall bestellen!</span>
				<div class="app-sec-icon d-flex">
					<a href="javascript:void();" class="d-block"><img
								src="<?php echo base_url(); ?>assets/images/android.png" class="img-fluid"></a>
					<a href="javascript:void();" class="d-block ml-2"><img
								src="<?php echo base_url(); ?>assets/images/ios.png" class="img-fluid"></a>
				</div>
			</div>
			<div class="col-md-4">
				<div class="app-img-sec">
					<img src="<?php echo base_url(); ?>assets/images/app-ios.png" class="img-fluid slideInUp wow"
						 data-wow-delay="0.8s">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="py-60 crown-sec">
	<div class="container">
		<div class="head-res text-center">
			<span>Lieferando.de</span>
			<h3>Deine Zeit.</h3>
		</div>
		<div class="row">
			<div class="owl-carousel owl-theme slider-div-cs" id="slide-funk">
				<div class="item">
					<div class="px-box fadeInDown wow">
						<div class="px-icon">
							<img src="<?php echo base_url(); ?>assets/images/bag.png" class="img-fluid">
						</div>
						<h4 class="px-headline text-center">Deine Extras</h4>
						<ul class="px-listbox">
							<li>
								<a href="javascript:void(0);">Unser Prämienshop</a>: jede Menge großartiger
								Gutscheine
								und Rabatte
							</li>
							<li>Sammle Stempel und erfahre mehr über Gewinnspiele, Rabatte, Neuigkeiten und mehr&nbsp;über
								unsere Newsletter und Sozialen Medien
							</li>
						</ul>
					</div>
				</div>
				<div class="item">
					<div class="px-box fadeInDown wow" data-wow-delay="0.4s">
						<div class="px-icon">
							<img src="<?php echo base_url(); ?>assets/images/crown.png" class="img-fluid">
						</div>
						<h4 class="px-headline text-center">Deine Garantie</h4>
						<ul class="px-listbox">
							<li>
								Exzellenter Service umsonst
							</li>
							<li>Authentische <br> Nutzerbewertungen</li>
							<li><a href="javascript:void(0);">Preisgarantie</a>: Du bezahlst genauso viel für dein
								geliefertes Essen, wie wenn Du direkt beim Restaurant bestellst
							</li>
						</ul>
					</div>
				</div>
				<div class="item">
					<div class="px-box fadeInDown wow" data-wow-delay="0.6s">
						<div class="px-icon">
							<img src="<?php echo base_url(); ?>assets/images/check.png" class="img-fluid">
						</div>
						<h4 class="px-headline text-center">Deine Vorteile</h4>
						<ul class="px-listbox">
							<li>
								15.000+ Lieferservices bieten Dir die größte Auswahl an Essen
							</li>
							<li>Bezahle bar oder bargeldlos</li>
							<li>Bestelle wo und wann Du willst mit jedem Gerät</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="py-60 right-com">
	<div class="container">
		<div class="row">
			<div class="col-xl-6 col-md-8">
				<div class="textcontent-text">
					<h3>
						Lust auf mehr?<br>
						Auf unserem Blog findest Du spannende <br>News aus den Bereichen Food &amp; Lifestyle!
					</h3>
					<a href="javascript:void();" class="green-text"> &gt; Zum Blog </a>
				</div>
			</div>
			<div class="col-xl-6 col-md-4">
				<div class="com-img fadeIn wow" data-wow-delay="0.4s">
					<img src="<?php echo base_url(); ?>assets/images/desktop-right.png" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</div>
<!--	   Tab-sec-->
<div class="py-60 tab-gallery">
	<div class="container">
		<div class="head-res text-center mb-4">
			<span>Neu hier?</span>
			<h3>Entdecke Lieferando.de</h3>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div id="carousel1_indicator" class="carousel slide" data-ride="carousel" data-interval="false">
					<ul class="nav nav-tabs carousel-indicators" id="myTab" role="tablist">
						<li data-target="#carousel1_indicator" data-slide-to="0" class="active nav-item"
							role="presentation">
							<a class="nav-link active" data-toggle="tab" href="#Städte" role="tab"
							   aria-controls="Städte" aria-selected="true">Städte</a>
						</li>
						<li data-target="#carousel1_indicator" data-slide-to="1" class="nav-item text-center"
							role="presentation">
							<a class="nav-link" data-toggle="tab" href="#Regionen" role="tab"
							   aria-controls="Regionen"
							   aria-selected="false">Regionen</a>
						</li>
						<li data-target="#carousel1_indicator" data-slide-to="2" class="nav-item text-center"
							role="presentation">
							<a class="nav-link" data-toggle="tab" href="#Küchenrichtungen" role="tab"
							   aria-controls="Küchenrichtungen" aria-selected="false">Küchenrichtungen</a>
						</li>
						<li data-target="#carousel1_indicator" data-slide-to="3" class="nav-item text-center"
							role="presentation">
							<a class="nav-link" data-toggle="tab" href="#Gerichte" role="tab"
							   aria-controls="Gerichte"
							   aria-selected="false">Gerichte</a>
						</li>
						<li data-target="#carousel1_indicator" data-slide-to="4" class="nav-item text-center"
							role="presentation">
							<a class="nav-link" data-toggle="tab" href="#Unsere" role="tab" aria-controls="Unsere"
							   aria-selected="false">Unsere Empfehlungen</a>
						</li>
						<li data-target="#carousel1_indicator" data-slide-to="5" class="nav-item text-center"
							role="presentation">
							<a class="nav-link" data-toggle="tab" href="#Weitere" role="tab" aria-controls="Weitere"
							   aria-selected="false">Weitere Infos</a>
						</li>
					</ul>
					<div class="carousel-inner tab-content" id="myTabContent">
						<div class="carousel-item active">
							<div class="tab-pane show active" id="Städte" role="tabpanel" aria-labelledby="">
								<ul class="tab_content visible mt-3">
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Berlin">
											<div class="yd-tabslider-cities-berlin"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Berlin</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Hamburg">
											<div class="yd-tabslider-cities-hamburg"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Hamburg</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Köln">
											<div class="yd-tabslider-cities-koeln"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Köln</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Bremen">
											<div class="yd-tabslider-cities-bremen"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Bremen</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="München">
											<div class="yd-tabslider-cities-muenchen"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">München</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Essen">
											<div class="yd-tabslider-cities-essen"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Essen</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Frankfurt am Main">
											<div class="yd-tabslider-cities-frankfurt"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Frankfurt am Main</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="alle Städte">
											<div class="yd-tabslider-cities-empty"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">alle Städte</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="carousel-item">
							<div class="tab-pane" id="Küchenrichtungen" role="tabpanel"
								 aria-labelledby="Küchenrichtungen">
								<ul class="tab_content visible mt-3">
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Berlin">
											<div class="yd-tabslider-Italienisch"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Italienisch</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Hamburg">
											<div class="yd-tabslider-Chinesisch"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Chinesisch</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Köln">
											<div class="yd-tabslider-cities-koeln"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Indisch</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Bremen">
											<div class="yd-tabslider-Griechisch"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Griechisch</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="München">
											<div class="yd-tabslider-Mexikanisch"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Mexikanisch</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Essen">
											<div class="yd-tabslider-Essen"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Essen</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Frankfurt am Main">
											<div class="yd-tabslider-Asiatisch"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Asiatisch</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="alle Städte">
											<div class="yd-tabslider-empty"></div>
											<span class="tabslider-link-text">alle Nationalitäten</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="carousel-item">
							<div class="tab-pane" id="Küchenrichtungen" role="tabpanel"
								 aria-labelledby="Küchenrichtungen">
								<ul class="tab_content visible mt-3">
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Berlin">
											<div class="yd-tabslider-Italienisch"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Italienisch</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Hamburg">
											<div class="yd-tabslider-Chinesisch"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Chinesisch</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Köln">
											<div class="yd-tabslider-cities-koeln"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Indisch</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Bremen">
											<div class="yd-tabslider-Griechisch"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Griechisch</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="München">
											<div class="yd-tabslider-Mexikanisch"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Mexikanisch</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Essen">
											<div class="yd-tabslider-Essen"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Essen</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Frankfurt am Main">
											<div class="yd-tabslider-Asiatisch"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Asiatisch</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="alle Städte">
											<div class="yd-tabslider-empty"></div>
											<span class="tabslider-link-text">alle Nationalitäten</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="carousel-item">
							<div class="tab-pane" id="Gerichte" role="tabpanel" aria-labelledby="">
								<ul class="tab_content visible mt-3">
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Berlin">
											<div class="yd-tabslider-pizza"><img
														src="<?php echo base_url(); ?>assets/images/pizza.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Pizza</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Hamburg">
											<div class="yd-tabslider-Burger"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Burger</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Köln">
											<div class="yd-tabslider-Sushi"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Sushi</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="München">
											<div class="yd-tabslider-cities-muenchen"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Döner</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Essen">
											<div class="yd-tabslider-Pommes"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Pommes</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Frankfurt am Main">
											<div class="yd-tabslider-Pasta"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Pasta</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="alle Städte">
											<div class="yd-tabslider-cities-Schnitzel"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Schnitzel</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="alle Städte">
											<div class="yd-tabslider-cities-empty"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">alle Städte</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="carousel-item">
							<div class="tab-pane" id="Unsere" role="tabpanel" aria-labelledby="">
								<ul class="tab_content visible mt-3">
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Berlin">
											<div class="yd-tabslider-pizza"><img
														src="<?php echo base_url(); ?>assets/images/pizza.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Pizza</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Hamburg">
											<div class="yd-tabslider-Burger"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Burger</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Köln">
											<div class="yd-tabslider-Sushi"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Sushi</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="München">
											<div class="yd-tabslider-cities-muenchen"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Döner</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Essen">
											<div class="yd-tabslider-Pommes"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Pommes</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Frankfurt am Main">
											<div class="yd-tabslider-Pasta"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Pasta</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="carousel-item">
							<div class="tab-pane" id="Weitere" role="tabpanel" aria-labelledby="">
								<ul class="tab_content visible mt-3">
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Berlin">
											<div class="yd-tabslider-pizza"><img
														src="<?php echo base_url(); ?>assets/images/pizza.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Pizza</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Hamburg">
											<div class="yd-tabslider-Burger"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Burger</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Köln">
											<div class="yd-tabslider-Sushi"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Sushi</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="München">
											<div class="yd-tabslider-cities-muenchen"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Döner</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Essen">
											<div class="yd-tabslider-Pommes"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Pommes</span>
										</a>
									</li>
									<li class="grid">
										<a class="tabslider-links" href="javascript:void();" target="_self"
										   title="Frankfurt am Main">
											<div class="yd-tabslider-Pasta"><img
														src="<?php echo base_url(); ?>assets/images/berlin.jpg"
														class="img-fluid"></div>
											<span class="tabslider-link-text">Pasta</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<a class="carousel-control-prev" href="#carousel1_indicator" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carousel1_indicator" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
		<!--			 check-->
		<!--
               <div class="col-md-12">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                     <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="Pr-manage" data-toggle="tab" href="#Städte" role="tab" aria-controls="Städte" aria-selected="true">Städte</a>
                      </li>
                     <li class="nav-item text-center" role="presentation">
                        <a class="nav-link" id="Hr-manege" data-toggle="tab" href="#Regionen" role="tab" aria-controls="Regionen" aria-selected="false">Regionen</a>
                      </li>
                     <li class="nav-item text-center" role="presentation">
                        <a class="nav-link" id="Lead-manage" data-toggle="tab" href="#Küchenrichtungen" role="tab" aria-controls="Küchenrichtungen" aria-selected="false">Küchenrichtungen</a>
                      </li>
               <li class="nav-item text-center" role="presentation">
                        <a class="nav-link" id="Lead-manage" data-toggle="tab" href="#Gerichte" role="tab" aria-controls="Gerichte" aria-selected="false">Gerichte</a>
                      </li>
               <li class="nav-item text-center" role="presentation">
                        <a class="nav-link" id="Lead-manage" data-toggle="tab" href="#Unsere" role="tab" aria-controls="Unsere" aria-selected="false">Unsere Empfehlungen</a>
                      </li>
               <li class="nav-item text-center" role="presentation">
                        <a class="nav-link" id="Lead-manage" data-toggle="tab" href="#Weitere" role="tab" aria-controls="Weitere" aria-selected="false">Weitere Infos</a>
                      </li> 
                  </ul>
                  <div class="tab-content" id="myTabContent">
                     <div class="tab-pane fade show active" id="Städte" role="tabpanel" aria-labelledby=""> 
               <ul class="tab_content visible mt-3">
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Berlin">
               <div class="yd-tabslider-cities-berlin"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Berlin</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Hamburg">
               <div class="yd-tabslider-cities-hamburg"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Hamburg</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Köln">
               <div class="yd-tabslider-cities-koeln"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Köln</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Bremen">
               <div class="yd-tabslider-cities-bremen"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Bremen</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="München">
               <div class="yd-tabslider-cities-muenchen"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">München</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Essen">
               <div class="yd-tabslider-cities-essen"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Essen</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Frankfurt am Main">
               <div class="yd-tabslider-cities-frankfurt"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Frankfurt am Main</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="alle Städte">
               <div class="yd-tabslider-cities-empty"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">alle Städte</span>
               </a>
               </li>
               </ul>
               </div>
                     <div class="tab-pane fade" id="Regionen" role="tabpanel" aria-labelledby="Regionen">
               <ul id="states" class="tab_content mt-3 common-links">
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-baden-wuerttemberg" target="_self" title="Baden- Württemberg">
                <span class="tabslider-link-text">Baden- Württemberg</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-bayern" target="_self" title="Bayern">
                <span class="tabslider-link-text">Bayern</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-berlin" target="_self" title="Berlin">
                <span class="tabslider-link-text">Berlin</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-brandenburg" target="_self" title="Brandenburg">
                <span class="tabslider-link-text">Brandenburg</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-bremen" target="_self" title="Bremen">
                <span class="tabslider-link-text">Bremen</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-hamburg" target="_self" title="Hamburg">
                <span class="tabslider-link-text">Hamburg</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-hessen" target="_self" title="Hessen">
                <span class="tabslider-link-text">Hessen</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-mecklenburg-vorpommern" target="_self" title="Mecklenburg-Vorpommern">
                <span class="tabslider-link-text">Mecklenburg-Vorpommern</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-niedersachsen" target="_self" title="Niedersachsen">
                <span class="tabslider-link-text">Niedersachsen</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-nordrhein-westfalen" target="_self" title="Nordrhein-Westfalen">
                <span class="tabslider-link-text">Nordrhein-Westfalen</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-rheinland-pfalz" target="_self" title="Rheinland-Pfalz">
                <span class="tabslider-link-text">Rheinland-Pfalz</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-saarland" target="_self" title="Saarland">
                <span class="tabslider-link-text">Saarland</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-sachsen" target="_self" title="Sachsen">
                <span class="tabslider-link-text">Sachsen</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-sachsen-anhalt" target="_self" title="Sachsen-Anhalt">
                <span class="tabslider-link-text">Sachsen-Anhalt</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-schleswig-holstein" target="_self" title="Schleswig-Holstein">
                <span class="tabslider-link-text">Schleswig-Holstein</span>
               </a>
               </li>
               <li class="list">
               <a class="tabslider-links" href="/lieferservice-thueringen" target="_self" title="Thüringen">
                <span class="tabslider-link-text">Thüringen</span>
               </a>
               </li>
               </ul>
               </div>
                     <div class="tab-pane fade" id="Küchenrichtungen" role="tabpanel" aria-labelledby="Küchenrichtungen"> 
               <ul class="tab_content visible mt-3">
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Berlin">
               <div class="yd-tabslider-Italienisch"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Italienisch</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Hamburg">
               <div class="yd-tabslider-Chinesisch"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Chinesisch</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Köln">
               <div class="yd-tabslider-cities-koeln"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Indisch</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Bremen">
               <div class="yd-tabslider-Griechisch"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Griechisch</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="München">
               <div class="yd-tabslider-Mexikanisch"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Mexikanisch</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Essen">
               <div class="yd-tabslider-Essen"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Essen</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Frankfurt am Main">
               <div class="yd-tabslider-Asiatisch"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Asiatisch</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="alle Städte">
               <div class="yd-tabslider-empty"></div>
               <span class="tabslider-link-text">alle Nationalitäten</span>
               </a>
               </li>
               </ul>
               </div> 
               <div class="tab-pane fade" id="Gerichte" role="tabpanel" aria-labelledby=""> 
               <ul class="tab_content visible mt-3">
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Berlin">
               <div class="yd-tabslider-pizza"><img src="<?php echo base_url(); ?>assets/images/pizza.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Pizza</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Hamburg">
               <div class="yd-tabslider-Burger"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Burger</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Köln">
               <div class="yd-tabslider-Sushi"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Sushi</span>
               </a>
               </li> 
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="München">
               <div class="yd-tabslider-cities-muenchen"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Döner</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Essen">
               <div class="yd-tabslider-Pommes"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Pommes</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Frankfurt am Main">
               <div class="yd-tabslider-Pasta"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Pasta</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="alle Städte">
               <div class="yd-tabslider-cities-Schnitzel"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Schnitzel</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="alle Städte">
               <div class="yd-tabslider-cities-empty"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">alle Städte</span>
               </a>
               </li>
               </ul>
               </div>
               
               
               <div class="tab-pane fade" id="Unsere" role="tabpanel" aria-labelledby=""> 
               <ul class="tab_content visible mt-3">
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Berlin">
               <div class="yd-tabslider-pizza"><img src="<?php echo base_url(); ?>assets/images/pizza.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Pizza</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Hamburg">
               <div class="yd-tabslider-Burger"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Burger</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Köln">
               <div class="yd-tabslider-Sushi"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Sushi</span>
               </a>
               </li> 
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="München">
               <div class="yd-tabslider-cities-muenchen"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Döner</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Essen">
               <div class="yd-tabslider-Pommes"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Pommes</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Frankfurt am Main">
               <div class="yd-tabslider-Pasta"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Pasta</span>
               </a>
               </li> 
               </ul>
               </div>
               
               <div class="tab-pane fade" id="Weitere" role="tabpanel" aria-labelledby=""> 
               <ul class="tab_content visible mt-3">
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Berlin">
               <div class="yd-tabslider-pizza"><img src="<?php echo base_url(); ?>assets/images/pizza.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Pizza</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Hamburg">
               <div class="yd-tabslider-Burger"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Burger</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Köln">
               <div class="yd-tabslider-Sushi"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Sushi</span>
               </a>
               </li> 
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="München">
               <div class="yd-tabslider-cities-muenchen"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Döner</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Essen">
               <div class="yd-tabslider-Pommes"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Pommes</span>
               </a>
               </li>
               <li class="grid">
               <a class="tabslider-links" href="javascript:void();" target="_self" title="Frankfurt am Main">
               <div class="yd-tabslider-Pasta"><img src="<?php echo base_url(); ?>assets/images/berlin.jpg" class="img-fluid"></div>
               <span class="tabslider-link-text">Pasta</span>
               </a>
               </li> 
               </ul>
               </div>
               
               
               </div>
                  </div>
               -->
	</div>
</div>
<!--		   Tab-sec-end-->
<div class="mehr-sec py-60">
	<div class="container">
		<div class="textcontent-text">
			<h3>Mit Eatura schnell und bequem online Essen bestellen</h3>
			<p>Lust auf heiße Pizza, saftige Burger oder frisches Sushi? Jetzt online bestellen und bequem zu Hause
				oder
				im Büro genießen. Finde mit wenigen Klicks Deine Lieblingsrestaurants und wähle ein Gericht Deiner
				Wahl.
				Bezahle einfach und sicher online oder bar. Um volle Flexibilität zu genießen, lade Dir jetzt auch
				die
				App von Eatura herunter und bestelle immer und überall.</p>
			<a href="javascript:void(0);"> &gt; mehr </a>
		</div>
	</div>
</div>
<footer>
	<div class="main-footer py-5">
		<div class="footer-top">
			<div class="footer-logo text-center mb-5">
				<img src="<?php echo base_url(); ?>assets/images/footer-logo.png" class="img-fluid">
			</div>
			<div class="social text-center">
				<h3>Follow us</h3>
				<ul>
					<li><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
					<li><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
					<li><a href="javascript:void(0);"><i class="fab fa-blogger"></i></a></li>
					<li><a href="javascript:void(0);"><i class="fab fa-youtube"></i></a></li>
				</ul>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="footer-content">
							<h3 class="toggle-class">Lieferando.de</h3>
							<ul>
								<li><a href="javascript:void(0);">Kundenservice</a></li>
								<li><a href="javascript:void(0);">Ein Restaurant empfehlen</a></li>
								<li><a href="javascript:void(0);">Ein Restaurant anmelden</a></li>
								<li><a href="javascript:void(0);">Jobs</a></li>
								<li><a href="javascript:void(0);">AGB</a></li>
								<li><a href="javascript:void(0);">Stempelkarten</a></li>
								<li><a href="javascript:void(0);">Datenschutzerklärung</a></li>
								<li><a href="javascript:void(0);">Impressum</a></li>
								<li><a href="javascript:void(0);">Verwendung von Cookies</a></li>
								<li><a href="javascript:void(0);">Werde Affiliate-Partner</a></li>
								<li class="mt-4 follow-us">
									<h3>Follow us</h3>
								</li>
								<li class="follow-us"><a href="javascript:void(0);"><i
												class="fab fa-facebook-f"></i>
										Facebook</a></li>
								<li class="follow-us"><a href="javascript:void(0);"><i class="fab fa-twitter"></i>
										Twitter</a></li>
								<li class="follow-us"><a href="javascript:void(0);"><i class="fab fa-blogger"></i>
										Blog</a>
								</li>
								<li class="follow-us"><a href="javascript:void(0);"><i class="fab fa-youtube"></i>
										Youtube</a></li>
							</ul>
						</div>
						<div class="footer-content mt-4">
							<h3>International</h3>
							<ul>
								<li><a href="javascript:void(0);">Investor Relations</a></li>
								<li><a href="javascript:void(0);">Thuisbezorgd.nl</a></li>
								<li><a href="javascript:void(0);">Takeaway.com - Belgien</a></li>
								<li><a href="javascript:void(0);">Lieferando.de</a></li>
								<li><a href="javascript:void(0);">Pyszne.pl</a></li>
								<li><a href="javascript:void(0);">Lieferando.at</a></li>
								<li><a href="javascript:void(0);">Eat.ch</a></li>
								<li><a href="javascript:void(0);">Takeaway.com - Luxembourg</a></li>
								<li><a href="javascript:void(0);">Takeaway.com - Portugal</a></li>
								<li><a href="javascript:void(0);">Vietnammm.com</a></li>
								<li><a href="javascript:void(0);">Takeaway.com - Bulgarien</a></li>
								<li><a href="javascript:void(0);">Takeaway.com - Rumänien</a></li>
								<li><a href="javascript:void(0);">10bis</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3">
						<div class="footer-content">
							<h3>Essen</h3>
							<ul>
								<li><a href="javascript:void(0);">Essen</a></li>
								<li><a href="javascript:void(0);">Pizza</a></li>
								<li><a href="javascript:void(0);">Mediterran</a></li>
								<li><a href="javascript:void(0);">Grillgerichte</a></li>
								<li><a href="javascript:void(0);">Asiatisch</a></li>
								<li><a href="javascript:void(0);">Sonstige</a></li>
								<li><a href="javascript:void(0);">Mittagessen / Frühstück</a></li>
								<li><a href="javascript:void(0);">Übrige Asiatische</a></li>
								<li><a href="javascript:void(0);">Polnisch</a></li>
								<li><a href="javascript:void(0);">Amerikanisch</a></li>
								<li><a href="javascript:void(0);">Getränke und Eis</a></li>
								<li><a href="javascript:void(0);">Mehr Essen bestellen...</a></li>
							</ul>
						</div>
						<div class="footer-content mt-4">
							<h3>Regionen</h3>
							<ul>
								<li><a href="javascript:void(0);">Baden-Württemberg</a></li>
								<li><a href="javascript:void(0);">Bayern</a></li>
								<li><a href="javascript:void(0);">Berlin</a></li>
								<li><a href="javascript:void(0);">Brandenburg</a></li>
								<li><a href="javascript:void(0);">Bremen</a></li>
								<li><a href="javascript:void(0);">Hamburg</a></li>
								<li><a href="javascript:void(0);">Hessen</a></li>
								<li><a href="javascript:void(0);">Mecklenburg-Vorpommern</a></li>
								<li><a href="javascript:void(0);">Niedersachsen</a></li>
								<li><a href="javascript:void(0);">Nordrhein-Westfalen</a></li>
								<li><a href="javascript:void(0);">Rheinland-Pfalz</a></li>
								<li><a href="javascript:void(0);">Saarland</a></li>
								<li><a href="javascript:void(0);">Sachsen</a></li>
								<li><a href="javascript:void(0);">Sachsen-Anhalt</a></li>
								<li><a href="javascript:void(0);">Schleswig-Holstein</a></li>
								<li><a href="javascript:void(0);">Thüringen</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3">
						<div class="footer-content">
							<h3>Städte</h3>
							<ul>
								<li><a href="javascript:void(0);">Berlin</a></li>
								<li><a href="javascript:void(0);">Hamburg</a></li>
								<li><a href="javascript:void(0);">München</a></li>
								<li><a href="javascript:void(0);">Frankfurt</a></li>
								<li><a href="javascript:void(0);">Essen</a></li>
								<li><a href="javascript:void(0);">Dortmund</a></li>
								<li><a href="javascript:void(0);">Stuttgart</a></li>
								<li><a href="javascript:void(0);">Düsseldorf</a></li>
								<li><a href="javascript:void(0);">Bremen</a></li>
							</ul>
						</div>
						<div class="footer-content mt-4">
							<h3>Neue Lieferdienste</h3>
							<ul>
								<li><a href="javascript:void(0);">Döner & Co 2, Neubrandenburg</a></li>
								<li><a href="javascript:void(0);">Seeterrasse Restaurant, Joachimsthal</a></li>
								<li><a href="javascript:void(0);">Pizzeria & Restaurante Vi.., Köln</a></li>
								<li><a href="javascript:void(0);">Ristorante AlbaChiara, Wöllstadt</a></li>
								<li><a href="javascript:void(0);">Zum Keglerheim, Hasselroth</a></li>
								<li><a href="javascript:void(0);">Brandos, Plochingen</a></li>
								<li><a href="javascript:void(0);">Trattoria La Piazetta da .., Berlin</a></li>
								<li><a href="javascript:void(0);">Fame Pizza, Bad Laasphe</a></li>
								<li><a href="javascript:void(0);">Pizza Zaziano, Norderstedt</a></li>
								<li><a href="javascript:void(0);">Sangeet indisches Restaur.., Penzberg</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-3">
						<div class="footer-content">
							<h3>Partner</h3>
							<ul>
								<li><a href="javascript:void(0);">Essen bestellen</a></li>
								<li><a href="javascript:void(0);">Sushi bestellen</a></li>
								<li><a href="javascript:void(0);">Vapiano</a></li>
								<li><a href="javascript:void(0);">Call a Pizza</a></li>
								<li><a href="javascript:void(0);">Nordsee</a></li>
								<li><a href="javascript:void(0);">Burger King</a></li>
								<li><a href="javascript:void(0);">McDonald's</a></li>
								<li><a href="javascript:void(0);">BurgerMe</a></li>
								<li><a href="javascript:void(0);">Sushi Circle</a></li>
								<li><a href="javascript:void(0);">Dean & David</a></li>
								<li><a href="javascript:void(0);">Yoko Sushi</a></li>
								<li><a href="javascript:void(0);">Freddy Fresh</a></li>
								<li><a href="javascript:void(0);">Pizza Max</a></li>
								<li><a href="javascript:void(0);">Pizza Hut</a></li>
								<li><a href="javascript:void(0);">Gutschein</a></li>
								<li><a href="javascript:void(0);">Domino's Pizza</a></li>
								<li><a href="javascript:void(0);">Prämienshop</a></li>
								<li><a href="javascript:void(0);">Ketten</a></li>
								<li><a href="javascript:void(0);">Foodwiki</a></li>
								<li><a href="javascript:void(0);">Coca-Cola MealDeals</a></li>
								<li><a href="javascript:void(0);">Takeaway Pay (B2B)</a></li>
							</ul>
						</div>
					</div>
				</div>
				<hr class="mt-5">
			</div>
		</div>
		<div class="container mt-5">
			<ul>
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
	<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>

	<!--		Header search  popup-->
	<div class="modal fade rounded-0 show" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
		 aria-hidden="true" id="search-pop-header">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<h2 class="modal-title">Lieferadresse eingeben</h2>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<form id="pincodeFORM" action="<?php echo base_url('/'); ?>" method="post" autocomplete="off">
						<div class="search-location form-group mb-0"><i class="fa fa-map-marker-alt"></i><input
									class="form-control form-cstm" id="modal-autocomplete" type="text" name="pincode"
									autocomplete="off"
									placeholder="Enter Your Pincode"
									value="<?= $this->input->cookie('pincode', true) ?>"
							>
						</div>
						<button type="submit" class="btn btn-search">Anzeigen</button>
					</form>

				</div>
			</div>
		</div>
	</div>
	<!--		  end of Header search popup-->

	<script>
		function autocomplete(inp, arr) {
			/*the autocomplete function takes two arguments,
			the text field element and an array of possible autocompleted values:*/
			var currentFocus;
			/*execute a function when someone writes in the text field:*/
			inp.addEventListener("input", function (e) {
				var a, b, i, val = this.value;
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
						/*make the matching letters bold:*/
						b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
						b.innerHTML += arr[i].substr(val.length);
						/*insert a input field that will hold the current array item's value:*/
						b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
						/*execute a function when someone clicks on the item value (DIV element):*/
						b.addEventListener("click", function (e) {
							/*insert the value for the autocomplete text field:*/
							inp.value = this.getElementsByTagName("input")[0].value;
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
			}

			/*execute a function when someone clicks in the document:*/
			document.addEventListener("click", function (e) {
				closeAllLists(e.target);
			});
		}

		/*An array containing all the pincode:*/
		<?php if(!empty($pincodes)){?>
		var countries =<?php echo json_encode($pincodes) . ';';
		}else{?>
		var countries = [''];
		<?php }?>

		autocomplete(document.getElementById("myInput"), countries);
		autocomplete(document.getElementById("modal-autocomplete"), countries);
	</script>
	<script>


		$('#slide-funk').owlCarousel({
			margin: 20,
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1, loop: true,
					nav: true,
					dots: true,
				},
				1001: {
					items: 3,
					nav: false,
				}
			}
		})
		$('#slide-deliver').owlCarousel({
			margin: 20,
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1, loop: true,
					nav: true,
					dots: true,
				},
				1001: {
					items: 3,
					nav: false,
				}
			}
		})

		$('.footer-content>h3').click(function () {
			$('.footer-content h3.toggle-class').removeClass('toggle-class');
			$(this).addClass('toggle-class');
		});

	</script>
	<script>
		new WOW().init();
	</script>
</footer>
<!--	End of Footer section-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	

<script src="<?php echo base_url() ?>assets/js/jquery.toast.js"></script>
<?php if ($this->session->flashdata('pin_code_not_found')) { ?>
	<script type="text/javascript">
		swal({title: "Error",text: '<?php echo $this->session->flashdata('pin_code_not_found');?>',icon: "error",buttons: false,timer: 3000});
	</script>
<?php } ?>
</body>
</html>


