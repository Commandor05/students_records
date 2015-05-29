<?php

/**
 * Class FrontController
 */
class FrontController
{
    protected $_controller, $_action, $_params, $_body;
    static $_instance;

    /**
     * @return FrontController instance
     */
    public static function getInstance()
    {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    private function __construct()
    {
        $request = $_SERVER['REQUEST_URI'];
        $splits = explode('/', trim($request, '/'));
        //Какой сontroller использовать?
        $this->_controller = !empty($splits[0]) ? ucfirst($splits[0]) . 'Controller' : 'IndexController';
        //Какой action использовать?
        $this->_action = !empty($splits[1]) ? $splits[1] . 'Action' : 'indexAction';
        //Есть ли параметры и их значения?
        if (!empty($splits[2])) {
            $keys = $values = array();
            for ($i = 2, $cnt = count($splits); $i < $cnt; $i++) {
                if ($i % 2 == 0) {
                    //Чётное = ключ (параметр)
                    $keys[] = $splits[$i];
                } else {
                    //Значение параметра;
                    $values[] = $splits[$i];
                }
            }
            $this->_params = array_combine($keys, $values);
        }
    }

    /**
     * Routing
     * @throws Exception generate for non existed controllers and action
     */
    public function route()
    {
        if (class_exists($this->getController())) {
            $rc = new ReflectionClass($this->getController());
            if ($rc->implementsInterface('IController')) {
                if ($rc->hasMethod($this->getAction())) {
                    $controller = $rc->newInstance();
                    $method = $rc->getMethod($this->getAction());
                    $method->invoke($controller);
                } else {
                    throw new Exception("Action");
                }
            } else {
                throw new Exception("Interface");
            }
        } else {
            throw new Exception("Controller");
        }
    }

    /**
     * @return array of params from address line, used for action
     */
    public function getParams()
    {
        return $this->_params;
    }

    /**
     * @return string - controller name
     */
    public function getController()
    {
        return $this->_controller;
    }

    /**
     * @return string - action name
     */
    public function getAction()
    {
        return $this->_action;
    }

    /**
     * @return mixed - get content for view
     */
    public function getBody()
    {
        return $this->_body;
    }

    /**
     * @param $body - content for view
     */
    public function setBody($body)
    {
        $this->_body = $body;
    }
}	