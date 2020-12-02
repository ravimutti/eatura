<?php

function getCurl($url, $data) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = json_decode(curl_exec($ch));

	curl_close($ch);
	return $response;
}

function getMyOrders($data) {
	$url = SITEURL . "myOrder";
	return getCurl($url, $data);
}

function getAddressByUserId($data) {
	$url = SITEURL . "getAddress";
	return getCurl($url, $data);
}