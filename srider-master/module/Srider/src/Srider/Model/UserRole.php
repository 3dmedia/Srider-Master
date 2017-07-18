<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class UserRole {

    public $id;
    public $user_id;
    public $role_id;
    public $active;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->user_id = (!empty($data['user_id'])) ? $data['user_id'] : null;
        $this->role_id = (!empty($data['role_id'])) ? $data['role_id'] : null;
        $this->active = (!empty($data['active'])) ? $data['active'] : null;
    }

}
