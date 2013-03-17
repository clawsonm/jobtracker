<?php

class JT_TeamBoxView extends JT_BoxView
{

    public function __construct($teams = NULL, $default = 0, $name = 'team', $allownothing = false)
    {
        if(is_null($teams))
            $teams = new JT_Teams();
        if($default == 0)
            $default = $_SESSION['display_team'];
        parent::__construct($teams, $default, $name);
    }

    public function renderDefaultNotFound($team = NULL)
    {
        $team = new JT_Team($this->default);
        parent::renderDefaultNotFound($team);
    }
}

?>
