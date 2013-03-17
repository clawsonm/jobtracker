<?php

$dbhost = "localhost";
$dbuser = "jobtracker";
$dbpass = "jtdb";
$dbname = "jobtracker";

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if($db->connect_errno)
    die($db->connect_error);

?>
