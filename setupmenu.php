<?php
require_once("includes/config.php");
$require_admin = true;
include('includes/header.php');
$admin_login = $user->isAdmin();

include('includes/pagetop.php');
include('includes/boxes/topmenu.php');
?>
<hr />
<div class="contentwrapper">
<div class="setupmenu">
<h2>Setup Menu</h2>
<a href="teams.php">Teams</a><br />
<a href="buildings.php">Buildings</a><br />
<a href="departments.php">Departments</a><br />
<a href="clients.php">Clients</a><br />
<a href="statuses.php">Statuses</a><br />
<a href="priorities.php">Priorities</a><br />
</div>
</div>
<?php
include('includes/footer.php');
$_SESSION['breadcrumb'] = 'setupmenu';    

?>
