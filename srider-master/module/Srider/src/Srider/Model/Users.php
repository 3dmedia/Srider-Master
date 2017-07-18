<?php

/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Srider\Model;

class Users
{
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $fax;
    public $address;
    public $post_code;
    public $city_id;
    public $county_id;
    public $country_id;
    public $website;
    public $password;
    public $facebook_user;
    public $image;
    public $created_at;
    public $updated_at;
    public $created_by;
    public $agency_id;
    public $active;
    public $commission_id;
    public $documents_id;
    public $experience;
    public $language_id;
  
    public function exchangeArray($data)
    {
        $this->id                  = (!empty($data['id'])) ? $data['id'] : null;
        $this->first_name          = (!empty($data['first_name'])) ? $data['first_name'] : null;
        $this->last_name           = (!empty($data['last_name'])) ? $data['last_name'] : null;
        $this->email               = (!empty($data['email'])) ? $data['email'] : null;
        $this->phone               = (!empty($data['phone'])) ? $data['phone'] : null;
        $this->fax                 = (!empty($data['fax'])) ? $data['fax'] : null;
        $this->address             = (!empty($data['address'])) ? $data['address'] : null;
        $this->post_code           = (!empty($data['post_code'])) ? $data['post_code'] : null;
        $this->city_id             = (!empty($data['city_id'])) ? $data['city_id'] : null;
        $this->county_id           = (!empty($data['county_id'])) ? $data['county_id'] : null;
        $this->country_id          = (!empty($data['country_id'])) ? $data['country_id'] : null;
        $this->website             = (!empty($data['website'])) ? $data['website'] : null;
        $this->password            = (!empty($data['password'])) ? $data['password'] : null;
        $this->facebook_user       = (!empty($data['facebook_user'])) ? $data['facebook_user'] : null;
        $this->image               = (!empty($data['image'])) ? $data['image'] : null;
        $this->created_at          = (!empty($data['created_at'])) ? $data['created_at'] : null;
        $this->updated_at          = (!empty($data['updated_at'])) ? $data['updated_at'] : null;
        $this->created_by          = (!empty($data['created_by'])) ? $data['created_by'] : null;
        $this->agency_id           = (!empty($data['agency_id'])) ? $data['agency_id'] : null;
        $this->active              = (!empty($data['active'])) ? $data['active'] : null;
        $this->commission_id       = (!empty($data['commission_id'])) ? $data['commission_id'] : null;
        $this->documents_id        = (!empty($data['documents_id'])) ? $data['documents_id'] : null;
        $this->experience          = (!empty($data['experience'])) ? $data['experience'] : null;
        $this->language_id         = (!empty($data['language_id'])) ? $data['language_id'] : null;
    }
}