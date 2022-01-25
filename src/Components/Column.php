<?php
namespace App\Components;

class Column
{
    
    protected int $active = 0;

    protected array $columns = [];

    protected array $groupColumn = [];

    /**
     * @method add 
     * @var \Closure $callback
     * @var string $type half|full
     */
    public function add(\Closure $callback)
    {
        if ($callback instanceof \Closure) {
            array_push($this->columns,[$callback($this)]);
        }
    }

    
    protected function styles()
    {
        $css = <<<EOT
        <style>
            .row-cus {
                box-sizing: border-box;
            }
            /* Create four equal columns that floats next to each other */
            .row-cus .column-cus {
                float: left;
                width: 25%;
                padding: 10px;
                height: 300px; /* Should be removed. Only for demonstration */
            }
            /* Clear floats after the columns */
            .row-cus .row-cus:after {
                content: "";
                display: table;
                clear: both;
            }
            /* Responsive layout - makes the four columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 600px) {
                .row-cus .column-cus{
                    width: 100%;
                }
            }
        </style>
        EOT;

        echo $css;
    }

    /**
     * @method groupingColumn
     */
    protected function groupingColumn()
    {
        $this->groupColumn = array_chunk($this->columns,4,true);
    }

    /**
     * @method render
     */
    public function render()
    {
        $this->active ++;
        
        $this->groupingColumn();


        $html = '';
        $html .= "<div class='row-cus'>";
        $html .= $this->styles();
        foreach($this->groupColumn as $kgcol => $vgcol){
            if(count($vgcol) == 1){
                $styles = 'width:98.7%';
            }else if(count($vgcol) == 2){
                $styles = 'width:48%';
            }else if(count($vgcol) == 3){
                $styles = 'width:31.33%';
            }else{
                $styles = 'width:23.5%';
            }
            foreach($vgcol as $col => $vcol){
                if($col === array_key_last($vgcol) && count($vgcol) == 3){
                    $styles = 'width:33.33%';
                }
                if($col === array_key_last($vgcol) && count($vgcol) == 2){
                    $styles = 'width:49%';
                }
                if($col === array_key_last($vgcol) && count($vgcol) > 3){
                    $styles = 'width:24%';
                }
                $html .= "<div class='column-cus' style='{$styles}'>";
                    $html .= $vcol[0];
                $html .= "</div>";
            }
        }
        $html .= "</div>";

        return $html;
    }

    /**
     * @method __destruct
     */
    public function __destruct() {
        if($this->active < 1){
            echo $this->render();
        }
    }
}