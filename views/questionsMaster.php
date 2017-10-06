<!-- this is the master template for question asking. we want to poke the subviews through in certain places using ajax by passing the type id of the current question back to the question controller. -->

<div class="questionArea">
</div>

<div class="answerArea">
</div>

<!--<button style="float:left;" id="btn_prev">Previous</button>-->
<button style="float:right;" id="btn_next">Next</button>

</div>
<style>
	button {
		position: relative;
		top: 50%;
		margin-right: 5%;
		width:100px;
		min-width: unset;
	}

	.content {
		width: 100%;
	}

	.questionArea:first-letter {
		text-transform: capitalize;
	}
	.logo {
		margin-left: 35px;
	}

</style>

<script>

var reset1 = false;
var reset2 = false;
var currentQuestionId;
$(document).ready(function(){
	Get();
	$("#btn_next").click(function(){
		if(reset1 && reset2){
			$.ajax({
				url:"<?php echo base_url();?>index.php/Questions/PostAnswer/"+currentQuestionId,
				method:"POST",
				data: {choice:choice},
				success:function(data){
					if(data=="Saved"){
						Get();
					}else{
						$(".questionArea").html(data);
					}
				}
			});
			//Get();
		}
	});
});

function Get(){
	reset1=false;
	reset2=false;
	$.ajax({
			url:"<?php echo base_url();?>index.php/Questions/GetNextQuestion",
			method: 'GET',
			success:function(data){
				// get the data that comes back as json and put it into an arrayed object
				console.log(data);
				if(data=="end"){
					window.location.href="<?php echo base_url();?>index.php/End";
				}else{
					var obj = JSON.parse(data);
					$(".questionArea").html(obj[0].question);
					currentQuestionId = obj[0].id;
					reset1=true;
					console.log("reset1");
					$.ajax({
						url:"<?php echo base_url();?>index.php/Questions/GetAnswerTemplate",
						method: 'GET',
						success:function(data){
							$(".answerArea").html(data);
							reset2=true;
							console.log("reset2");
					},
						error:function(){
							console.log("there was an error");
						}
					});
				}
			},
			error:function(){
				console.log("there was an error");
			}
		});
}

</script>