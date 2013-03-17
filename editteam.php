<?php

require_once('includes/config.php');

if(isset($_GET['team']))
{
    //get team
    $team = new JT_Team(intval($_GET['team']));

    //handle ajax form submission
    if(isset($_GET['save']))
    {
        //TODO: validate data

        $team->setName($_POST['name']);
        $team->setFullname($_POST['fullname']);
        $result = '';
        if($team->writeChanges())
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
        $teameditbox = new JT_TeamEditView($team);
        $teameditbox->render();
    }
}
else
{
    //handle creating new buildings
}
?>
