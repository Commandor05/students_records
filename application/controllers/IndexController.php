<?php

/**
 * Class IndexController
 *
 */
class IndexController implements IController
{
    /**
     * @var FrontController  instance
     */
    private $_fc;
    /**
     * @var StudentsDB instance
     */
    private $_db;
    /**
     * @var StudentsModel  - object for students records model
     */
    private $_model;
    /**
     * @var TemplateModel - object for template model
     */
    private $_templete;

    function __construct()
    {
        $this->_fc = FrontController::getInstance();
        $this->_db = StudentsDB::getInstance();
        $this->_model = new StudentsModel();
        $this->_templete = new TemplateModel();
    }


    /**
     *Serve Home page requests
     */
    public function indexAction()
    {
        $this->_model->rec = $this->_db->getRec();
        $content = $this->_model->render(STUD_DEFAULT_FILE);
        $this->_templete->content = $content;
        $output = $this->_templete->render(LAYOUT_FILE);
        $this->_fc->setBody($output);
    }
}
