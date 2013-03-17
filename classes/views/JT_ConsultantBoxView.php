<?php

class JT_ConsultantBoxView extends JT_BoxView
{

    public function __construct($consultants = NULL, $default = 0, $name = 'consultant', $nobody = false)
    {
        if(is_null($consultants))
            $consultants = new JT_Consultants();
        parent::__construct($consultants, $default, $name, $nobody);
    }

    public function renderNothingItem()
    {
        echo('<option');
        if($this->default == 0)
            echo(' selected="selected"');
        echo(' value="0">Nobody</option>');
    }

    protected function renderDefaultNotFound($consult = NULL)
    {
        $consult = new JT_Client($this->default);
        parent::renderDefaultNotFound($consult);
    }

}

?>
