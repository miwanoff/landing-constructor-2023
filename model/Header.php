<?php

class Header extends Block
{

    private $landing_header;
    private $logo_img;

    public function __construct($landing_header = "Header", $logo_img = "")
    {
        $this->landing_header = $landing_header;
        $this->logo_img = $logo_img;
    }

    public function draw()
    {
        if ($this->logo_img) {
            $img = "<img src=\"{$this->logo_img}\" alt=\"logo\" class=\"logo\"/>";
        } else {
            $img = "";
        }

        $str = <<<EOD
    <!-------------Блок "Header"-------------------------->
    <div class='header'>
        {$img}
        <h1>{$this->landing_header} </h1>
    </div>
    <!-------------Конец блока "Header"-------------------->\n
EOD;
        return $str;
    }

}