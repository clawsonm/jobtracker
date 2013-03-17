<?php
function joblist($joblist_where = "")
{
if(isset($joblist_where) && strlen($joblist_where) > 1)
    $joblist_where = "WHERE $joblist_where";
else
    $joblist_where = "";
$task_result = mysql_query("SELECT * FROM task $joblist_where") or die(mysql_error());
if(mysql_num_rows($task_result) == 0)
    echo('<h4 class="notice">No Tasks Here</h4>');
else
{
?>
<dl>
<dt class="togglesection">Task List</dt>
<dd>
<table id="tasklist" class="tablesorter">
<thead><tr><th>Client</th><th>Assigned to</th><th>Status</th><th>Priority</th><th>Title</th></tr></thead><tbody>
<?php
while($task_row = mysql_fetch_array($task_result))
{
    echo('<tr>');
    //client
    $client_result = mysql_query("SELECT * FROM client WHERE id='" . $task_row['client_fkey'] . "'") or die(mysql_error());
    $client_row = mysql_fetch_array($client_result);
    echo('<td>' . $client_row['lastname'] . ', ' . $client_row['firstname'] . '</td>');
    //assignedto
    if(!is_null($task_row['assignedto']))
    {
	$consult_result = mysql_query("SELECT consultant.*, client.lastname, client.firstname FROM consultant LEFT JOIN client ON consultant.client_fkey=client.id WHERE consultant.id='" . $task_row['assignedto'] . "'") or die(mysql_error());
	$consult_row = mysql_fetch_array($consult_result);
	echo('<td>' . $consult_row['lastname'] . ', ' . $consult_row['firstname'] . '</td>');
    }
    else
	echo ('<td>        </td>');
    //status
    $status_result = mysql_query("SELECT * FROM status WHERE id='" . $task_row['status_fkey'] . "'") or die(mysql_error());
    $status_row = mysql_fetch_array($status_result);
    echo('<td>' . $status_row['name'] . '</td>');
    //priority
    $priority_result = mysql_query("SELECT * FROM priority WHERE id='" . $task_row['priority_fkey'] . "'") or die(mysql_error());
    $priority_row = mysql_fetch_array($priority_result);
    echo('<td>' . $priority_row['name'] . '</td>');
    //title
    echo('<td><a ' . (($task_row['removed'] == 1) ? 'class="deleteditem"' : '') . 'href="taskdetail.php?task=' . $task_row['id'] . '">' . $task_row['title'] . '</a></td>');
    echo('</tr>');
}
?>
</tbody>
</table>
</dd>
<?php
}
}
?>
