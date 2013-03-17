<?php
require_once("includes/config.php");
include("includes/header.php");
$admin_login = $user->isAdmin();
if(isset($_GET['team']))
    $_SESSION['display_team']=$_GET['team'];
else
    $_SESSION['display_team']=$user->getClientInfo()->getTeam()->getID();
if(isset($_GET['status']))
    $_SESSION['display_status'] = $_GET['status'];
else if(!isset($_SESSION['display_status']))
    $_SESSION['display_status'] = JT_Collection::HIDE;

include('includes/pagetop.php');
include('includes/boxes/topmenu.php');
include('includes/boxes/statusmenu.php');?>
<hr />
<div class="contentwrapper">
<?php
$tasks = new JT_Tasks($_SESSION['display_team'], NULL, $_SESSION['display_status']);
$tasklist = new JT_TaskListView($tasks);
$tasklist->render();

?>
</div>
<?php
include('includes/footer.php');
$_SESSION['breadcrumb'] = 'tasklist';    

?>
