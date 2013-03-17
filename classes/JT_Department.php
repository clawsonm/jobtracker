<?php

require_once(JT_INCLUDES . "/dbinit.php");

class JT_Department extends JT_NamedListItem
{
    private $abbreviation = '';

    public function __construct($deptinfo)
    {
        global $db;
        if(!is_array($deptinfo))
        {
            $query = "SELECT * FROM department WHERE id=$deptinfo";
            $result = $db->query($query);
            if($result->num_rows == 0)
                die("unrecognized department");
            $deptinfo = $result->fetch_assoc();
            $result->free();
        }
        $this->id = $deptinfo['id'];
        $this->name = $deptinfo['name'];
        $this->abbreviation = $deptinfo['abbreviation'];
        parent::__construct($deptinfo);
    }

    public static function getDepartmentByID($id)
    {
        global $db;

        $query = "SELECT * FROM department WHERE id=$id";

        $result = $db->query($query);

        if($result->num_rows != 0)
            return new JT_Department($result->fetch_assoc());
        else
            return false;
    }

    public function getAbbr()
    {
        return $this->abbreviation;
    }

    public function setAbbr($abbr)
    {
        $this->abbreviation = $abbr;
        $this->changed = true;
        return true;
    }

    public function writeChanges()
    {
        global $db;

        if(!$this->changed)
            return true;

        $query = "UPDATE department SET name='" . $this->name . "', "
                . "abbreviation='" . $this->abbreviation . "' "
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
