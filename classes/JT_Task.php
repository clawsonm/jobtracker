<?php

require_once(JT_INCLUDES . '/dbinit.php');

class JT_Task extends JT_Removable
{
    private $client = NULL;
    private $secondary_client = NULL;
    private $team = NULL;
    private $enteredby = NULL;
    private $assignedto = NULL;
    private $status = NULL;
    private $priority = NULL;
    private $title = '';
    private $description = '';
    private $children = NULL;
    private $entries = NULL;

    public function __construct($taskinfo)
    {
        global $db;
        if(!is_array($taskinfo))
        {
            $query = "SELECT * FROM task WHERE id=$taskinfo";

            $result = $db->query($query);

            if($result->num_rows == 0)
                die("couldn't find task");
            
            $taskinfo = $result->fetch_assoc();

            $result->free();
        }
        $this->id = $taskinfo['id'];
        $this->client = new JT_Client($taskinfo['client_fkey']);
        if(isset($taskinfo['secondary_client']) && $taskinfo['secondary_client'] != 0)
            $this->secondary_client = new JT_Client($taskinfo['secondary_client']);
        $this->team = new JT_Team($taskinfo['team_fkey']);
        $this->enteredby = new JT_Client($taskinfo['enteredby']);
        if(isset($taskinfo['assignedto']) && $taskinfo['assignedto'] != 0)
            $this->assignedto = new JT_Client($taskinfo['assignedto']);
        $this->status = new JT_Status($taskinfo['status_fkey']);
        $this->priority = new JT_Priority($taskinfo['priority_fkey']);
        $this->title = $taskinfo['title'];
        $this->description = $taskinfo['description'];
        $this->children = new JT_Tasks(NULL, $this->id);
        $this->entries = new JT_Entries($this->id);
        parent::__construct($taskinfo);
    }

    public static function getTaskByID($id)
    {
        global $db;

        $query = "SELECT * FROM task WHERE id=$id";

        $result = $db->query($query);

        if($result->num_rows != 0)
            return new JT_Task($result->fetch_assoc());
        else
            return false;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client)
    {
        if($client instanceof JT_Client)
        {
            $this->client = $client;
            $this->changed = true;
            return true;
        }
        else if(intval($client) > 0)
        {
            $client = JT_Client::getClientByID($client);
            return $this->setClient($client);
        }
        else
            return false;
    }

    public function getSecondaryClient()
    {
        return $this->secondary_client;
    }

    public function setSecondaryClient($client)
    {
        if(is_null($client) || ($client instanceof JT_Client))
        {
            $this->client = $client;
            $this->changed = true;
            return true;
        }
        else if(intval($client) > 0)
        {
            $client = JT_Client::getClientByID($client);
            return $this->setSecondaryClient($client);
        }
        else
            return false;
    }

    public function getTeam()
    {
        return $this->team;
    }

    public function setTeam($team)
    {
        if($team instanceof JT_Team)
        {
            $this->team = $team;
            $this->changed = true;
            return true;
        }
        else if(intval($team) > 0)
        {
            $team = JT_Team::getTeamByID($team);
            return $this->setTeam($team);
        }
        else
            return false;
    }

    public function getEnteredBy()
    {
        return $this->enteredby;
    }

    public function getAssignedTo()
    {
        return $this->assignedto;
    }

    public function assignTo($consult)
    {
        if(is_null($consult) || (($consult instanceof JT_Client) && $consult->isConsultant()))
        {
            $this->assignedto = $consult;
            $this->changed = true;
            return true;
        }
        else if(intval($consult) > 0)
        {
            $consult = JT_Client::getClientByID($consult);
            return $this->assignTo($consult);
        }
        else
            return false;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        if($status instanceof JT_Status)
        {
            $this->status = $status;
            $this->changed = true;
            return true;
        }
        else if(intval($status) > 0)
        {
            $status = JT_Status::getStatusByID($status);
            return $this->setStatus($status);
        }
        else 
            return false;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setPriority($prior)
    {
        if($prior instanceof JT_Priority)
        {
            $this->prior = $prior;
            $this->changed = true;
            return true;
        }
        else if(intval($prior) > 0)
        {
            $prior = JT_Priority::getPriorityByID($prior);
            return $this->setPriority($prior);
        }
        else 
            return false;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->changed = true;
        return true;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($desc)
    {
        $this->description = $desc;
        $this->changed = true;
        return true;
    }

    public function setParentTask($id)
    {
        global $db;

        $query = "UPDATE task SET parent_fkey=$id WHERE id=" . $this->id;

        $db->query($query);
        if($db->affected_rows != 0)
            return true;
        else
            return false;
    }

    public function getChildTasks()
    {
        return $this->children;
    }

    public function addChildTask($task)
    {
        return $this->children->add($task);
    }

    public function getEntries()
    {
        return $this->entries;
    }

    public function addEntry($entry)
    {
        return $this->entries->add($entry);
    }

    public function writeChanges()
    {
        global $db;

        if(!$this->changed)
            return true;

        $query = "UPDATE task SET " 
                . "client_fkey=" . $this->client->getID() . ", ";
        if(!is_null($this->secondary_client))
            $query .= "secondary_client=" . $this->secondary_client->getID() . ", ";
        else
            $query .= "secondary_client=NULL, ";

        $query .= "team_fkey=" . $this->team->getID() . ", ";

        if(!is_null($this->assignedto))
            $query .= "assignedto=" . $this->assignedto->getID() . ", ";
        else
            $query .= "assignedto=NULL, ";
        
        $query .= "status_fkey=" . $this->status->getID() . ", "
                . "priority_fkey=" . $this->priority->getID() . ", "
                . "title='" . $this->title . "', "
                . "description='" . $this->description . "', "
                . "removed=" . (($this->removed) ? '1' : '0' ) . " "
                . "WHERE id=" . $this->id;

        $db->query($query);

        if($db->affected_rows != 0)
        {
            $this->changed = false;
            return true;
        }
        else
            return false;
    }

}

?>
