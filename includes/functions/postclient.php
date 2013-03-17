<?php
function postclient()
{
if(isset($_POST['save_client']) && $_POST['save_client'] == 'S')
{
    //handle saving client data
    
    $clientid = $_POST['client_id'];
    settype($clientid, 'integer');
    $lastname = mysql_real_escape_string($_POST['lastname']);
    $firstname = mysql_real_escape_string($_POST['firstname']);
    $room = mysql_real_escape_string($_POST['room']);
    $building = $_POST['building'];
    settype($building, 'integer');
    $email = mysql_real_escape_string($_POST['email']);
    $homephone = mysql_real_escape_string($_POST['homephone']);
    $workphone = mysql_real_escape_string($_POST['workphone']);
    $cellphone = mysql_real_escape_string($_POST['cellphone']);
    $chair = ((isset($_POST['chair']) && $_POST['chair'] == 'is-chair') ? 1 : 0);    
    $department = $_POST['department'];
    settype($department, 'integer');

    if($clientid == -1)
    {
	mysql_query("INSERT INTO client (lastname, firstname, room, building_fkey, email, homephone, workphone, cellphone, chair, department_fkey) VALUES('$lastname', '$firstname', '$room', '$building', '$email', '$homephone', '$workphone', '$cellphone', '$chair', '$department')") or die(mysql_error());
    }
    else
    {
	mysql_query("UPDATE client SET lastname='$lastname', firstname='$firstname', room='$room', building_fkey='$building', email='$email', homephone='$homephone', workphone='$workphone', cellphone='$cellphone', chair='$chair', department_fkey='$department' WHERE id='$clientid'");
    }
}
elseif(isset($_POST['delete_client']) && $_POST['delete_client'] = "D")
{
    $clientid = $_POST['client_id'];
    settype($clientid, 'integer');
    mysql_query("UPDATE client SET removed='1' WHERE id='$clientid'");
}
}
?>
