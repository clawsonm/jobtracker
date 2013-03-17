<?php

require_once('includes/config.php');

if(isset($_GET['priority']))
{
    //get priority
    $priority = new JT_Priority(intval($_GET['priority']));

    //handle ajax form submission
    if(isset($_GET['save']))
    {
        //TODO: validate data

        $priority->setName($_POST['name']);
        $priority->setWeight($_POST['weight']);
        $result = '';
        if($priority->writeChanges())
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
            $priority->setIcon(JT_FILES_LOC . $filename);
            $priority->writeChanges();
            $result = array('priority'    => 'success',
                            'message'   => 'File uploaded successfully.',
                            'file'      => JT_FILES_LOC . $filename
                        );
        }
        else
        {
            $result = array('priority'    => 'error',
                            'message'   => 'Failed to upload file');
        }
        header('Content-type: text/html');
        echo(json_encode($result));
        exit;
    }
    else //display edit box
    {
        $priorityeditbox = new JT_PriorityEditView($priority);
        $priorityeditbox->render();
    }
}
else
{
    //handle creating new priorities
}
?>
