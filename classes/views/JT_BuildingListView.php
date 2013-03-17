<?php

class JT_BuildingListView extends JT_ListView
{

    public function __construct($buildinglist)
    {
        parent::__construct($buildinglist);
        $this->tableName = 'Building';
        $this->columnNames = array('Name', 'Abbreviation');
    }
    
    protected function renderTableRow($building)
    {
?>
<tr>
<td>
<?php
        echo('<a href="editbuilding.php?building=' . $building->getID() . '" class="ajaxform">'
             . $building->getName() . '</a>');
?>
</td>
<td><?php echo($building->getAbbr()); ?></td>
</tr>
<?php
    }
}

?>
