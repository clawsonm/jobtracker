<?php

require_once(JT_INCLUDES . '/dbinit.php');

class JT_Entry extends JT_Removable
{
    private $consultant = NULL;
    private $updated = 0;
    private $entered = 0;
    private $timespent = '';
    private $description = '';

    public function __construct($entryinfo)
    {
        global $db;
        if(!is_array($entryinfo))
        {
            $query = "SELECT * FROM entry WHERE id='$entryinfo'";

            $result = $db->query($query);

            if($result->num_rows == 0)
                die("couldn't find task entry");

            $entryinfo = $result->fetch_assoc();
            $result->free();
        }
        $this->id = $entryinfo['id'];
        $this->consultant = new JT_Client($entryinfo['consultant_fkey']);
        $this->updated = new DateTime($entryinfo['updated']);
        $this->entered = new DateTime($entryinfo['entered']);
        $this->timespent = DateInterval::createFromDateString($entryinfo['timespent']);
        $this->description = $entryinfo['description'];
        parent::__construct($entryinfo);
    }

    public static function getEntryByID($id)
    {
        global $db;

        $query = "SELECT * FROM entry WHERE id=$id";

        $result = $db->query($query);

        if($result->num_rows != 0)
            return new JT_Entry($result->fetch_assoc());
        else
            return false;
    }

    public function setTaskOwner($taskid)
    {
        global $db;
        $query = "UPDATE entry SET task_fkey=$taskid WHERE id=" . $this->id;
        $db->query($query);
        if($db->affected_rows != 0)
            return true;
        else
            return false;
    }

    public function getConsultant()
    {
        return $this->consultant;
    }

    public function setConsultant($consultant)
    {
        if(($consultant instanceof JT_Client) && $consultant->isConsultant())
        {
            $this->consultant = $consultant;
            $this->changed = true;
            return true;
        }
        else
            return false;
    }

    public function getTimeUpdated()
    {
        return $this->updated;
    }

    public function getTimeEntered()
    {
        return $this->entered;
    }

    public function getTimeSpent()
    {
        return $this->timespent;
    }

    public function setTimeSpent($timespent)
    {
        if($timespent instanceof DateInterval)
            $this->timespent = $timespent;
        else
            $this->timespent = DateInterval::createFromDateString($timespent);
        $this->changed = true;
    }
     
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        $this->changed = true;
    }
    
    private function registerUpdate()
    {
        $this->updated = new DateTime('now');
    }

    public static function createNewEntry($entryinfo)
    {
        $sql = "INSERT INTO entry (task_fkey, consultant_fkey, updated, entered, timespent, description) VALUES ($entryinfo[task_fkey], $entryinfo[consultant_fkey], NOW(), NOW(), $entryinfo[timespent], $entryinfo[description])";

        mysql_query($sql);

        $newid = mysql_insert_id();

        return new JT_Entry($newid);
    }

    public function writeChanges()
    {
        global $db;

        if(!$this->changed)
            return true;

        $this->registerChanges();

        $query = "UPDATE entry SET " 
                . "consultant_fkey=" . $this->consultant->getID() . ", "
                . "updated=NOW(), " 
                . "timespent='" . $this->timespent->format("H:I:S") . "' "
                . "description='" . $this->description . "', "
                . "removed=" . (($this->removed) ? '1' : '0')
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
