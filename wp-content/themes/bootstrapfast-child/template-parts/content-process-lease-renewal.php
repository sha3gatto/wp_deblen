<?php

$cnameErr = $phoneErr = $propertyAddressErr = $renewalPeriodErr = $databaseErr = $urlErr = "";
$cname = $phone = $propertyAddress = $renewalPeriod = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["cname"])) {
		$cnameErr = "Name is required";
	} else {
		$cname = test_input($_POST["cname"]);
		if (!preg_match("/^[a-zA-Z ]+$/",$cname)) {
			$cnameErr = "Only letters and white space allowed";
		}
	}

	if (empty($_POST["phone"])) {
		$phoneErr = "Phone is required";
	} else {
		$phone = test_input($_POST["phone"]);
		$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
		if (!preg_match($regex, $phone)) {
			$phoneErr = "Invalid phone format";
		}
	}

	if (empty($_POST["property_address"])) {
		$propertyAddressErr = "Property address is required";
	} else {
		$propertyAddress = test_input($_POST["property_address"]);
		if (!preg_match("/^[a-zA-Z0-9\s\S]+$/",$propertyAddress)) {
			$propertyAddressErr = "Invalid property address format";
		}
	}

	if (empty($_POST["renewal_period"])) {
		$renewalPeriodErr = "Lease renewal is required";
	} else {
		$renewalPeriod = test_input($_POST["renewal_period"]);
		if (!preg_match("/^[0-9]+$/",$renewalPeriod)) {
			$renewalPeriodErr = "Invalid lease renewal format";
		}
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if (empty($cnameErr) && empty($phoneErr) && empty($propertyAddressErr) && empty($renewalPeriodErr) && !empty($cname) && !empty($phone) && !empty($propertyAddress) && !empty($renewalPeriod)) {

	$wpdb->insert(
		'pr_lease_renewal',
		array(
			'period' => (string)$renewalPeriod,
			'name' => (string)$cname,
			'phone' => (string)$phone,
			'address' => (string)$propertyAddress
		)
	);

	if ($wpdb->insert_id) {
		header('Location: get_site_url()/success/');
	} else {
		$databaseErr = 'Internal error';
		header('Location: get_site_url()/failure/?' . 'databaseErr=' . $databaseErr);
	}
} else {
	$errorMsg = ['cnameErr' => $cnameErr, 'phoneErr' => $phoneErr, 'propertyAddressErr' => $propertyAddressErr, 'renewalPeriodErr' => $renewalPeriodErr];
	foreach ($errorMsg as $k => $v) {
		if (!empty($v)) {
			$urlErr .= $k .'='. $v . '&';
		}
	}
	$l = strlen($urlErr);
	$urlErr = substr($urlErr, 0, $l-1);
	header('Location: get_site_url()/failure/?' . $urlErr);
}
?>