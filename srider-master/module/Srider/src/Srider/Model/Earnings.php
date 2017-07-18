<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class Earnings {

    public $id;
    public $user_id;
    public $booking_id;
    public $sum;
    public $created_at;
    public $penalty;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->user_id = (!empty($data['user_id'])) ? $data['user_id'] : null;
        $this->booking_id = (!empty($data['booking_id'])) ? $data['booking_id'] : null;
        $this->sum = (!empty($data['sum'])) ? $data['sum'] : null;
        $this->created_at = (!empty($data['created_at'])) ? $data['created_at'] : null;
        $this->penalty = (!empty($data['penalty'])) ? $data['penalty'] : null;
    }

}
