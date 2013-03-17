<?php

abstract class JT_Removable extends JT_AbstractData
{
    protected $removed = false;

    public function __construct($datarow)
    {
        parent::__construct($datarow);
        $this->removed = $datarow['removed'];
    }

    public function isRemoved()
    {
        return $this->removed;
    }

    public function remove()
    {
        $this->removed = true;
        $this->changed = true;
    }
}

?>
