<?php
namespace Omaicode\TableBuilder;

class Action
{
    public  $text;
    public  $url;
    public  $icon;
    public  $attributes = [];

    public function __construct(string $text, $url = '#', array $attributes = [])
    {
        $this->text         = $text;
        $this->url          = $url;
        $this->attributes   = $attributes;
    }

    public function icon(string $icon)
    {
        $this->icon = $icon;
        
        return $this;
    }
}