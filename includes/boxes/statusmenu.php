<div class="topmenu">
<?php
$team = intval($_GET['team']);
$statuses = new JT_Statuses(false, JT_Collection::SHOW_ONLY);
echo('<a class="button');
if(!isset($_SESSION['display_status']) || $_SESSION['display_status'] == JT_Collection::HIDE)
    echo(' highlighted');
echo('" href="tasklist.php?team=' . $team . '&status=' . JT_Collection::HIDE . '">Normal</a>');
foreach ($statuses->getList() as $status)
{
    echo('<a class="button');
    if(isset($_SESSION['display_status']) && $_SESSION['display_status'] == $status->getID())
        echo(' highlighted');
    echo('" href="tasklist.php?team=' . $team . '&status=' . $status->getID() . '">' . $status->getName() . '</a>');
}
?>
</div>

