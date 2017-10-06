<?php

class Device extends Ci_Model {

	function Create($code){

		$sql = "DELETE from `device` WHERE true;";
		$this->db->query($sql);
		 $sql = "INSERT INTO `device` (`keyCode`) VALUES (?);";
		if($this->db->query($sql,array($code))){
			return true;
		}else{
			return false;
		}
	}

	function Read(){
		$sql = "SELECT * FROM `device`";
		$results = $this->db->query($sql)->result();
		return $results;
	}

	function Delete(){

	}



}