<?php
/* 
	* Text Monster Model
*/
class tm_model{
	/**
	 * 
	 * @global class $wpdb the wordpress database class
	 * @param int $id the user id that we want info for
	 * @return array the authorized lines for this user
	 */
	public function getAuthLine($id)
	{
		/* This Function will get Authorized Cell Number */
		global $wpdb;
		
		$sql = "SELECT * FROM " . TABLE_AUTH_LINES . " WHERE uid='{$id}'";
		$data = $wpdb->get_results($sql);
		
		return print_r($data); //print_r for testing purposes
		
	}
	
	/**
	 * 
	 * @global class $wpdb the wp db class
	 * @param string $state the 2 letter state abbreviation
	 * @param string $city the city in that specific state
	 * @param string $county the county in that specific state
	 * @return array the target data
	 */
	public function getTargetData($state, $city=null, $county=null)
	{
		global $wpdb;
		
		//if we only have state and city and county are null
		$sql = "SELECT DISTINCT NPA, NXX, State, City, County FROM " . TABLE_TARGETS . " WHERE State='{$state}'";
		
		//if we have state and city
		if($state != null && $city != null)
		{
			$sql = "SELECT DISTINCT NPA, NXX, State, City, County FROM " . TABLE_TARGETS . " WHERE State='{$state}' AND City='{$city}'";
		}
		//if we have state and city and county
		if($state != null && $city != null && $county != null)
		{
			$sql = "SELECT DISTINCT NPA, NXX, State, City, County FROM " . TABLE_TARGETS . " WHERE State='{$state}' AND City='{$city}' AND County='{$county}'";
		}
		
		//if we have state and county ( this is going to be the most used. )
		if($state != null && $county != null)
		{
			$sql = "SELECT DISTINCT NPA, NXX, State, City, County FROM " . TABLE_TARGETS . " WHERE State='{$state}' AND County='{$county}'";
		}
		
		$data = $wpdb->get_results($sql);
		
		return $data; 
	}
	
	/**
	 * 
	 * @global class $wpdb wordpress database class
	 * @param string $state 2 Letter state abbreviation
	 * @return array the counties in the specific state
	 */
	public function getCounties($state)
	{
		global $wpdb;
		
		//no empty counties aloud :)
		$sql = "SELECT DISTINCT County FROM " . TABLE_TARGETS . " WHERE State='{$state}' AND County != ''";
		$data = $wpdb->get_results($sql);
		
		return $data;
		
	}
	
	/**
	 * 
	 * @global class $wpbd wordpress database class
	 * @param string $state 2 letter state abbreviation
	 * @return array the cities inside of this state
	 */
	public function getCities($state)
	{
		global $wpdb;
		
		$sql = "SELECT DISTINCT City FROM " . TABLE_TARGETS . " WHERE State='{$state}' AND City != ''";
		$data = $wpdb->get_results($sql);
		
		return $data;
		
	}
}
