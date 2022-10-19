<?php
namespace Omaicode\FormBuilder\Fields;

use Omaicode\FormBuilder\Fields\Traits\HasPlainInput;

class Ckeditor extends BaseField
{
    use HasPlainInput;
    
    protected $view = 'form-builder::fields.ckeditor';
    protected static $css = [
        '/vendor/form-builder/css/ckeditor.css'
    ];
    protected static $js = [
        '/vendor/form-builder/js/ckeditor.js',
        '/vendor/form-builder/js/ckeditor.plugins.js',
    ];
    
    /**
     * Render this filed.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        $this->setScript($this->script());
        $this->defaultAttribute('id', $this->id)
            ->defaultAttribute('name', $this->elementName ?: $this->formatName($this->column))
            ->defaultAttribute('value', old($this->elementName ?: $this->column, $this->value()))
            ->defaultAttribute('placeholder', $this->getPlaceholder());

        return parent::render();
    }

    protected function script()
    {
        return <<<SCRIPT
        Ckeditor
        .create( document.querySelector( '#{$this->id}' ), {toolbar: {shouldNotGroupWhenFull: true}})
        .then( editor => {
            window.ckeditor_{$this->id} = editor;
            editor.editing.view.document.on(
                'enter',
                ( evt, data ) => {
                    editor.execute('shiftEnter');
                    //Cancel existing event
                    data.preventDefault();
                    evt.stop();
             }, {priority: 'high' });
        } )
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( error );
        } );        
        SCRIPT;
    }
}