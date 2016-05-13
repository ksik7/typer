<?php

class League_LeagueController extends Zend_Controller_Action{


    public function init()
    {
        $contextSwitch = $this->_helper->getHelper('contextSwitch');
        $contextSwitch->addActionContext('details','json')
            ->initContext();
    }
    public function indexAction()
    {

    }

    public function listAction()
    {
        $leagues = LeaguesQuery::create()->find();
        
        $this->view->assign('leagues', $leagues);
    }

    public function createAction()
    {
        $user = UsersQuery::create()->find()->toArray('id');

        foreach($user as $value){
            $result[$value['Id']] = $value['Login'];
        }

        
        $form = new League_Form_CreateForm();
        $element = $form->getElement('user');
        $element->setMultiOptions($result);

        $league = new Leagues();

        $request = $this->getRequest();

        if($request->isPost()){

            if($form->isValid($this->_request->getPost())){

                $league->setName($form->getValue('name'));
                $league->setUserId($form->getValue('user'));
                $league->save();
                $this->redirect('/league/league/list');

            }
        }

        $this->view->assign('form', $form);



    }

    public function editAction()
    {

    }

    public function addUserToLeagueAction()
    {
        
    }

    public function addMatchToLeagueAction()
    {
        $request = $this->getRequest();

        $id = $request->getParam('id');
    }

    public function detailsAction()
    {
        $request = $this->getRequest();
        if(!$this->_request->isXmlHttpRequest()){
            $this->view->assign('test', $request->getParam('id'));
        }else{
            $id = $request->getParam('id');

            $data = DataLeagueQuery::create()
                ->joinWith('DataLeague.Matches')
                ->joinWith('DataLeague.Leagues')
                ->where('Leagues.id = ?', $id)
                ->find();

            $league = LeaguesQuery::create()->joinUsers()->withColumn('Users.login')->findPk($id);

            $this->view->assign('ajax', $data->toJSON(true));
        }
    }
}