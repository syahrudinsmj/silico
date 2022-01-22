<?php
namespace App\Components;

class Tab
{

    protected int $active = 0;

    protected array $contents = [];

    /**
     * @method add
     * @var string $label
     * @var \CLosure $callback
     */
    public function add($label, \Closure $callback = null)
    {
        if ($callback instanceof \Closure) {
            $this->contents[$label] = $callback($this);
        }
    }

    protected function styles()
    {
        $css = <<<EOT
        <style>
            /* Style the tab */
            .tab-cus {
                overflow: hidden;
                border: 0px solid #ccc;
                background-color: #f6f6f6;
            }
            
            /* Style the buttons inside the tab */
            .tab-cus button {
                text-decoration:none;
                color:#2f2f2f;
                background-color: inherit;
                float: left;
                border: none;
                outline: none;
                cursor: pointer;
                padding: 14px 16px;
                transition: 0.3s;
                border-radius: 10px 10px 0px 0px
            }
            
            /* Change background color of buttons on hover */
            .tab-cus button:hover {
                background-color: #fff;
                color:#828282;
            }
            
            /* Create an active/current tablink class */
            .tab-cus button.active {
                background-color: #fff;
                color:#828282
            }
            
            /* Style the tab content */
            .tabcontent-cus {
                display: none;
                padding: 6px 12px;
                border: 2px solid #f6f6f6;
                border-top: none;
                -webkit-animation: fadeEffect 1s;
                animation: fadeEffect 1s;
                background-color: #fff;
                color:#828282;
                border-radius: 0px 0px 10px 10px
            }
            .tabcontent-cus.active {
                display: block;
            }
            
            /* Fade in tabs */
            @-webkit-keyframes fadeEffect {
                from {opacity: 0;}
                to {opacity: 1;}
            }
            @keyframes fadeEffect {
                from {opacity: 0;}
                to {opacity: 1;}
            }
        </style>
        EOT;

        echo $css;
    }

    protected function javascript()
    {
        $js = <<<EOT
        <script>
            function openTabs(evt, idTabs) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent-cus");
                for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks-cus");
                for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(idTabs).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>
        EOT;

        echo $js;
    }

    /**
     * @method render
     */
    public function render()
    {
        $this->active ++;

        $html = "";
        $html .= $this->styles();
        $html .= $this->javascript();
        if(count($this->contents)>0){
            $html .= "<div id='content-list' class='tab-cus'>";
                    foreach($this->contents as $llabel => $vlabel){
                        $uniqId = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $llabel));
                        $active = ($llabel === array_key_first($this->contents) && !array_key_exists('tabs',$_GET))? 'active' : '';                        
                        if(array_key_exists('tabs',$_GET)){
                            $active = ($_GET['tabs'] == $uniqId)? 'active' : 'no';
                        }
                        $html .= "<button class='tablinks-cus {$active} ' onclick='openTabs(event, \"{$uniqId}\")' >{$llabel}</button>";
                    }
            $html .= "</div>";

            $html .= "<div id='tab-content'>";
                foreach($this->contents as $llabel => $vlabel){
                    $uniqId = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "", $llabel));
                    $active = ($llabel === array_key_first($this->contents) && !array_key_exists('tabs',$_GET))? 'active' : '';                  
                    if(array_key_exists('tabs',$_GET)){
                        $active = ($_GET['tabs'] === $uniqId)? 'active' : $active;
                    }
                    $html .= "<div id='".$uniqId."'  class='tabcontent-cus {$active}'>";
                        $html .= $vlabel;
                    $html .= "</div>";
                }
            $html .= "</div>";
        }

        return $html;
    }
    
    public function __destruct() {
        if($this->active < 1){
            echo $this->render();
        }
    }
}