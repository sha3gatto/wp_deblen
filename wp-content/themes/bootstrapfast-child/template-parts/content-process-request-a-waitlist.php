<?php

include('validation.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$valid = validation($_POST, 'waitlist');
}

$urlErr = '';

if (empty($valid['cnameErr']) && empty($valid['phoneErr']) && empty($valid['propertyAddressErr']) && !empty($valid['cname']) && !empty($valid['phone']) && !empty($valid['propertyAddress'])) {

	$wpdb->insert(
		'pr_waitlist',
		array(
			'name' => (string)$valid['cname'],
			'phone' => (string)$valid['phone'],
			'address' => (string)$valid['propertyAddress']
		)
	);

	if ($wpdb->insert_id) {
		header('Location: get_site_url()/success/');
	} else {
		$valid['databaseErr'] = 'Internal error';
		header('Location: get_site_url()/failure/?' . 'databaseErr=' . $valid['databaseErr']);
	}
} else {
	$errorMsg = ['cnameErr' => $valid['cnameErr'], 'phoneErr' => $valid['phoneErr'], 'propertyAddressErr' => $valid['propertyAddressErr']];
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