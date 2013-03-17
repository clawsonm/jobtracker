<?php

class JT_BuildingEditView implements JT_EditView
{
    private $building;

    public function __construct($building)
    {
        $this->building = $building;
    }

    public function render()
    {
?>
<div class="building">
<form autocomplete="off" action="editbuilding.php?building=<?php echo($this->building->getID()); ?>" method="post">
<span>Name: </span>
<input type="text" name="name" size="40" value="<?php echo($this->building->getName()); ?>" /> <br />

<span>Abbreviation: </span>
<input type="text" name="abbreviation" size="15" maxlength="15" value="<?php echo($this->building->getAbbr()); ?>" /><br />

<input type="hidden" name="id" value="<?php echo($this->building->getID()); ?>" />

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
