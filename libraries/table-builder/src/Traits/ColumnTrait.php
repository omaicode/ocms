<?php
namespace Omaicode\TableBuilder\Traits;

use Closure;
use Omaicode\TableBuilder\Column;
use Omaicode\TableBuilder\Exceptions\TableColumnException;

trait ColumnTrait
{
    public array $columns = [];

    public function addColumn(Column $column)
    {
        $this->columns[] = $column;

        return $this;
    }

    public function initColumns()
    {
        foreach($this->columns() as $column) {
            if(!$column instanceof Column) {
                throw new TableColumnException(__('omc::errors.column_class'));
            } else {
                $this->addColumn($column);
            }
        }
    }

    public function totalColumns()
    {
        $columns  = count($this->columns);
        $addition = 0;

        if(method_exists($this, 'showActions') && $this->showActions()) {
            $addition += 1;
        }

        return $columns + $addition;
    }

    public function getArrayColumns()
    {
        $arr = [];

        foreach($this->columns as $column) {
            $arr[] = $column->toArray();
        }

        return $arr;
    }
}