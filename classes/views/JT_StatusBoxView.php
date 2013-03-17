<?php

class JT_StatusBoxView extends JT_BoxView
{

    public function __construct($statuses = NULL, $default = 0, $name = 'status', $allownothing = false)
    {
        if(is_null($statuses))
            $statuses = new JT_Statuses();
        parent::__construct($statuses, $default, $name);
    }

    public function renderDefaultNotFound($status = NULL)
    {
        $status = new JT_Status($this->default);
        parent::renderDefaultNotFound($status);
    }
}

?>
