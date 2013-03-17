<?php
//please run include/functions/postconsult.php: postconsult() first
function editconsult($consult_id){
    if($consult_id == -1)
    {
	$consult_row = array("id" => $consult_id, "client_fkey" => -1, "group_fkey" => -1, "radio" => 0, "notify" => 0, "removed" => 0);
    }
    else
    {	
$consult_result = mysql_query("SELECT consultant.*, department.id AS deptid FROM consultant LEFT JOIN client ON consultant.client_fkey=client.id LEFT JOIN department ON client.department_fkey=department.id WHERE consultant.id='$consult_id'");
$consult_row = mysql_fetch_array($consult_result);
    }
?>
<div class="editrow">
<form autocomplete="off" action="#" method="post">
<table>
<tr>
<td>
<select name="group">
<?php
    $group_result = mysql_query("SELECT * FROM logingroup");
    while ($group_row = mysql_fetch_array($group_result))
    {
	echo('<option ' . (($group_row['id'] == $consult_row['group_fkey']) ? 'selected="selected" ': '') .'value="' . $group_row['id'] . '">' . $group_row['name'] . '</option>');
    }
?>
</select>
</td>

<td>
<select name="client">
<?php
    $client_result = mysql_query("SELECT * FROM client");
    while ($client_row = mysql_fetch_array($client_result))
    {
	echo('<option ' . (($client_row['id'] == $consult_row['client_fkey']) ? 'selected="selected" ': '') .'value="' . $client_row['id'] . '">' . $client_row['lastname'] . ', ' . $client_row['firstname'] . '</option>');
    }
?>
</select>
<select>
<?php
    $dept_result = mysql_query("SELECT * FROM department");
    while ($dept_row = mysql_fetch_array($dept_result))
    {
	echo('<option ' . (($dept_row['id'] == $consult_row['deptid']) ? 'selected="selected" ': '') . 'value="' . $dept_row['id'] . '">' . $dept_row['abbreviation'] . '</option>');
    }
?>
</select>
</td>

<td>
<?php
    echo('<input type="checkbox" name="radio" ' . (($consult_row['radio'] == 1) ? 'checked="checked" ': '') . 'value="has-radio" />');
?>
</td>

<td>
<?php
    echo('<input type="checkbox" name="notify" ' . (($consult_row['notify'] == 1) ? 'checked="checked" ': '') . 'value="will-notify" />');
    echo('<input type="hidden" name="consult_id" value="' . $consult_row['id'] . '" />');
?>
</td>

<td>
<input type="submit" name="save_consult" value="S" /><br />
<input type="button" name="cancel_edit" value="X" /><br />
<input type="submit" name="delete_consult" value="D" />
</td>

</tr>
</table>
</form>
</div>
<?php
}
?>
