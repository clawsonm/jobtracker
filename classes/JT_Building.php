<?php

require_once(JT_INCLUDES . "/dbinit.php");

class JT_Building extends JT_NamedListItem
{
    private $abbr = '';

    public function __construct($bldginfo)
    {
        global $db;

        if(!is_array($bldginfo))
        {
            $query = "SELECT * FROM building WHERE id=$bldginfo";
            $result = $db->query($query);
            if($result->num_rows == 0)
                die('unrecognized building');
            $bldginfo = $result->fetch_assoc();
            $result->free();
        }
        $this->id = $bldginfo['id'];
        $this->name = $bldginfo['name'];
        $this->abbr = $bldginfo['abbreviation'];
        parent::__construct($bldginfo);
    }

    public static function getBuildingByID($id)
    {
        global $db;

        $query = "SELECT * FROM building WHERE id=$id";

        $result = $db->query($query);

        if($result->num_rows != 0)
            return new JT_Building($result->fetch_assoc());
        else
            return false;
    }

    public function getAbbr()
    {
        return $this->abbr;
    }

    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;
        $this->changed = true;
        return true;
    }

    public function writeChanges()
    {
        global $db;

        if(!$this->changed)
            return true;

        $query = "UPDATE building SET name='" . $this->name . "', abbreviation='" . $this->abbr ."' WHERE id=" . $this->id;

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
