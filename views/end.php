This is the end of the survey

thank you for your time filling it out.
<br><br>
<button onclick="GoHome();">Go back to home</button>

<script>
setInterval(function(){
	GoHome();
},10000);

function GoHome(){
	window.location.href="<?php echo base_url();?>";
}
</script>