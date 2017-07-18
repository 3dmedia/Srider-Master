<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class Resource {

    public $id;
    public $resource_name;
    public $active;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->resource_name = (!empty($data['resource_name'])) ? $data['resource_name'] : null;
        $this->active = (!empty($data['active'])) ? $data['active'] : null;
    }

}
