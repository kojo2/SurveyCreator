<div class="align-left" style="width:50%; position: relative; left:50%; transform: TranslateX(-50%);">
<?php
$currentRespondent = $answers[0]->respondentId;
echo("RESPONDENT ID: $currentRespondent<br>");
echo("<br>RESPONDENT details: Name: ".$answers[0]->fname." ".$answers[0]->lname." - Address: ".$answers[0]->address." - Tel: ".$answers[0]->telephone." - Email: ".$answers[0]->email."<br><br>");
foreach ($answers as $a=>$answer) {
	if($answer->respondentId == $currentRespondent){
		echo "$answer->question : $answer->answer<br>";
	}else{
		echo("<br><br><br>RESPONDENT ID: $answer->respondentId<br>");
		echo("<br>RESPONDENT details: Name: $answer->fname $answer->lname - Organistion: $answer->organisation - Address: $answer->address - Tel: $answer->telephone - Email: $answer->email<br><br>");
		$currentRespondent = $answers[$a+1]->respondentId;
		echo "$answer->question : $answer->answer<br>";
	}
	$currentRespondent = $answer->respondentId;
}
?>
</div>