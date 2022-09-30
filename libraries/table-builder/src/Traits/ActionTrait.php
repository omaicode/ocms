<?php
namespace Omaicode\TableBuilder\Traits;

use Illuminate\Support\Collection;
use Omaicode\TableBuilder\Action;
use Omaicode\TableBuilder\Exceptions\TableActionException;

trait ActionTrait
{
    public    ?Collection $actions = null;
    protected bool $show_actions   = true;
    protected bool $disable_edit   = false;
    protected bool $disable_delete = false;
    protected ?string $edit_url    = null;
    protected ?string $delete_url  = null;
    
    protected function actions()
    {
        return [];
    }

    protected function addEditAction()
    {
        $this->addAction(new Action('link', __('omc::table.edit'), $this->edit_url));
    }

    protected function addDeleteAction()
    {
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><g fill="currentColor"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></g></svg>';
        $this->addAction(new Action('delete', __('omc::table.delete'), $this->delete_url, $icon, ['style' => ['color' => '#e11d48']]));
    }

    public function showActions()
    {
        return $this->show_actions;
    }

    public function addAction(Action $action)
    {
        if(!$this->actions) {
            $this->actions = collect();
        }

        $this->actions->add($action);

        return $this;
    }

    public function initActions()
    {
        if(!$this->disable_edit && $this->edit_url) {
            $this->addEditAction();
        }

        if(!$this->disable_delete && $this->delete_url) {
            $this->addDeleteAction();
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