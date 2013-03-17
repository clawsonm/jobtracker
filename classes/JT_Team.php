<?php

require_once(JT_INCLUDES . '/dbinit.php');

class JT_Team extends JT_NamedListItem
{
    private $fullname = '';

    public function __construct($teaminfo)
    {
        global $db;
        if(!is_array($teaminfo))
        {
            $query = "SELECT * FROM team WHERE id=$teaminfo";
            $result = $db->query($query);
            if($result->num_rows == 0)
                die("unrecognized team");
            $teaminfo = $result->fetch_assoc();
            $result->free();
        }
        $this->id = $teaminfo['id'];
        $this->fullname = $teaminfo['fullname'];
        $this->name = $teaminfo['name'];
        parent::__construct($teaminfo);
    }

    public static function getTeamByID($id)
    {
        global $db;

        $query = "SELECT * FROM team WHERE id=$id";

        $result = $db->query($query);

        if($result->num_rows != 0)
            return new JT_Team($result->fetch_assoc());
        else
            return false;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function setFullname($name)
    {
        $this->fullname = $name;
        $this->changed = true;
        return true;
    }

    public function writeChanges()
    {
        global $db;
        
        if(!$this->changed)
            return true;

        $query = "UPDATE team SET fullname='" . $this->fullname . "', "
                . "name='" . $this->name . "', "
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
