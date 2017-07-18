<?php

/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Srider\Navigation;

use Zend\Navigation\Service\DefaultNavigationFactory;

class NavigationFactory extends DefaultNavigationFactory
{
    /**
     * @return string
     */
    protected function getName()
    {
        return 'navigation-left';
    }
}