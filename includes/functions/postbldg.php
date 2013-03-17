<?php
function postbldg()
{
if(isset($_POST['save_bldg']) && $_POST['save_bldg'] == 'S')
{
    //handle saving bldg data
    
    $bldgid = $_POST['bldg_id'];
    settype($bldgid, 'integer');
    $name = mysql_real_escape_string($_POST['name']);
    $abbr = mysql_real_escape_string($_POST['abbr']);
    if($bldgid == -1)
    {
	mysql_query("INSERT INTO building (name, abbreviation) VALUES('$name', '$abbr')") or die(mysql_error());
    }
    else
    {
	mysql_query("UPDATE building SET name='$name', abbreviation='$abbr' WHERE id='$bldgid'");
    }
}
elseif(isset($_POST['delete_bldg']) && $_POST['delete_bldg'] = "D")
{
    $bldgid = $_POST['bldg_id'];
    settype($bldgid, 'integer');
    mysql_query("UPDATE building SET removed='1' WHERE id='$bldgid'");
}
}
?>
