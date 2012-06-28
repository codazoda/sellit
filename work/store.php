<?php

class Store {

	public $init;

	// Constructor 
	public function __construct() {
		// Parse the ini file
		$this->init = parse_ini_file('store.ini', true);
	}
	
	// Create a new ad
	public function create($data) {
		// Create an ID
		$id = $this->idCreate();
		// Write the data file
		file_put_contents( $this->init['path']['data'] . $id . $this->init['data']['ext'] );
	}
	
	// Read an existing ad
	public function read($id) {
		return file_get_contents( $this->init['path']['data'] . $id . $this->init['data']['ext'] );
	}
	
	// Update an existing ad
	public function update($id, $data) {
		$file = $this->init['path']['data'] . $id . $this->init['data']['ext'];
		// If the file doesn't exist
		if (!file_exists($file)) {
			// Ooops, the file didn't exist
			return false;
		} else {
			// Replace the existing contents with the data
			return file_put_contents($file, $data);
		}
	}
	
	// Delete an existing ad
	public function delete($id) {
		$file = $this->init['path']['data'] . $id . $this->init['data']['ext'];
		// If the file doesn't exist
		if (!file_exists($file)) {
			// Ooops, the file didn't exist
			return false;
		} else {
			// Delete the file
			unlink($file);
			return true;
		}
	}

	// Move the file to the trash
	public function trash($id) {
		$old = $this->init['path']['data'] . $id . $this->init['data']['ext'];
		$new = $this->init['path']['trash'] . $id . $this->init['data']['ext'];
		// If the file doesn't exist
		if (!file_exists($file)) {
			// Ooops, the file didn't exist
			return false;
		} else {
			// Move the file by renaming it
			return rename($old, $new);
		}
	}
	
	// Create a random id number
	private function idCreate() {
		while ($id = '') {
			// Create a random string
			$str = substr( str_shuffle( $this->init['id']['chars'] ), 0, $this->init['id']['length'] );
			// If the file exists
			if ( file_exists( $this->init['path']['data'] . $str . $this->init['data']['ext'] ) ) {
				return false;
			}
		}
	}

}

?>
