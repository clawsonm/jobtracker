<?php
$mydb = mysql_connect('localhost', 'jobtracker', 'jtdb') or die(mysql_error());
mysql_select_db('jobtracker', $mydb) or die(mysql_error());

$group_fields='fullname, name, login_type, password';

?>
