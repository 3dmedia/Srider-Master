<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

class Booking {

    public $id;
    public $pickup_date;
    public $reservation_date;
    public $car_type_id;
    public $cost;
    public $user_id;
    public $source;
    public $pickup;
    public $destination;
    public $waypoints;
    public $created_at;
    public $updated_at;
    public $status;
    public $cancelations;
    public $canceled_by;
    public $insurance_id;
    public $flight;
    public $terminal;
    public $referral;

    public function exchangeArray($data) {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->pickup_date = (!empty($data['pickup_date'])) ? $data['pickup_date'] : null;
        $this->reservation_date = (!empty($data['reservation_date'])) ? $data['reservation_date'] : null;
        $this->car_type_id = (!empty($data['car_type_id'])) ? $data['car_type_id'] : null;
        $this->cost = (!empty($data['cost'])) ? $data['cost'] : null;
        $this->user_id = (!empty($data['user_id'])) ? $data['user_id'] : null;
        $this->source = (!empty($data['source'])) ? $data['source'] : null;
        $this->pickup = (!empty($data['pickup'])) ? $data['pickup'] : null;
        $this->destination = (!empty($data['destination'])) ? $data['destination'] : null;
        $this->waypoints = (!empty($data['waypoints'])) ? $data['waypoints'] : null;
        $this->created_at = (!empty($data['created_at'])) ? $data['created_at'] : null;
        $this->updated_at = (!empty($data['updated_at'])) ? $data['updated_at'] : null;
        $this->status = (!empty($data['status'])) ? $data['status'] : null;
        $this->cancelations = (!empty($data['cancelations'])) ? $data['cancelations'] : null;
        $this->canceled_by = (!empty($data['canceled_by'])) ? $data['canceled_by'] : null;
        $this->insurance_id = (!empty($data['insurance_id'])) ? $data['insurance_id'] : null;
        $this->flight = (!empty($data['flight'])) ? $data['flight'] : null;
        $this->terminal = (!empty($data['terminal'])) ? $data['terminal'] : null;
        $this->referral = (!empty($data['referral'])) ? $data['referral'] : null;
    }

}
