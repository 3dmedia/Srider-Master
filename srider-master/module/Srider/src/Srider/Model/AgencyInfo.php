<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class AgencyInfo {

    public $id;
    public $name;
    public $contact;
    public $license;
    public $license_file;
    public $insurance;
    public $insurance_file;
    public $contact_type_id;
    public $comission;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->contact = (!empty($data['contact'])) ? $data['contact'] : null;
        $this->license = (!empty($data['license'])) ? $data['license'] : null;
        $this->license_file = (!empty($data['license_file'])) ? $data['license_file'] : null;
        $this->insurance = (!empty($data['insurance'])) ? $data['insurance'] : null;
        $this->insurance_file = (!empty($data['insurance_file'])) ? $data['insurance_file'] : null;
        $this->contact_type_id = (!empty($data['contact_type_id'])) ? $data['contact_type_id'] : null;
        $this->comission = (!empty($data['comission'])) ? $data['comission'] : null;
    }

}
