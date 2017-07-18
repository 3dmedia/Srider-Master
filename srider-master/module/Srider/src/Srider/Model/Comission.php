<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class Commission {

    public $id;
    public $name;
    public $percentage;
    public $paid;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->percentage = (!empty($data['percentage'])) ? $data['percentage'] : null;
        $this->paid = (!empty($data['paid'])) ? $data['paid'] : null;
    }

}
