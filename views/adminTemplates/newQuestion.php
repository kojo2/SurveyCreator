<?php echo form_open('/Admin/CreateNewQuestion');?>
<label for="question">Question:</label>
<input type="text" name="question" id="question"></input><br><br>
<label for="sectors">Sectors:</label>
<input type="text" name="sectors" id="sectors"></input><br><br>
<label for="type">Type:</label>
<select name="type" id="type">
	<option>Yes/No</option>
	<option>Strongly Agree/Disagree</option>
	<option>Text</option>
</select>
<br><br>
<input type="submit" value="Add question"></input>


<style>
input, select{
	width: 50%;
	float: right;
	margin-right: 40%;
}
<?php echo form_close;?>
</style>