<?php

class JT_TaskEditView implements JT_EditView
{
    private $task = NULL;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function render()
    {
?>
<div class="task">
<form autocomplete="off" action="#" method="post">
<div class="taskcontrols">
<?php $this->renderClientBox(); ?>
<div class="taskinfo">
<div class="taskinfo">
<?php
        $teambox = new JT_TeamBoxView(new JT_Teams(), $this->task->getTeam()->getID());
        $teambox->render();
        $statusbox = new JT_StatusBoxView(new JT_Statuses(), $this->task->getStatus()->getID());
        $statusbox->render();
        $priorbox = new JT_PriorityBoxView(new JT_Priorities(), $this->task->getPriority()->getID());
        $priorbox->render();

?>
</div>
<br />
<div class="taskinfo">
<?php
        $this->renderEnteredByBox();
//        $this->renderAssignedToBox();
        $default = 0;
        if(!is_null($this->task->getAssignedTo()))
            $default = $this->task->getAssignedTo()->getID();
        $assignedtobox = new JT_ConsultantBoxView(new JT_Consultants(), $default, 'Assigned To', true);
        $assignedtobox->render();
?>
</div>
</div>
<?php
        $this->renderSubmitBox();
?>
</div>
<?php
        $this->renderContentBox();
?>
</form>
<br style="clear: both;" />
<?php
        //child tasks
        $children_view = new JT_TaskListView($this->task->getChildTasks());
        $children_view->render();

        //entries
        $entries_view = new JT_EntryListView($this->task->getEntries());
        $entries_view->render();

?>
</div>
<?php
    }

    private function renderClientBox()
    {
?>
    <div class="clientbox">Client: 
    <select name="dept">
<?php
        $depts = new JT_Departments();
        foreach($depts->getList() as $dept)
        {
            echo('<option');
            if($this->task->getClient()->getDepartment()->getID() == $dept->getID())
                echo(' selected="selected"');
            echo(' value="' . $dept->getID() . '">');
            echo($dept->getAbbr() . '</option>');
        }
?>
    </select>
	<br />
	<select name="client">
<?php
        $clients = new JT_Clients();
        foreach($clients->getList() as $client)
        {
            echo('<option');
            if($this->task->getClient()->getID() == $client->getID())
                echo(' selected="selected"');
            echo(' value="' . $client->getID() . '">');
            echo($client->getFullname() . '</option>');
        }
?>
    </select>
    </div> <!-- end client box div -->
<?php
    }

    private function renderEnteredByBox()
    {
        //TODO: when I implement new tasks: make select box for new tasks
        echo('<span>Entered By: ' . $this->task->getEnteredBy()->getFullname() . '</span>');
    }

    private function renderAssignedToBox()
    {
?>
	<span>Assigned To: 
	<select name="assignedto">
<?php
        //handle assigned to and assigning to nobody
        echo('<option');
        if(is_null($this->task->getAssignedTo()))
            echo(' selected="selected"');
        echo(' value="0">Nobody</option>'); 
        
        $consultants = new JT_Consultants();
        foreach($consultants->getList() as $consultant)
        {
            echo('<option');
            if(!is_null($this->task->getAssignedTo())
               && $this->task->getAssignedTo()->getID() == $consultant->getID())
                echo(' selected="selected"');
            echo(' value="' . $consultant->getID() . '">');
            echo($consultant->getFullname() . '</option>');
 
        }
?>
    </select>
	</span>
<?php
    }

    private function renderSubmitBox()
    {
        global $user;
?>
<div class="tasksubmit">
<input type="hidden" name="taskid" value="<?php echo($this->task->getID()); ?>" />
<input type="submit" name="tasksubmit" id="tasksubmit" value="Update" />
<br />
<input type="button" id="taskcancel" value="Cancel" />
<?php
    //breadcrumb handling
    if($_SESSION['breadcrumb'] == "task")
	    $url="taskdetail.php?task=$_SESSION[taskid]";
    elseif($_SESSION['breadcrumb'] == "tasklist")
	    $url = "tasklist.php?team=$_SESSION[display_team]";
    else
	    $url = "$_SESSION[breadcrumb].php";
    $url = urlencode($url);
    echo('<input type="hidden" name="cancelurl" value="' . $url . '" />');
    //admin features
    if($user->isAdmin())
	    echo('<br /><input type="submit" name="taskdelete" value="Delete" />');
?>
</div>
<?php
    }

    private function renderContentBox()
    {
?>
<div>
	<div style="float: left; text-align: right; margin-right: 5px;">
	Title:
	<br /><br />
	Description: </div>
	<div style="float: right">
    <input type="text" name="title" size="80" maxlength="80" value="<?php echo($this->task->getTitle()); ?>" />
	<br />
    <textarea name="description" cols="80" rows="10"><?php echo($this->task->getDescription()); ?></textarea>
	</div>
	</div>
<?php
    }

    public function handleRequests()
    {
        //will implement
    }

    public function renderHead()
    {
        //don't need anything in header
    }

}

?>
