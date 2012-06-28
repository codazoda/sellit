<?php

	// Include the setup
	include 'init.php';

	// If a category was passed, us that or home
	if (isset($_GET['cat'])) {
		$cat = $_GET['cat'];
	} else {
		$cat = 'Home';
	}

	// Load the list of categories
	$categories = loadCategories();

	// Load the list of items
	$items = loadItems($categories, $cat);

	// Include the HTML view
	include 'view/index.php';


	/**
	 * Load a specific cache.  If the cache is old,
	 * refresh it.
	 */
	function loadCategories() {
		// TODO: Look at the file date
		$hoursOld = 100;
		// If it's older than we would like
		if ($hoursOld > 24) {
			// Refresh the cache
			buildCategoryCache();
		}
		// Load the cache file
		$cache = json_decode(file_get_contents("./cache/cats.json"), true);
		// Sort the array
		ksort($cache);
		// If there is a home category
		if (isset($cache['Home'])) {
			// Save the values
			$top['Home'] = $cache['Home'];
			// Remove the homes category
			unset($cache['Home']);
			// Add it back to the top
			$sorted = $top + $cache;
		}
		return $sorted;
	}

	/**
	 * Load a list of items in a particular category
	 * into an array.
	 */
	function loadItems($categories, $cat) {
		// Loop through the filenames in this category
		if (isset($categories[$cat])) {
			foreach($categories[$cat] as $id) {
				// Load that file
				$items[] = array_merge(array('id' => $id), parse_ini_file("./data/$id.ini"));
			}
		}
		return $items;
	}

	/**
	 * Setup the category index array.  Generate a cached
	 * json data file that can be used elsewhere without
	 * reading through the whole directory.
	 */
	function buildCategoryCache() {
		// Open the directory
		$dir = dir("./data");
		// Loop through the files
		while (false !== ($file = $dir->read())) {
			// Grab the file extension
			$ext = substr($file, -4, 4);
			// If this is an ini file
			if ($ext == '.ini') {
				// Grab the data
				$item = parse_ini_file('./data/' . $file);
				// Split the categories
				$cats = explode(',', $item['cat']);
				// Loop through the categories
				foreach($cats as $cat) {
					// Remove whitespace
					$cat = trim($cat);
					// Strip the extension
					$id = substr($file, 0, strlen($file)-4);
					// Add this id to the cat array
					$index[$cat][] = $id;
				}
			}
		}
		// Serialize the index
		$json = json_encode($index);
		// Save the index
		file_put_contents('./cache/cats.json', $json);
		// Close the directory
		$dir->close();
	}

?>
