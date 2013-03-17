<?php
//please run include/functions/postclient.php: postclient() first
function editclient($client_id){
    if($client_id == -1)
    {
	$client_row = array("id" => $client_id, "lastname" => "", "firstname" => "", "room" => "", "building_fkey" => -1, "email" => "", "homephone" => "", "workphone" => "", "cellphone" => "", "chair" => 0, "department_fkey" => -1, "removed" => 0);
    }
    else
    {	
$client_result = mysql_query("SELECT * FROM client WHERE id='$client_id'");
$client_row = mysql_fetch_array($client_result);
    }
?>
<div class="editrow">
<form autocomplete="off" action="#" method="post">
<table>
<tr>
<td>
<?php
    echo('<input type="text" name="lastname" size="10" maxlength="40" value="' . $client_row['lastname'] . '" />, <input type="text" name="firstname" size="10" maxlength="40" value="' . $client_row['firstname'] . '" />');
?>
</td>

<td>
    <select name="department">
<?php
    //department
    $dept_result = mysql_query("SELECT * FROM department");
    while ($dept_row = mysql_fetch_array($dept_result))
    {
	echo('<option ' . (($dept_row['id'] == $client_row['department_fkey']) ? 'selected="selected" ' : '') . 'value="' . $dept_row['id'] . '">' . $dept_row['abbreviation'] . '</option>');
    }
?>
    </select>
</td>

<td>
<?php
    echo('<input type="text" name="room" size="4" maxlength="5" value="' . $client_row['room'] . '" /><select name="building">');
    $bldg_result = mysql_query("SELECT * FROM building");
    while ($bldg_row = mysql_fetch_array($bldg_result))
    {
	echo('<option ' . (($bldg_row['id'] == $client_row['building_fkey']) ? 'selected="selected" ' : '' ) . 'value="' . $bldg_row['id'] . '">' . $bldg_row['abbreviation'] . '</option>');
    }
?>
    </select>
</td>

<td>
<?php
    echo('<input type="text" name="workphone" size="4" maxlength="11" value="' . $client_row['workphone'] . '" />');
?>
</td>

<td>
<?php
    echo('<input type="text" name="cellphone" size="7" maxlength="11" value="' . $client_row['cellphone'] . '" />');
?>
</td>

<td>
<?php
    echo('<input type="text" name="homephone" size="7" maxlength="11" value="' . $client_row['homephone'] . '" />');
?>
</td>

<td>
<?php
    echo('<input type="text" name="email" size="12" maxlength="40" value="' . $client_row['email'] . '" />');
?>
</td>

<td>
<?php
    echo('<input type="checkbox" name="chair" ' . (($client_row['chair'] == 1) ? 'checked="checked" ' : '') . 'value="is-chair" />');
    echo('<input type="hidden" name="client_id" value="' . $client_row['id'] . '" />');
?>
</td>

<td>
<input type="submit" name="save_client" value="S" /><br />
<input type="button" name="cancel_edit" value="X" /><br />
<input type="submit" name="delete_client" value="D" />
</td>

</tr>
</table>
</form>
</div>
<?php
}
?>
