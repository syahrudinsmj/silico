<?php
namespace App\Components\Partials;

class Select 
{

    protected static string $label;

    protected static string $name;

    protected static array $options;

    protected static $value;

    protected static string $attributes;

    protected static string $placeholder;

    public function __construct()
    {

    }

    public static function get($label, $name, $options, $value, $attributes, $placeholder)
    {
        self::$options     = $options;
        self::$label       = $label;
        self::$name        = $name;
        self::$value       = $value;
        self::$attributes  = $attributes;
        self::$placeholder = (strlen($placeholder)>0)? $placeholder : $label;

        $html = "<div style='display:block;margin:5px;padding:2px;'>";
            $html .= "<label>".self::$label."</label><br/>";
            $html .= "<select name='".self::$name."' ".self::$attributes.">";
                $html .= "<option value=''>".self::$placeholder."</option>";
                foreach( self::$options as $kopt => $vopt ){
                    $selected = ($kopt == self::$value)? 'selected' :'';
                    $html .= "<option value='".$kopt."' ".$selected.">".$vopt."</option>";
                }
            $html .= "</select>";
        $html .= "</div>";

        return $html;
    }
}