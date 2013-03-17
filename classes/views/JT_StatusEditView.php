<?php

class JT_StatusEditView implements JT_EditView
{
    private $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function render()
    {
?>
<div class="status">
<form autocomplete="off" action="editstatus.php?status=<?php echo($this->status->getID()); ?>" method="post">
<span>Name: </span>
<input type="text" name="name" size="15" maxlength="15" value="<?php echo($this->status->getName()); ?>" /> <br />

<span>Hidden by default: </span>
<input type="checkbox" name="hide" value="hide" <?php if($this->status->isHidden()) { echo('checked="checked"'); } ?> >Hide</input><br />

<span>Weight: </span>
<input type="text" name="weight" min="1" max="100" width="4" value="<?php echo($this->status->getWeight()); ?>" /><br />

<span>Icon: </span>
<?php
        if($this->status->hasIcon())
        {
            echo('<img src="' . $this->status->getIcon() . '" /><br />');
        }   
?>
<input type="file" name="icon" value="Upload Icon" /><br />

<input type="hidden" name="id" value="<?php echo($this->status->getID()); ?>" />

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
