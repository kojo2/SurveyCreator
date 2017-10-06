<table>
<th>Question</th>
<th>Sector</th>
<th>Question type</th>
<?php
foreach ($questions as $q) {
	$type = '';
	switch ($q->typeId) {
		case 1:
			$type = 'Yes or no';
			break;
		case 2:
			$type = 'Multiple Choice';
			break;
		case 3:
			$type = 'Strongly Agree/Disagree';
			break;
		case 4:
			$type = 'Text';
			break;
	}
	echo "<tr><td><a href='".base_url()."index.php/admin/EditQuestion/$q->id'>".ucfirst($q->question)."</td><td>$q->name</td><td>$type</a></td></tr>";
}?>
</table>
<br>
<button onclick="Go();">Add new question</button>

<script>
	function Go(){
		if(confirm("Do you want this to be a multiple choice question?")){
			window.location.href='<?php echo base_url();?>index.php/Admin/AddNewMCQuestion';
		}else{
			window.location.href='<?php echo base_url();?>index.php/Admin/AddNewQuestion';
		}
	}
</script>

<style>

table {
	text-align: left;
}

a {
	color:#242486;
}

tr:hover, tr:hover a {
	background-color: #242486;
	color:white;
}
</style>
