<?php

/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Srider\Form\Filter;

use Zend\InputFilter\InputFilter;

class BookFilter extends InputFilter {

    public function __construct(){
        
        $isEmpty = \Zend\Validator\NotEmpty::IS_EMPTY;
        $invalidEmail = \Zend\Validator\EmailAddress::INVALID_FORMAT;
        
        $this->add(array(
            'name' => 'pick_up_location',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            $isEmpty => 'Pick-up place can not be empty.'
                        )
                    ),
                    'break_chain_on_failure' => true
                ),
//                array(
//                    'name' => 'EmailAddress',
//                    'options' => array(
//                        'messages' => array(
//                            $invalidEmail => 'Please enter a valid email address.'
//                        )
//                    )
//                )
            ),
        ));
       
    }
}