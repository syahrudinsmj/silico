<?php
namespace App\Components;

use App\Components\Partials\Input;
use App\Components\Partials\Button;
use App\Components\Partials\Select;
use App\Components\Partials\CheckboxRadio;

/**
 * untuk membuat form mengunakan class php
 */
class Form
{
    protected int $active = 0;

    /**
     * @var string $method
     */
    public string $method = "GET";

    /**
     * @var string $action
     */
    public string $action = "/";

    /**
     * @var string $target
     */
    public string $target = "";

    /**
     * @var array $data
     */
    protected array $data = [];

    /**
     * @var array $column
     */
    protected array $column = [];

    /**
     * @var array $button;
     */
    public array $button = [];


    /**
     * @var boolean $laravel 
     */
    public bool $laravel = false;

    /**
     * @var array $formAttributes;
     */
    public array $formAttributes = [];


    public function column(\Closure $callback)
    {
        if ($callback instanceof \Closure) {
            array_push($this->column,[]);
            return $callback($this);
        }
    }

    protected function addTocolumn($html)
    {   
        $counter = count($this->column);
        
        if($counter>0){
            $num = $counter-1;
            array_push($this->column[$num],$html);
        }else{
            array_push($this->data,$html);
        }
    }
    
    /**
     * @method button
     * @var string $label
     * @var string $type
     * @var string $icon
     * @var array $attributes
     */
    public function button($label = null, $type = "button", $icon = null, $attributes = [] )
    {
        $attributes = $this->setAttribute($attributes);
        
        $html = Button::get($label, $type, $icon, $attributes);

        array_push($this->button,$html);
    }

    /**
     * @method field
     * @var string $type
     * @var string $label
     * @var string $name
     * @var any $value
     * @var array $attributes
     */
    public function field($type = "text", $label = null, $name = null, $value = null, $attributes = [])
    {   
        $attributes = $this->setAttribute($attributes);

        $html = Input::get($type, $label, $name, $value, $attributes);

        $this->addTocolumn($html);
    }

    /**
     * @method radio
     * @var string $label
     * @var string $name
     * @var any $value
     * @var array $options : key => value
     * @var array $attributes
     */
    public function radio($label = null, $name = null, $value = null, $options = [], $attributes = [])
    {
        $html = $this->checkRadio('radio',$label, $name, $value, $options, $attributes);

        $this->addTocolumn($html);
    }

    
    /**
     * @method checkbox
     * @var string $label
     * @var string $name
     * @var any $value
     * @var array $options : key => value
     * @var array $attributes
     */
    public function checkbox($label = null, $name = null, $value = null, $options = [], $attributes = [])
    {
        $html = $this->checkRadio('checkbox',$label, $name, $value, $options, $attributes);

        $this->addTocolumn($html);
    }

    /**
     * @method checkRadio
     * @var string $label
     * @var string $name
     * @var any $value
     * @var array $options : key => value
     * @var array $attributes
     */
    protected function checkRadio($type = 'checkbox', $label, $name, $value, $options, $attributes){
        
        $attributes = $this->setAttribute($attributes);

        $html = CheckboxRadio::get($type, $label, $name, $value, $options, $attributes);

        return $html;
    }
    
    /**
     * @method select
     * @var string $label
     * @var array $options : key => value
     * @var string $name
     * @var any $value
     * @var array $attributes
     * @var string $placeholder
     */
    public function select($label = null, $name = null, $options = [], $value = null, $attributes = [], $placeholder = null)
    {
        $attributes = $this->setAttribute($attributes);

        $html = Select::get($label, $name, $options, $value, $attributes, $placeholder);

        $this->addTocolumn($html);
    }

    /**
     * @method render
     */
    public function render()
    {
        $this->active ++;

        // var_dump($this);
        // die();

        $formAttributes = $this->setAttribute($this->formAttributes);

        $target = (strlen($this->target)>0)?  "target='{$this->target}'" : '';
        $html = "<form action='{$this->action}' method='{$this->method}' {$target} {$formAttributes}>";
            if($this->laravel){
                $token = csrf_token();
                $html .= '<input type="hidden" name="_token" value="'.$token.'">';
            }
            $html .= "<table style='width:100%'>";
                $html .= "<tr>";
            if(count($this->column)>0){
                foreach($this->column as $kcol => $vcol){
                    $html .= "<td>";
                    foreach($vcol as $kdt => $vdt){
                        $html .= $vdt;
                    }
                    $html .= "</td>";
                }
            }else{
                $html .= "<td>";
                foreach($this->data as $kdt => $vdt){
                        $html .= $vdt;
                }
                $html .= "</td>";
            }
                $html .= "</tr>";
                $counter = count($this->column);
                $html .= "<tr>";
                    $html .= "<td colspan='{$counter}'>";
                    // button place
                    if(count($this->button)>0){
                        foreach($this->button as $kbtn => $vbtn){
                            $html .= $vbtn;
                        }
                    }else{
                        $html .= Button::get("Submit","submit","","");
                        $html .= Button::get("Batal","reset","","");
                    }
                    $html .= "</td>";
                $html .= "</tr>";

            $html .= "</table>";
        $html .= "</form>";

        return $html;
    }

    /**
     * @method setAttribute
     * @var array $attributes
     */
    protected function setAttribute($attributes)
    {
        $exist = ['name', 'type', 'value'];

        foreach($exist as $ex){
            if(array_key_exists($ex,$attributes)){
                unset($attributes[$ex]);
            }
        }

        $attributes = http_build_query($attributes, "", ' ');
        return $attributes;
    }

    public function __destruct() {
        if($this->active < 1){
            echo $this->render();
        }
    }
}