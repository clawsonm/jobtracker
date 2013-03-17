<?php
function postconsult()
{
if(isset($_POST['save_consult']) && $_POST['save_consult'] == 'S')
{
    //handle saving consult data
    
    $consultid = $_POST['consult_id'];
    settype($consultid, 'integer');
    $client = $_POST['client'];
    settype($client, 'integer');
    $group = $_POST['group'];
    settype($group, 'integer');
    $radio = (($_POST['radio'] == 'has-radio') ? 1 : 0);
    $notify = (($_POST['notify'] == 'will-notify') ? 1 : 0);
    if($consultid == -1)
    {
	mysql_query("INSERT INTO consultant (client_fkey, group_fkey, radio, notify) VALUES('$client', '$group', '$radio', '$notify')") or die(mysql_error());
    }
    else
    {
	mysql_query("UPDATE consultant SET client_fkey='$client', group_fkey='$group', radio='$radio', notify='$notify' WHERE id='$consultid'");
    }
}
elseif(isset($_POST['delete_consult']) && $_POST['delete_consult'] = "D")
{
    $consultid = $_POST['consult_id'];
    settype($consultid, 'integer');
    mysql_query("UPDATE consultant SET removed='1' WHERE id='$consultid'");
}
}
?>
