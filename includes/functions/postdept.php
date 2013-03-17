<?php
function postdept()
{
if(isset($_POST['save_dept']) && $_POST['save_dept'] == 'S')
{
    //handle saving dept data
    
    $deptid = $_POST['dept_id'];
    settype($deptid, 'integer');
    $name = mysql_real_escape_string($_POST['name']);
    $abbr = mysql_real_escape_string($_POST['abbr']);
    if($deptid == -1)
    {
	mysql_query("INSERT INTO department (name, abbreviation) VALUES('$name', '$abbr')") or die(mysql_error());
    }
    else
    {
	mysql_query("UPDATE department SET name='$name', abbreviation='$abbr' WHERE id='$deptid'");
    }
}
elseif(isset($_POST['delete_dept']) && $_POST['delete_dept'] = "D")
{
    $deptid = $_POST['dept_id'];
    settype($deptid, 'integer');
    mysql_query("UPDATE department SET removed='1' WHERE id='$deptid'");
}
}
?>
