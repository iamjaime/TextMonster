<?php
/*
	* This Class handles what happens on plugin activation.
	*
	* This creates the Default database tables and inserts the default data.
	* In order to get started with Text Monster.
*/
class tm_activate{
	/*
		* __construct() Function
		*
		* Creates the Tables Needed For TextMonster To Operate.
	*/
	function __construct($status=true)
	{
		global $wpdb;
		if($status)
		{	
			$tables[] = $this->UsersTable();
			$tables[] = $this->AuthLinesTable();
			$tables[] = $this->TargetsTable();
			
			foreach($tables as $table):
				$wpdb->query($table);
			endforeach;
			
			$this->InsertData(); //lets insert data into our tables :)
		}
		else
		{
			//de-activation was called!
			//lets drop our tables!
			$aTables[] = TABLE_USERS;
			$aTables[] = TABLE_AUTH_LINES;
			
			//NEVER DROP THE TARGETS! it will take forever to put back in the db.
			//unless we use SSH
			//$aTables[] = TABLE_TARGETS;
			
			//now we drop the tables!
			$this->dropTables($aTables);
		}
	}
	
	
	/*
		*dropTables Function
		*
		*@private function
		*return void
	*/
	private function dropTables($aTables)
	{
		global $wpdb;
		
		$query_string = 'DROP TABLE ';
		
		foreach($aTables as $key => $table)
		{
			$query_string .= '`'.$table.'`';
			$query_string .= ',';
		}
		
		$query_string = rtrim($query_string,','); //remove last comma
		$query_string .= ';'; //lets add the semi-colon to end the query string!
		
		$sql = $query_string;
		
		$wpdb->query($sql);
	}
	
	/*
		* UsersTable Function
		*
		* @access private
		* @return string $sql query
	*/
	private function UsersTable()
	{
		//lets Create the tables for the database if they don't already exist!
		$sql = "CREATE TABLE IF NOT EXISTS `". TABLE_USERS ."` (
  `id` int(32) NOT NULL AUTO_INCREMENT,";
  		
		//$sql .= "`dummy` TINYINT(2) NOT NULL,";
		
		$sql .= "`registration_date` DATETIME NOT NULL,"; //the registration date (in most cases same as activation)
		$sql .= "`lastlogin_date` DATETIME NOT NULL,";
		$sql .= "`activation_date` DATETIME NOT NULL,"; //the last activation date
		$sql .= "`level` TINYINT(2) NOT NULL,"; //the level they are on! :)
		
		$sql .= "`active` TINYINT(1) NOT NULL,";
		$sql .= "`fb_id` BIGINT NOT NULL,";
		$sql .= "`gender` varchar(30) NOT NULL,";
		$sql .= "`personal_email` varchar(255) NOT NULL,";
		$sql .= "`coinbase_address` varchar(255) NOT NULL,";
		$sql .= "`paypal_email` varchar(255) NOT NULL,";
		$sql .= "`username` varchar(30) NOT NULL,";
		$sql .= "`password` char(40) NOT NULL,"; //we use CHAR because it's fixed length and sha1 enc will use 40 chars for better performance over varchar on db.
		$sql .= "`first_name` varchar(50) NOT NULL,";
		$sql .= "`last_name` varchar(50) NOT NULL,";
		$sql .= "`mobile_phone` varchar(20) NOT NULL,";
		//$sql .= "`address` varchar(255) NOT NULL,";
		$sql .= "`city` varchar(255) NOT NULL,";
		$sql .= "`province` varchar(255) NOT NULL,";
		$sql .= "`postal_code` varchar(20) NOT NULL,";
		$sql .= "`country` varchar(2) NOT NULL,"; //we will use the iso country code in order to use less bytes.
		$sql .= "`dob` DATETIME NOT NULL,";
		
		
		$sql .= "  
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";
		
		return $sql;
	}
	
	
	/*
		* AuthLinesTable Function
		*
		* @access private
		* @return string $sql query
	*/
	private function AuthLinesTable()
	{
		//lets Create the tables for the database if they don't already exist!
		$sql = "CREATE TABLE IF NOT EXISTS `". TABLE_AUTH_LINES ."` (
  `id` int(32) NOT NULL AUTO_INCREMENT,";
		
		$sql .= "`uid` int(32) NOT NULL,";
		$sql .= "`auth_number` VARCHAR(15) NOT NULL,";
		$sql .= "`status` TINYINT(1) NOT NULL,";
		
		
		$sql .= "  
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";
		
		return $sql;
	}
	
