<?php

/**
 * Class StudentsController
 *
 */
class StudentsController implements IController
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
     * Serve requests for students list
     */
    function listAction()
    {
        $this->_model->rec = $this->_db->getRec();
        $content = $this->_model->render(STUD_LIST_FILE);
        $this->_templete->content = $content;
        $output = $this->_templete->render(LAYOUT_FILE);
        $this->_fc->setBody($output);
    }

    /**
     * Use for serve edit form requests
     */
    function editAction()
    {
        $params = $this->_fc->getParams();
        $id = $params['id'];
        $this->_model->row = $this->_db->getRow($id);
        $content = $this->_model->render(STUD_EDIT_FILE);
        $this->_templete->content = $content;
        $output = $this->_templete->render(LAYOUT_FILE);
        $this->_fc->setBody($output);
    }

    /**
     * Use for serve add form requests
     */
    function addAction()
    {
        $content = $this->_model->render(STUD_ADD_FILE);
        $this->_templete->content = $content;
        $output = $this->_templete->render(LAYOUT_FILE);
        $this->_fc->setBody($output);
    }

    /**
     * Use for save record requests
     */
    function saveAction()
    {
        $params = $this->_fc->getParams();
        $name = $this->_db->clearData($params['name']);
        $lastName = $this->_db->clearData($params['lastName']);
        $gender = $this->_db->clearData($params['gender']);
        $age = $this->_db->clearData((int)$params['age']);
        $faculty = $this->_db->clearData((int)$params['faculty']);
        $this->_model->row = $this->_db->saveRec($name, $lastName, $gender, $age, $faculty);
        header('Location:/students/list');
    }

    /**
     * Use for update edited record requests
     */
    function updateAction()
    {
        $params = $this->_fc->getParams();
        $id = $this->_db->clearData((int)$params['id']);
        $name = $this->_db->clearData($params['name']);
        $lastName = $this->_db->clearData($params['lastName']);
        $gender = $this->_db->clearData($params['gender']);
        $age = $this->_db->clearData((int)$params['age']);
        $faculty = $this->_db->clearData((int)$params['faculty']);
        $this->_model->row = $this->_db->updateRec($id, $name, $lastName, $gender, $age, $faculty);
        header('Location:/students/list');
    }

    /**
     * Serve delete record requests
     */
    function delAction()
    {
        $params = $this->_fc->getParams();
        $id = $params['id'];
        $this->_db->deleteRec($id);
        header('Location:/students/list');
    }
}