There are an error:
<?php

$err = ['databaseErr', 'cnameErr', 'emailErr', 'phoneErr', 'messageErr', 'propertyAddressErr', 'problemErr', 'renewalPeriodErr'];
$strErr = '';

foreach ($_GET as $k => $v) {
	if (in_array($k, $err)) {
		$strErr .= $v . ', ';
	}	
}
$l = strlen($strErr);
$strErr = substr($strErr, 0, $l-2);
echo $strErr;
?>