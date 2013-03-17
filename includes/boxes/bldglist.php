<?php
function bldglist($show_deleted = false)
{
require_once('editbldg.php');
if($show_deleted)
    $show_deleted = "";
else
    $show_deleted = "WHERE removed=0";
$bldg_result=mysql_query("SELECT * FROM building $show_deleted ORDER BY name ASC") or die(mysql_error());
?>
<dl>
<dt class="togglesection">Buildings</dt>
<dd>
<table id="bldglist" class="tablesorter">
<thead><tr><th>Name</th><th>Abbreviation</th><th>Edit</th></tr>
<tr><th colspan="3"><?php echo('<a class="editbutton" href="">');?>Add Building</a><?php editbldg(-1); ?></th></tr></thead><tbody>
<?php
while ($bldg_row = mysql_fetch_array($bldg_result))
{
    echo('<tr>');

    echo('<td' . ( ($bldg_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $bldg_row['name'] . '</td>');

    echo('<td' . ( ($bldg_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $bldg_row['abbreviation'] . '</td>');

    echo('<td><a class="editbutton" href="">E</a>');
    editbldg($bldg_row['id']);
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
