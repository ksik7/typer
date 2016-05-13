<?php

class League_Form_CreateForm extends Zend_Form{

    public function __construct($option = null)
    {
        parent::__construct($option);

        $this->setName('CreateLeague');

        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Nazwa ligii:')
            ->setRequired();

        $user = new Zend_Form_Element_Select('user');

        $user->setLabel('Użytkownik')
            ->setRequired();

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Stwórz');

        $this->addElements(array($name, $user, $submit));
        $this->setMethod('post');
        $this->setAction('/league/league/create');

    }
}