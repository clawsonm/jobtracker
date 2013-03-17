<?php
function grouplist($show_deleted = false)
{
require_once('editgroup.php');
if($show_deleted)
    $show_deleted = "";
else
    $show_deleted = "WHERE removed=0";
$group_result=mysql_query("SELECT * FROM logingroup $show_deleted ORDER BY fullname ASC") or die(mysql_error());
?>
<dl>
<dt class="togglesection">Groups</dt>
<dd>
<table id="grouplist" class="tablesorter">
<thead><tr><th>Name</th><th>Abbreviation</th><th>Type</th><th>Edit</th></tr><tr><th colspan="4"><?php echo('<a class="editbutton" href="">');?>Add Group</a><?php editgroup(-1); ?></th></tr></thead><tbody>
<?php
while ($group_row = mysql_fetch_array($group_result))
{
    echo('<tr>');

    echo('<td' . ( ($group_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $group_row['fullname'] . ' <a href="tasklist.php?group=' . $group_row['id'] . '">View</a></td>');

    echo('<td' . ( ($group_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $group_row['name'] . '</td>');

    echo('<td' . ( ($group_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $group_row['login_type'] . '</td>');

    echo('<td><a class="editbutton" href="">E</a>');
    editgroup($group_row['id']);
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
