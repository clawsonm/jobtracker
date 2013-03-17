<?php

require_once(JT_INCLUDES . "/dbinit.php");

class JT_Teams extends JT_Collection
{

    public function __construct($showremoved = false)
    {
        global $db;
        $query = "SELECT * FROM team";
        if(!$showremoved)
            $query .= " WHERE removed=0";

        $result = $db->query($query);

        while($row = $result->fetch_assoc())
        {
            $tempTeam = new JT_Team($row);
            $this->data[] = $tempTeam;
        }
    }
}

?>
