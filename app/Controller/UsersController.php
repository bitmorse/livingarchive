<?php

class UsersController extends AppController {
    
    public $components = array(
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'authError' => 'Did you really think you are allowed to see that?'
        )
    );

    public function beforeFilter(){
        //which actions are public (dont require login)?
        $this->Auth->allow(array('register', 'login'));
    }


    public function register(){
        
    }

    public function login(){

    }

    public function dashboard(){

    }


    

}