<?php

require_once('includes/config.php');

if(isset($_GET['department']))
{
    //get department
    $department = new JT_Department(intval($_GET['department']));

    //handle ajax form submission
    if(isset($_GET['save']))
    {
        //TODO: validate data

        $department->setName($_POST['name']);
        $department->setAbbr($_POST['abbreviation']);
        $result = '';
        if($department->writeChanges())
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
        $departmenteditbox = new JT_DepartmentEditView($department);
        $departmenteditbox->render();
    }
}
else
{
    //handle creating new departments
}
?>
