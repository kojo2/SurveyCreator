<?php
$failure = false;

$keyCode =  randomString(32);

echo $keyCode;

$db = new mysqli('localhost', 'sm1', '***Redacted***', 'survey_mothership');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$statement = $db->prepare("INSERT INTO `devices` (`keyCode`) VALUES (?);");

$statement->bind_param('s',$keyCode);

if(!$statement->execute()){
	$failure=true;
}

$statement->free_result();
$db->close();

if(!$failure){
	echo $keyCode;
}

function randomString($length = 6) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}