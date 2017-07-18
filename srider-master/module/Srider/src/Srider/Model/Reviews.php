<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class Reviews {

    public $id;
    public $message;
    public $user_id;
    public $booking_id;
    public $rating;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->message = (!empty($data['message'])) ? $data['message'] : null;
        $this->user_id = (!empty($data['user_id'])) ? $data['user_id'] : null;
        $this->booking_id = (!empty($data['booking_id'])) ? $data['booking_id'] : null;
        $this->rating = (!empty($data['rating'])) ? $data['rating'] : null;
    }

}
