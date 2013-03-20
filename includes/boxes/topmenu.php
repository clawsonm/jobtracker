<div class="topmenu">
<?php
$teams = new JT_Teams();
foreach ($teams->getList() as $team)
{
    echo('<a class="button');
    if(isset($_SESSION['display_team']) && $_SESSION['display_team'] == $team->getID())
        echo(' highlighted');
    echo('" href="tasklist.php?team=' . $team->getID());
    if(isset($_SESSION['display_status']) && $_SESSION['display_status'] != JT_Collection::HIDE)
        echo('&status=' . JT_Collection::HIDE);
    echo('">' . $team->getFullname() . '</a>');
}
if($user->isAdmin())
{
?>
<a class="button" href="setupmenu.php">Setup</a>
<?php
}
?>
<a class="button" href="taskdetail.php?task=NEW">Add Task</a>
<a class="button" href="logout.php">Logout</a>
</div>

