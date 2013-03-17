<?php
//please run include/functions/poststat.php: poststat() first
function editstat($stat_id){
    if($stat_id == -1)
    {
	$stat_row = array("id" => $stat_id, "name" => "", "hide" => 0);
    }
    else
    {	
$stat_result = mysql_query("SELECT * FROM status WHERE id='$stat_id'");
$stat_row = mysql_fetch_array($stat_result);
    }
?>
<div class="editrow">
<form autocomplete="off" action="#" method="post">
<table>
<tr>
<td>
<?php
    echo('<input type="text" name="name" size="15" maxlength="15" value="' . $stat_row['name'] . '" />');
    echo('<input type="checkbox" name="hide" value="hide" /> Hide <br />');
    echo('<input type="hidden" name="stat_id" value="' . $stat_row['id'] . '" />');
?>
</td>

<td>
<input type="submit" name="save_stat" value="S" /><br />
<input type="button" name="cancel_edit" value="X" /><br />
<input type="submit" name="delete_stat" value="D" />
</td>

</tr>
</table>
</form>
</div>
<?php
}
?>
