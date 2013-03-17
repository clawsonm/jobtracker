<?php

require_once(JT_INCLUDES . '/dbinit.php');

class JT_Priorities extends JT_Collection
{

    public function __construct($showremoved = false)
    {
        global $db;
        $query = "SELECT * FROM priority"; 
        if(!$showremoved)
            $query .= " WHERE removed=0";
        $query .= " ORDER BY weight DESC";

        $result = $db->query($query);

        $this->data = array();

        while ($row = $result->fetch_assoc())
        {
            $tempPrior = new JT_Priority($row);
            $this->data[] = $tempPrior;
        }
        $result->free();

    }

    function getNames()
    {
        $names = array();

        foreach($this->data as $prior)
        {
            $names[] = $prior->getName();
        }
        return $names;
    }

    function getWeightedNames()
    {
        $names = array();

        foreach($this->data as $prior)
        {
            $names[$prior->getWeight()] = $prior->getName();
        }
        return $names;
    }


}

?>
