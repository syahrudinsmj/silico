<?php
namespace App\Components\Partials;

class CheckboxRadio 
{

    protected static string $type;

    protected static string $label;

    protected static string $name;

    protected static array $options;

    protected static $value;

    protected static string $attributes;

    public function __construct()
    {

    }

    public static function get($type, $label, $name, $value, $options, $attributes)
    {
        self::$type       = $type;
        self::$options    = $options;
        self::$label      = $label;
        self::$name       = $name;
        self::$value      = $value;
        self::$attributes = $attributes;

        $html = "<div style='display:block;margin:5px;padding:2px;'>";
        $html .= "<label>".self::$label."</label><br/>";


        foreach(self::$options as $kopt => $vopt){

            $checked = (self::$value == $vopt)? 'checked' : '';

            $checkloop = ($kopt === array_key_first(self::$options))? 'checked' :'';

            $checked = (strlen($checked)>0)? $checked : $checkloop ;
            
            $html .= "<input type='".self::$type."' name='".self::$name."' value='".$kopt."' ".self::$attributes." ".$checked." > ";
            $html .= "<label>".$vopt."</label> &nbsp; &nbsp; &nbsp;";
        }
        $html .= "</div>";
        
        return $html;
    }
}