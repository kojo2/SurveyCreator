<?php echo form_open('/Login/login_submit');?>
<label for="username">Username:</label>
<input type="text" id="username" name="username"></input>
<label for="pw">Password:</label>
<input type="password" id="pw" name="pw"></input>

<input type="submit"></input>
<?php echo form_close();?>