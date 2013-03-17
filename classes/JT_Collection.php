<?php

abstract class JT_Collection
{
    const HIDE = 0;
    const SHOW_ONLY = 1;
    const SHOW_ALL = 2;

    protected $data = array();
    protected $changed = false;

    public abstract function __construct();

    public function getList()
    {
        return $this->data;
    }

    public function contains($id)
    {
        foreach($this->data as $item)
        {
            if($item->getID() == $id)
                return true;
        }
        return false;
    }

    public function add($item)
    {
        $this->data[] = $item;
        $this->changed = true;
        return true;
    }

    public function isEmpty()
    {
        return (count($this->data) == 0);
    }

    public function size()
    {
        return count($this->data);
    }

}

?>
