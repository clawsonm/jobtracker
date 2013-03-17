<?php
function checkloggedin()
{
    if(isset($_COOKIE['groupid']))
    {
        $groupid = $_COOKIE['groupid'];
        settype($groupid,'integer');
        $login_result = mysql_query("SELECT * FROM logingroup WHERE id='$groupid'") or die(mysql_error());
        while($login_row = mysql_fetch_array($login_result))
        {
	        if($_COOKIE['groupname'] == $login_row['name'] && $_COOKIE['grouppw'] == $login_row['password'])
	        {
	            return ($login_row['login_type'] == 'a');
	        }
        }
    }
    else
    {
        header("Location: index.php");
    }
}
?>
