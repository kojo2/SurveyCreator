Welcome <?php echo $username; ?><br>
This is the admin page. From here you can edit questions, edit users, generate reports, edit visitors and view their answers and details.

<ul>
<li style="left: -20px;"><a href="<?php echo base_url();?>index.php/Admin/EditQuestions">Questions</a></li>
<li style="left: -20px;"><a href="<?php echo base_url();?>index.php/Reports">Reports</a></li>
<li style="left: -20px;"><a href="<?php echo base_url();?>index.php/Admin/SyncData">Sync Data</a></li>
<li style="left: -20px;"><a href="<?php echo base_url();?>index.php/Admin/RegisterDevice">Register Device</a></li>
</ul>
