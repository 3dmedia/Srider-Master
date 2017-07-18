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
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mail;
use Srider\Form\RegisterForm;
use Srider\Form\Filter\RegisterFilter;
use Srider\Utility\UserPassword;
use Srider\Model\Users;
use Srider\Model\UsersTable;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\AuthenticationService;

class RegisterController extends \Zend\Mvc\Controller\AbstractActionController {

    protected $storage;
    protected $authservice;

    public function indexAction() {

        $request = $this->getRequest();

        $view = new ViewModel();
        $registerForm = new RegisterForm('registerForm');
        $registerForm->setInputFilter(new RegisterFilter());

        if ($request->isPost()) {

            $data = $request->getPost();
            $registerForm->setData($data);

            if ($registerForm->isValid()) {
                $data = $registerForm->getData();


                //    if ($result->isValid()) {

                $userPassword = new UserPassword();
                $encyptPass = $userPassword->create($data['password']);

                $newUserData = array(
                    'email' => $data['email'],
                    'password' => $encyptPass,
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'phone' => $data['phone'],
                    'role_id' => 1
                );

                try {
                    $status = $this->setUser($newUserData);
                    if (!empty($status)) {
                        die('Something went wrong. Please try again.');
                    }
                    $this->sendNotificationEmail($newUserData);
                } catch (Exception $e) {
                    die("noooooooo");
                }
//                    $this->flashMessenger()->addMessage(array(
//                        'success' => 'Login Success.'
//                    ));
                // Redirect to page after successful login
                //  } else {
//                    $this->flashMessenger()->addMessage(array(
//                        'error' => 'invalid credentials.'
//                    ));
                // Redirect to page after login failure
                //   }
                //  return $this->redirect()->tourl('/srider');
                // Logic for login authentication
            } else {
                $errors = $registerForm->getMessages();
//                 prx($errors);
            }
        }

        $view->setVariable('registerForm', $registerForm);
        return $view;
    }

    public function sendNotificationEmail($data) {
        $mail = new Mail\Message();
        $mail->setBody('This is the text of the mail.')
                ->setFrom('somebody@example.com', 'Some Sender')
                ->addTo($data['email'], 'Some Recipient')
                ->setSubject('TestSubject');
//        $smtpOptions = new \Zend\Mail\Transport\SmtpOptions();
//        $smtpOptions->setHost('smtp.gmail.com')
//                ->setConnectionClass('login')
//                ->setName('smtp.gmail.com')
//                ->setConnectionConfig(array(
//                    'username' => 'webgurulogix@gmail.com',
//                    'password' => 'Technico!1',
//                    'ssl' => 'tls',
//        ));
        try {
        //   $transport = new Mail\Transport\Sendmail();
         //   $transport->send($mail);
        } catch (Exception $e) {
            die('email not sent.');
        }
    }

    public function setUser($data) {
        $userTable = $this->getServiceLocator()->get("UsersTable");
        $userTable->insert($data);
        $user_id = $userTable->getLastInsertValue();
        //add user role after inserting user
        $newUserRoleData = array(
            'user_id' => $user_id,
            'role_id' => 1,
            'active' => 1
        );
        $userRoleTable = $this->getServiceLocator()->get("UserRoleTable");
        $userRoleTable->insert($newUserRoleData);
    }

//    public function setUserRole($array) {
//        $userTable = $this->getServiceLocator()->get("User_roleTable");
//        $userTable->insert($array);
//    }

    private function getAuthService() {
        if (!$this->authservice) {
            $this->authservice = $this->getServiceLocator()->get('AuthService');
        }
        return $this->authservice;
    }

    public function logoutAction() {
        $session = new Container('Users');
        $session->getManager()->destroy();
        $this->getAuthService()->clearIdentity();
        return $this->redirect()->toUrl('/login');
    }

}
