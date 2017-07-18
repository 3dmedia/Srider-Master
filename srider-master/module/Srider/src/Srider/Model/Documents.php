<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class Documents {

    public $id;
    public $photo;
    public $police_record;
    public $driver_licence;
    public $car_insurance;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->photo = (!empty($data['photo'])) ? $data['photo'] : null;
        $this->police_record = (!empty($data['police_record'])) ? $data['police_record'] : null;
        $this->driver_licence = (!empty($data['driver_licence'])) ? $data['driver_licence'] : null;
        $this->car_insurance = (!empty($data['car_insurance'])) ? $data['car_insurance'] : null;
    }

}
