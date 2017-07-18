<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class Car {

    public $id;
    public $model;
    public $brand_id;
    public $color;
    public $made_year;
    public $seats_number;
    public $max_luggage;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->model = (!empty($data['model'])) ? $data['model'] : null;
        $this->brand_id = (!empty($data['brand_id'])) ? $data['brand_id'] : null;
        $this->color = (!empty($data['color'])) ? $data['color'] : null;
        $this->made_year = (!empty($data['made_year'])) ? $data['made_year'] : null;
        $this->seats_number = (!empty($data['seats_number'])) ? $data['seats_number'] : null;
        $this->max_luggage = (!empty($data['max_luggage'])) ? $data['max_luggage'] : null;
    }

}
