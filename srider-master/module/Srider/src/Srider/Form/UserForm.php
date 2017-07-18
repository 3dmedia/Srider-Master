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

class UserForm extends Form {

	public function __construct($method = null)
	{
		parent::__construct('user');

		$this->add(array(
			'name' => 'id',
			'type' => 'Hidden',
		));

		$this->add(array(
			'name' => 'id_role',
			'type' => 'Select',
			'options' => array(
				'label' => 'User Role',
				'value_options' => array(
					'0' => 'Choose role',
					'1' => 'SuperAdmin',
					'2' => 'Admin',
					'9' => 'Customer',
				)
			),
		));

		$this->add(array(
			'name' => 'email',
			'type' => 'Email',
			'options' => array(
				'label' => 'Email',
			),
		));

		$this->add(array(
			'name' => 'pass',
			'type' => 'Password',
			'options' => array(
				'label' => 'Password',
			),
		));

		$this->add(array(
			'name' => 'status',
			'type' => 'Select',
			'options' => array(
				'label' => 'Status',
				'value_options' => array(
					'active' => 'Active',
					'pending' => 'Pending',
					'inactive' => 'Inactive',
				)
			),
		));

		$this->add(array(
			'name' => 'submit',
			'type' => 'Submit',
			'attributes' => array(
				'value' => 'Save',
				'id' => 'submitbutton',
			),
		));
	}
}
