<?php
function deptlist($show_deleted = false)
{
require_once('editdept.php');
if($show_deleted)
    $show_deleted = "";
else
    $show_deleted = "WHERE removed=0";
$dept_result=mysql_query("SELECT * FROM department $show_deleted ORDER BY name ASC") or die(mysql_error());
?>
<dl>
<dt class="togglesection">Departments</dt>
<dd>
<table id="deptlist" class="tablesorter">
<thead><tr><th>Name</th><th>Abbreviation</th><th>Edit</th></tr><tr><th colspan="3"><?php echo('<a class="editbutton" href="">');?>Add Department</a><?php editdept(-1); ?></th></tr></thead><tbody>
<?php
while ($dept_row = mysql_fetch_array($dept_result))
{
    echo('<tr>');

    echo('<td' . ( ($dept_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $dept_row['name'] . '</td>');

    echo('<td' . ( ($dept_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $dept_row['abbreviation'] . '</td>');

    echo('<td><a class="editbutton" href="">E</a>');
    editdept($dept_row['id']);
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
