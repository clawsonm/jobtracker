<?php
function statlist($show_deleted = false)
{
require_once('editstat.php');
if($show_deleted)
    $show_deleted = "";
else
    $show_deleted = "WHERE removed=0";
$stat_result=mysql_query("SELECT * FROM status $show_deleted ORDER BY name ASC") or die(mysql_error());
?>
<dl>
<dt class="togglesection">Statuses</dt>
<dd>
<table id="statlist" class="tablesorter">
<thead><tr><th>Name</th><th>Hide</th><th>Edit</th></tr><tr><th colspan="3"><?php echo('<a class="editbutton" href="">');?>Add Status</a><?php editstat(-1); ?></th></tr></thead><tbody>
<?php
while ($stat_row = mysql_fetch_array($stat_result))
{
    echo('<tr>');

    echo('<td' . ( ($stat_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $stat_row['name'] . '</td>');

    echo('<td>' . ( ($stat_row['hide'] == 1) ? 'true' : 'false') . '</td>');

    echo('<td><a class="editbutton" href="">E</a>');
    editstat($stat_row['id']);
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
