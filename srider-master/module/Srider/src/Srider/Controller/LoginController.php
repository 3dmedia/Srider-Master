<?php

/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Srider\Controller;
 
use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Srider\Form\LoginForm;
use Srider\Form\Filter\LoginFilter;
use Srider\Utility\UserPassword;

use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\AuthenticationService;

class LoginController extends \Zend\Mvc\Controller\AbstractActionController {

    protected $storage;
    protected $authservice;

    public function indexAction(){       

        $request = $this->getRequest();

        $view = new ViewModel();
        $loginForm = new LoginForm('loginForm');       
        $loginForm->setInputFilter(new LoginFilter() );

        if ($request->isPost()) {
            
            $data = $request->getPost();
            $loginForm->setData($data);

            if ($loginForm->isValid()) {
                $data = $loginForm->getData();
           
                $userPassword = new UserPassword();
                $encyptPass = $userPassword->create($data['password']);
                $authService = $this->getServiceLocator()->get('AuthService');
          
                $authService->getAdapter()
                    ->setIdentity($data['email'])
                    ->setCredential($encyptPass);

                $result = $authService->authenticate();
  
                if ($result->isValid()) {

                    $userDetails = $this->_getUserDetails(array(
                        'email' => $data['email']
                    ), array(
                        'id',
                        'first_name',
                        'last_name',
                        'image',                        
                    ));

                    $session = new Container('Users');
                    $session->offsetSet('email', $data['email']);
                    $session->offsetSet('userId', $userDetails[0]['id']);
                    $session->offsetSet('roleId', $userDetails[0]['role_id']);
                    $session->offsetSet('roleName', $userDetails[0]['role_name']);
                    $session->offsetSet('userName', $userDetails[0]['first_name']. ' ' . $userDetails[0]['last_name']);
                    $session->offsetSet('userPicture', $userDetails[0]['image']) ;
 
//                    $this->flashMessenger()->addMessage(array(
//                        'success' => 'Login Success.'
//                    ));
                    // Redirect to page after successful login
                } else {
//                    $this->flashMessenger()->addMessage(array(
//                        'error' => 'invalid credentials.'
//                    ));
                    // Redirect to page after login failure
                }
                return $this->redirect()->tourl('/srider');
                // Logic for login authentication
            } else {
                $errors = $loginForm->getMessages();
//                 prx($errors);
            }
        }

        $view->setVariable('loginForm', $loginForm);
        return $view;
    }

    private function _getUserDetails($where, $columns)
    {
        $userTable = $this->getServiceLocator()->get("UsersTable");
        $users = $userTable->getUsers($where, $columns);
        return $users;
    }

    private function getAuthService()
    {
        if (!$this->authservice) {
                $this->authservice = $this->getServiceLocator()->get('AuthService');
        }
        return $this->authservice;
    }

    public function logoutAction(){
        $session = new Container('Users');
        $session->getManager()->destroy();
        $this->getAuthService()->clearIdentity();
        return $this->redirect()->toUrl('/login');
    }
}