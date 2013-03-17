<?php
function postboxes($task_id)
{
if(isset($_POST['save_entry']) && $_POST['save_entry'] == 'S')
{
    //handle saving entry data
    
    $entryid = $_POST['entry_id'];
    settype($entryid, 'integer');
    $consult_fkey = $_POST['consultant'];
    settype($consult_fkey, 'integer');
    $timespent = mysql_real_escape_string($_POST['timespent']);
    $desc = mysql_real_escape_string($_POST['entry_desc']);
    if($entryid == -1)
    {
	mysql_query("INSERT INTO taskentry (task_fkey, consultant_fkey, entered, timespent, description) VALUES('$task_id', '$consult_fkey', NOW(), '$timespent', '$desc')") or die(mysql_error());
    }
    else
    {
	mysql_query("UPDATE taskentry SET consultant_fkey='$consult_fkey', timespent='$timespent', description='$desc' WHERE id='$entryid'");
    }
}
elseif(isset($_POST['delete_entry']) && $_POST['delete_entry'] = "D")
{
    $entryid = $_POST['entry_id'];
    settype($entryid, 'integer');
    mysql_query("UPDATE taskentry SET removed='1' WHERE id='$entryid'");
}
}
?>
