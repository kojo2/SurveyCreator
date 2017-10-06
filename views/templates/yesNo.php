<ul>
<li>Yes</li>
<li>No</li>
</ul>

<script>
var choice = 0;
$("li").click(function(){
	$("li").removeClass("selected");
	$(this).addClass("selected");
	choice = $(this).index();
	switch(choice){
		case 0:
			choice="Yes";
			break;
		case 1:
			choice="No";
			break;
	}
});
</script>

