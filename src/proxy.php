<?php
if (isset($_GET['goproxy']) AND 
	isset($_GET['kw']) AND 
	null !== get_option('go_connector_api_key') AND 
	$_GET['goproxy'] == get_option('go_connector_api_key')) 
{

	$result = \Goproxy\Google::search_keyword($_GET['kw']);

	echo $_SERVER['SERVER_ADDR'] . ':goproxyip:';
	print_r($result);

	die();
}