<?php

/**
* 
*/
class mAnswers extends CI_model
{
	
	function ReadAllForQuestionId($questionId){
		$sql = "SELECT * FROM manswers where parentQuestionId = ?";
		$results = $this->db->query($sql,array($questionId))->result();
		return $results;
	}

	function Create($pid,$answer){
		$sql = "INSERT INTO `manswers` (`parentQuestionId`,`Answer`) VALUES (?,?);";
		$result = $this->db->query($sql,array($pid,$answer));
		return $result;
	}
}