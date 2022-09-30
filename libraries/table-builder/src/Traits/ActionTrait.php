<?php
namespace Omaicode\TableBuilder\Traits;

use Omaicode\TableBuilder\Action;
use Omaicode\TableBuilder\Exceptions\TableActionException;

trait ActionTrait
{
    public    array $actions       = [];
    protected bool $show_actions   = true;
    protected bool $disable_edit   = false;
    protected bool $disable_delete = false;
    protected ?string $edit_url    = null;
    protected ?string $delete_url  = null;
    
    protected function actions()
    {
        return [];
    }

    public function showActions()
    {
        return $this->show_actions;
    }

    public function addAction(Action $action)
    {
        $this->action[] = $action;

        return $this;
    }

    public function initActions()
    {
        if(!$this->disable_edit && $this->edit_url) {
            $this->addAction(new Action(__('omc::table.edit'), $this->edit_url));
        }

        if(!$this->disable_delete && $this->delete_url) {
            $this->addAction(new Action(__('omc::table.delete'), $this->delete_url));
        }

        foreach($this->actions() as $action) {
            if(!$action instanceof Action) {
                throw new TableActionException(__('omc::errors.action_class'));
            } else {
                $this->addAction($action);
            }
        }
    }
}