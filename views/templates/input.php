	<textarea></textarea>

<script>

var choice;

		$("textarea").change(function(){
			choice = $(this).val();	
			//alert("choice is: "+choice);
		});

/*});*/

</script>

<style>
textarea {
	 width: 90%;
}
</style>