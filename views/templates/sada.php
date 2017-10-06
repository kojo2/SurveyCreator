<ul>
<li>Strongly Agree</li>
<li>Agree</li>
<li>Neither Agree nor Disagree</li>
<li>Disagree</li>
<li>Strongly Disagree</li>
</ul>

<script>
var choice;
$("li").click(function(){
	$("li").removeClass("selected");
	$(this).addClass("selected");
	choice = $(this).html();
});
</script>

