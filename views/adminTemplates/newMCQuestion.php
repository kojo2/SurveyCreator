<?php echo form_open("Admin/CreateNewMCQuestion");?>
<label>Sector Ids</label><br>
<input type="text" name="sectorIds" /><br>
<label>Question</label><br>
<input type="text" name="question" /><br>
<div id="fields">
<label>Answer</label><br>
<input type="text" name="answer1"/>
</div><br>
<button>Add new answer</button>
<br><br>
<input type="text" name="idsTotal" style="display:none;" id="idsTotal" value="1"/>
<input type="submit" value="Add question"/>

<script>

var id=2;

$("button").click(function(e){
	e.preventDefault();
	$("#fields").append("<br><br><label>Answer</label><br><input type='text' name='answer"+id+"'/>");
	$("#idsTotal").val(id);
	id++;
});
</script>
