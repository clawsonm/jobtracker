<?php

class JT_ClientListView extends JT_ListView
{

    public function __construct($clientlist)
    {
        parent::__construct($clientlist);
        $this->tableName = 'Client';
        $this->columnNames = array('Fullname', 'Username', 'Address', 'Work Phone', 'Department', 'Consultant Info');
    }
    
    protected function renderTableRow($client)
    {
?>
<tr>
<td>
<?php
        echo('<a href="editclient.php?client=' . $client->getID() . '" class="ajaxform">'
             . $client->getFullname() . '</a>');
?>
</td>
<td><?php echo($client->getUsername()); ?></td>
<td><?php echo($client->getRoom() . ' ' . $client->getBuilding()->getAbbr()); ?></td>
<td><?php echo($client->getWorkPhone()); ?></td>
<td><?php echo($client->getDepartment()->getAbbr() . (($client->isChair()) ? ' *' : '')); ?></td>
<td>
<?php
        if($client->isConsultant())
        {
            echo($client->getTeam()->getName());
            if($client->isAdmin())
                echo(', Admin');
            if($client->hasNotify())
                echo(', Notify');
        }
        else
            echo('');
?></td>
</tr>
<?php
    }
}

?>
