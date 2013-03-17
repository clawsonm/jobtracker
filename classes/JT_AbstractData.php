<?php

abstract class JT_AbstractData
{
    protected $id = 0;
    protected $changed = false;

    public function __construct($datarow)
    {
        $this->id = $datarow['id'];
    }

    public abstract function writeChanges();

    public function getID()
    {
        return $this->id;
    }

    public function __destruct()
    {
        if($this->changed)
            $this->writeChanges();
    }
   
}

?>
