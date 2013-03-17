<?php
//please run include/functions/postaddr.php: postaddr() first
function editaddr($addr_type,$addr_id){
    if($addr_id == -1)
    {
	$addr_row = array("id" => $addr_id, "addr_type" => $addr_type, "building_fkey" => "0", "room" => "", "address1" => "", "address2" => "", "city" => "", "state" => "", "zip" => "", "country" => "USA");
    }
    else
    {	
$addr_result = mysql_query("SELECT * FROM address WHERE id='$addr_id'");
$addr_row = mysql_fetch_array($addr_result);
    }
?>
<div class="editrow">
<form autocomplete="off" action="#" method="post">
<table>
<tr>
<td>
<?php
    echo('<input type="hidden" name="addr_type" value="' . $addr_type .'" />');
    if($addr_type == 'b')
    {
	echo('<input type="text" name="room" size="5" maxlength="5" value="' . $addr_row['room'] . '" />');
?>
</td>

<td>
<select name="building">
<?php
	$bldg_result = mysql_query("SELECT * FROM building");
	while($bldg_row = mysql_fetch_array($bldg_result))
	{
	    echo('<option ' . (($addr_row['building_fkey'] == $bldg_row['id']) ? 'selected="selected" ': '' ) . ' value="' . $bldg_row['id'] . '">' . $bldg_row['abbreviation'] . '</option>');
	}
?>
</select>
<?php
    }
    else
    {
	echo('<input type="text" name="address1" size="20" maxlength="40" value="' . $addr_row['address1'] . '" />');
?>
</td>

<td>
<?php
	echo('<input type="text" name="address2" size="20" maxlength="40" value="' . $addr_row['address2'] . '" />');
?>
</td>

<td>
<?php
	echo('<input type="text" name="city" size="12" maxlength="30" value="' . $addr_row['city'] . '" />');
?>
</td>

<td>
<?php
	echo('<input type="text" name="state" size="2" maxlength="2" value="' . $addr_row['state'] . '" />');
?>
</td>

<td>
<?php
	echo('<input type="text" name="zip" size="5" maxlength="10" value="' . $addr_row['zip'] . '" />');
?>
</td>

<td>
<?php
	echo('<input type="text" name="country" size="10" maxlength="20" value="' . $addr_row['country'] . '" />');
    }
    echo('<input type="hidden" name="addr_id" value="' . $addr_row['id'] . '" />');
?>
</td>

<td>
<input type="submit" name="save_addr" value="S" /><br />
<input type="button" name="cancel_edit" value="X" /><br />
<input type="submit" name="delete_addr" value="D" />
</td>

</tr>
</table>
</form>
</div>
<?php
}
?>
