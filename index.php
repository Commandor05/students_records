<?php
/**
 * Default paths for files search
 */
set_include_path(get_include_path()
    . PATH_SEPARATOR . 'application/controllers'
    . PATH_SEPARATOR . 'application/models'
    . PATH_SEPARATOR . 'application/views'
    . PATH_SEPARATOR . 'application/views/layouts');

/* Files names for: views */
define('STUD_DEFAULT_FILE', 'student_default.php');
define('STUD_EDIT_FILE', 'student_edit.php');
define('STUD_LIST_FILE', 'student_list.php');
define('STUD_ADD_FILE', 'student_add.php');
define('LAYOUT_FILE', 'layout.php');

/**
 * Path to DB
 */
define('STD_DB', $_SERVER["DOCUMENT_ROOT"] . '/data/students.db');

define('BOOTSTRAP_DIR', $_SERVER["DOCUMENT_ROOT"] . '/application/views/layouts/');

/**
 * Classes autoloader
 * @param string $class -class name
 */
function __autoload($class)
{
    require_once($class . '.php');
}

/* Initialise and start FrontController */
$front = FrontController::getInstance();
$front->route();

/* Data output */
echo $front->getBody();