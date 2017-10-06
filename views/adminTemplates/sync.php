Syncing...
<div id="answers" style="display: none;">
<?php
$currentRespondent = $answers[0]->respondentId;
echo("$currentRespondent,".$answers[0]->fname.",".$answers[0]->lname.",".$answers[0]->organisation.",".$answers[0]->address.",".$answers[0]->telephone.",".$answers[0]->email.",".$answers[0]->postcode.",");
foreach ($answers as $a=>$answer) {
	if($answer->respondentId == $currentRespondent){
		echo "qid:$answer->questionId:$answer->answer^,";
	}else{
		echo("*$answer->respondentId,");
		echo("$answer->fname,$answer->lname,$answer->organisation,$answer->address,$answer->telephone ,$answer->email,$answer->postcode,");
		$currentRespondent = $answers[$a+1]->respondentId;
		echo "qid:$answer->questionId:$answer->answer^,";
	}
	$currentRespondent = $answer->respondentId;
}?>
</div>

<script>
/*$.get({
	url:'http://185.145.46.41',
	success:function(data){
		document.write("got there successfully");
	},
	error:function(error){
		document.write("there was an error: "+error);
		console.log("there was an error: "+error);
		
	}
});*/
console.log("hello");

var content;

$(document).ready(function(){
	content = $("#answers").html();
	$.ajax({
		url:'***REDACTED***',
		data:{s:content,'key':'<?php echo $key;?>'},
		method:'POST',
		success:function(data){
			console.log("data: "+data);
			document.write(data);
			//document.write("got there successfully");
		},
		error:function(error){
			document.write("error: "+error);
			console.log("error: "+error);
		}
	});
});

</script>