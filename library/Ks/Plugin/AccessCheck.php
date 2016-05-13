<?php


class Ks_Plugin_AccessCheck extends Zend_Controller_Plugin_Abstract
{

    private $_acl = null;

    public function __construct(Zend_Acl $acl)
    {
        $this->_acl = $acl;
    }

    /**
     * @param Zend_Controller_Request_Abstract $request
     *
     */

    public function preDispatch(Zend_Controller_Request_Abstract $request) {

        $module = $request->getModuleName();
        $controller = $request->getControllerName();
        $action = $request->getActionName();
        $resource = "{$module}-{$controller}";


        if($this->_acl->has($resource)) {
            if (!$this->_acl->isAllowed(Zend_Registry::get('role'), $resource, $action)) {
                $request->setModuleName('auth')
                    ->setControllerName('auth')
                    ->setActionName('login');
            }
        }
    }
}