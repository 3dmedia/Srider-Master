<?php

/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Srider\Utility;
use Zend\Crypt\Password\Bcrypt;

class UserPassword
{
    public $salt = ''; # $salt = 'aUJ$Gga#dj_asdgdj'
    public $method = 'sha1'; # @TODO Change to bcrypt when Srider app is ready

    public function __construct($method = null)
    {
        if (! is_null($method)) {
                $this->method = $method;
        }
    }

    public function getUserDetails($where, $columns){
    	$userTable = $this->getServiceLocator()->get("Users");
    	$users = $userTable->getUsers($where, $columns);
        return $users;
    }
 
    public function create($password)
    {
        if ($this->method == 'md5') {
            return md5($this->salt . $password);
        } elseif ($this->method == 'sha1') {
                return sha1($this->salt . $password);
        } elseif ($this->method == 'bcrypt') {
            $bcrypt = new Bcrypt();
            $bcrypt->setCost(14);
            return $bcrypt->create($password);
        }
    }
 
    public function verify($password, $hash)
    {
        if ($this->method == 'md5') {
            return $hash == md5($this->salt . $password);
        } elseif ($this->method == 'sha1') {
            return $hash == sha1($this->salt . $password);
        } elseif ($this->method == 'bcrypt') {
            $bcrypt = new Bcrypt();
            $bcrypt->setCost(14);
            return $bcrypt->verify($password, $hash);
        }
    }
    
    public function randomPassword($lenght = 9) {
        $alphabet = "abcdefghijklmnopqrstuwxyz#!@#$%^&*()_-=+;:,.?'ABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array();  
        $alphaLength = strlen($alphabet) - 1;  
        for ($i = 0; $i < $lenght; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);  
    }
}