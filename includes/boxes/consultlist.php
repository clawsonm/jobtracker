<?php
function consultlist($show_deleted = false)
{
require_once('editconsult.php');
if($show_deleted)
    $show_deleted = "";
else
    $show_deleted = "WHERE removed=0";
$consult_result=mysql_query("SELECT consultant.*, client.lastname, client.firstname, logingroup.name AS grpabbr, department.abbreviation AS deptabbr FROM consultant LEFT JOIN logingroup ON consultant.group_fkey=logingroup.id LEFT JOIN client ON consultant.client_fkey=client.id LEFT JOIN department ON client.department_fkey=department.id $show_deleted ORDER BY grpabbr ASC") or die(mysql_error());
?>
<dl>
<dt class="togglesection">Consultants</dt>
<dd>
<table id="consultlist" class="tablesorter">
<thead><tr><th>Group</th><th>Lastname, Firstname</th><th>Dept</th><th>Radio</th><th>Notify</th><th>Edit</th></tr><tr><th colspan="6"><?php echo('<a class="editbutton" href="">');?>Add Consultant</a><?php editconsult(-1); ?></th></tr></thead><tbody>
<?php
while ($consult_row = mysql_fetch_array($consult_result))
{
    echo('<tr>');

    echo('<td' . ( ($consult_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $consult_row['grpabbr'] . '</td>');

    echo('<td' . ( ($consult_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $consult_row['lastname'] . ', ' . $consult_row['firstname'] . '</td>');

    echo('<td' . ( ($consult_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $consult_row['deptabbr'] . '</td>');

    echo('<td' . ( ($consult_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . (($consult_row['radio'] == 1) ? 'Yes' : 'No') . '</td>');

    echo('<td' . ( ($consult_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . (($consult_row['notify'] == 1) ? 'Yes' : 'No') . '</td>');

    echo('<td><a class="editbutton" href="">E</a>');
    editconsult($consult_row['id']);
    echo('</td></tr>'); 
}

?>
</tbody>
</table>
</dd>
</dl>
<?php
} //end function
?>
