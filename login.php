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
include('includes/header.php');
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
