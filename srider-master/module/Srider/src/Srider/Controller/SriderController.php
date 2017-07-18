<?php

/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Srider\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel; 
use Srider\Model\Users;          
use Zend\Session\Container;
use Zend\Form\Element;
use Srider\Utility\UserPassword;
use Srider\Form\BookForm;
use Srider\Form\Filter\BookFilter;

class SriderController extends AbstractActionController
{
//    public function __construct(){}     
     
    public function indexAction()
    { 
        $request = $this->getRequest();

        $view = new ViewModel();
        $bookForm = new BookForm('bookForm');       
        $bookForm->setInputFilter(new BookFilter() );
echo 'in'; 
        if ($request->isPost()) { 
            $data = $request->getPost();
            $bookForm->setData($data);

            if ($bookForm->isValid()) {
                $data = $bookForm->getData();

                print_rt($data);
die('...');
//                return $this->redirect()->tourl('/srider');
                // Logic for $bookForm authentication
            } else {
                $errors = $bookForm->getMessages();
                // prx($errors);
            }
        }

        $view->setVariable('bookForm', $bookForm);
        return $view;
    }
    
    public function addAction()
    { 
        echo 'ADD'; die('...');
        return new ViewModel(array());
    }
    
    public function changeLocaleChineseAction()
    {
        $result = new ViewModel();
        $result->setTerminal(true);
        $response = $this->getResponse();

        // New Container will get he Language Session if the SessionManager already knows the language session.
        $session = new Container('language');
        $request = $this->getRequest();
        $config = $this->serviceLocator->get('config');

        $language = $config['translator']['locale']; //default locale from Application/config/module.config.php
        if (isset($config['translator']['locale'])) {
            $session->language = $language;
            $this->serviceLocator->get('translator')->setLocale('zh_CN')
                ->setFallbackLocale('zh_CN')
                ;

        }

        return $this->redirect()->toRoute('home'); 

    }

    public function changeLocaleEnglishAction()
    {
        // New Container will get he Language Session if the SessionManager already knows the language session.
        $session = new Container('language');

        //just clear the language session
        $session->getManager()->getStorage()->clear('language');
        $language = 'en_US'; //set new language
        $request = $this->getRequest();
        $config = $this->serviceLocator->get('config');
        $session->language = $language;
        $this->serviceLocator->get('translator')->setLocale('en_US')
            ->setFallbackLocale('en_US')
            ;
        return $this->redirect()->toRoute('home');

    }
    
    
}