<?php

class JT_ClientEditView implements JT_EditView
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function render()
    {
?>
<div class="client">
<form autocomplete="off" action="editclient.php?client=<?php echo($this->client->getID()); ?>" method="post">

<span>Firstname: </span>
<input type="text" name="firstname" size="20" maxlength="32" value="<?php echo($this->client->getFirstname()); ?>" /> <br />

<span>Lastname: </span>
<input type="text" name="lastname" size="20" maxlength="50" value="<?php echo($this->client->getLastname()); ?>" /> <br />

<span>Username: </span>
<input type="text" name="username" size="20" maxlength="32" value="<?php echo($this->client->getUsername()); ?>" /> <br />

<span>UIN: </span>
<input type="text" name="uin" size="10" maxlength="15" value="<?php echo($this->client->getUIN()); ?>" /> <br />

<?php 

        $addresseditview = new JT_AddressEditView($this->client->getRoom(), $this->client->getBuilding());
        $addresseditview->render();
?>

<span>Email: </span>
<input type="text" name="email" size="20" maxlength="32" value="<?php echo($this->client->getEmail()); ?>" /> <br />

<span>Home Phone: </span>
<input type="text" name="homephone" size="15" maxlength="15" value="<?php echo($this->client->getHomePhone()); ?>" /> <br />

<span>Work Phone: </span>
<input type="text" name="workphone" size="15" maxlength="15" value="<?php echo($this->client->getWorkPhone()); ?>" /> <br />

<span>Cellphone: </span>
<input type="text" name="cellphone" size="15" maxlength="15" value="<?php echo($this->client->getCellphone()); ?>" /> <br />

<?php

        $departments = new JT_Departments();
        $deptboxview = new JT_DeptBoxView($departments, $this->client->getDepartment()->getID());

        $deptboxview->render();

?>

<span>Department Chair: </span>
<input type="checkbox" name="chair" value="chair" <?php if($this->client->isChair()) { echo('checked="checked"'); } ?> >Chair</input><br />

<hr />

<span>Consultant Info: </span>
<input type="checkbox" id="consultanttoggle" name="consultant" value="consultant" <?php if($this->client->isConsultant()) { echo('checked="checked"'); } ?> >Consultant</input><br />

<div id="consultantinfo" <?php echo ((($this->client->isConsultant()) ? '' :' style="display: none;"' )); ?>>

<?php

        $teams = new JT_Teams();
        $teamboxview = new JT_TeamBoxView($teams, $this->client->getTeam()->getID());
        $teamboxview->render();

?>

<span>Admin: </span>
<input type="checkbox" name="admin" value="admin" <?php if($this->client->isAdmin()) { echo('checked="checked"'); } ?> >Admin</input><br />

<span>Notify: </span>
<input type="checkbox" name="notify" value="notify" <?php if($this->client->hasNotify()) { echo('checked="checked"'); } ?> >Notify</input><br />

</div><!-- close consultantinfo -->

<input type="hidden" name="id" value="<?php echo($this->client->getID()); ?>" />

</form>
</div>
<?php
    }

    public function handleRequests()
    {
        //not implemented
    }

    public function renderHead()
    {
        //not used
    }

}

?>
