<?php
/*
Plugin Name: Text Monster
Plugin URI: http://www.textmonster.org
Description: Text Message Blasting App
Version: 1.0
Author: Affordablewebdev
Author URI: http://www.affordablewebdev.com/
*/

//The path that the plugin is in :)
define( 'TM_PATH', plugin_dir_url(__FILE__) );
define( 'TM_PLUGIN_DIR', 'TextMonster'); //the plugin dir name


//lets activate this plugin!
register_activation_hook( __FILE__, function() {
  add_option('Activated_Plugin', TM_PLUGIN_DIR); //TextMonster is the name of plugin forlder.
  /* activation code here */
  require_once("tm-init.php");
  $tm_activate = new tm_activate;
});

register_deactivation_hook( __FILE__, function() {
  /* deactivation code here */
   	require_once("tm-init.php");
	$tm_deactivate = new tm_activate(false);
});


//lets create the hook for The TextMonster Options/Configurations Main Tab
add_action('admin_menu', 'tm_options_tab');
function tm_options_tab()
{
	//lets create the main menu page ( the dashboard )
	add_menu_page( 'TextMonster', 'TextMonster', 'manage_options', 'tm_main', 'tm_main_page', 'dashicons-format-status');	
	
	//lets create a TextMonster sub page
	//add_submenu_page( 'tm_main', 'Text Monster Settings', 'Settings', 'manage_options', 'tm_settings', 'tm_settings_page' );
	
}

//dashboard page function
function tm_main_page()
{
	//this is the dashboard page.
	include("admin/tm_main_page.php");
}

//Lets include the different Action Methods that will be used in our THEME :)
include("methods.php");
$tm_methods = new TM_Methods(); //we use this to init the Methods that we will use in our frontend