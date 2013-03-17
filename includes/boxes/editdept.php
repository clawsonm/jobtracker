<?php
//please run include/functions/postdept.php: postdept() first
function editdept($dept_id){
    if($dept_id == -1)
    {
	$dept_row = array("id" => $dept_id, "name" => "", "abbreviation" => "");
    }
    else
    {	
$dept_result = mysql_query("SELECT * FROM department WHERE id='$dept_id'");
$dept_row = mysql_fetch_array($dept_result);
    }
?>
<div class="editrow">
<form autocomplete="off" action="#" method="post">
<table>
<tr>
<td>
<?php
    echo('<input type="text" name="name" size="40" maxlength="40" value="' . $dept_row['name'] . '" />');
?>
</td>

<td>
<?php
    echo('<input type="text" name="abbr" maxlength="20" value="' . $dept_row['abbreviation'] . '" />');
    echo('<input type="hidden" name="dept_id" value="' . $dept_row['id'] . '" />');
?>
</td>

<td>
<input type="submit" name="save_dept" value="S" /><br />
<input type="button" name="cancel_edit" value="X" /><br />
<input type="submit" name="delete_dept" value="D" />
</td>

</tr>
</table>
</form>
</div>
<?php
}
?>
