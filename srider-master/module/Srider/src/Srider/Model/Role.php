<?php

/*
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Srider\Model;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Complysight\Service\UserAuthAdapter;
use Zend\Session\Container;
use Complysight\Service\UserPassword;
use Zend\Db\Sql\Update;
use Zend\Validator\Explode;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;

class Role extends AbstractTableGateway {

//    public $id;
//    public $role_name;
//    public $active;

    public $table = 'role';
    
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(ResultSet::TYPE_ARRAY);
        $this->initialize();
    }
    
//    public function exchangeArray($data) {
//        $this->id = (!empty($data['id'])) ? $data['id'] : null;
//        $this->role_name = (!empty($data['role_name'])) ? $data['role_name'] : null;
//        $this->active = (!empty($data['active'])) ? $data['active'] : null;
//    }

    public function getUserRoles($where = array(), $columns = array())
    {
        try {
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()->from(array(
                'role' => $this->table
            ));
            $select->columns(array(
                'id',
                'role_name',
                'active',
            ));
            $select->where('`active` = 1');
            if (count($where) > 0) {
                $select->where($where);
            }
            
            if (count($columns) > 0) {
                $select->columns($columns);
            }
//            print_r($sql->getSqlstringForSqlObject($select));
            $statement = $sql->prepareStatementForSqlObject($select);
            $roles = $this->resultSetPrototype->initialize($statement->execute())
                ->toArray();
            return $roles;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }
}
