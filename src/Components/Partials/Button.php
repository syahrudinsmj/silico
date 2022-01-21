<?php
namespace App\Components\Partials;

class Button 
{

    protected static string $label;

    protected static string $type;

    protected static $icon;

    protected static string $attributes;

    public function __construct()
    {
        
    }

    public static function get($label, $type, $icon, $attributes)
    {
        self::$label      = $label;
        self::$type       = $type;
        self::$icon       = $icon;
        self::$attributes = $attributes;

        $html = "<div style='display:inline-block;margin:5px;'>";
            $html .= "<button type='".self::$type."' ".self::$attributes." > ".self::$icon." ".self::$label." </button>";
        $html .= "</div>";

        return $html;
    }
}