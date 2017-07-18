<?php

/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class Country
{
    public $id;
    public $name;
    public $phone_prefix;
  
    public function exchangeArray($data)
    {
        $this->id                  = (!empty($data['id'])) ? $data['id'] : null;
        $this->name          = (!empty($data['name'])) ? $data['name'] : null;
        $this->phone_prefix           = (!empty($data['phone_prefix'])) ? $data['phone_prefix'] : null;
    }
}