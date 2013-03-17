<?php
function postprior()
{
if(isset($_POST['save_prior']) && $_POST['save_prior'] == 'S')
{
    //handle saving prior data
    
    $priorid = $_POST['prior_id'];
    settype($priorid, 'integer');
    $name = mysql_real_escape_string($_POST['name']);
    if($priorid == -1)
    {
	mysql_query("INSERT INTO priority (name) VALUES('$name')") or die(mysql_error());
    }
    else
    {
	mysql_query("UPDATE priority SET name='$name' WHERE id='$priorid'");
    }
}
elseif(isset($_POST['delete_prior']) && $_POST['delete_prior'] = "D")
{
    $priorid = $_POST['prior_id'];
    settype($priorid, 'integer');
    mysql_query("UPDATE priority SET removed='1' WHERE id='$priorid'");
}
}
?>
