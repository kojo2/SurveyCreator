<?php echo form_open('/Register/register_submit');?>
<label for="username">Username:</label>
<input type="text" id="username" name="username"></input>
<label for="pw">Password:</label>
<input type="password" id="pw" name="pw"></input>
<label for="cpw">Confirm password:</label>
<input type="password" id="cpw" name="cpw"></input>
<input type="submit" id="submit"></input>

<?php echo form_close();?>
