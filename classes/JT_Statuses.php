<?php

require_once(JT_INCLUDES . "/dbinit.php");

class JT_Statuses extends JT_Collection
{

    public function __construct($showremoved = false, $showhidden = JT_Collection::SHOW_ALL)
    {
        global $db;
        $query = "SELECT * FROM status";
        $where = array();
        if(!$showremoved)
            $where[] = "removed=0";
        if($showhidden == JT_Collection::SHOW_ONLY)
            $where[] = 'hidden=1';
        else if($showhidden == JT_Collection::HIDE)
            $where[] = 'hidden=0';
        if (count($where) > 0)
            $query .= ' WHERE ' . implode(' AND ', $where);
        $query .= " ORDER BY weight DESC";

        $result = $db->query($query);

        $this->data = array();

        while ($row = $result->fetch_assoc())
        {
            $tempStatus = new JT_Status($row);
            $this->data[] = $tempStatus;
        }
        $result->free();

    }

    function getNames()
    {
        $names = array();

        foreach($this->data as $status)
        {
            $names[] = $status->getName();
        }
        return $names;
    }

    function getWeightedNames()
    {
        $names = array();

        foreach($this->data as $status)
        {
            $names[$status->getWeight()] = $status->getName();
        }
        return $names;
    }


}

?>
