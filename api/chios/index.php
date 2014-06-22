<?php
$hash = $_GET['hash'];
ini_set('display_errors', 0);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "604939425-6jFgHpT2GAwKceYuISTJIgXQyH4h8OV3VRfSIZw4",
    'oauth_access_token_secret' => "ClIlgz5h3FC0VaW7rugbknZ5yrRipgPvnxbStpR8o",
    'consumer_key' => "JOjKb6PhvH6PnvIPlK3A",
    'consumer_secret' => "q9s4bn4pUVroDANfTDTekcsw8JGGUBhbEzOlNarPWY"
);

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/search/tweets.json';
//$url = 'https://api.twitter.com/1.1/followers/ids.json';
if($hash){
	$getfield = '?q=%23'.$hash.'&result_type=recent&count=10';
}else{
	$getfield = '?q=#baseball&result_type=recent';
}
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
echo $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
