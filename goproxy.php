<?php
namespace Goproxy;
/*
	Plugin Name: GoProxy
	Description: It does what it has to do..
	Version: 1.0.1
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Define some good constants.
define( 'SEARCH_PROXY_ROOT', plugin_dir_path( __FILE__ ) );

// Include everything..
require_once( SEARCH_PROXY_ROOT . 'src/google.php' );
require_once( SEARCH_PROXY_ROOT . 'src/proxy.php' );

require 'plugin-update-checker/plugin-update-checker.php';
$className = \PucFactory::getLatestClassVersion('PucGitHubChecker');

$myUpdateChecker = new $className(
    'https://github.com/kjellberg/goproxy',
    __FILE__,
    'master'
);

// This just echoes the chosen line, we'll position it later
function goproxy_connector_show_admin_notices() {

	if (!get_option('go_connector_api_key'))
		add_option('go_connector_api_key', rand(57182391388,92839189312381));

	echo "<p id='goproxy_admin_notice'>GO PROXY KEY: ".get_option('go_connector_api_key')."</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', '\Goproxy\goproxy_connector_show_admin_notices' );

// We need some CSS to position the paragraph
function goproxy_admin_notice_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#goproxy_admin_notice {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', '\goproxy\goproxy_admin_notice_css' );
