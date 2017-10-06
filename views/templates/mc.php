

<div class="mAnswersArea">
<ul>
</ul>
</div>

<script>

var choice;

//$(document).ready(function(){
	$.get("<?php echo base_url();?>index.php/Questions/GetmAnswers",function(data){

		var parsedData = JSON.parse(data);

		console.log(parsedData.length);

		for(var i=0;i<parsedData.length;i++){
			//console.log("parsedData[i] "+parsedData[i].Answer);
			$(".mAnswersArea ul").append("<li>"+parsedData[i].Answer+"</li>");
		}
		//console.log(data);

		//make the width of each answer the same percentage so they all fit on one line (based on how many there are)
		//var width = String(100/($("li").length)-1)+"%";

		//$("li").css({"width":width});
		$("li").click(function(){
			$("li").removeClass("selected");
			$(this).addClass("selected");
			choice = $(this).html();	
			//alert("choice is: "+choice);
		});
	});

/*});*/

</script>
