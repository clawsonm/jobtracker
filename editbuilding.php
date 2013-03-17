<?php

require_once('includes/config.php');

if(isset($_GET['building']))
{
    //get building
    $building = new JT_Building(intval($_GET['building']));

    //handle ajax form submission
    if(isset($_GET['save']))
    {
        //TODO: validate data

        $building->setName($_POST['name']);
        $building->setAbbr($_POST['abbreviation']);
        $result = '';
        if($building->writeChanges())
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
        $buildingeditbox = new JT_BuildingEditView($building);
        $buildingeditbox->render();
    }
}
else
{
    //handle creating new buildings
}
?>
