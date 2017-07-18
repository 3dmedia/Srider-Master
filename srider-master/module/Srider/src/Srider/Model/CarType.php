<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class CarType {

    public $id;
    public $name;
    public $image;
    public $active;
    public $brand_id;
    public $tariff_id;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->image = (!empty($data['image'])) ? $data['image'] : null;
        $this->active = (!empty($data['active'])) ? $data['active'] : null;
        $this->brand_id = (!empty($data['brand_id'])) ? $data['brand_id'] : null;
        $this->tariff_id = (!empty($data['tariff_id'])) ? $data['tariff_id'] : null;
    }

}
