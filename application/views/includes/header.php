<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
	<link rel="stylesheet"
		  href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/toaster.css">
	<!-- <link rel="icon" href="<?php echo base_url(); ?>assets/images/fav.png" type="image/png" sizes="20x20"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

	<script>
		const apiURL = '<?php echo SITEURL; ?>';
		const siteURL = '<?php echo base_url(); ?>';
	</script>
	<title></title>

	<style>

		.autocomplete-items {
			position: absolute;
			border: 1px solid #d4d4d4;
			border-bottom: none;
			border-top: none;
			z-index: 9;
			top: 49px;
			left: 0;
			right: 107px;
			text-align: left;
		}

		button.btn.btn-search {
			vertical-align: 6px;
		}

		.autocomplete-items div {
			padding: 10px;
			cursor: pointer;
			background-color: #fff;
			border-bottom: 1px solid #d4d4d4;
		}

		/*when hovering an item:*/
		.autocomplete-items div:hover {
			background-color: #e9e9e9;
		}

		/*when navigating through the items using the arrow keys:*/
		.autocomplete-active {
			background-color: DodgerBlue !important;
			color: #ffffff;
		}
	</style>
</head>
<body >
<header class="main-header">
	<div class="topbar-container container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="topbar__logo">
					<?php if($this->uri->segment(2) == "place-order") { ?>
						<a href="<?=site_url().$this->input->cookie('currentRestaurant', TRUE)?>" class="back"><i class="fa fa-chevron-left"></i></a>
					<?php } ?>
					<!-- <a href="javascript:window.history.go(-1)" class="logo-sec">
						<img src="<?php echo base_url(); ?>assets/images/logo.png" class="img-fluid large-logo">
					</a> -->

				</div>
			</div>
			<div class="col-md-4">
				<div class="topbar__title-container">
					<?php
					if ($this->input->cookie('delivery_type', true) != "") {
						?>
						<a class="topbar__title" data-toggle="modal"
						   data-backdrop="static" data-keyboard="false"
						   data-target="#search-pop-header">
						   <?php

						   if( $this->input->cookie('delivery_type', true) == "delivery")
								echo $this->input->cookie('pincode', true);
								else
								echo "Abholen"
						   ?>

						</a>
					<?php } else { ?>
						<a class="topbar__title" data-toggle="modal" data-backdrop="static" data-keyboard="false"
						   data-target="#search-pop-header"> Wo möchtest Du
							Essen
							bestellen?</a>
					<?php }
					?>


				</div>
			</div>
			<div class="col-md-4">
				<div class="d-flex menu-container">
					<div class="icon-country">
						<span><img src="<?php echo base_url(); ?>assets/images/flag-ge.png" class="img-fluid"></span>
					</div>
					<div class="menu-right">
						<i class="fas fa-bars" data-toggle="modal" data-target="#menu-pop"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
<?php
function formatPrice($amount)
{
	$amount = number_format($amount, 2);
	return str_replace(".", ",", $amount);
}

function substrwords($text, $maxchar, $end = '...')
{

	if (strlen(trim($text)) == 0) {
		return $text;
	}
	if (strlen($text) > $maxchar || $text == '') {
		$words = preg_split('/\s/', $text);
		$output = '';
		$i = 0;
		while (1) {
			$length = strlen($output) + strlen($words[$i]);
			if ($length > $maxchar) {
				break;
			} else {
				$output .= " " . $words[$i];
				++$i;
			}
		}
		$output .= $end;
	} else {
		$output = $text;
	}
	return $output;
}

?>
<script>
	let deliveryType = '<?= $this->input->cookie('delivery_type', true)?>';
</script>
