<?php
$msg =  isset($parameters[0]['msg'])? $parameters[0]['msg'] : '';
?>
<span style="color: red"><?php echo $msg;?></span>
<table width="100%" border="1">
  <tr>
    <td colspan="6"><a href="<?=BASE_URL;?>/users/adduserview">Add New</a></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>ID</strong></td>
    <td bgcolor="#CCCCCC"><strong>Username</strong></td>
    <td bgcolor="#CCCCCC"><strong>Date Created </strong></td>
    <td bgcolor="#CCCCCC"><strong>Date Modified </strong></td>
    <td bgcolor="#CCCCCC"><strong>Edit</strong></td>
    <td bgcolor="#CCCCCC"><strong>Delete</strong></td>
  </tr>
  <?php
  foreach($parameters as $key=>$val)
  {
  ?>
  <tr>
    <td><?php echo $val['id'];?>&nbsp;</td>
    <td><?php echo $val['username'];?>&nbsp;</td>
    <td><?php echo $val['date_created'];?>&nbsp;</td>
    <td><?php echo $val['date_updated'];?>&nbsp;</td>
    <td><a href="<?=BASE_URL;?>/users/edituserview/<?php echo $val['id'];?>">Edit</a>&nbsp;</td>
    <td><a href="<?=BASE_URL;?>/users/deleteuser/<?php echo $val['id'];?>">Delete</a>&nbsp;</td>
  </tr>
  <?php
  }
  ?>
</table>

				