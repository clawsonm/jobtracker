<?php
error_reporting(E_ALL);

$curfolder = dirname(__FILE__);
$base = realpath($curfolder . '/../');

define('JT_ROOT', $base);
define('JT_INCLUDES', JT_ROOT . '/includes');
define('JT_CLASSES', JT_ROOT . '/classes' );
define('JT_VIEWS', JT_CLASSES . '/views');
define('JT_FILES', JT_ROOT . '/files/');
define('JT_FILES_LOC', 'files/');

spl_autoload_register(function ($class) {
    if(strstr($class, "View") != false)
        require_once(JT_VIEWS . "/$class.php");
    else
        require_once(JT_CLASSES . "/$class.php");
});

date_default_timezone_set("America/Denver");

include(JT_INCLUDES . '/dbinit.php');

session_start();
$user = NULL;
$login = new JT_Login();
if(!isset($jt_no_login) && !$login->verify())
{
    header("Location: login.php");
    exit();
}
if(isset($require_admin) && $require_admin && !$user->isAdmin())
{
    header("Location: index.php");
}

?>
