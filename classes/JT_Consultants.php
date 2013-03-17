<?php

class JT_Consultants extends JT_Collection
{

    public function __construct()
    {
        global $db;
        $query = "SELECT * FROM client WHERE consultant=1";

        $result = $db->query($query);

        while($row = $result->fetch_assoc())
        {
            $tempConsultant = new JT_Client($row);
            $this->data[] = $tempConsultant;
        }
        $result->free();
    }
    
}

?>
