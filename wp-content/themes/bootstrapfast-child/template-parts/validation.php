<?php
function validation($post, $type) {

	$valid = ['cnameErr'=>'','phoneErr'=>'','propertyAddressErr'=>'','problemErr'=>'','renewalPeriodErr'=>'','databaseErr'=>'','emailErr'=>'','messageErr'=>'','cname'=>'','phone'=>'','propertyAddress'=>'','problem'=>'','renewalPeriod'=>'','email'=>'','message'=>''];

	if (empty($post["cname"])) {
		$valid['cnameErr'] = "Name is required";
	} else {
		$valid['cname'] = test_input($post["cname"]);
		if (!preg_match("/^[a-zA-Z ]+$/",$valid['cname'])) {
			$valid['cnameErr'] = "Only letters and white space allowed";
		}
	}

	if (empty($post["phone"])) {
		$valid['phoneErr'] = "Phone is required";
	} else {
		$valid['phone'] = test_input($post["phone"]);
		$regex = "/^(\d[\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i";
		if (!preg_match($regex, $valid['phone'])) {
			$valid['phoneErr'] = "Invalid phone format";
		}
	}

	if (empty($post["property_address"])) {
		$valid['propertyAddressErr'] = "Property address is required";
	} else {
		$valid['propertyAddress'] = test_input($post["property_address"]);
		if (!preg_match("/^[a-zA-Z0-9\s\S]+$/",$valid['propertyAddress'])) {
			$valid['propertyAddressErr'] = "Invalid property address format";
		}
	}

	if (empty($post["problem"]) && $type === 'repair_notice') {
		$valid['problemErr'] = "Problem description is required";
	} else {
		$valid['problem'] = test_input($post["problem"]);
		if (!preg_match("/^[a-zA-Z0-9 ]+$/",$valid['problem'])) {
			$valid['problemErr'] = "Invalid problem description format";
		}
	}

	if (empty($_POST["renewal_period"]) && $type === 'lease_renewal') {
		$valid['renewalPeriodErr'] = "Lease renewal is required";
	} else {
		$valid['renewalPeriod'] = test_input($_POST["renewal_period"]);
		if (!preg_match("/^[0-9]+$/",$valid['renewalPeriod'])) {
			$valid['renewalPeriodErr'] = "Invalid lease renewal format";
		}
	}

	if (empty($_POST["email"]) && $type === 'contact_us') {
		$valid['emailErr'] = "Email is required";
	} else {
		$valid['email'] = test_input($_POST["email"]);
		if (!filter_var($valid['email'], FILTER_VALIDATE_EMAIL)) {
			$valid['emailErr'] = "Invalid email format";
		}
	}

	if (empty($_POST["message"]) && $type === 'contact_us') {
		$valid['messageErr'] = "Message is required";
	} else {
		$valid['message'] = test_input($_POST["message"]);
		if (!preg_match("/^[a-zA-Z0-9\s]*$/",$valid['message'])) {
			$valid['messageErr'] = "Invalid message format";
		}
	}
	return $valid;
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>