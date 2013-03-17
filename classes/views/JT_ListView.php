<?php

abstract class JT_ListView implements JT_View
{
    protected $list = NULL;
    protected $tableName = '';
    protected $columnNames = array();

    public function __construct($datalist)
    {
        $this->list = $datalist;
    }
    
    public function render()
    {
        if($this->list->isEmpty())
        {
            echo('<div><p>No ' . ucwords($this->tableName) . '</p></div>');
            return;
        }
        $this->renderTableHeader();
        foreach($this->list->getList() as $list)
        {
            $this->renderTableRow($list);
        }
        $this->renderTableFooter();
    }

    protected function renderTableHeader()
    {
?>
<dl>
<dt class="togglesection"><?php echo(ucwords($this->tableName) . ' List (' . $this->list->size() . ')'); ?></dt>
<dd>
<table id="<?php echo(strtolower(str_replace(' ', '', $this->tableName))); ?>list" class="tablesorter">
<thead>
<tr>
<?php
        foreach($this->columnNames as $col)
        {
            echo('<th>' . $col . '</th>');
        }
?>
</tr>
</thead>
<tbody>
<?php
    }

    protected abstract function renderTableRow($item);

    protected function renderTableFooter()
    {
?>
</tbody>
</table>
</dd>
<?php
    }

    protected function renderIcon($url)
    {
        echo('<img class="icon" width="16" height="16" src="' . $url . '" />');
    }

    public function renderHead()
    {
        //we don't need anything the head right now
    }

}

?>
