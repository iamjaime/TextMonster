<?php
/*
	* This File Contains All Of The Methods That We Will Use In Our Front End ( OUR THEME )
	* The do_action() Calls will be controlled by this file.
	* First we must add_action() for each function in the construct method in order to use the method in our theme
*/
include("tm-init.php");

class TM_Methods{
	
	function __construct()
	{	
		/* Lets Call our methods function */
		$this->methods(); //init the methods!
		
	}
	
	public function methods()
	{
		global $tm_core;
		global $tm_model;
		//Lets have all the hooks here....
		//add_action($tag, $function_to_add, $priority, $accepted_args)
		add_action('tm_getAuthNums', array($tm_model, 'getAuthLine'),10,1); //gets array of authorized lines
	}
	
}