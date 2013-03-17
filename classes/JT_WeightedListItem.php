<?php

abstract class JT_WeightedListItem extends JT_NamedListItem
{
    protected $weight = 0;

    public function __construct($itemrow)
    {
        parent::__construct($itemrow);
        $this->weight = $itemrow['weight'];
    }
    
    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
        $this->changed = true;
        return true;
    }
}

?>
