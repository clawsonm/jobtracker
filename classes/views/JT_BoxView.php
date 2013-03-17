<?php

abstract class JT_BoxView implements JT_View
{
    protected $list = NULL;
    protected $default = 0;
    protected $name = '';
    protected $nothing = false;

    public function __construct($list = NULL, $default = 0, $name = '', $allownothing = false)
    {
        if($list == NULL)
            die("can't view a null list");
        $this->list = $list;
        $this->default = $default;
        $this->name = $name;
        $this->nothing = $allownothing;
    }

    public function render()
    {
?>
<div class="boxview">
<span><?php echo(ucwords($this->name)); ?>:</span>
<select name="<?php echo(strtolower(str_replace(' ' , '', $this->name)));?>">
<?php
        if($this->nothing)
            $this->renderNothingItem();
        if($this->default != 0 && !$this->list->contains($this->default))
            $this->renderDefaultNotFound();
        foreach($this->list->getList() as $item)
        {
            echo('<option');
            if($this->default == $item->getID())
                echo(' selected="selected"');
            echo(' value="' . $item->getID()  . '">');
            echo($item->getName() . '</option>');
        }
?>
</select>
</div>
<?php
    }

    public function renderNothingItem()
    {
        //by default no nothing items
        //
        return;
    }

    protected function renderDefaultNotFound($item = NULL)
    {
        if(is_null($item))
            return;
        echo('<option class="deleteditem" ');
        echo('selected="selected" value="' . $this->default .'">');
        echo($item->getName() . '</option>');

    }

    public function renderHead()
    {
        //not used yet
    }

}

?>
