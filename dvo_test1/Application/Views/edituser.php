<?php
$msg        =  isset($parameters[0]['msg'])          ? $parameters[0]['msg']        : '';
$created_by =  isset($parameters[0]['created_by'])   ? $parameters[0]['created_by'] : '';
$username   =  isset($parameters[0]['username'])     ? $parameters[0]['username']   : '';
$password   =  isset($parameters[0]['password'])     ? $parameters[0]['password']   : '';
$id         =  isset($parameters[0]['id'])           ? $parameters[0]['id']         : '';
?>
<span style="color: red"><?php echo $msg;?></span>
<form method="post" name="edituser" action="<?=BASE_URL;?>/users/edituserindb" onsubmit="return validateForm();">
<table width="100%" border="1">
      <tr>
    <td><strong>Username</strong></td>
    <td><input type="text" name="username" id="username" value="<?php echo $username;?>"  /></td>    
  </tr>
  <tr>
    <td><strong>Password</strong></td>
    <td><input type="password" name="password" id="password" value="<?php echo $password;?>" /></td>
    
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td>
        <?php 
        if($created_by==$_SESSION['id'])
        {?>
            <input type="submit" value="submit" />&nbsp;</td>
        <?php
        }
        else
        {
        ?>
            <span style="color: red">Sorry you cannot edit this entry because you didnt create it</span><?php 
        }?>

  </tr>
</table>
<input type="hidden" name="user_id" value="<?php echo $id;?>" />
<input type="hidden" name="task" value="edituserindb" />
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