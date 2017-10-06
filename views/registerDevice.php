<button onclick="Register();">Register this device</button>

<script>

var key;

	function Register(){
		$.ajax({
			url:"****REDACTED****",
			success:function(data){
				window.location.href="<?php echo base_url();?>index.php/Admin/RegisterDeviceWithCode/"+data;
			},
			error:function(error){
				document.write("there was an error");
			}
		});
	}
</script>