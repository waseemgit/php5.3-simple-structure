<?php
$msg =  isset($parameters['2'])? $parameters['2'] : '';
session_destroy();
?>
<span style="color: red;margin-left: 800px;"><?php echo $msg;?></span>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<title>Login DVO</title>
</head>
<body>
    <form action="<?=BASE_URL;?>/users/confirm" method="post" name="myform" onsubmit="return validate();">
        <table width="200" border="1" align="center">
            <tr>
              <td><strong>UserName</strong></td>
              <td><input id="username" name="username" type="text" placeholder="User Name" /></td>
            </tr>
            <tr>
              <td><strong>Password</strong></td>
              <td><input id="password" name="password" type="password" placeholder="Password" /></td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;<input type="submit" value="Login" /></td>
            </tr>
      </table>
				
    </form>
</body>	
</html>
<script type = "text/javascript">
function validate()
 {

	var un = document.getElementById("username").value;
	var pw = document.getElementById('password').value;
	if(un==''){alert('Please enter username');return false;}
	if(pw==''){alert('Please enter password');return false;}
}


</script>

