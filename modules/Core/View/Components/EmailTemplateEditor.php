<?php
namespace Modules\Core\View\Components;

use Illuminate\View\Component;

class EmailTemplateEditor extends Component
{
    public $value;
    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value = '', $name)
    {
        $this->value = $value;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('core::components.email-template-editor');
    }
}
