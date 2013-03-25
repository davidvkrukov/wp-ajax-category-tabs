<?php 
/*
Plugin Name: WP AJAX Category Tabs
Plugin URI: https://github.com/davidvkrukov/wp-ajax-category-tabs/archive/master.zip
Description: Implements list of selected categories as tabs with lists of posts in content of these tabs. Uses jQuery tabs plugin.
Version: 1.0
Author: David V. Krukov
Author URI: http://www.k-works-team.com
License: GPL2
*/

// Exit if accessed directly
if(!defined('ABSPATH')) exit;

require_once dirname(__FILE__).'/src/ct-main.php';

if(class_exists('WPACT_Main')){
	register_activation_hook(__FILE__,array('WPACT_Main','__activate'));
	WPACT_Main::init();
}