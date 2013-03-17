<?php
require_once("includes/config.php");
$require_admin = true;
include('includes/header.php');
$admin_login = $user->isAdmin();

//post process
include('includes/pagetop.php');
include('includes/boxes/topmenu.php'); ?>
<hr />
<div class="contentwrapper">
<?php

$deptlist = new JT_Departments();

$deptlistview = new JT_DepartmentListView($deptlist);

$deptlistview->render();

?>

</div>
<?php
include('includes/footer.php');
$_SESSION['breadcrumb'] = 'departments';    
?>
