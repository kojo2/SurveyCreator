<?php

class Answers extends Ci_Model {
	function Create($questionId,$respondentId,$answer){
		$data = array(
			'questionId'=>$questionId,
			'respondentId'=>$respondentId,
			'answer'=>$answer
		);
		$result = $this->db->insert('answers',$data);
		return $result;
	}

	function ReadAll(){
		$sql = "SELECT * FROM `answers`;";
		$results = $this->db->query($sql)->result();
		return $results;
	}

	function GetRespondents(){
		$sql = "SELECT respondentId FROM `answers` GROUP BY respondentId;";
		$results = $this->db->query($sql)->result();
		return $results;	
	}

	function ReadJoinQuestions(){
		$sql = "SELECT * FROM `answers` INNER JOIN `questions` on `answers`.`questionId` = `questions`.`id`;";
		$results = $this->db->query($sql)->result();
		return $results;	
	}

	function ReadJoinQuestionsOnRespondents(){
		$sql = "SELECT * FROM `answers` INNER JOIN `questions` on `answers`.`questionId` = `questions`.`id` INNER JOIN `respondents` on `answers`.`respondentId`=`respondents`.`id`;";
		$results = $this->db->query($sql)->result();
		return $results;	
	}

	function Delete(){
		$sql = "DELETE FROM `answers` WHERE 1;";
		$result = $this->db->query($sql);
		return $result;
	}

	
}