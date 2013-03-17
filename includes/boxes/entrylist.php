<?php
function entrylist($task_id, $loggedin_admin = false)
{
require_once('editentry.php');
if(!isset($task_id) || $task_id < 1)
    echo('<h4 class="notice">No work done.</h4>');
else{
$entry_result=mysql_query("SELECT taskentry.*,client.lastname,client.firstname FROM taskentry LEFT JOIN consultant ON consultant.id=taskentry.consultant_fkey LEFT JOIN client ON client.id=consultant.client_fkey WHERE task_fkey=$task_id AND taskentry.removed=0 ORDER BY entered DESC") or die(mysql_error());
?>
<dl>
<dt class="togglesection">Work Done</dt>
<dd>
<table id="entrylist" class="tablesorter">
<thead><tr><th>Consultant</th><th>Updated</th><th>Time</th><th>Description</th><th>Edit</th></tr><tr><th colspan="5"><?php echo('<a class="editbutton" href="">');?>Add Work Done</a><?php editentry(-1); ?></th></tr></thead><tbody>
<?php
if(mysql_num_rows($entry_result) == 0)
    echo('<tr>
	<td colspan="5">
	<div>
	<h4 class="notice">No Work Done</h4>
	</div>
	</td>
	</tr>
	');
while ($entry_row = mysql_fetch_array($entry_result))
{
    echo('<tr>');

    echo('<td>' . $entry_row['lastname'] . ", " . $entry_row['firstname'] . '</td>');

    echo('<td>' . $entry_row['updated'] . '</td>');

    echo('<td>' . $entry_row['timespent'] . '</td>');

    echo('<td>' . nl2br(wordwrap($entry_row['description'], 65)) . '</td>');

    echo('<td><a class="editbutton" href="">E</a>');
    editentry($entry_row['id'], $loggedin_admin);
    echo('</td></tr>'); 
}

?>
</tbody>
</table>
</dd>
</dl>
<?php
} //end func arg test
} //end function
?>
