<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/mysqldb.class.php');		
	require_once($_SERVER['DOCUMENT_ROOT'].'/classes/utilities.class.php');		
	require_once($_SERVER['DOCUMENT_ROOT'].'/stripe/init.php');
	
/*
	$version = curl_version();
	var_dump($version);
*/

// Include stripe-php as you usually do, either with composer as shown,
// or with a direct require, as commented out.
//require_once("vendor/autoload.php");
 //require_once("/path/to/stripe-php/init.php");

//	\Stripe\Stripe::setApiKey("sk_test_qyYipHL4YUTJOJeX3QkPaZDE");
/*
	\Stripe\Stripe::setApiKey("sk_live_lVO36k6oBF1q5v6hltUT2Ddj");
\Stripe\Stripe::$apiBase = "https://api-tls12.stripe.com";
try {
  \Stripe\Charge::all();
  echo "TLS 1.2 supported, no action required.";
} catch (\Stripe\Error\ApiConnection $e) {
  echo "TLS 1.2 is not supported. You will need to upgrade your integration.";
}
*/


// Test from PayPal 
/*
echo 'Test if the TLS version is compatible with PayPal:<br/>';
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "https://tlstest.paypal.com/"); 
echo '&nbsp;curl_exec($ch): ';
var_dump(curl_exec($ch));
echo '<br/>&nbsp;curl_error($ch): ';
var_dump(curl_error($ch));
curl_close($ch);

// Test from https://github.com/paypal/adaptivepayments-sdk-php/issues/64
echo '<br/><br/>Another test, get TLS & SSL Version:<br/>';
$ch = curl_init('https://www.howsmyssl.com/a/check');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
$json = json_decode($data);
echo ' TLS Version: ';
echo $json->tls_version;

$curl_info = curl_version();
echo '<br/> SSL Version: ';
echo $curl_info['ssl_version'];
curl_close($ch);
*/

	
// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
// Set this to 0 once you go live or don't require logging.
define("DEBUG", 1);
// Set to 0 once you're ready to go live
define("USE_SANDBOX", 1);
define("LOG_FILE", "./ipn.log");
// Read POST data
// reading posted data directly from $_POST causes serialization
// issues with array data in POST. Reading raw POST data from input stream instead.
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
	$keyval = explode ('=', $keyval);
	if (count($keyval) == 2)
		$myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
	$get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
	if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
		$value = urlencode(stripslashes($value));
	} else {
		$value = urlencode($value);
	}
	$req .= "&$key=$value";
}
// Post IPN data back to PayPal to validate the IPN data is genuine
// Without this step anyone can fake IPN data
if(USE_SANDBOX == true) {
	$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
} else {
	$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
}
$ch = curl_init($paypal_url);
if ($ch == FALSE) {
	return FALSE;
}

//curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
if(DEBUG == true) {
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
}
// CONFIG: Optional proxy configuration
//curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
// CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
// of the certificate as shown below. Ensure the file is readable by the webserver.
// This is mandatory for some environments.
//$cert = __DIR__ . "/cacert.pem";
//curl_setopt($ch, CURLOPT_CAINFO, $cert);
$res = curl_exec($ch);
if (curl_errno($ch) != 0) // cURL error
	{
	if(DEBUG == true) {	
		error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
	}
	curl_close($ch);
	exit;
} else {
		// Log the entire HTTP response if debug is switched on.
		if(DEBUG == true) {
			error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
			error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
		}
		curl_close($ch);
}
// Inspect IPN validation result and act accordingly
// Split response headers and payload, a better way for strcmp
$tokens = explode("\r\n\r\n", trim($res));
$res = trim(end($tokens));
if (strcmp ($res, "VERIFIED") == 0) {
	// check whether the payment_status is Completed
	// check that txn_id has not been previously processed
	// check that receiver_email is your PayPal email
	// check that payment_amount/payment_currency are correct
	// process payment and mark item as paid.
	// assign posted variables to local variables
	
	//$item_name = $_POST['item_name'];
	//$item_number = $_POST['item_number'];
	$payment_status = $_POST['payment_status'];
	$payment_amount = $_POST['mc_gross'];
	//$payment_currency = $_POST['mc_currency'];
	//$txn_id = $_POST['txn_id'];
	//$receiver_email = $_POST['receiver_email'];
	$payer_email = $_POST['payer_email'];
	
	
	$database = new Database;
	$database->query('INSERT INTO ipn_test (one, two, three) VALUES (:one, :two, :three');
	$database->bind(':one', $payment_status);		
	$database->bind(':two', $payment_amount);		
	$database->bind(':three', $payer_email);		

	$result = $database->execute();
	
	
	if(DEBUG == true) {
		error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
	}
} else if (strcmp ($res, "INVALID") == 0) {
	// log for manual investigation
	// Add business logic here which deals with invalid IPN messages
	if(DEBUG == true) {
		error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
	}
}
?>