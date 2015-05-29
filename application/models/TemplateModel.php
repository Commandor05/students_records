<?php

class TemplateModel
{

    public $content = '';

    public function render($file)
    {
        /* $file - текущее представление */
        ob_start();
        include($file);
        return ob_get_clean();
    }
}