<?php

require 'store.php';

class AdStore extends Store {

	// Construct
	public function __construct() {
		parent::__construct();
	}
	
	// Add meta data and trash a record
	public function trash($id, $meta) {
		$old = $this->init['path']['data'] . $id . $this->init['data']['ext'];
		$new = $this->init['path']['trash'] . $id . $this->init['data']['ext'];
		// Make sure the file exists
		if (!file_exists($file)) {
			return false;
		} else {
			// Read the old file
			$data = file_get_contents($old);
			// Add the meta data
			$data = array_merge($data, $meta);
			// Write a new file in the old location
			file_put_contents($old, $data);
			// Trash the file
			parent::trash($data);
		}
	}

}

?>
