<?php
	
// The URL to connect with (note the /api/ that's needed and note it's person rather than party)
// SEE: http://capsulecrm.com/help/page/api_gettingstarted/
/*
$capsulepage =  'https://api.capsulecrm.com/api/v2/parties';

$person = array('person' =>
    array('title' => 'Mr',
          'firstName' => 'Test12',
          'lastName' => 'Tester12',
          'jobTitle' => 'Chairman',
          'organisationName' => 'Big Company',
          'about' => 'Testing'));

$person_json = json_encode($person);

// The URL to connect with (note the /api/ that's needed and note it's person rather than party)
// SEE: http://capsulecrm.com/help/page/api_gettingstarted/
$capsulepage =  'https://api.capsulecrm.com/api/v2/person';

// Initialize the session and return a cURL handle to pass to other cURL functions.
$ch = curl_init($capsulepage);

// Set appropriate options NB these are the minimum necessary to achieve a post with a useful response
// ...can and should add more in a real application such as
// timeout CURLOPT_CONNECTTIMEOUT
// and useragent CURLOPT_USERAGENT
// replace 1234567890123456789 with your own API token from your user preferences page
$options = array(CURLOPT_USERPWD => '66IeGH3PlDAhJPt2bvhsJVjA+yjjUtouEKJgMfJjFFmKe4KLLCQJQlCj0iaMArfn:x',
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $person_json
                );
curl_setopt_array($ch, $options);

// Do the POST and collect the response for future printing etc., then close the session
$response = curl_exec($ch);
$responseInfo = curl_getinfo($ch);
curl_close($ch);

echo $response;
*/

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,'https://api.capsulecrm.com/api/v2/party');
curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_USERPWD, '66IeGH3PlDAhJPt2bvhsJVjA+yjjUtouEKJgMfJjFFmKe4KLLCQJQlCj0iaMArfn:x');
$result=curl_exec ($ch);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);   //get status code
curl_close ($ch);

echo $status_code;

?>