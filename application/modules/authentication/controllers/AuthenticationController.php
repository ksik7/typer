<?php

class Authentication_AuthenticationController extends Zend_Controller_Action{

    public function loginAction()
    {
        $request = $this->getRequest();
        $form = new Authentication_Form_LoginForm();

        $this->view->assign('loginForm', $form);


    }

}