<?php

class Authentication_Form_LoginForm extends Zend_Form{

    public function __construct($option = null)
    {
        parent::__construct();

        $this->setName('loginForm');

        $login = new Zend_Form_Element_Text('login');
        $login->setLabel('Login:')
            ->setRequired(true);

        $password = new Zend_Form_Element_Text('password');
        $password->setLabel('Hasło:')
            ->setRequired(true);
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Zaloguj');
        
        $this->addElements(array($login, $password, $submit));
        $this->setMethod('post');
        $this->setAction('/authentication/authentication/login');

    }

}