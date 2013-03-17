<?php

class JT_ClientBoxView extends JT_BoxView
{

    public function __construct($clients = NULL, $default = 0, $name = 'Client', $allownothing = false)
    {
        if(is_null($clients))
            $clients = new JT_Clients();
        parent::__construct($clients, $default, $name, $allownothing);

    }

    public function renderDefaultNotFound($client = NULL)
    {
        $client = new JT_Client($this->default);
        parent::__renderDefaultNotFound($client);
    }

}

?>
