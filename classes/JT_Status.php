<?php

require_once(JT_INCLUDES . "/dbinit.php");

class JT_Status extends JT_WeightedListItem
{
    private $icon = NULL;
    private $hidden = false;

    public function __construct($statusinfo)
    {
        global $db;
        if(!is_array($statusinfo))
        {
            $query = "SELECT * FROM status WHERE id=$statusinfo";
            $result = $db->query($query);
            if($result->num_rows == 0)
                die('unrecognized status');
            $statusinfo = $result->fetch_assoc();
            $result->free();
        }

        parent::__construct($statusinfo);
        if(isset($statusinfo['icon']) && $statusinfo['icon'] != '')
            $this->icon = $statusinfo['icon'];
        $this->hidden = ($statusinfo['hidden'] == 1);
    }
    
    public static function getStatusByID($id)
    {
        global $db;

        $query = "SELECT * FROM status WHERE id=$id";

        $result = $db->query($query);

        if($result->num_rows != 0)
            return new JT_Status($result->fetch_assoc());
        else
            return false;
    }

    public function hasIcon()
    {
        return (!($this->icon == NULL || $this->icon == ''));
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($path)
    {
        $this->icon = $path;
        $this->changed = true;
        return true;
    }

    public function isHidden()
    {
        return $this->hidden;
    }

    public function setHiddenFlag($hide)
    {
        $this->hidden = $hide;
        $this->changed = true;
        return true;
    }
    
    public function writeChanges()
    {
        global $db;
        
        if(!$this->changed)
            return true;

        $query = "UPDATE status SET name='" . $this->name . "', "
                . "icon='" . $this->icon . "', "
                . "weight=" . $this->weight . ", "
                . "hidden=" . (($this->hidden) ? '1' : '0' ) . ", "
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
