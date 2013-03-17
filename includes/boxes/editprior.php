<?php
//please run include/functions/postprior.php: postprior() first
function editprior($prior_id){
    if($prior_id == -1)
    {
	$prior_row = array("id" => $prior_id, "name" => "");
    }
    else
    {	
$prior_result = mysql_query("SELECT * FROM priority WHERE id='$prior_id'");
$prior_row = mysql_fetch_array($prior_result);
    }
?>
<div class="editrow">
<form autocomplete="off" action="#" method="post">
<table>
<tr>
<td>
<?php
    echo('<input type="text" name="name" size="40" maxlength="40" value="' . $prior_row['name'] . '" />');
    echo('<input type="hidden" name="prior_id" value="' . $prior_row['id'] . '" />');
?>
</td>

<td>
<input type="submit" name="save_prior" value="S" /><br />
<input type="button" name="cancel_edit" value="X" /><br />
<input type="submit" name="delete_prior" value="D" />
</td>

</tr>
</table>
</form>
</div>
<?php
}
?>
