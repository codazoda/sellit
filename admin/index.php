<?php

	// Include the setup
	include('../init.php');

	// Test password
	if ($_SERVER['PHP_AUTH_USER'] == $username and 
		$_SERVER['PHP_AUTH_PW'] == $password) {

		// Set a cookie
		setcookie('admin', $token, time() + 60*60*24, '/');

		// Redirect
		header('Location: ../');
	    	
	} else {

		// Ask for password
		header('WWW-Authenticate: Basic realm="HTTP Auth Test"');
		
	}

?>