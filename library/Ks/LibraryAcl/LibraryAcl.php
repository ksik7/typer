<?php

class Ks_LibraryAcl_LibraryAcl extends Zend_Acl{

    public function __construct()
    {
        $this->addResource(new Zend_Acl_Resource('default-index'));

        $this->addResource(new Zend_Acl_Resource('test-product'));
        $this->addResource(new Zend_Acl_Resource('auth-auth'));

        $this->addRole(new Zend_Acl_Role('guest'));
        $this->addRole(new Zend_Acl_Role('user'),'guest');
        $this->addRole(new Zend_Acl_Role('admin'), 'user');

        $this->allow('guest', 'auth-auth', 'login');
        $this->deny('user', 'auth-auth', 'login');
        $this->allow('user', 'default-index', array('index','list','error'));
        $this->allow('user', 'auth-auth', array('logout'));
        $this->allow('admin', 'test-product', 'index');
    }

}