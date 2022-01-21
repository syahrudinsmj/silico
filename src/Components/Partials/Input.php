<?php
namespace App\Components\Partials;

class Input 
{

    protected static string $type;

    protected static string $label;

    protected static string $name;

    protected static $value;

    protected static string $attributes;

    public function __construct()
    {
        
    }

    public static function get($type, $label, $name, $value, $attributes)
    {
        self::$type       = $type;
        self::$label      = $label;
        self::$name       = $name;
        self::$value      = $value;
        self::$attributes = $attributes;

        $html = "<div style='display:block;margin:5px;padding:2px;'>";
            $html .= "<label>".self::$label."</label><br/>";
            $html .= "<input type='".self::$type."' name='".self::$name."' value='".self::$value."' ".self::$attributes.">";
        $html .= "</div>";

        return $html;
    }
}