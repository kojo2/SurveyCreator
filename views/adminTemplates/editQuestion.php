<label for="question">Question:</label><br>
<input type="text" name="question" id="question" placeholder="<?php echo $question;?>"></input><br><br>
<label for="sectors">Sectors:</label><br>
<input type="text" name="sectors" id="sectors" placeholder="<?php echo $sectorIds;?>"></input><br><br>
<label for="type">Type:</label><br>
<?php 
	switch($type){
		case 1:
			$type="Yes/No";
			break;
		case 2:
			$type="Multiple Choice";
			break;
		case 3:
			$type="Strongly Agree/Disagree";
			break;
		case 4:
			$type="Text";
			break;
	}
?>
<select name="type" id="type">
	<option <?php if($type=="Yes/No"){echo "selected";}?>>Yes/No</option>
	<option <?php if($type=="Multiple Choice"){echo "selected";}?>>Multiple Choice</option>
	<option <?php if($type=="Strongly Agree/Disagree"){echo "selected";}?>>Strongly Agree/Disagree</option>
	<option <?php if($type=="Text"){echo "selected";}?>>Text</option>
</select>
<br><br>
<input type="submit" value="Add question"></input>

<button onclick="Delete();">Delete this question</button>

<script>
function Delete(){
	if(confirm("Are you sure?")){
		window.location.href='<?php echo base_url();?>index.php/Admin/DeleteQuestion/<?php echo $questionId;?>';
	}
}
</script>

<style>
input[type="text"], select{
	margin-right: 40%;
	background-color:white;
	border-color:#242486;
	border-style: solid;
	margin:auto;
	color:#242486;
}

input[type="text"]::placeholder{
	color:#242486;
	opacity: 1.0;
}

select {
	border-radius: 30px;
	width:33%;
	padding: 5px 30px;
}

</style>