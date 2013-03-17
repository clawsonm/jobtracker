<?php

abstract class JT_NamedListItem extends JT_Removable
{
    protected $name = '';

    public function __construct($itemrow)
    {
        parent::__construct($itemrow);
        $this->name = $itemrow['name'];
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->changed = true;
        return true;
    }

}

?>
