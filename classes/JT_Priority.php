<?php

require_once(JT_INCLUDES . "/dbinit.php");

class JT_Priority extends JT_WeightedListItem
{
    private $icon = NULL;

    public function __construct($priorityinfo)
    {
        global $db;
        if(!is_array($priorityinfo))
        {
            $query = "SELECT * FROM priority WHERE id=$priorityinfo";

            $result = $db->query($query);
            
            if($result->num_rows == 0)
                die("unrecognized priority");
            $priorityinfo = $result->fetch_assoc();
            $result->free();
        }
        parent::__construct($priorityinfo);
        if(isset($priorityinfo['icon']) && $priorityinfo['icon'] != '')
            $this->icon = $priorityinfo['icon'];
    }

    public static function getPriorityByID($id)
    {
        global $db;

        $query = "SELECT * FROM priority WHERE id=$id";

        $result = $db->query($query);

        if($result->num_rows != 0)
            return new JT_Priority($result->fetch_assoc());
        else
            return false;
    }
    
    public function hasIcon()
    {
        return (!($this->icon == NULL || $this->icon == ''));
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($path)
    {
        $this->icon = $path;
        $this->changed = true;
        return true;
    }

    public function writeChanges()
    {
        global $db;
        
        if(!$this->changed)
            return true;

        $query = "UPDATE priority SET name='" . $this->name . "', "
                . "icon='" . $this->icon . "', "
                . "weight=" . $this->weight . ", "
                . "removed=" . (($this->removed) ? '1' : '0') . " "
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
