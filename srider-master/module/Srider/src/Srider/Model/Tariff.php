<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class Tariff {

    public $id;
    public $price;
    public $price_km;
    public $minimum_price;
    public $hour_color_id;
    public $route_id;
    public $day_id;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->price = (!empty($data['price'])) ? $data['price'] : null;
        $this->price_km = (!empty($data['price_km'])) ? $data['price_km'] : null;
        $this->minimum_price = (!empty($data['minimum_price'])) ? $data['minimum_price'] : null;
        $this->hour_color_id = (!empty($data['hour_color_id'])) ? $data['hour_color_id'] : null;
        $this->route_id = (!empty($data['route_id'])) ? $data['route_id'] : null;
        $this->day_id = (!empty($data['day_id'])) ? $data['day_id'] : null;
    }

}
