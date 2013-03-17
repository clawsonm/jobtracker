<?php

require_once('includes/config.php');

if(isset($_GET['status']))
{
    //get status
    $status = new JT_Status(intval($_GET['status']));

    //handle ajax form submission
    if(isset($_GET['save']))
    {
        //TODO: validate data

        $status->setName($_POST['name']);
        $status->setHiddenFlag((isset($_POST['hide']) && $_POST['hide'] == 'hide'));
        $status->setWeight($_POST['weight']);
        $result = '';
        if($status->writeChanges())
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
    //handle icon file uploads
    else if(isset($_GET['upload']))
    {
        $result = '';
        $filename = basename($_FILES['icon']['name']);
        if(move_uploaded_file($_FILES['icon']['tmp_name'], JT_FILES . $filename))
        {
            $status->setIcon(JT_FILES_LOC . $filename);
            $status->writeChanges();
            $result = array('status'    => 'success',
                            'message'   => 'File uploaded successfully.',
                            'file'      => JT_FILES_LOC . $filename
                        );
        }
        else
        {
            $result = array('status'    => 'error',
                            'message'   => 'Failed to upload file');
        }
        header('Content-type: text/html');
        echo(json_encode($result));
        exit;
    }
    else //display edit box
    {
        $statuseditbox = new JT_StatusEditView($status);
        $statuseditbox->render();
    }
}
else
{
    //handle creating new statuses
}
?>
