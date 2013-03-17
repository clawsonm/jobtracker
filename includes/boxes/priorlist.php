<?php
function priorlist($show_deleted = false)
{
require_once('editprior.php');
if($show_deleted)
    $show_deleted = "";
else
    $show_deleted = "WHERE removed=0";
$prior_result=mysql_query("SELECT * FROM priority $show_deleted ORDER BY name ASC") or die(mysql_error());
?>
<dl>
<dt class="togglesection">Priorities</dt>
<dd>
<table id="priorlist" class="tablesorter">
<thead><tr><th>Name</th><th>Edit</th></tr><tr><th colspan="2"><?php echo('<a class="editbutton" href="">');?>Add Priority</a><?php editprior(-1); ?></th></tr></thead><tbody>
<?php
while ($prior_row = mysql_fetch_array($prior_result))
{
    echo('<tr>');

    echo('<td' . ( ($prior_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $prior_row['name'] . '</td>');

    echo('<td><a class="editbutton" href="">E</a>');
    editprior($prior_row['id']);
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
