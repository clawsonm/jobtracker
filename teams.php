<?php
require_once("includes/config.php");
$require_admin = true;
include('includes/header.php');
$admin_login = $user->isAdmin();

include('includes/pagetop.php');
include('includes/boxes/topmenu.php'); ?>
<hr />
<div class="contentwrapper">
<?php

$teamlist = new JT_Teams();

$teamlistview = new JT_TeamListView($teamlist);

$teamlistview->render();

?>

</div>
<?php
include('includes/footer.php');
$_SESSION['breadcrumb'] = 'teams';    
?>
