<?php

require_once(JT_INCLUDES . "/dbinit.php");

class JT_Client extends JT_Removable
{
    private $uin = 0;
    private $username = '';
    private $lastname = '';
    private $firstname = '';
    private $room = 0;
    private $building = NULL;
    private $email = '';
    private $homephone = 0;
    private $workphone = 0;
    private $cellphone = 0;
    private $chair = false;
    private $department = NULL;
    private $consultant = false;
    private $team = NULL;
    private $admin = false;
    private $notify = false;
    
    public function __construct($clientinfo)
    {
        global $db;
        if(!is_array($clientinfo))
        {
            $query = "SELECT * FROM client WHERE id=$clientinfo";
            $result = $db->query($query);
            if($result->num_rows == 0)
                die('unrecognized client');
            $clientinfo = $result->fetch_assoc();
            $result->free();
        }
        
        $this->id = $clientinfo['id'];
        $this->uin = $clientinfo['uin'];
        $this->username = $clientinfo['username'];
        $this->lastname = $clientinfo['lastname'];
        $this->firstname = $clientinfo['firstname'];
        $this->room = $clientinfo['room'];
        $this->building = new JT_Building($clientinfo['building_fkey']);
        $this->email = $clientinfo['email'];
        $this->homephone = $clientinfo['homephone'];
        $this->workphone = $clientinfo['workphone'];
        $this->cellphone = $clientinfo['cellphone'];
        $this->chair = ($clientinfo['chair'] == 1);
        $this->department = new JT_Department($clientinfo['department_fkey']);
        $this->consultant = ($clientinfo['consultant'] == 1);
        if(isset($clientinfo['team_fkey']))
            $this->team = new JT_Team($clientinfo['team_fkey']);
        $this->admin = ($clientinfo['admin'] == 1);
        $this->notify = ($clientinfo['notify'] == 1);
        parent::__construct($clientinfo);
    }

    public static function getClientByID($id)
    {
        global $db;

        $query = "SELECT * FROM client WHERE id=$id";

        $result = $db->query($query);

        if($result->num_rows != 0)
            return new JT_Client($result->fetch_assoc());
        else
            return false;
    }

    public function getUIN()
    {
        return $this->uin;
    }

    public function setUIN($uin)
    {
        $this->uin = $uin;
        $this->changed = true;
        return true;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        $this->changed = true;
        return true;
    }
    
    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($last)
    {
        $this->lastname = $last;
        $this->changed = true;
        return true;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($first)
    {
        $this->firstname = $first;
        $this->changed = true;
        return true;
    }

    public function getFullname()
    {
        return $this->lastname . ", " . $this->firstname;
    }

    public function getName()
    {
        return $this->getFullname();
    }

    public function getRoom()
    {
        return $this->room;
    }

    public function setRoom($room)
    {
        $this->room = $room;
        $this->changed = true;
        return true;
    }

    public function getBuilding()
    {
        return $this->building;
    }

    public function setBuilding($bldg)
    {
        if($bldg instanceof JT_Building)
        {
            $this->building = $bldg;
            $this->changed = true;
            return true;
        }
        else if(intval($bldg) > 0)
        {
            $bldg = JT_Building::getBuildingByID($bldg);
            return $this->setBuilding($bldg);
        }
        else
            return false;
    }

    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail($email)
    {
        $this->email = $email;
        $this->changed = true;
        return true;
    }

    public function getHomePhone()
    {
        return $this->homephone;
    }

    public function setHomePhone($home)
    {
        $this->homephone = $home;
        $this->changed = true;
        return true;
    }

    public function getWorkPhone()
    {
        return $this->workphone;
    }

    public function setWorkPhone($work)
    {
        $this->workphone = $work;
        $this->changed = true;
        return true;
    }

    public function getCellphone()
    {
        return $this->cellphone;
    }

    public function setCellphone($cell)
    {
        $this->cellphone = $cell;
        $this->changed = true;
        return true;
    }

    public function isChair()
    {
        return $this->chair;
    }

    public function setChairFlag($chair)
    {
        $this->chair = $chair;
        $this->changed = true;
        return true;
    }

    public function getDepartment()
    {
        return $this->department;
    }

    public function setDepartment($dept)
    {
        if($dept instanceof JT_Department)
        {
            $this->department = $dept;
            $this->changed = true;
            return true;
        }
        else if (intval($dept) > 0)
        {
            $dept = JT_Department::getDepartmentByID($dept);
            return $this->setDepartment($dept);
        }
        else
            return false;
    }

    public function isConsultant()
    {
        return $this->consultant;
    }

    public function setConsultantFlag($consult)
    {
        $this->consultant = $consult;
        $this->changed = true;
        return true;
    }

    public function getTeam()
    {
        return $this->team;
    }

    public function setTeam($team)
    {
        if($team instanceof JT_Team)
        {
            $this->team = $team;
            $this->changed = true;
            return true;
        }
        else if (intval($team) > 0)
        {
            $team = JT_Team::getTeamByID($team);
            return $this->setTeam($team);
        }
        else
            return false;
    }

    public function isAdmin()
    {
        return $this->consultant && $this->admin;
    }

    public function setAdminFlag($admin)
    {
        $this->admin = $this->consultant && $admin;
        $this->changed = true;
        return true;
    }

    public function hasNotify()
    {
        return $this->consultant && $this->notify;
    }

    public function setNotifyFlag($notify)
    {
        $this->notify = $this->consultant && $notify;
        $this->changed = true;
        return true;
    }

    public function writeChanges()
    {
        global $db;

        if(!$this->changed)
            return true;

        $query = "UPDATE client SET uin='" . $this->uin . "', "
                . "username='" . $this->username . "', "
                . "lastname='" . $this->lastname . "', "
                . "firstname='" . $this->firstname . "', "
                . "room='" . $this->room . "', "
                . "building_fkey='" . $this->building->getID() . "', "
                . "email='" . $this->email . "', "
                . "homephone='" . $this->homephone . "', "
                . "workphone='" . $this->workphone . "', "
                . "cellphone='" . $this->cellphone . "', "
                . "chair='" . (($this->chair) ? '1' : '0') . "', "
                . "department_fkey='" . $this->department->getID() . "', "
                . "consultant='" . (($this->consultant) ? '1' : '0') . "', "
                . "team_fkey='" . $this->team->getID() . "', "
                . "admin='" . (($this->admin) ? '1' : '0' ) . "', "
                . "notify='" . (($this->notify) ? '1' : '0' ) . "', "
                . "removed='" . (($this->removed) ? '1' : '0' ) . "'"
                . "WHERE id=" . $this->id;

        $db->query($query);

        if($db->affected_rows != 0)
        {
            $this->changed = false;
            return true;
        }
        else
            return false;
    }

}

?>
