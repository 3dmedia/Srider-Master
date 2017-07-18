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

class BookForm extends Form {

    public function __construct($name) {
        
        parent::__construct($name);
        $this->setAttribute('method', 'post');
 
        $this->add(array(
            'name' => 'pick_up_location',
            'type' => 'text',
            'required' => true,
            'options' => array(
                'id' => 'origin-input',
                'class' => 'form-control home-textbox',         
                'placeholder' => 'Type your pickup location',
//                'onfocus' => 'geolocate()'
            ),
            'attributes' => array(
                'type' => 'text',
                'id'   => 'origin-input',
                'class' => 'form-control home-textbox autocomplete controls',
                'required' => 'required',
                'placeholder' => 'Type your pickup location',
                'maxlength' => '200',
            ),
        ));
//        $this->get('pick_up_location')->setAttributes(array(
//            'onfocus' => 'geolocate()',
//        ));
        
        $this->add(array(
            'name' => 'pick_up_date',
            'type' => 'text',
            'required' => true,
            'options' => array(
                'id' => 'pick_up_date',
                'class' => 'form-control input_date date-picker',         
                'placeholder' => 'Select pick-up date',
            ),
            'attributes' => array(
                'type' => 'text',
                'id'   => 'pick_up_date',
                'class' => 'form-control date-picker',
                'required' => 'required',
                'placeholder' => 'Select pick-up date',
                'maxlength' => '50',
            ),
        ));
        
        $this->add(array(
            'name' => 'pick_up_time',
            'type' => 'text',
            'required' => true,
            'options' => array(
                'id' => 'pick_up_time',
                'class' => 'form-control input_date time-picker',         
                'placeholder' => 'Select pick-up hour',
            ),
            'attributes' => array(
                'type' => 'text',
                'id'   => 'pick_up_time',
                'class' => 'form-control time-picker',
                'required' => 'required',
                'placeholder' => 'Select pick-up hour',
                'maxlength' => '50',
            ),
        ));
        
        $this->add(array(
            'name' => 'destination_location',
            'type' => 'text',
            'required' => true,
            'options' => array(
                'id' => 'autocomplete_destination',
                'class' => 'form-control time-picker',         
                'placeholder' => 'Select destination location',
            ),
            'attributes' => array(
                'type' => 'text',
                'id'   => 'destination-input',
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Select destination location controls',
                'maxlength' => '200',
            ),
        )); 
//        $decorator_chain = null;
//        $this->add(array(
//            'type' => 'Zend\Form\Element\Radio',
//            'name' => 'type',
//            'options' => array(
////                'label' => 'AAAAA',
//                'value_options' => array(
//                    array(
//                        'value' => false,
//                        'attributes' => array(
//                            'id' => 'changemode-walking',
//                        ),
////                        'label' => 'Walking',
//                        'selected' => false,
//                    ),
//                    array(
//                        'value' => false,
//                        'attributes' => array(
//                            'id' => 'changemode-transit',
//                        ),
////                        'label' => 'Transit',
//                        'selected' => false,
//                    ),
//                    array(
//                        'value' => false,
//                        'attributes' => array(
//                            'id' => 'changemode-driving',
//                        ),
////                        'label' => 'Driving',
////                        'label' => 0,
//                        'selected' => true,
//                    ),
//                ),
//            ),
//        ));
//        $this->get('type')->remove('Label');

//        $elementDd = $this->get('type');  
//        print_rt($elementDd->clearLabelOptions()); die('...');
//        $elementDd->clearLabelOptions();
//        $element->removeLabelOptions([
//            'label' => 'AAAAA'
//        ]);

        $this->add(array(
            'name' => 'submit_booking',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Book now',
                'data-toggle' => 'modal',
                'data-target' => '#complete-dialog',
                'id'   => 'submit_booking',
                'class' => 'btn btn-primary full-width',
            ),
        ));
    }
}