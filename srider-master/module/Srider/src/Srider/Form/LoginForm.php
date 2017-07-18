<?php

/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Srider\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\Element\Csrf;

class LoginForm extends Form {

    public function __construct($name) {
        
        parent::__construct($name);
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'email',
            'type' => 'text',
            'required' => true,
            'options' => array(
                'label' => 'Email',
                'id' => 'email',
                'class' => 'form-control input-lg',             
//                'maxlength' => '100'             
            ),
            'attributes' => array(
                'type' => 'text',
                'id'   => 'email',
                'class' => 'form-control input-lg',
                'required' => 'required',
                'placeholder' => 'Email',
                'maxlength' => '100',
            ),
        ));

       $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'required' => true,
            'options' => array(
                'label' => 'Password',
                'id' => 'password',
                'placeholder' => 'Password',
                'class' => 'form-control'      
            ),
            'attributes' => array(
                'type' => 'password',
                'id'   => 'password',
                'class' => 'form-control input-lg',
                'required' => 'required',
                'placeholder' => 'Password',
                'maxlength' => '60',
            ),
       ));
       
       $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'loginCsrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 3600
                )
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Submit',
                'id'   => 'btn-signup',
                'class' => 'btn btn-block btn-primary btn-lg',
            ),
        ));
    }
}