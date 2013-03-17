<?php

class JT_PriorityListView extends JT_ListView
{

    public function __construct($prioritylist)
    {
        parent::__construct($prioritylist);
        $this->tableName = 'Priority';
        $this->columnNames = array('Name', 'Icon', 'Weight');
    }
    
    protected function renderTableRow($priority)
    {
?>
<tr>
<td>
<?php
        echo('<a href="editpriority.php?priority=' . $priority->getID() . '" class="ajaxform">'
             . $priority->getName() . '</a>');
?>
</td>
<td>
<?php
        if($priority->hasIcon())
            echo('<img class="icon" src="' . $priority->getIcon() . '" />');
        else
            echo('<span>No Icon</span>');
?>
</td>
<td><?php echo($priority->getWeight()); ?></td>
</tr>
<?php
    }
}

?>
