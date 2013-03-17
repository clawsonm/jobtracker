<?php

require_once(JT_INCLUDES . '/dbinit.php');

class JT_Clients extends JT_Collection
{

    public function __construct($showremoved = false)
    {
        global $db;
        $query = "SELECT * FROM client";
        if(!$showremoved)
            $query .= " WHERE removed=0";

        $result = $db->query($query);

        $this->data = array();

        while ($row = $result->fetch_assoc())
        {
            $tempClient = new JT_Client($row);
            $this->data[]  = $tempClient;
        }
        $result->free();
    }
}

?>
