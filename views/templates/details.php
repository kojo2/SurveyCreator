<label>
Thank you for agreeing to take our survey. We hope you won't mind first filling out some details:
</label>
<br><br>
<!--<?php echo form_open(base_url()."index.php/Details/CreateRespondent");?>-->
<form>
<label>First Name:<span class='fname'></span></label>
<input type="text" name="fname" class="fname" required>

<label>Last Name:<span class='lname'></span></label>
<input type="text" name="lname" class="lname" required>

<label>Organisation:<span class='organisation'></span></label>
<input type="text" name="organisation" class="organisation" required>

<label>Email address:<span class='email'></span></label>
<input type="email" name="email" class="email" required>

<label>Telephone No:<span></span></label>
<input type="tel" name="tel" class="tel">

<label>Address:<span></span></label>
<input type="text" name="address" class="address">

<label>Postcode:<span></span></label>
<input type="text" name="postcode" class="postcode">
<button style="margin-top: 20px;">Go</button>
<!-- <?php echo form_close();?> -->
</form>
<div id="errors">
</div>
<script>

$("input").change(function(){
	var name = $(this).attr("class");
	//client-side validation for instant response, backed up by server-side for security
	var error="";
	var length = $(this).val().length;
	if(length<3){
		error = "Too short";
	}
	if(length>50){
		error = "Too long";
	}
	$("span."+name).html("<br>"+error);
});

$("button").click(function(e){
	var hadErrors = false;
	e.preventDefault();
		$("span").each(function(){
			if($(this).html()!="<br>" && $(this).html()!=""){
				hadErrors = true;
			}
			console.log("hadErrors: "+hadErrors);
		});
		var fname = $("input.fname").val();
		var lname = $("input.lname").val();
		var email = $("input.email").val();
		var tel = $("input.tel").val();
		var address = $("input.address").val();
		var organisation = $("input.organisation").val();
		var postcode = $("input.postcode").val();
		//alert("haderrors: "+hadErrors);
		if(!hadErrors){
			$.post({
				url:'<?php echo base_url();?>index.php/Details/CreateRespondent',
				data:{fname:fname,lname:lname,email:email,tel:tel,address:address,organisation:organisation,postcode:postcode}, 
				success:function(data){
					$("#errors").html(data);
				}
			});
		}
	//return false;
})
	
</script>
