<?php
//please run include/functions/postentry.php: postentry() first
function editentry($entry_id, $loggedin_admin = false){
    if($entry_id == -1)
    {
	$entry_row = array("id" => $entry_id, "task_fkey" => -1, "consultant_fkey" => -1, "entered" => time(), "updated" => time() , "timespent" => "00:00:00", "description" => "");
    }
    else
    {	
$entry_result = mysql_query("SELECT taskentry.*,client.lastname,client.firstname FROM taskentry LEFT JOIN consultant ON consultant.id=taskentry.consultant_fkey LEFT JOIN client ON client.id=consultant.client_fkey WHERE taskentry.id='$entry_id'");
$entry_row = mysql_fetch_array($entry_result);
    }
?>
<div class="editrow">
<form autocomplete="off" action="#" method="post">
<table>
<tr>
<td>
<select name="consultant">
<?php
    $consult_result = mysql_query("SELECT consultant.*, client.lastname, client.firstname FROM consultant INNER JOIN client ON consultant.client_fkey=client.id ORDER BY lastname") or die(mysql_error());
    while($consult_row = mysql_fetch_array($consult_result))
    {
	echo('<option' . ( ($entry_row['consultant_fkey'] == $consult_row['id']) ? ' selected="selected"' : "") . ' value="' . $consult_row['id'] . '">' . $consult_row['lastname'] . ", " . $consult_row['firstname'] . '</option>' . "\n");
    }
?>
</select>
</td>

<td>
<?php
    echo('<label for="timespent' . $entry_row['id'] . '">Time Spent:</label>');
    echo('<input type="hidden" name="entry_id" value="' . $entry_row['id'] . '" />');
?>
</td>

<td>
<?php
    echo('<input type="text" id="timespent' . $entry_row['id'] . '" name="timespent" size="6" value="' . $entry_row['timespent'] . '"/>');
?>
</td>

<td>
<textarea name="entry_desc" cols="45" rows="8">
<?php echo $entry_row['description']; ?>
</textarea>
</td>

<td>
<input type="submit" name="save_entry" value="S" /><br />
<input type="button" name="cancel_edit" value="X" />
<?php
    if($loggedin_admin)
	echo('<br />
	<input type="submit" name="delete_entry" value="D" />');
?>
</td>
</tr>
</table>
</form>
</div>
<?php
}
?>
