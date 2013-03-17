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

$clientlist = new JT_Clients();

$clientlistview = new JT_ClientListView($clientlist);

$clientlistview->render();

?>

</div>
<?php
include('includes/footer.php');
$_SESSION['breadcrumb'] = 'clients';    

?>
