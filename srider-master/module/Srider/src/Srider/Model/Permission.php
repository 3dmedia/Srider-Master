<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class Permission {

    public $id;
    public $permission_name;
    public $resource_id;
    public $active;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->permission_name = (!empty($data['permission_name'])) ? $data['permission_name'] : null;
        $this->resource_id = (!empty($data['resource_id'])) ? $data['resource_id'] : null;
        $this->active = (!empty($data['active'])) ? $data['active'] : null;
    }

}
