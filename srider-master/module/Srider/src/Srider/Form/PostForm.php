<?php

/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

 namespace Srider\Form;

 use Zend\Form\Form;

 class PostForm extends Form
 {
     public function __construct()
     {
         $this->add(array(
             'name' => 'post-fieldset',
             'type' => 'Srider\Form\PostFieldset'
         ));

         $this->add(array(
             'type' => 'submit',
             'name' => 'submit',
             'attributes' => array(
                 'value' => 'Insert new Observation'
             )
         ));
     }
 }