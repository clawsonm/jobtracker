<?php

class JT_StatusListView extends JT_ListView
{

    public function __construct($statuslist)
    {
        parent::__construct($statuslist);
        $this->tableName = 'Status';
        $this->columnNames = array('Name', 'Icon', 'Weight', 'Hidden');
    }
    
    protected function renderTableRow($status)
    {
?>
<tr>
<td>
<?php
        echo('<a href="editstatus.php?status=' . $status->getID() . '" class="ajaxform">'
             . $status->getName() . '</a>');
?>
</td>
<td>
<?php
        if($status->hasIcon())
            echo('<img class="icon" src="' . $status->getIcon() . '" />');
        else
            echo('<span>No Icon</span>');
?>
</td>
<td><?php echo($status->getWeight()); ?></td>
<td>
<?php
        if($status->isHidden())
            echo('True');
        else
            echo('False');
?>
</td>
</tr>
<?php
    }
}

?>
