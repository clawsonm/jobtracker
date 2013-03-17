<?php
//please run include/functions/postgroup.php: postgroup() first
function editgroup($group_id){
    if($group_id == -1)
    {
	$group_row = array("id" => $group_id, "fullname" => "", "name" => "", "login_type" => "u");
    }
    else
    {	
$group_result = mysql_query("SELECT * FROM logingroup WHERE id='$group_id'");
$group_row = mysql_fetch_array($group_result);
    }
?>
<div class="editrow">
<form autocomplete="off" action="#" method="post">
<table>
<tr>
<td>
<?php
    echo('<input type="text" name="name" size="40" maxlength="40" value="' . $group_row['fullname'] . '" /> <br />
	<div style="float: right;"><label for="passworda' . $group_row['id'] .'"><span>Enter Password:</span></label> <br /><label for="passwordb' . $group_row['id'] . '"><span>Retype Password:</span></label></div>');
?>
</td>

<td>
<?php
    echo('<input type="text" name="abbr" maxlength="20" value="' . $group_row['name'] . '" /> <br />');
    echo('<input type="password" id="passworda' . $group_row['id'] . '" name="password1" /> <br />');
    echo('<input type="password" id="passwordb' . $group_row['id'] . '" name="password2" />');
?>
</td>

<td>
<?php
    echo('<select name="login_type">
	    <option ' . (($group_row['login_type'] == 'u') ? 'selected="selected" ' : ''). 'value="u">User</option>
	    <option ' . (($group_row['login_type'] == 'a') ? 'selected="selected" ' : ''). 'value="a">Admin</option>
	</select>');
    echo('<input type="hidden" name="group_id" value="' . $group_row['id'] . '" />');
?>
</td>

<td>
<input type="submit" name="save_group" value="S" /><br />
<input type="button" name="cancel_edit" value="X" /><br />
<input type="submit" name="delete_group" value="D" />
</td>

</tr>
</table>
</form>
</div>
<?php
}
?>
