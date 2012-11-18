<?php
/**
 * Enter your API keys below.  You get your API keys by creating an
 * app on https://dev.twitter.com/apps/new.
 */
return array(
	'active' => Fuel::$env,

	'development' => array(
		'twitter_consumer_key'     => isset($_SERVER['HTTP_TWITTER_CONSUMER_KEY']) ? $_SERVER['HTTP_TWITTER_CONSUMER_KEY'] : null,
		'twitter_consumer_secret'  => isset($_SERVER['HTTP_TWITTER_CONSUMER_SECRET']) ? $_SERVER['HTTP_TWITTER_CONSUMER_SECRET'] : null,
	),
	'production' => array(
		'twitter_consumer_key'     => getenv('TWITTER_CONSUMER_KEY'),
		'twitter_consumer_secret'  => getenv('TWITTER_CONSUMER_SECRET'),
	),
);
