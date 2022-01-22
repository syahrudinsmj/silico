<?php
namespace App\Components;

class Card
{
    protected int $active = 0;

    protected array $contents = [];

    protected string $title = "";

    protected string $description = "";

    protected $body;

    protected $footer;

    /**
     * @method setTitle
     * @var string $title
     */
    public function setTitle($title = "")
    {
        $this->title = $title;
    }

    /**
     * @method setDescription
     * @var string $description
     */
    public function setDescription($description = "")
    {
        $this->description = $description;
    }

    /**
     * @method setBody
     */
    public function setBody(\Closure $callback = null){
        if ($callback instanceof \Closure) {
            $this->body = $callback($this);
        }
    }

    /**
     * @method setFooter
     */
    public function setFooter(\Closure $callback = null)
    {
        if ($callback instanceof \Closure) {
            $this->footer = $callback($this);
        }
    }

    
    protected function styles()
    {
        $css = <<<EOT
        <style>
            #card-custom {
                display:inline-block;
                width:98.5%;
                border:1px solid #e4e4e4;
                padding:10px;
                border-radius:10px 10px;
            }
            #card-custom .header{
                display:inline-block;
                width:100%;
                border-bottom:1px solid #e4e4e4;
                padding-top:6px;
                padding-bottom:12px;
            }
            #card-custom .header .title-cus{
                color : #3d3d3d;
                margin:0px;
                // padding:10px 0px 10px 0px;
            }
            #card-custom .header .description-cus{
                margin-left:4px;
                color: #c9c9c9
            }
            #card-custom .body{
                display:block;
                padding-top:4px;
            }
            #card-custom .footer{
                display:block;
                padding-top:4px;
            }
        </style>
        EOT;

        echo $css;
    }
    
    /**
     * @method render
     */
    protected function render()
    {
        $this->active ++;

        $html = "";
        $html .= $this->styles();

        $html .= "<div id='card-custom'>";
            // header
            $html .= "<div class='header'>";
                $html .= "<h4 class='title-cus'>{$this->title}<small class='description-cus'>{$this->description}</small></h4>";
            $html .= "</div>";
            // body
            $html .= "<div class='body'>";
                $html .= $this->body;
            $html .= "</div>";
            // footer
            $html .= "<div class='footer'>";
                $html .= $this->footer;
            $html .= "</div>";

        $html .= "</div>";

        return $html;
    }
    
    public function __destruct() {
        if($this->active < 1){
            echo $this->render();
        }
    }
}