<?php

// Prompt for a password
if ($_SERVER['PHP_AUTH_USER'] != 'admin' && $_SERVER['PHP_AUTH_PW'] != 'admin') {
    header('WWW-Authenticate: Basic realm="HTTP Auth Test"');
}

// Setup the filename
if (isset($_REQUEST['id'])) {
	// Set the edit filename
	$fn = "data/{$_REQUEST['id']}.ini";
	// Load the default
	$default = readfile($fn);
} else {
	// Pick a random id
	$id = rand(10000,99999);
	// Set the filename
	$fn = "data/$id.ini";
}

// If data was posted
if (isset($_POST['content'])) {
    $content = stripslashes($_POST['content']);
    $fp = fopen($fn,"w") or die ("Error opening file in write mode!");
    fputs($fp,$content);
    fclose($fp) or die ("Error closing file!");
}

?>

<form action="edit.php" method="post">
    <textarea rows="25" cols="40" name="content"><?php readfile('default.ini'); ?></textarea><br>
    <input type="submit" value="Save">
</form>
