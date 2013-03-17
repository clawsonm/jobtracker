<?php

class JT_AddressEditView implements JT_EditView
{
    private $room;
    private $buiding;

    public function __construct($room, $building)
    {
        $this->room = $room;
        $this->building = $building;
    }

    public function render()
    {
?>
<div class="address">
<span>Room: </span>
<input type="text" name="room" size="5" maxlength="10" value="<?php echo($this->room); ?>" />

<?php
        $buildings = new JT_Buildings();

        $buildingbox = new JT_BuildingBoxView($buildings, $this->building->getID());

        $buildingbox->render();
?>

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
