<?php

class JT_DeptBoxView extends JT_BoxView
{

    public function __construct($depts = NULL, $default = 0, $name = 'Department', $allownothing = false)
    {
        if (is_null($depts))
            $depts = new JT_Departments();
        parent::__construct($depts, $default, $name);
    }

    public function renderDefaultNotFound($dept = NULL)
    {
        $dept = new JT_Department($this->default);
        parent::__renderDefaultNotFound($dept);
    }

}

?>
