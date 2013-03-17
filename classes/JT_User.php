<?php

require_once(JT_INCLUDES . '/dbinit.php');

class JT_User
{
    private $client = NULL;

    public function __construct($userinfo)
    {
        global $db;
        if(is_int($userinfo))
        {
            $query = "SELECT * FROM client WHERE id=$userinfo";
            $result = $db->query($query);
            if($result->num_rows > 0)
                $this->populateUserInfo($result->fetch_assoc());
            else
                die("Couldn't find user!");
        }
        else
            $this->populateUserInfo($userinfo);
    }

    function getID()
    {
        return $this->client->getID();
    }

    function getClientInfo()
    {
        return $this->client;
    }

    function getUsername()
    {
        return $this->client->getUsername();
    }

    function getClient()
    {
        return $this->client;
    }

    function isConsultant()
    {
        return $this->client->isConsultant();
    }

    function isAdmin()
    {
        return $this->client->isAdmin();
    }

    public static function getUserByID($id)
    {
        $sql = "SELECT * FROM client WHERE id = $id";

        return self::getUser($sql);
    }

    public static function getUserByUIN($uin)
    {
        $sql = "SELECT * FROM client WHERE uin = $uin";

        return self::getUser($sql);
    }

    public static function getUserByUsername($username)
    {
        $sql = "SELECT * FROM client WHERE username='$username'";
        
        return self::getUser($sql);
    }

    private static function getUser($query)
    {
        global $db;
        $result = $db->query($query);

        if($result->num_rows > 0)
            return new JT_User($result->fetch_assoc());
        else
            return false;
    }

    private function populateUserInfo($row)
    {
        $this->client = new JT_Client($row);
    }

    function authUser($password)
    {
        global $db;
        $query = "SELECT username, password FROM client WHERE id='" . $this->client->getID() . "' AND password=SHA1('$password')";

        $result = $db->query($query);

        if($db->errno)
            die($db->error);

        if($result->num_rows > 0)
        {
            $result->free();
            return true;
        }

        $result->free();
        return false;
    }


}


?>
