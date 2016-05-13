<?php

class Ks_Auth_Adapter_Db implements Zend_Auth_Adapter_Interface{

    const NOT_FOUND_MESSAGE = "Account not found";
    const BAD_PW_MESSAGE = "Password is invalid";
    const NOT_ACTIVE_MESSAGE = "Account not active";
    const NOT_FOUND = "Podane błędne login lub hasło";
    const WRONG_PW = "Podane błędne hasło";
    const NOT_ACTIVATE = "Użytkownik nieaktywny";

    private $username;
    private $password;
    private $options;

    /**
     *
     * @var Users
     */
    public $user;

    public function __construct($username, $password, $options)
    {
        $this->username = $username;
        $this->password = $password;

        $this->options = $options;
    }

    /**
     * @var UsersQuery $queryClass
     * @return Zend_Auth_Result
     */


    public function authenticate()
    {

            $queryClass = $this->options . 'Query';
            $this->user = UsersQuery::create()
                ->condition('cond1', $this->options . '.login = ?', $this->username)
                ->condition('cond2', $this->options . '.password = ?', $this->password)
                ->where(array('cond1','cond2'), 'and')
                ->findOne();

            if($this->user) {
                $result =  $this->result(Zend_Auth_Result::SUCCESS);
            }
            else{
                $result = $this->result(Zend_Auth_Result::FAILURE);
            }

        return $this->result($result);
    }

    /**
     * Factory for Zend_Auth_Result
     *
     * @param integer $code   The Result code, see Zend_Auth_Result
     * @param mixed $messages     The Message, can be a string or array
     * @return Zend_Auth_Result
     */
    private function result($code, $messages = array())
    {
        if (!is_array($messages)) {
            $messages = array($messages);
        }

        return new Zend_Auth_Result(
            $code,
            $this->user,
            $messages
        );
    }
}