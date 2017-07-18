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

class IndexController extends AbstractActionController
{
    public function __construct(){}     
     
    public function indexAction()
    { 
        #@TODO
        $request = $this->getRequest();
        $bookForm = 'tralala';
        $view = new ViewModel();

        $view->setVariable('bookForm', $bookForm);
        return $view;
    }
    
    public function signupAction()
    { 
        #@TODO
        $request = $this->getRequest();
        $bookForm = 'tralala';
        $view = new ViewModel();

        $view->setVariable('bookForm', $bookForm);
        return $view;
    }
    
     
    
}