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
		global $tm_model;
		//Lets have all the hooks here....
		//add_action($tag, $function_to_add, $priority, $accepted_args)
		add_action('tm_getAuthNums', array($tm_model, 'getAuthLine'),10,1); //gets array of authorized lines
		add_action('tm_getTargets', array($this, 'jsonTargets'),10,3); //accepts 3 params
		add_action('tm_states', array($this, 'jsonStates')); //no params needed
		add_action('tm_counties', array($this, 'jsonCounties'),10,1); //state param
	}
	
	/**
	 * 
	 * @global class $tm_model The model class
	 * @param string $state The state
	 * @param string $city The city
	 * @param string $county The county
	 * @return string json data
	 */
	public function jsonTargets($state,$city=null,$county=null)
	{
		global $tm_model;
		
		$targets = $tm_model->getTargetData($state,$city,$county);
	
		echo json_encode($targets);
	}
	
	/**
	 * 
	 * @global class $tm_core
	 * @return string json data
	 */
	public function jsonStates()
	{
		global $tm_core;
		$states = $tm_core->states();
		
		echo json_encode($states);
	}
	
	
	/**
	 * 
	 * @global class $tm_model the model class
	 * @param string $state 2 letter state abbreviation
	 */
	public function jsonCounties($state)
	{
		global $tm_model;
		$counties = $tm_model->getCounties($state);
		
		echo json_encode($counties);
	}
}