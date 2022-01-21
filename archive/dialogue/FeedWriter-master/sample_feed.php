<?php
	
	
// You should use an autoloader instead of including the files directly.
// This is done here only to make the examples work out of the box.
include 'Item.php';
include 'Feed.php';
include 'RSS2.php';
include 'InvalidOperationException.php';

	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/mysqldb.class.php');		
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/utilities.class.php');		


date_default_timezone_set('UTC');
use \FeedWriter\RSS2;
/**
 * Copyright (C) 2008 Anis uddin Ahmad <anisniit@gmail.com>
 * Copyright (C) 2013 Michael Bemmerl <mail@mx-server.de>
 *
 * This file is part of the "Universal Feed Writer" project.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
 
 
// Creating an instance of RSS2 class.
$TestFeed = new RSS2();
// Setting some basic channel elements. These three elements are mandatory.
$TestFeed->setTitle('ServeBartendCook  - Restaurant and Hospitality Jobs');
$TestFeed->setLink('https://servebartendcook.com');
$TestFeed->setDescription('Find local hospitality jobs or hire staff! Quick, easy job search and posting for servers, bartenders, cooks.  Job Matching for restaurant, bar positions.');
// Image title and link must match with the 'title' and 'link' channel elements for RSS 2.0,
// which were set above.

//$TestFeed->setImage('https://upload.wikimedia.org/wikipedia/commons/thumb/d/d9/Rss-feed.svg/256px-Rss-feed.svg.png', 'Testing & Checking the Feed Writer project', 'https://github.com/mibe/FeedWriter');
// Use the setChannelElement() function for other optional channel elements.
// See http://www.rssboard.org/rss-specification#optionalChannelElements
// for other optional channel elements. Here the language code for American English is used for the
// optional "language" channel element.

$TestFeed->setChannelElement('language', 'en-US');
// The date when this feed was lastly updated. The publication date is also set.
$TestFeed->setDate(time());
$TestFeed->setChannelElement('pubDate', date(\DATE_RSS, strtotime('2017-04-02')));
// By using arrays as channelElement values, can be set element like this
//  <skipDays>
//      <day>Saturday</day>
//      <day>Sunday</day>
// </skipDays>
// Thanks to - Peter Fargaš <peter.fargas.work@googlemail.com>

//$TestFeed->setChannelElement("skipDays", array('day'=>['Saturday','Sunday']));
// You can add additional link elements, e.g. to a PubSubHubbub server with custom relations.
// It's recommended to provide a backlink to the feed URL.

$TestFeed->setSelfLink('https://servebartendcook.com/FeedWriter-master/sample_feed.php');

//$TestFeed->setAtomLink('http://pubsubhubbub.appspot.com', 'hub');
// You can add more XML namespaces for more custom channel elements which are not defined
// in the RSS 2 specification. Here the 'creativeCommons' element is used. There are much more

// available. Have a look at this list: http://feedvalidator.org/docs/howto/declare_namespaces.html
//$TestFeed->addNamespace('creativeCommons', 'http://backend.userland.com/creativeCommonsRssModule');
//$TestFeed->setChannelElement('creativeCommons:license', 'http://www.creativecommons.org/licenses/by/1.0');
// If you want you can also add a line to publicly announce that you used
// this fine piece of software to generate the feed. ;-)

$TestFeed->addGenerator();
// Here we are done setting up the feed. What's next is adding some feed items.
// Create a new feed item.

//get open jobs
	$database = new Database;
	$database->query("SELECT * FROM jobs, stores, jobs_specialties
								WHERE  jobs.job_status = :job_status
								AND jobs.storeID = stores.storeID
								AND jobs_specialties.jobID = jobs.jobID
								AND jobs.expiration_date > NOW()
								ORDER BY jobs.date_created DESC ");							
	$database->bind(':job_status', 'Open');			
	$job_list  = $database->resultset();				


$utilities = new Utilities;
foreach($job_list as $row) {
	
	$jobID							= $row['jobID'];
	$hash							= $row['public_hash'];
	$store_name					= $row['name'];
	$store_zip						= $row['zip'];
	$title		 						= $row['title'];
	$main_skill		 			= $row['specialty'];
	$date_created 				= $row['date_created'];
	
	$city_state = $utilities->get_city_state($store_zip);
	
		switch($main_skill) {
			case "Bartender":
				$og_title = "Bartender Position Available";
				$og_description = $title." @ ".$store_name;		
				$meta_title = "Hiring Bartender Position - ".$store_name;		
			break;
			
			case "Manager":
				$og_title = "Management Position Available";
				$og_description = $title." @ ".$store_name;				
				$meta_title = "Hiring Management Position - ".$store_name;				
			break;
			
			case "Kitchen":
				$og_title = "Kitchen Position Available";
				$og_description = $title." @ ".$store_name;	
				
				if (strpos($title, 'Line Cook') !== false) {
					$meta_title = "Hiring Line Cook Position - ".$store_name;				
				} elseif (strpos($title, 'Prep') !== false) {
					$meta_title = "Hiring Prep Cook Position - ".$store_name;					
				} elseif (strpos($title, 'Dish') !== false) {
					$meta_title = "Hiring Dish Position - ".$store_name;					
				} else {
					$meta_title = "Hiring Kitchen Position - ".$store_name;										
				}
				
			break;
			
			case "Server":
				$og_title = "Server Position Available";
				$og_description = $title." @ ".$store_name;				
				$meta_title = "Hiring Server Position - ".$store_name;				
			break;
									
			case "Bus":
				$og_title = "Bus Position Available";
				$og_description = $title." @ ".$store_name;				
				$meta_title = "Hiring Bus Position - ".$store_name;				
			break;

			case "Host":
				$og_title = "Host Position Available";
				$og_description = $title." @ ".$store_name;				
				$meta_title = "Hiring Host Position - ".$store_name;				
			break;						
		}
		
		$meta_description = $store_name." in ".$city_state['city'].", ".$city_state['state']." is hiring - ".$title;					
	

	$newItem = $TestFeed->createNewItem();

	// Add basic elements to the feed item
	// These are again mandatory for a valid feed.
	$newItem->setTitle($meta_description);
	$newItem->setLink('https://servebartendcook.com/public_listing_new.php?ID='.$jobID.'&ref='.$hash);
	$newItem->setDescription($meta_description);

// The following method calls add some optional elements to the feed item.
// Let's set the publication date of this item. You could also use a UNIX timestamp or
// an instance of PHP's DateTime class.
	$newItem->setDate($date_created);

// You can also attach a media object to a feed item. You just need the URL, the byte length
// and the MIME type of the media. Here's a quirk: The RSS2 spec says "The url must be an http url.".
// Other schemes like ftp, https, etc. produce an error in feed validators.
//$newItem->addEnclosure('http://upload.wikimedia.org/wikipedia/commons/4/49/En-us-hello-1.ogg', 11779, 'audio/ogg');

// If you want you can set the name (and email address) of the author of this feed item.
//$newItem->setAuthor('Anis uddin Ahmad', 'admin@ajaxray.com');

// You can set a globally unique identifier. This can be a URL or any other string.
// If you set permaLink to true, the identifier must be an URL. The default of the
// permaLink parameter is false.
//$newItem->setId('http://example.com/URL/to/article', true);

// Use the addElement() method for other optional elements.
// This here will add the 'source' element. The second parameter is the value of the element
// and the third is an array containing the element attributes.
//$newItem->addElement('source', 'Mike\'s page', array('url' => 'http://www.example.com'));

	// Now add the feed item to the main feed.
	$TestFeed->addItem($newItem);

}

// Another method to add feeds items is by using an array which contains key-value pairs
// of every item element. Elements which have attributes cannot be added by this way.
/*
$newItem = $TestFeed->createNewItem();
$newItem->addElementArray(array('title'=> 'The 2nd item', 'link' => 'http://www.google.com', 'description' => 'Just another test.'));
$TestFeed->addItem($newItem);
*/

// OK. Everything is done. Now generate the feed.
// Then do anything (e,g cache, save, attach, print) you want with the feed in $myFeed.
$myFeed = $TestFeed->generateFeed();

// If you want to send the feed directly to the browser, use the printFeed() method.
$TestFeed->printFeed();