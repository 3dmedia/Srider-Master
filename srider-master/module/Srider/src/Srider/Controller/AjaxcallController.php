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

class AjaxcallController extends AbstractActionController
{
    
    public function indexAction()
    {
        die('AJAX');
        return new ViewModel(array(
            'exports' => 'exports content',
        ));
        
        
    }
    public function checkUserAction()
    {
//        $request = $this->getRequest();
        
//        if($request->isPost()) {
            # Helpers
            $viewHelperManager = $this->getServiceLocator()->get('ViewHelperManager');
            $escapeHtml = $viewHelperManager->get('escapeHtml');
            
//            $post = $request->getPost();
             
            # Observations    
//            if($post['query']){
            $q = $escapeHtml(trim(strip_tags($this->params()->fromQuery('query'))));
            if(!empty($q)){
                $usersData = $this->_getUserDetails(array(
                            'search'      => $q,
                        ), array(
                            'id',
                            'first_name',
                            'last_name',
                            'telephone',                        
                            'picture',                        
                            'role_id',                        
                            'email',                        
                            'address',                        
                        ));
//                echo '<br> Obs: '; print_rt($userDetails); 
    //            $user = $this->getUsersTbl()->getUsers(['first_name' => $q]);
    //            $users = $this->getUsersTbl();
    //            echo '<br> aaa: '; print_rt($This->users);
    //            $users = $this->getUsersTbl()->getUsers(['first_name' => $q], array());
                $viewModel = new ViewModel();
                $viewModel->setVariables(array('users' => $usersData))
                          ->setTerminal(true);

                return $viewModel;
//                return $this->response;
            }
//            }
//        }
 
    }
    
    private function _getUserDetails($where, $columns)
    {
        $session  = new Container('User');
        $clinicId = null;  
        if ($session->offsetExists ('clinicId')) {       
            $clinicId = $session->offsetGet('clinicId');
        }
                
        $userTable = $this->getServiceLocator()->get("Users");
        $users = $userTable->getAjaxUsers($where, $columns, $clinicId);
        return $users;
    }
    
    public function fillUserAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setVariables(array('key' => 'value'))
                  ->setTerminal(true);

        return $viewModel;
    }
}