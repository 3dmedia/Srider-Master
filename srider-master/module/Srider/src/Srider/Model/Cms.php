<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class Cms {

    public $id;
    public $action;
    public $body_text;
    public $page_type;
    public $user_id;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->action = (!empty($data['action'])) ? $data['action'] : null;
        $this->body_text = (!empty($data['body_text'])) ? $data['body_text'] : null;
        $this->page_type = (!empty($data['page_type'])) ? $data['page_type'] : null;
        $this->user_id = (!empty($data['user_id'])) ? $data['user_id'] : null;

    }

}
