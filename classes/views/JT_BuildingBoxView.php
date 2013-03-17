<?php

class JT_BuildingBoxView extends JT_BoxView
{

    public function __construct($bldgs = NULL, $default = 0, $name = 'Building', $allownothing = false)
    {
        if (is_null($bldgs))
            $bldgs = new JT_Buildings();
        parent::__construct($bldgs, $default, $name);
    }

    public function renderDefaultNotFound($bldg = NULL)
    {
        $bldg = new JT_Building($this->default);
        parent::__renderDefaultNotFound($bldg);
    }

}

?>
