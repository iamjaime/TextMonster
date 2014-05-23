<?php
/*
	* THIS IS THE BOOTSTRAP. 
	* 
	* THIS WILL INIT ALL OF THE NECESSARY CLASSES FOR THE PLUGINS IN ORDER.
*/
/*--------------------------------------------------------------------------*/
require_once("includes/tm-config.php"); //handles all defined values for our class configurations.
require_once("includes/tm-core.class.php"); //handles general functionality
require_once("includes/tm-model.class.php"); //handles database work
require_once("includes/tm-activate.class.php"); //handles plugin activation and deactivation
//require_once("includes/tm-paypal.class.php"); //handles paypal methods

//now we init them....
global $tm_core;
global $tm_model;
//global $tm_paypal;

$tm_core = new TM;
$tm_model = new tm_model;
//$tm_paypal = new tm_paypal;