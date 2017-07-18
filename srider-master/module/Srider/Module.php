<?php

/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Srider;

use Srider\Model\Srider;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\Adapter\DbTable as DbAuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Session\Container;

use Srider\Model\Permissions;
use Srider\Model\ResourceTable;
use Srider\Model\RolePermissions;
use Srider\Utility\Acl;
use Srider\Model\Role;
use Srider\Model\UserRoles;
use Srider\Model\Users;
use Srider\Model\UsersTable;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        ini_set('date.timezone', 'Europe/Bucharest'); # TODO: Change timezone for other countries
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $serviceManager = $e->getApplication()->getServiceManager();

        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'boforeDispatch'), 100);
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'afterDispatch'), -100);
        
        // Just a call to the translator, nothing special!
        $serviceManager->get('translator');
        $this->initTranslator($e);
    }
    
    protected function initTranslator(MvcEvent $event)
    {
        $serviceManager = $event->getApplication()->getServiceManager();

        // use Zend\Session\Container add this to top
        $session = New Container('language');

        $translator = $serviceManager->get('translator');
        if($session['language'] != 'zh_CN'){ //if session doesn't have zh_CN then set it as english
        $translator
            ->setLocale($session->language)
            ->setFallbackLocale('en_US')
            ;
        }
    }
    
    function boforeDispatch(MvcEvent $event){
        $request  = $event->getRequest();
        $response = $event->getResponse();
        $target   = $event->getTarget();

        #  Offline pages don't needed authentication  
        $whiteList = array (
            'Srider\Controller\Srider-index',
            'Srider\Controller\Login-index' ,
            'Srider\Controller\Login-logout',
            'Srider\Controller\Index-index',
            'Srider\Controller\Index-signup',
        );
        
        $requestUri = $request->getRequestUri();
        $controller = $event->getRouteMatch()->getParam('controller');
        $action     = $event->getRouteMatch()->getParam('action');
        
        $requestedResourse = $controller . "-" . $action;
        
        $session = new Container('Users');
       

        if ($session->offsetExists ('email')) {       
            if ($requestedResourse == 'Srider\Controller\Login-index' || in_array ( $requestedResourse, $whiteList )) {
                $url = '/index';
                $response->setHeaders ($response->getHeaders()->addHeaderLine('Location', $url));
                $response->setStatusCode ( 302 );
            }else{
                $serviceManager = $event->getApplication()->getServiceManager();
                $userRole = $session->offsetGet('roleName');
                
                $acl = $serviceManager->get('Acl');
                $acl->initAcl();
//                unset($session);
                $status = $acl->isAccessAllowed($userRole, $controller, $action);
//                echo '<pre>';
//                echo ' acl '; print_r($status); echo ' <br/> ';
//                echo ' UID exists: '; print_r($session->offsetGet ('userName')); echo ' <br/> ';
//                echo ' Email exists: '; print_r($session->offsetGet ('email')); echo ' <br/> ';
//                echo ' $requestedResourse: '; print_r($requestedResourse); echo ' <br/> ';
//                echo ' $userRole: '; print_r($userRole); echo ' <br/> ';
//                echo ' $controller: '; print_r($controller); echo ' <br/> ';
//                echo ' $action: '; print_r($action); 
//                die('...');

                if (!$status) {
                    die('Permission denied!');
                }
                
            }		
        }else{
            if ($requestedResourse != 'Srider\Controller\Login-index' && ! in_array ( $requestedResourse, $whiteList )) {
                $url = '/404';                
                $response->setHeaders ( $response->getHeaders ()->addHeaderLine ( 'Location', $url ) );
                $response->setStatusCode ( 302 ); 
            }
            $response->sendHeaders ();
        }
    }

    function afterDispatch(MvcEvent $event){
    }


    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return array(            
            'factories' => array(
                # Acl the shit!
                'Acl' => function ($serviceManager) {
                        return new Acl();
                },
                'UsersTable' => function ($serviceManager) {
                        return new UsersTable( $serviceManager->get('Zend\Db\Adapter\Adapter') );
                },
                'Role' => function ($serviceManager) {
                        return new Role( $serviceManager->get('Zend\Db\Adapter\Adapter') );
                },
                'UserRoles' => function ($serviceManager) {
                        return new UserRoles( $serviceManager->get('Zend\Db\Adapter\Adapter') );
                },
                'Permissions' => function ($serviceManager) {
                        return new Permissions( $serviceManager->get('Zend\Db\Adapter\Adapter') );
                },
                'ResourceTable' => function ($serviceManager) {
                        return new ResourceTable( $serviceManager->get('Zend\Db\Adapter\Adapter'));
                },
                'RolePermissions' => function ($serviceManager) {
                        return new RolePermissions($serviceManager->get('Zend\Db\Adapter\Adapter') );
                },
                'AuthService' => function ($serviceManager) {
                    $adapter = $serviceManager->get('Zend\Db\Adapter\Adapter');
                    $dbAuthAdapter = new DbAuthAdapter ( $adapter, 'users', 'email', 'password' );

                    $auth = new AuthenticationService();
                    $auth->setAdapter ( $dbAuthAdapter );
                    return $auth;
                }
            ),
        );
    }
}
