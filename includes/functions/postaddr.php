<?php
function postaddr()
{
if(isset($_POST['save_addr']) && $_POST['save_addr'] == 'S')
{
    //handle saving addr data
    
    $addrid = $_POST['addr_id'];
    settype($addrid, 'integer');
    $addr_type = (($_POST['addr_type'] == 'b') ? 'b': 's' );
    $room = mysql_real_escape_string($_POST['room']);
    $building = $_POST['building'];
    settype($building, 'integer');
    $addr1 = mysql_real_escape_string($_POST['address1']);
    $addr2 = mysql_real_escape_string($_POST['address2']);
    $city = mysql_real_escape_string($_POST['city']);
    $state = mysql_real_escape_string($_POST['state']);
    $zip = mysql_real_escape_string($_POST['zip']);
    $country = mysql_real_escape_string($_POST['country']);

    if($addrid == -1)
    {
	if($addr_type == 'b')
	{
	    mysql_query("INSERT INTO address (addr_type, building_fkey, room, address1, address2, city, state, zip, country) VALUES('b', '$building', '$room', '', '', '', '  ', '', '')") or die(mysql_error());
	}
	else
	{
	    mysql_query("INSERT INTO address (addr_type, building_fkey, room, address1, address2, city, state, zip, country) VALUES('s', '0', '', '$addr1', '$addr2', '$city', '$state', '$zip', '$country')") or die(mysql_error());
	}
    }
    else
    {
	if($addr_type == 'b')
	{
	    mysql_query("UPDATE address SET building_fkey='$building', room='$room' WHERE id='$addrid'");
	}
	else
	{
	    mysql_query("UPDATE address SET address1='$addr1', address2='$addr2', city='$city', state='$state', zip='$zip', country='$country' WHERE id='$addrid'");
	}
    }
}
elseif(isset($_POST['delete_addr']) && $_POST['delete_addr'] = "D")
{
    $addrid = $_POST['addr_id'];
    settype($addrid, 'integer');
    mysql_query("UPDATE address SET removed='1' WHERE id='$addrid'");
}
}
?>
