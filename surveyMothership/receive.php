<?php


$key = $_POST['key'];

$content =  $_POST['s'];

// * delimits respondents

$contentA = explode("*",$content);

$db = new mysqli('localhost', 'sm1', '***REDACTED***', 'survey_mothership');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$statement = $db->prepare("SELECT * FROM `devices`");

if(!$statement->execute()){
	echo "unable to query devices table in database";
	$failure=true;
}

$statement->bind_result($results);

$allowed = false;

while($statement->fetch()){
	if($results==$key){
		echo "found it in the database!!!";
		$allowed = true;
	}
}

if(!$allowed){
	echo "sorry not allowed<script>setInterval(function(){window.location.href='/survey/index.php/Admin'},3000);</script>";
}


// key has been accepted and we now perform the data manipulation

if($allowed){

	$failure=false;

	$questionsAndAnswers = array();

	// qid: delimits answers

	$questionsAndAnswersA = explode("qid:",$content);

	foreach ($questionsAndAnswersA as $q) {
		array_push($questionsAndAnswers,explode("^",$q)[0]);
	}



	foreach ($contentA as $c) {
		// break string into individual respondents
		$contentB = explode(",",$c);
		$respondentId = $contentB[0];
		$fname = $contentB[1];
		$lname = $contentB[2];
		$organisation = $contentB[3];
		$address = $contentB[4];
		$telNo = $contentB[5];
		$email = $contentB[6];
		$postcode = $contentB[7];

		//echo "$respondentId,$fname,$lname,$organisation,$address,$telNo,$email,$postcode";

		/*$respondentExists = false;
		//check if respondent already exists
		$statement = $db->prepare("SELECT * FROM `respondents` where `id`=?;");
		$statement->bind_param('s',$respondentId);

		if(count($statement->fetch())>0){
			$respondentExists = true;
		}*/
		//if(!$respondentExists){

			$statement = $db->prepare("INSERT INTO `respondents` (`id`,`fname`,`lname`,`organisation`,`email`,`telephone`,`address`,`postcode`) VALUES (?,?,?,?,?,?,?,?);");

			// turn respondentId into integer ready to insert into the database
			$newId = intval($respondentId);

			$statement->bind_param('isssssss', $newId,$fname,$lname,$organisation,$email,$telNo,$address,$postcode);

			if(!$statement->execute()){
				echo "respondent failed to be put into database<br>";
				$failure=true;
			}

			
			// we blank the first of the answers as this is just the respondent's details
			$questionsAndAnswers[0]="";

			// loop through each answer and save the integer loop counter value as $i
			foreach ($questionsAndAnswers as $i=>$qa) {
				// make sure we are leaving out the first answer (respondent's details)
				if($i>0){
					//check if answer already exists

					$qaA = explode(":",$qa);
					$qids = $qaA[0];
					$qid = intval($qids);
					$a = $qaA[1];


						$statement = $db->prepare("INSERT INTO `answers` (`questionId`,`respondentId`,`answer`) VALUES (?,?,?);");
						
						$statement->bind_param('iis', $qid,$respondentId,$a);
						if(!$statement->execute()){
							echo "answer failed to be put into database<br>";
							$failure=true;
						}
					//}
				}
			//}
		}
	}
	$statement->free_result();
	$db->close();

	if($failure){
		echo "database not synced";
	}
	else{
		echo "database synced successfully";
		echo "<script>setInterval(function(){window.location.href='/survey/index.php/Admin/Delete'},3000);</script>";
	}
}
