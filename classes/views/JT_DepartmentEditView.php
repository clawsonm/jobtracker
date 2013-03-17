<?php

class JT_DepartmentEditView implements JT_EditView
{
    private $department;

    public function __construct($department)
    {
        $this->department = $department;
    }

    public function render()
    {
?>
<div class="department">
<form autocomplete="off" action="editdepartment.php?department=<?php echo($this->department->getID()); ?>" method="post">
<span>Name: </span>
<input type="text" name="name" size="40" value="<?php echo($this->department->getName()); ?>" /> <br />

<span>Abbreviation: </span>
<input type="text" name="abbreviation" size="15" maxlength="15" value="<?php echo($this->department->getAbbr()); ?>" /><br />

<input type="hidden" name="id" value="<?php echo($this->department->getID()); ?>" />

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
