<?php

	// Include the admin settings
	include 'settings.php';

	// Create a token
	$token = md5(date('Y-m-d') . ' ' . $password);

?>