	private function TargetsTable()
	{
		//lets Create the tables for the database if they don't already exist!
		$sql = "CREATE TABLE IF NOT EXISTS `". TABLE_TARGETS ."` (
  `id` int(100) NOT NULL AUTO_INCREMENT,";
		
		$sql .= "`NPA` char(3) NOT NULL,";
		$sql .= "`NXX` char(3) NOT NULL,";
		$sql .= "`CountyPop` int(50) NOT NULL,";
		$sql .= "`ZipCodeCount` int(50) NOT NULL,";
		$sql .= "`ZipCodeFreq` int(50) NOT NULL,";
		$sql .= "`Latitude` decimal(12,8) NOT NULL,";
		$sql .= "`Longitude` decimal(12,8) NOT NULL,";
		$sql .= "`State` char(2) NOT NULL,";
		$sql .= "`City` varchar(255) NOT NULL,";
		$sql .= "`County` varchar(255) NOT NULL,";
		$sql .= "`TimeZone` varchar(255) NOT NULL,";
		$sql .= "`ObservesDST` varchar(255) NOT NULL,";
		$sql .= "`NXXUseType` varchar(255) NOT NULL,";
		$sql .= "`NXXIntroVersion` varchar(255) NOT NULL,";
		$sql .= "`ZipCode` varchar(255) NOT NULL,";
		$sql .= "`NPANew` varchar(255) NOT NULL,";
		$sql .= "`FIPS` varchar(255) NOT NULL,";
		$sql .= "`LATA` varchar(255) NOT NULL,";
		$sql .= "`Overlay` varchar(255) NOT NULL,";
		$sql .= "`RateCenter` varchar(255) NOT NULL,";
		$sql .= "`SwitchCLLI` varchar(255) NOT NULL,";
		$sql .= "`MSA_CBSA` varchar(255) NOT NULL,";
		$sql .= "`MSA_CBSA_Code` varchar(255) NOT NULL,";
		$sql .= "`OCN` varchar(255) NOT NULL,";
		$sql .= "`Company` varchar(255) NOT NULL,";
		$sql .= "`CoverageAreaName` varchar(255) NOT NULL,";
		$sql .= "`NPANXX` char(6) NOT NULL,";
		
		$sql .= "  
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
		
		return $sql;
	}
	
	
	
	/*
		*InsertData Function
		*
		*@private function
		*return void
	*/
	
	private function InsertData()
	{
		global $wpdb;
		
		//Check if Table already has data, else lets run an insert.
		$sql = "SELECT id FROM " . TABLE_USERS;
		$res = $wpdb->get_results($sql);
		
		if($res == null){
		
		$wpdb->insert(TABLE_USERS, array(
			'id' => 1,
			'registration_date' => DT,
			'lastlogin_date' => DT,
			'activation_date' => '',
			'level' => 0,
			'active' => 1,
			'fb_id' => 1425844867,
			'gender' => 'male',
			'personal_email' => 'textmonster2@gmail.com',
			'paypal_email' => 'jaime-facilitator@iamjaime.com', //sandbox email for now
			'username' => 'PanConQu3sSo',
			'first_name' => 'Jaime',
			'last_name' => 'Bernal',
			'city' => 'Elmhurst',
			'province' => 'New York',
			'dob' => '1989-07-25 00:00:00'	
		));
		
		}//end if result = null	
		
		//Check if Table already has data, else lets run an insert.
		$sql = "SELECT id FROM " . TABLE_AUTH_LINES;
		$res = $wpdb->get_results($sql);
		
		if($res == null){
		
		$wpdb->insert(TABLE_AUTH_LINES, array(
			'uid' => 1,
			'auth_number' => 6463231803,
			'status' => 1	
		));
		
		}//end if result = null	
		
	}
	
	
	
	
			
}