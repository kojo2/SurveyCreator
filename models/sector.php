<?php

/**
* `
*/
class Sector extends CI_model
{
	
	function ReadAll(){
		$sql = "SELECT * FROM sectors";
		$results = $this->db->query($sql)->result();
		return $results;
	}

	function FindSectorByName($name){
		$sql = "SELECT * FROM sectors where name = ?";
		$results = $this->db->query($sql,array($name))->result();
		return $results;
	}

}
