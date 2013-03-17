<?php

require_once(JT_INCLUDES . "/dbinit.php");

class JT_Tasks extends JT_Collection
{
    private $parent = NULL;

    public function __construct($team = NULL, $parent = NULL, $status = NULL, $showremoved = false)
    {
        global $db;
    
        $this->parent = $parent;

        $query = "SELECT task.* FROM task LEFT JOIN status ON task.status_fkey=status.id WHERE ";
        if(!is_null($parent))
            $query .= "task.parent_fkey=$parent";
        else
            $query .= "task.parent_fkey IS NULL";
        if(!is_null($status) && $status != JT_Collection::HIDE)
            $query .= " AND task.status_fkey=$status";
        else
            $query .= " AND status.hidden=0";
        if(!is_null($team))
            $query .= " AND task.team_fkey=$team";
        if(!$showremoved)
            $query .= " AND task.removed=0";

        $result = $db->query($query);

        if($db->errno)
            echo($db->error);

        $this->data = array();
        while($row = $result->fetch_assoc())
        {
            $tempTask = new JT_Task($row);
            $this->data[] = $tempTask;
        }
        $result->free();
    }

    public function writeChanges()
    {
        if(!$this->changed)
            return true;

        //if this list has no parent then I can't add it to its children
        if(is_null($this->parent))
            return true;

        foreach($this->data as $task)
        {
            $task->setParentTask($parent);
        }
        return true;
    }

}

?>
