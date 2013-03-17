<?php

require_once(JT_INCLUDES . '/dbinit.php');

class JT_Login
{

    public function __construct()
    {
        @session_start();

        if(!isset($_SESSION['uid']))
        {
            $this->resetSession();
        }
    }

    function resetSession()
    {
        @session_start();
        $_SESSION = array();
        $_SESSION['uid'] = -1;
    }

    function setSession()
    {
        global $user;
        @session_start();
        $_SESSION['uid'] = $user->getID();
    }

    function authenticate($username, $password)
    {
        global $user;

        $user = JT_User::getUserByUsername($username);
        if(!$user)
        {
            $this->resetSession();
            return false;
        }
        $success = $user->authUser($password);

        if (!$success)
        {
            $this->resetSession();
            return false;
        }
        $this->setSession();
        return true;

    }

    function verify()
    {
        global $user;
        @session_start();
        if(!isset($_SESSION['uid']) || $_SESSION['uid'] == -1)
            return false;
        $uid = $_SESSION['uid'];

        $user = JT_User::getUserByID($uid);

        if(!$user)
        {
            $this->resetSession();
        }
        return $user;
    }

    function logout()
    {
        @session_start();
        $this->resetSession();
        session_destroy();
    }

}


?>
