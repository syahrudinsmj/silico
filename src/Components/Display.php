<?php
namespace App\Components;

class Display {

    protected int $active = 0;

    protected array $fields = [];

    public function text($label = null,$value = null)
    {
        array_push($this->fields,[
            'type'  => 'text',
            'label' => $label,
            'value' => $value,
        ]);
    }

    public function tag($label = null, $value = [])
    {
        array_push($this->fields,[
            'type'  => 'tag',
            'label' => $label,
            'value' => $value,
        ]);
    }

    public function image($label = null, $value = '')
    {
        array_push($this->fields,[
            'type'  => 'image',
            'label' => $label,
            'value' => $value,
        ]);
    }

    public function images($label = null, $value = [])
    {
        array_push($this->fields,[
            'type'  => 'images',
            'label' => $label,
            'value' => $value,
        ]);
    }

    public function download($label = null, $value = '')
    {
        
        array_push($this->fields,[
            'type'  => 'download',
            'label' => $label,
            'value' => $value,
        ]);
    }
    
    public function downloads($label = null, $value = [])
    {
        array_push($this->fields,[
            'type'  => 'downloads',
            'label' => $label,
            'value' => $value,
        ]);
    }

    public function html($value = ''){
        array_push($this->fields,[
            'type'  => 'html',
            'label' => '',
            'value' => $value,
        ]);
    }

    public function callback(\Closure $callback)
    {
        array_push($this->fields,[
            'type'  => 'callback',
            'label' => '',
            'value' => $callback(),
        ]);
    }

    protected function styles()
    {
        $css = <<<EOT
        <style>
            .table-row-custom{  
                display:table-row;
            }
            .table-row-custom .col-custom{ 
                display:table-cell;
                vertical-align: top;
                padding:4px 10px 4px 10px
            }
        </style>
        EOT;

        echo $css;
    }

    public function render()
    {
        $this->active ++;

        $html = '';
        $html .= $this->styles();
        $html .= "<div style='display:table'>";
        foreach($this->fields as $kfield => $vfield){
           $html .= $this->htmlRender($vfield['type'],$vfield['label'],$vfield['value']);
        }
        $html .= "</div>";

        return $html;
    }

    protected function htmlRender($type = null, $label = null, $value = null)
    {
        $html = "";
        if($type === 'text'){
            $html .= "<div class='table-row-custom'>";
                $html .= "<div class='col-custom'>";
                    $html .= "<b>".$label."</b>";
                $html .= "</div>";
                $html .= "<div class='col-custom'>";
                    $html .= $value;
                $html .= "</div>";
            $html .= "</div>";
        }

        if($type === 'tag'){
            $html .= "<div class='table-row-custom'>";
                $html .= "<div class='col-custom'>";
                    $html .= "<b>".$label."</b>";
                $html .= "</div>";
                $html .= "<div class='col-custom'>";
                    $html .= implode(", ",$value);
                $html .= "</div>";
            $html .= "</div>";
        }

        if($type === 'image'){
            $html .= "<div class='table-row-custom'>";
                $html .= "<div class='col-custom'>";
                    $html .= "<b>".$label."</b>";
                $html .= "</div>";
                $html .= "<div class='col-custom'>";
                    $html .= "<img src='".$value."' alt='".$label."' width='200' height='200'>";
                $html .= "</div>";
            $html .= "</div>";
        }

        if($type === 'images'){
            $html .= "<div class='table-row-custom'>";
                $html .= "<div class='col-custom'>";
                    $html .= "<b>".$label."</b>";
                $html .= "</div>";
                $html .= "<div class='col-custom'>";
                    foreach($value as $kval => $vval){
                        $html .= "<img src='".$vval."' alt='".($label.' '.$kval)."' width='200' height='200' style='display:inline-block;margin:3px;'>";
                        $html .= "<img src='".$vval."' alt='".($label.' '.$kval)."' width='200' height='200' style='display:inline-block;margin:3px;'>";
                    }
                $html .= "</div>";
            $html .= "</div>";
        }

        if($type === 'download'){
            $html .= "<div class='table-row-custom'>";
                $html .= "<div class='col-custom'>";
                    $html .= "<b>".$label."</b>";
                $html .= "</div>";
                $html .= "<div class='col-custom'>";
                    $html .= "<a href='".$value."' target='_blank' download > Download ".$label."</a>";
                $html .= "</div>";
            $html .= "</div>";
        }
        
        if($type === 'downloads'){
            $html .= "<div class='table-row-custom'>";
                $html .= "<div class='col-custom'>";
                    $html .= "<b>".$label."</b>";
                $html .= "</div>";
                $html .= "<div class='col-custom'>";
                    foreach($value as $kval => $vval){
                        $html .= "<a href='".$vval."' target='_blank' download > Download ".($label.' '.$kval)."</a><br/>";
                    }
                $html .= "</div>";
            $html .= "</div>";
        }

        if($type === 'html'){
            $html .= "<div class='table-row-custom'>";
                $html .= "<div class='col-custom'></div>";
                $html .= "<div class='col-custom'>";
                    $html .= $value;
                $html .= "</div>";
            $html .= "</div>";
        }
        
        if($type === 'callback'){
            $html .= "<div class='table-row-custom'>";
                $html .= "<div class='col-custom'></div>";
                $html .= "<div class='col-custom'>";
                    $html .= $value;
                $html .= "</div>";
            $html .= "</div>";
        }

        return $html;
    }

    public function __destruct()
    {
        if($this->active < 1){
            echo $this->render();
        }
    }
}