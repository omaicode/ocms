<?php
namespace Omaicode\TableBuilder;

class Action
{
    public  $type;
    public  $text;
    public  $url;
    public  $icon;
    public  $attributes = [];

    public function __construct($type = 'link', string $text, $url = '#', $icon = null, array $attributes = [])
    {
        $this->text         = $text;
        $this->url          = $url;
        $this->attributes   = $attributes;
        $this->icon         = $icon;
        $this->type         = $type;
    }

    public function icon(string $icon)
    {
        $this->icon = $icon;
        
        return $this;
    }
}