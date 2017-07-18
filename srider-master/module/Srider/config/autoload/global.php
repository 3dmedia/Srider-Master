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
        'service_manager' => array(
            'factories' => array(
            'Zend\Db\Adapter\Adapter' => function ($serviceManager) {
                    $adapterFactory = new Zend\Db\Adapter\AdapterServiceFactory();
                    $adapter = $adapterFactory->createService($serviceManager);
                    \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($adapter);
                    return $adapter;
                }
            ),
        ),
                    
); 