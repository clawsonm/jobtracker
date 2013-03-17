<?php
function postgroup()
{
if(isset($_POST['save_group']) && $_POST['save_group'] == 'S')
{
    //handle saving group data
    
    $groupid = $_POST['group_id'];
    settype($groupid, 'integer');
    $name = mysql_real_escape_string($_POST['name']);
    $abbr = mysql_real_escape_string($_POST['abbr']);
    if($_POST['login_type'] == 'a')
	$login_type = 'a';
    else
	$login_type = 'u';
    $password1 = mysql_real_escape_string($_POST['password1']);
    $password2 = mysql_real_escape_string($_POST['password2']);
    if($password1 == $password2)
	$password = $password1;
    else
	die("Passwords did not match!");
    $password = hash('sha256', $abbr . $password . 'jt');

    if($groupid == -1)
    {
	    mysql_query("INSERT INTO logingroup (fullname, name, login_type, password) VALUES('$name', '$abbr', '$login_type', '$password')") or die(mysql_error());
    }
    else
    {
	    mysql_query("UPDATE logingroup SET fullname='$name', name='$abbr', login_type='$login_type', password='$password' WHERE id='$groupid'");
    }
}
elseif(isset($_POST['delete_group']) && $_POST['delete_group'] = "D")
{
    $groupid = $_POST['group_id'];
    settype($groupid, 'integer');
    mysql_query("UPDATE logingroup SET removed='1' WHERE id='$groupid'");
}
}
?>
