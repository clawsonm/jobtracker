<?php
function addrlist($show_deleted = false)
{
require_once('editaddr.php');
if($show_deleted)
    $show_deleted = "";
else
    $show_deleted = "AND removed=0";
?>
<dl>
<dt class="togglesection">Addresses</dt>
<dd>
<table id="addrlist1" class="tablesorter">
<thead><tr><th>Room</th><th>Building</th><th>Edit</th></tr><tr><th colspan="3"><?php echo('<a class="editbutton" href="">');?>Add Building Address</a><?php editaddr('b',-1); ?></th></tr></thead><tbody>
<?php
$addr_result=mysql_query("SELECT address.*, building.abbreviation AS bldgabbr FROM address LEFT JOIN building ON address.building_fkey=building.id WHERE addr_type='b' $show_deleted ORDER BY bldgabbr ASC") or die(mysql_error());
while ($addr_row = mysql_fetch_array($addr_result))
{
    echo('<tr>');

    echo('<td' . ( ($addr_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $addr_row['room'] . '</td>');

    echo('<td' . ( ($addr_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $addr_row['bldgabbr'] . '</td>');

    echo('<td><a class="editbutton" href="">E</a>');
    editaddr('b', $addr_row['id']);
    echo('</td></tr>'); 
}

?>
</tbody>
</table>
<table id="addrlist2" class="tablesorter">
<thead><tr><th>Address 1</th><th>Address 2</th><th>City</th><th>State</th><th>Zip</th><th>Country</th><th>Edit</th></tr><tr><th colspan="7"><?php echo('<a class="editbutton" href="">');?>Add Street Address</a><?php editaddr('s',-1); ?></th></tr></thead><tbody>
<?php
$addr_result=mysql_query("SELECT * FROM address WHERE addr_type='s' $show_deleted ORDER BY state ASC") or die(mysql_error());
while ($addr_row = mysql_fetch_array($addr_result))
{
    echo('<tr>');

    echo('<td' . ( ($addr_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $addr_row['address1'] . '</td>');

    echo('<td' . ( ($addr_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $addr_row['address2'] . '</td>');
    
    echo('<td' . ( ($addr_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $addr_row['city'] . '</td>');

    echo('<td' . ( ($addr_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $addr_row['state'] . '</td>');
    
    echo('<td' . ( ($addr_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $addr_row['zip'] . '</td>');
    
    echo('<td' . ( ($addr_row['removed'] == 1) ? ' class="deleteditem"' : '') . '>' . $addr_row['country'] . '</td>');

    echo('<td><a class="editbutton" href="">E</a>');
    editaddr('s', $addr_row['id']);
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
