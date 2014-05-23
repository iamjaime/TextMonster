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
	public function getAuthLine($id){
		/* This Function will get Authorized Cell Number */
		global $wpdb;
		
		$sql = "SELECT * FROM " . TABLE_AUTH_LINES . " WHERE uid='{$id}'";
		$data = $wpdb->get_results($sql);
		
		return print_r($data); //print_r for testing purposes
		
	}
	
	
}
