<?php

	print_r($_POST);
	
	print_r($_FILES);
	
	// Make sure the title is valid
	if (strlen($_POST['title']) <= 3 ) {
		die('The title was too short.');
	}
	
	// Make sure the file type is valid (warn)
	if ($_FILES['photo1']['type'] != 'image/jpg') {
		echo 'Warning: The main photo file type was not JPG.';
	}
	
	// Set the product id name
	$id = $_POST['title'];
	
	// Write the ini file
	
	// Figure out the extension
	$_FILES['photo1']['extension'] = pathinfo($_FILES['photo1']['name'], PATHINFO_EXTENSION);
	
	// Move the file into place
	move_uploaded_file($_FILES['photo1']['tmp_name'], "$id-001." . $_FILES['photo1']['extension']);
	
?>
