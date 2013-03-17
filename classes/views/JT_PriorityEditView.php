<?php

class JT_PriorityEditView implements JT_EditView
{
    private $priority;

    public function __construct($priority)
    {
        $this->priority = $priority;
    }

    public function render()
    {
?>
<div class="priority">
<form autocomplete="off" action="editpriority.php?priority=<?php echo($this->priority->getID()); ?>" method="post">
<span>Name: </span>
<input type="text" name="name" size="15" maxlength="15" value="<?php echo($this->priority->getName()); ?>" /> <br />

<span>Weight: </span>
<input type="text" name="weight" min="1" max="100" width="4" value="<?php echo($this->priority->getWeight()); ?>" /><br />

<span>Icon: </span>
<?php
        if($this->priority->hasIcon())
        {
            echo('<img src="' . $this->priority->getIcon() . '" /><br />');
        }   
?>
<input type="file" name="icon" value="Upload Icon" /><br />

<input type="hidden" name="id" value="<?php echo($this->priority->getID()); ?>" />

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
