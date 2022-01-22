<?php

namespace App\Components;

/**
 * membuat table dengan php
 */
class Table
{

    protected int $active = 0;
    
    public array $attributes = [];

    public array $theadattributes = [];

    public array $thead = [];

    public array $data = [];

    /**
     * @method setHeader
     * @param Array $arr
     */
    public function setHeader($label = null,$row = 0, $attributes = [])
    {
        if(!array_key_exists($row,$this->thead)){
            $this->setRow($row);
        }

        array_push($this->thead[$row],[
            'label'      => $label,
            'attributes' => $attributes
        ]);
    }

    /**
     * @method setRow
     * @param integer $row
     */
    protected function setRow($row)
    {
        $this->thead[$row] = [];
    }
    
    /**
     * @method setData
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @method render
     */
    public function render()
    {
        $attributes = http_build_query($this->attributes, "", ' ');
        $table = "<table {$attributes}>";

            // table header
            $theadattributes = http_build_query($this->theadattributes, "", ' ');
            $table .= "<thead {$theadattributes}>";
                foreach($this->thead as $kthead => $vthead){
                    $table .= "<tr>";
                        foreach($vthead as $kvthead => $vvthead){
                            $attributes = $vvthead['attributes'];
                            $attributes = http_build_query($attributes, "", ' ');

                            $table .= "<th {$attributes}>{$vvthead['label']}</th>";
                        }
                    $table .= "</tr>";
                }
            $table .= "</thead>";

            // table body
            $table .= "<tbody>";
                foreach($this->data as $kdata => $vdata){
                    $table .= "<tr>";
                        foreach($vdata as $kvdata => $vvdata){
                            $table .= "<td>{$vdata[$kvdata]}</td>";
                        }
                    $table .= "</tr>";
                }
            $table .= "</tbody>";

        $table .= "</table>";

        return $table;
    }

    
    public function __destruct() {
        if($this->active < 1){
            echo $this->render();
        }
    }
}