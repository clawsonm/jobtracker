<?php

class JT_TeamEditView implements JT_EditView
{
    private $team;

    public function __construct($team)
    {
        $this->team = $team;
    }

    public function render()
    {
?>
<div class="team">
<form autocomplete="off" action="editteam.php?team=<?php echo($this->team->getID()); ?>" method="post">
<span>Name: </span>
<input type="text" name="name" size="15" maxlength="15" value="<?php echo($this->team->getName()); ?>" /> <br />

<span>Fullname: </span>
<input type="text" name="fullname" size="40" value="<?php echo($this->team->getFullname()); ?>" /><br />

<input type="hidden" name="id" value="<?php echo($this->team->getID()); ?>" />

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
