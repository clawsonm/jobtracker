<?php

require_once(JT_INCLUDES . "/dbinit.php");

class JT_Buildings extends JT_Collection
{
    public function __construct($showremoved = false)
    {
        global $db;
        $query = "SELECT * FROM building";
        if(!$showremoved)
            $query .= " WHERE removed=0";

        $result = $db->query($query);

        while($row = $result->fetch_assoc())
        {
            $tempBldg = new JT_Building($row);
            $this->data[] = $tempBldg;
        }
        $result->free();
    }

    function getNames()
    {
        $names = array();

        foreach($this->data as $bldg)
        {
            $names[] = $bldg->getName();
        }
        return $names;
    }

    function getAbbreviations()
    {
        $abbrs = array();

        foreach($this->data as $bldg)
        {
            $names[] = $bldg->getAbbr();
        }
        return $abbrs;
    }
}

?>
