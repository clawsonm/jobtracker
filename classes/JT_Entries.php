<?php

class JT_Entries extends JT_Collection
{
    private $taskid = NULL;

    public function __construct($taskid = NULL, $showremoved = false)
    {
        global $db;

        $this->taskid = $taskid;

        $query = "SELECT * FROM entry";
        if(!is_null($taskid))
        {
            $query .= " WHERE task_fkey='$taskid'";
            if(!$showremoved)
                $query .= " AND removed=0";
        }
        else if (!$showremoved)
            $query .= " WHERE removed=0";

        $result = $db->query($query);

        while($row = $result->fetch_assoc())
        {
            $tempEntry = new JT_Entry($row);
            $this->data[] = $tempEntry;
        }
        $result->free();
    }

    public function writeChanges()
    {
        if(!$this->changed)
            return true;

        //cannot add entry without associating it with a task
        if(is_null($this->taskid))
            return true;

        foreach($this->data as $entry)
        {
            $entry->setTaskOwner($taskid);
        }
        return true;
    }
}

?>
