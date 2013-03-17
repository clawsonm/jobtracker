<?php

class JT_PriorityBoxView extends JT_BoxView
{

    public function __construct($priors, $default = 0, $name = 'priority', $allownothing = false)
    {
        if(is_null($priors))
            $priors = new JT_Priorities();
        parent::__construct($priors, $default, $name);
    }

    protected function renderDefaultNotFound($priority = NULL)
    {
        $prior = new JT_Priority($this->default);
        parent::renderDefaultNotFound($prior);
    }

}

?>
