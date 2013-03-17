<?php

require_once(JT_INCLUDES . "/dbinit.php");

class JT_Departments extends JT_Collection
{

    public function __construct($showremoved = false)
    {
        global $db;
        $query = "SELECT * FROM department";
        if(!$showremoved)
            $query .= " WHERE removed=0";


        $result = $db->query($query);

        $this->data = array();

        while($row = $result->fetch_assoc())
        {
            $tempDept = new JT_Department($row);
            $this->data[] = $tempDept;
        }
        $result->free();
    }

    function getNames()
    {
        $names = array();

        foreach($this->data as $dept)
        {
            $names[] = $dept->getName();
        }
        return $names;
    }

    function getAbbreviations()
    {
        $abbrs = array();

        foreach($this->data as $dept)
        {
            $names[] = $dept->getAbbr();
        }
        return $abbrs;
    }
}

?>
