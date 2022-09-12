<?php
/**
* Plugin Name: Product Badges For Woocommerce
* Description: This plugin allows create Product Badges For Woocommerce plugin.
* Version: 1.0
* Copyright: 2022
* Text Domain: product-badges-for-woocommerce
* Domain Path: /languages 
*/


if (!defined('ABSPATH')) {
	die('-1');
}

// Define plugin file
define('PBFW_PLUGIN_FILE', __FILE__);

// Define plugin dir
define('PBFW_PLUGIN_DIR', plugins_url('', PBFW_PLUGIN_FILE));

// Define plugin base name
define('PBFW_BASE_NAME', plugin_basename(PBFW_PLUGIN_FILE));

// Include Plugins File
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// Include All Files
include_once('main/backend/pbfw_backend.php');
include_once('main/frontend/pbfw_frontend.php');
include_once('main/resources/pbfw-installation-require.php');
include_once('main/resources/pbfw-language.php');
include_once('main/resources/pbfw-load-js-css.php');