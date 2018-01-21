<?php

$cnameErr = $emailErr = $phoneErr = $messageErr = $databaseErr = $urlErr = "";
$cname = $email = $phone = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["cname"])) {
		$cnameErr = "Name is required";
	} else {
		$cname = test_input($_POST["cname"]);
		if (!preg_match("/^[a-zA-Z ]*$/",$cname)) {
			$cnameErr = "Only letters and white space allowed";
		}
	}

	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	} else {
		$email = test_input($_POST["email"]);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
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

	if (empty($_POST["message"])) {
		$messageErr = "Message is required";
	} else {
		$message = test_input($_POST["message"]);
		if (!preg_match("/^[a-zA-Z0-9\s]*$/",$message)) {
			$messageErr = "Invalid message format";
		}
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if (empty($cnameErr) && empty($emailErr) && empty($phoneErr) && empty($messageErr) && !empty($cname) && !empty($email) && !empty($phone) && !empty($message)) {

	$wpdb->insert(
		'pr_contact_us',
		array(
			'name' => (string)$cname,
			'phone' => (string)$phone,
			'email' => (string)$email,
			'message' => (string)$message
		)
	);

	if ($wpdb->insert_id) {
		header('Location: get_site_url()/success/');
	} else {
		$databaseErr = 'Internal error';
		header('Location: get_site_url()/failure/?' . 'databaseErr=' . $databaseErr);
	}
} else {
	$errorMsg = ['cnameErr' => $cnameErr, 'emailErr' => $emailErr, 'phoneErr' => $phoneErr, 'messageErr' => $messageErr];
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