<?php
$jt_no_login = true;
require_once('includes/config.php');
require_once(JT_INCLUDES . '/dbinit.php');

//login form submission
if(isset($_POST['login']))
{
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);

    if($login->authenticate($username, $password))
        header("Location: index.php");
    else
        header("Location: login.php");
    exit();
}

//already logged in
if($login->verify())
{
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html PUBLIC  "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>Job Tracker 3.0</title>
<link rel="stylesheet" href="css/common.css" />
<script type="text/javascript" src="js/jquery.js"></script>

</head>
<body>

<?php
include('includes/pagetop.php');
?>

<div class="loginwrapper">
<form action="login.php" method="post">
	<label for="username"><span>User:</span></label><input type="textbox" id="username" name="username"/><br style="clear: both"/>
	<label for="password"><span>Password:</span></label><input type="password" name="password" id="password"/>
	<input type="submit" name="login" id="submit" value="Login"/>
</form>
</div>

<?php
include('includes/footer.php');
?>
