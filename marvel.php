<?php
/**
* Author: Sundeep Joseph Machado
* Website: www.sundeepmachado.com
* Purpose: Example to query Marvel API using PHP
*/


// To create a new TimeStamp
$date = new DateTime();
$timestamp=$date->getTimestamp();
 
//Add your keys here. It would be better if you include them from an external file in production.
$keys=<YourPrivateKey>.<YourPublicKey>;
// Add the timestamp to the keys
$string=$timestamp.$keys;
//Generate MD5 digest, also hash is faster than md5 function
$md5=hash('md5', $string);

// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
// Query Iron Man by passing value in name parameter
curl_setopt($ch, CURLOPT_URL, "http://gateway.marvel.com:80/v1/public/characters?ts=$timestamp&apikey=<YourAPIKEY>&hash=$md5&name=Iron%20man");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json')                                                                       
);   
// grab URL and pass it to the browser

 //Execute curl
$output= curl_exec($ch) or die(curl_error()); 

//Format JSON output
echo str_replace('\\/', '/', $output);
// close cURL resource, and free up system resources
curl_close($ch);


?>