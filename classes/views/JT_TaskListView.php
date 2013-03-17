<?php

class JT_TaskListView extends JT_ListView
{

    public function __construct($tasklist)
    {
        parent::__construct($tasklist);
        $this->tableName = 'Task';
        $this->columnNames = array('Client', 'Assigned To', 'Status', 'Priority', 'Title');
    }

    protected function renderTableRow($task)
    {
?>
<tr>
<td><?php echo($task->getClient()->getFullname()); ?></td>
<td>
<?php
        $assignee = $task->getAssignedTo();
        if($assignee instanceof JT_Client)
            echo($assignee->getFullname());
        else
            echo("         ");
?>
</td>
<td>
<?php
        $status = $task->getStatus();
        echo($status->getName());
        if($status->hasIcon())
            $this->renderIcon($task->getStatus()->getIcon());
?>
</td>
<td>
<?php
        $prior = $task->getPriority();
        echo($prior->getName());
        if($prior->hasIcon())
            $this->renderIcon($prior->getIcon());
?>
</td>
<td>
<?php
        echo('<a href="taskdetail.php?task=' .$task->getID() . '">');
        echo($task->getTitle() . '</a>');
?>
</td>
</tr>
<?php
    }

}

?>
