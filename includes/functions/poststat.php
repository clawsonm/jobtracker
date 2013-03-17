<?php
function poststat()
{
if(isset($_POST['save_stat']) && $_POST['save_stat'] == 'S')
{
    //handle saving stat data
    
    $statid = $_POST['stat_id'];
    settype($statid, 'integer');
    $name = mysql_real_escape_string($_POST['name']);
    $hide = (isset($_POST['hide']) && $_POST['hide'] == "hide") ? 1 : 0;
    if($statid == -1)
    {
	mysql_query("INSERT INTO status (name,hide) VALUES('$name','$hide')") or die(mysql_error());
    }
    else
    {
	mysql_query("UPDATE status SET name='$name', hide='$hide' WHERE id='$statid'");
    }
}
elseif(isset($_POST['delete_stat']) && $_POST['delete_stat'] = "D")
{
    $statid = $_POST['stat_id'];
    settype($statid, 'integer');
    mysql_query("UPDATE status SET removed='1' WHERE id='$statid'");
}
}
?>
