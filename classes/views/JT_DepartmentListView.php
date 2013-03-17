<?php

class JT_DepartmentListView extends JT_ListView
{

    public function __construct($departmentlist)
    {
        parent::__construct($departmentlist);
        $this->tableName = 'Department';
        $this->columnNames = array('Name', 'Abbreviation');
    }
    
    protected function renderTableRow($department)
    {
?>
<tr>
<td>
<?php
        echo('<a href="editdepartment.php?department=' . $department->getID() . '" class="ajaxform">'
             . $department->getName() . '</a>');
?>
</td>
<td><?php echo($department->getAbbr()); ?></td>
</tr>
<?php
    }
}

?>
