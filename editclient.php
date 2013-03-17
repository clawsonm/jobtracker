<?php

require_once('includes/config.php');

if(isset($_GET['client']))
{
    //get client
    $client = new JT_Client(intval($_GET['client']));

    //handle ajax form submission
    if(isset($_GET['save']))
    {
        //TODO: validate data

        $client->setUsername($_POST['username']);
        $client->setUIN($_POST['uin']);
        $client->setLastname($_POST['lastname']);
        $client->setFirstname($_POST['firstname']);
        $client->setRoom($_POST['room']);
        $client->setBuilding($_POST['building']);
        $client->setEmail($_POST['email']);
        $client->setHomePhone($_POST['homephone']);
        $client->setWorkPhone($_POST['workphone']);
        $client->setCellphone($_POST['cellphone']);
        $client->setChairFlag((isset($_POST['chair']) && $_POST['chair'] == 'chair'));
        $client->setDepartment($_POST['department']);
        $client->setConsultantFlag((isset($_POST['consultant']) && $_POST['consultant'] == 'consultant'));
        if($client->isConsultant())
        {
            $client->setTeam($_POST['team']);
            $client->setAdminFlag((isset($_POST['admin']) && $_POST['admin'] == 'admin'));
            $client->setNotifyFlag((isset($_POST['notify']) && $_POST['notify'] == 'notify'));
        }    
        $result = '';
        if($client->writeChanges())
        {
            $result = array('status'    => 'success',
                            'message'   => 'Save Successful',
                        );
        }
        else
        {
            $result = array('status'    => 'failed',
                            'message'   => 'database write unsuccessful',
                        );
        }

        header('Content-type: text/html');
        echo(json_encode($result));
        exit;
    }
    else //display edit box
    {
        $clienteditbox = new JT_ClientEditView($client);
        $clienteditbox->render();
    }
}
else
{
    //handle creating new clients
}
?>
