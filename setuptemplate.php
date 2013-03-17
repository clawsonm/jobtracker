<?php
$require_admin = true;
include('includes/header.php');
$admin_login = $user->isAdmin();

//post process

include('includes/pagetop.php');
include('includes/boxes/topmenu.php'); ?>
<hr />
<div class="contentwrapper">
<h2>Setup Template</h2>

</div>
<?php
include('includes/footer.php');
$_SESSION['breadcrumb'] = 'template';    

?>
