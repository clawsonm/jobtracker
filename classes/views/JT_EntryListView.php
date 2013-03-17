<?php

class JT_EntryListView extends JT_ListView
{

    public function __construct($entries)
    {
        parent::__construct($entries);
        $this->tableName = 'Work Done';
        $this->columnNames = array('Consultant', 'Updated', 'Time', 'Description', 'Edit');
    }

    protected function renderTableRow($entry)
    {
?>
<tr>
<td><?php echo($entry->getConsultant()->getFullname());?></td>
<td><?php echo($entry->getTimeUpdated()->format("n/j/y g:ia")); ?></td>
<td><?php echo($entry->getTimeSpent()->format("%h:%I")); ?></td>
<td><?php echo(nl2br(wordwrap($entry->getDescription(), 65))); ?></td>
<td><a class="editbutton" href="">E</a><?php /* edit entry */ ?></td>
</tr>
<?php
    }

}

?>
