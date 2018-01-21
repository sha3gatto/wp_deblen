<?php

include('validation.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$valid = validation($_POST, 'contact_us');
}

$urlErr = '';

if (empty($valid['cnameErr']) && empty($valid['emailErr']) && empty($valid['phoneErr']) && empty($valid['messageErr']) && !empty($valid['cname']) && !empty($valid['email']) && !empty($valid['phone']) && !empty($valid['message'])) {

	$wpdb->insert(
		'pr_contact_us',
		array(
			'name' => (string)$valid['cname'],
			'phone' => (string)$valid['phone'],
			'email' => (string)$valid['email'],
			'message' => (string)$valid['message']
		)
	);

	if ($wpdb->insert_id) {
		header('Location: get_site_url()/success/');
	} else {
		$valid['databaseErr'] = 'Internal error';
		header('Location: get_site_url()/failure/?' . 'databaseErr=' . $valid['databaseErr']);
	}
} else {
	$errorMsg = ['cnameErr' => $valid['cnameErr'], 'emailErr' => $valid['emailErr'], 'phoneErr' => $valid['phoneErr'], 'messageErr' => $valid['messageErr']];
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