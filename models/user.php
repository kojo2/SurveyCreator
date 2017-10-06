<?php

class user extends CI_model {
	function Create($username,$password){
		$sql = "INSERT INTO `users` (`id`,`username`,`password`) VALUES (?,?,?);";
		$this->db->query($sql,array(null,$username,$password));
		return $this->db->affected_rows() > 0;
	}

	function ReadByUsername($username){
		$sql = "select * from users where username = ?";
		$results = $this->db->query($sql,array($username))->result();
		return $results;
	}

	function ReadUser($username,$password){
		$sql = "select * from users where username = ? and password = ?";
		$results = $this->db->query($sql,array($username,$password))->result();
		return $results;
	}
}