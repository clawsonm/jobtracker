<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: 0"); // Date in the past

require_once('includes/config.php');
$admin_login = $user->isAdmin();
if(!isset($_GET['task']))
{
	header("Location: tasklist.php");
}
//post data
if(isset($_POST['tasksubmit']) && $_POST['tasksubmit'] == 'Update')
{
    $taskid = intval($_POST['taskid']);
    $client = intval($_POST['client']);
    $status = intval($_POST['status']);
    $team = intval($_POST['team']);
    $priority = intval($_POST['priority']);
    $assignedto = intval($_POST['assignedto']);
    if($assignedto == 0)
	    $assignedto = "NULL";
    $title = mysql_real_escape_string($_POST['title']);
    $description = mysql_real_escape_string($_POST['description']);

    if($taskid == -1)
    {
        //TODO: handle new tasks
	    $enteredby = intval($_POST['enteredby']);
	    mysql_query("INSERT INTO task (client_fkey, group_fkey, status_fkey, priority_fkey, enteredby, assignedto, title, description) VALUES ('$client', '$group', '$status', '$priority', '$enteredby', '$assignedto', '$title', '$description')");
	    header("Location: tasklist.php?team=$_SESSION[display_team]");
    }
    else
    {
        $task = new JT_Task($taskid);
        $task->setClient($client);
        $task->setTeam($team);
        $task->assignTo($assignedto);
        $task->setStatus($status);
        $task->setPriority($priority);
        $task->setTitle($title);
        $task->setDescription($description);

        $task->writeChanges();

        header("Location: tasklist.php?team=$_SESSION[display_team]");
    }
}
if(isset($_POST['taskdelete']) && $_POST['taskdelete'] == "Delete")
{
    $taskid = $_POST['taskid'];
    settype($taskid, 'integer');
    mysql_query("UPDATE task SET removed=1 WHERE id=$taskid") or die(mysql_error());

    //delete child tasks
    $child_result = mysql_query("SELECT id FROM task WHERE parent_fkey='$taskid'");
    while($child_row = mysql_fetch_array($child_result))
    {
	    mysql_query("UPDATE task SET removed=1 WHERE id='$child_row[id]'") or die(mysql_error());
    }
}

//TODO: handle new tasks
//TODO: also handle new child tasks


include('includes/header.php');
include('includes/pagetop.php');
include('includes/boxes/topmenu.php');
?>
<hr />
<div class="contentwrapper">
<?php
$task = new JT_Task($_GET['task']);
$edittask = new JT_TaskEditView($task);
$edittask->render();
?>
</div>
<?php
include('includes/footer.php');
//breadcrumb handling
if(!isset($_POST['tasksubmit']))
{
    $_SESSION['taskid'] = $task->getID();
    $_SESSION['breadcrumb'] = 'task';
}
?>
