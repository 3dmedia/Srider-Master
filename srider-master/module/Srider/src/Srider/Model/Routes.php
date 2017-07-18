<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class Routes {

    public $id;
    public $from;
    public $to;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->from = (!empty($data['from'])) ? $data['from'] : null;
        $this->to = (!empty($data['to'])) ? $data['to'] : null;
    }

}
