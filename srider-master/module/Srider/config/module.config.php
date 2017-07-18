<?php

/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

return array(
    'db' => array(
        'driver'         => 'Pdo',
        'username'       => 'root',  
        'password'       => '',   
        'dsn'            => 'mysql:dbname=srider_schema;host=localhost',
        'driver_options' => array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Srider\Controller\Index'        => 'Srider\Controller\IndexController',
            'Srider\Controller\Srider'       => 'Srider\Controller\SriderController',
            'Srider\Controller\Login'        => 'Srider\Controller\LoginController',
            'Srider\Controller\Ajaxcall'     => 'Srider\Controller\AjaxcallController'
        ),
        'factories' => array(
//            'Srider\Controller\List' => 'Srider\Factory\ListControllerFactory',
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'Srider\Mapper\PostMapperInterface'   => 'Srider\Factory\ZendDbSqlMapperFactory',
            'Srider\Service\PostServiceInterface' => 'Srider\Factory\PostServiceFactory',
            'Zend\Db\Adapter\Adapter'         => 'Zend\Db\Adapter\AdapterServiceFactory',
            'navigation'                      => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'navigation-left'                 => 'Srider\Navigation\NavigationFactory'
        )
    ),   
    
    'router' => array(
        'routes' => array(
            'index' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/index[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Srider\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            'signup' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/sign-up',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Srider\Controller\Index',
                        'action'     => 'signup',
                    ),
                ),
            ),
            'srider' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/srider[/:action][/:id]',
                    'constraints' => array(
//                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action' => '(add|edit|delete)',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Srider\Controller\Srider',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array( 
                            'route'    => '/[:controller[/:action]]',
                        ),
                    ),
                ),
            ),
            
            'login' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/login',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Srider\Controller',
                        'controller' => 'Login',
                        'action' => 'index'
                    )
                )
            ),
            'logout' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Srider\Controller',
                        'controller' => 'Login',
                        'action' => 'logout'
                    )
                )
            ),
            'ajaxcall' => array(
                 'type'    => 'segment',
                 'options' => array(
                    'route'    => '/ajaxcall[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'action' => '(add|edit|delete)',
//                        'id'     => '[0-9]+',
                        'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Vm\Controller',
                        'controller' => 'Ajaxcall',
                        'action'     => 'index',
                    ),
                ),
//                'may_terminate' => true,
//                'child_routes' => array(
//                    'default' => array(
//                        'type'    => 'Segment',
//                        'options' => array(
//                            'route'    => '/[:controller[/:action]]',
//                        ),
//                    ),
//                ),
            ),
            'language' => array(
                'type' => 'Segment',
                'options' => array(
                    //'route' => '/[:language]',
                    'route' => '/en',
                    'constraints' => array(
                        'language' => 'en',
                    ),
                    'defaults' => array(
                        'controller' => 'Srider\Controller\Srider',
                        'action' => 'changeLocaleEnglish'
                    )
                )
            ),
            'languageChinese' => array(
                'type' => 'Segment',
                'options' => array(
                    //'route' => '/[:language]',
                    'route' => '/cn',
                    'constraints' => array(
                        'language' => 'cn',
                    ),
                    'defaults' => array(
                        'controller' => 'Srider\Controller\Srider',
                        'action' => 'changeLocaleChinese'
                    )
                )
            ),
        ),       
    ),
    'translator' => array(
        'locale' => 'ro_RO', //default is english which is set in module.php
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => '<i class="fa fa-user"></i><span>Profile</span>',
                'route' => 'home',
            ),
            array(
                'label' => '<i class="fa fa-envelope"></i><span>Messages</span>',
                'route' => 'srider',
            ),
            array(
                'label' => '<i class="fa fa-picture-o"></i><span>Albums</span>',
                'route' => 'srider',
            ),
            array(
                'label' => '<i class="fa fa-tasks"></i><span>Tasks</span>',
                'route' => 'srider',
            ),
            array(
                'label' => '<i class="fa fa-cog"></i><span>Settings</span>',
                'route' => 'srider',
            ),
            array(
                'label' => '<i class="fa fa-power-off"></i><span>Logout</span>',
                'route' => 'logout',
            ),
        ),
        'navigation-left' => array(
            array(
                'label' => '<i class="fa fa-dashboard"></i><span class="hidden-xs">Dashboard</span>',
                'route' => 'home',
            ),
            array(
                'label' => '<i class="fa fa-bar-chart-o"></i><span class="hidden-xs">Patients</span>',
                'route' => 'reports',
                'pages' => array(
                    array(
                        'label' => 'Insert patient',
                        'route' => 'srider',
                        'action' => 'add',
                    ),
                    array(
                        'label' => 'Edit',
                        'route' => 'srider',
                        'action' => 'edit',
                    ),
                    array(
                        'label' => 'Delete',
                        'route' => 'srider',
                        'action' => 'delete',
                    ),
                ),
            ),
            array(
                'label' => '<i class="fa fa-line-chart fa-4x full-width"></i> Analytics',
                'route' => 'analytics',
            ),
            array(
                'label' => '<i class="fa fa-file-code-o fa-4x full-width"></i> Exports',
                'route' => 'exports',
            ),
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
//            'srider/srider/index' => __DIR__ . '/../view/srider/srider//index.phtml'
            'srider/index/index' => __DIR__ . '/../view/srider/index//index.phtml'
        ),
        'template_path_stack' => array(
             __DIR__ . '/../view',
         ),
        # Json strategy for ajax calls
        'strategies' => array (           
            'ViewJsonStrategy'  
         )
    ),
);