<?php

class JT_TeamListView extends JT_ListView
{

    public function __construct($teamlist)
    {
        parent::__construct($teamlist);
        $this->tableName = 'Team';
        $this->columnNames = array('Name', 'Fullname');
    }
    
    protected function renderTableRow($team)
    {
?>
<tr>
<td>
<?php
        echo('<a href="editteam.php?team=' . $team->getID() . '" class="ajaxform">'
             . $team->getName() . '</a>');
?>
</td>
<td><?php echo($team->getFullname()); ?></td>
</tr>
<?php
    }
}

?>
