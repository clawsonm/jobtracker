<?php
function clientlist($show_deleted = false)
{
require_once('editclient.php');
if($show_deleted)
    $show_deleted = "";
else
    $show_deleted = "WHERE removed=0";
$client_result=mysql_query("SELECT client.*, building.abbreviation AS bldgabbr, department.abbreviation AS deptabbr FROM client LEFT JOIN building ON client.building_fkey=building.id LEFT JOIN department ON client.department_fkey=department.id $show_deleted ORDER BY lastname ASC") or die(mysql_error());
?>
<dl>
<dt class="togglesection">Clients</dt>
<dd>
<table id="clientlist" class="tablesorter">
<thead><tr><th>Lastname, Firstname</th><th>Department</th><th>Address</th><th>Phone</th><th>Cell</th><th>Home</th><th>Email</th><th>Chair</th><th>Edit</th></tr>
<tr><th colspan="9"><?php echo('<a class="editbutton" href="">');?>Add Client</a><?php editclient(-1); ?></th></tr></thead><tbody>
<?php
while ($client_row = mysql_fetch_array($client_result))
{
    echo('<tr>');

    echo('<td' . ( ($client_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $client_row['lastname'] . ', ' . $client_row['firstname'] . '</td>');

    echo('<td' . ( ($client_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $client_row['deptabbr'] . '</td>');

    echo('<td' . ( ($client_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $client_row['room'] . ' ' . $client_row['bldgabbr'] . '</td>');

    echo('<td' . ( ($client_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $client_row['workphone'] . '</td>');
    
    echo('<td' . ( ($client_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $client_row['cellphone'] . '</td>');

    echo('<td' . ( ($client_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $client_row['homephone'] . '</td>');
    
    echo('<td' . ( ($client_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $client_row['email'] . '</td>');
    
    echo('<td' . ( ($client_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . (($client_row['chair'] == 1) ? 'Yes' : 'No') . '</td>');


    echo('<td><a class="editbutton" href="">E</a>');
    editclient($client_row['id']);
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
