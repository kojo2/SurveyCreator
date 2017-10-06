<?php

/**
* 
*/
class Question extends CI_model
{

	function Read(){
		$sql = "SELECT * from questions";
		$results = $this->db->query($sql)->result();
		return $results;
	}

	function ReadAllJoin(){
		$sql = "SELECT `questions`.*, `sectors`.`name` FROM `questions` JOIN `sectors` on `questions`.`sectorID` = `sectors`.`id`";
		$results = $this->db->query($sql)->result();
		return $results;	
	}

	function ReadByQuestion($question){
		$sql = "SELECT * FROM `questions` WHERE `question`=?";
		$results = $this->db->query($sql,array($question))->result();
		return $results;
	}
	
	function ReadAllForSector($sector){
		$sql = "SELECT * from questions where sectorIds LIKE '%".$sector."%'";
		$results = $this->db->query($sql,array(strval($sector)))->result();
		return $results;
	}

	function ReadQuestionById($id){
		$sql = "SELECT * FROM questions where id = ?";
		$results = $this->db->query($sql,array($id))->result();
		return $results;
	}

	function ReadQuestionByIdJoinSector($id){
		$sql = "SELECT `questions`.*, `sectors`.`name` FROM `questions` JOIN `sectors` on `questions`.`sectorID` = `sectors`.`id` where `questions`.id=? ";
		$results = $this->db->query($sql,array($id))->result();
		return $results;
	}
	function Create($question,$sectors,$type){
		$typeId = 0;
		switch($type){
		case 'Yes/No':
			$typeId = 1;
		break;
		case 'Multiple Choice':
			$typeId = 2;
		break;
		case 'Strongly Agree/Disagree':
			$typeId = 3;
		break;
		case 'Text':
			$typeId = 4;
		break;
		}
		//echo "$question + $sectors + $type";
		$sql = "INSERT INTO `questions` (`question`,`sectorIds`,`typeId`,`sectorId`) VALUES (?,?,?,1);";
		if($this->db->query($sql,array($question,$sectors,$typeId))){
			return true;
		}else{
			return false;
		}
	}

	function Delete($qid){
		$sql = "DELETE from `questions` where `id`=?;";
		if($this->db->query($sql,array($qid))){
			return true;
		}else{
			return false;
		}
	}
}