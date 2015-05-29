<?php

class StudentsModel
{

    public $rec = array();
    public $row = array();
    public $id = 0;

    public function render($file)
    {
        /* $file - текущее представление */
        ob_start();
        include($file);
        return ob_get_clean();
    }
}