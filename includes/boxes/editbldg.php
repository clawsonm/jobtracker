<?php
//please run include/functions/postbldg.php: postbldg() first
function editbldg($bldg_id){
    if($bldg_id == -1)
    {
	$bldg_row = array("id" => $bldg_id, "name" => "", "abbreviation" => "");
    }
    else
    {	
$bldg_result = mysql_query("SELECT * FROM building WHERE id='$bldg_id'");
$bldg_row = mysql_fetch_array($bldg_result);
    }
?>
<div class="editrow">
<form autocomplete="off" action="#" method="post">
<table>
<tr>
<td>
<?php
    echo('<input type="text" name="name" size="40" maxlength="40" value="' . $bldg_row['name'] . '" />');
?>
</td>

<td>
<?php
    echo('<input type="text" name="abbr" size="5" maxlength="5" value="' . $bldg_row['abbreviation'] . '" />');
    echo('<input type="hidden" name="bldg_id" value="' . $bldg_row['id'] . '" />');
?>
</td>

<td>
<input type="submit" name="save_bldg" value="S" /><br />
<input type="button" name="cancel_edit" value="X" /><br />
<input type="submit" name="delete_bldg" value="D" />
</td>

</tr>
</table>
</form>
</div>
<?php
}
?>
