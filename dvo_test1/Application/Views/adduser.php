<?php
$msg        =  isset($parameters[2])          ? $parameters[2]        : '';
?>
<span style="color: red"><?php echo $msg;?></span>
<form method="post" name="adduser" action="<?=BASE_URL;?>/users/adduserindb" onsubmit="return validateForm();">
<table width="100%" border="1">
  <tr>
    <td><strong>Username</strong></td>
    <td><input type="text" name="username" id="username" /></td>    
  </tr>
    <tr>
    <td><strong>Password</strong></td>
    <td><input type="password" name="password" id="password" /></td>    
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="submit" />&nbsp;</td>

  </tr>
</table>
<input type="hidden" name="user_id" value="<?php echo $_GET['id'];?>" />
<input type="hidden" name="task" value="adduserindb" />
</form>

<script type = "text/javascript">
function validateForm()
{
	var un = document.getElementById('username').value;
        var pw = document.getElementById('password').value;
        
	if(un==''){alert('Please enter Username');return false;}
        if(pw==''){alert('Please enter password');return false;}
}
</script>