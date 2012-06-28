<?php

	// Load the RSS feed
	$xml = file_get_contents('http://www.ksl.com/resources/classifieds/rss_.xml?nid=231&category=353&viewNumResults=100');
	
	// Create a Simple XML element
	$ads = new SimpleXMLElement($xml);
	
	foreach ($ads->channel->item as $item) {
		
		// Grep out the SID
		preg_match('/.*ad=([0-9]*).*/', $item->link, $matches);
		$sid = $matches[1];
		
		// TODO: Grab the ad itself
		// TODO: Drop the filter
		// TODO: Grab the large image(s)
		// TODO: Grab the phone number
		
		// Show the details
		echo $item->title . "\n";
		echo $item->link . "\n";
		echo $item->description . "\n";
		echo $sid . "\n\n";

	
	}
	
	print_r($ads);

?>
