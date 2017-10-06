<?php

class Respondent extends Ci_Model {
	function Create($fname,$lname,$organisation,$email,$telephone,$address,$postcode){
		$sql = "INSERT INTO `respondents`(`fname`, `lname`, `organisation`, `email`, `telephone`, `address`, `postcode`) VALUES ('$fname','$lname','$organisation','$email','$telephone','$address','$postcode')";
		$result = $this->db->query($sql);
		return $result;
	}

	function Read(){

	}

	function ReadByFnameLname($fname,$lname){
		$sql = "SELECT * FROM `respondents` WHERE `fname` = ? AND `lname` = ?";
		$results = $this->db->query($sql,array($fname,$lname))->result();
		return $results;
	}

	function Update(){

	}

	function Delete(){
		$sql = "DELETE FROM `respondents` WHERE 1;";
		$result = $this->db->query($sql);
		return $result;
	}
}