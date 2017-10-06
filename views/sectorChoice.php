Please choose the sector that you visited today


<div id="results">
<ul style="list-style-type: none;">
<?php foreach ($sectors as $s){ ?>
	<li>
	<?php echo $s->name."<br>"; ?>
	</li>
<?php } ?>
</ul>
</div>

<script>
$("li").click(function(){
	window.location.href="Questions/ChooseSector/"+$(this).text();
});
</script>
