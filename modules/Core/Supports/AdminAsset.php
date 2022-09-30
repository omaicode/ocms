<?php
namespace Modules\Core\Supports;

use Illuminate\Support\Facades\Blade;

class AdminAsset
{
    protected $scripts = [];
    protected $styles = [];

    public function addScript(string $name, string $url)
    {
        $this->scripts[] = ['name' => $name, 'url' => $url];

        return $this;
    }

    public function removeScript(string $name)
    {
        if(isset($this->scripts[$name])) {
            unset($this->scripts[$name]);
        }

        return $this;
    }

    public function addStyle(string $name, string $url)
    {
        $this->styles[] = ['name' => $name, 'url' => $url];

        return $this;
    }

    public function removeStyle(string $name)
    {
        if(isset($this->styles[$name])) {
            unset($this->styles[$name]);
        }

        return $this;
    }

    public function renderScripts()
    {   
        $html  = '';
        foreach($this->scripts as $script) {
            $html .= <<<SCRIPT
            <script src="{$script['url']}"></script>
            SCRIPT;
        }

        return $html;
    }

    public function renderStyles()
    {   
        $html  = '';
        foreach($this->styles as $style) {
            $html .= <<<STYLE
            <link rel='stylesheet' type='text/css' href='{$style['url']}'/>
            STYLE;
        }

        return $html;
    }
}