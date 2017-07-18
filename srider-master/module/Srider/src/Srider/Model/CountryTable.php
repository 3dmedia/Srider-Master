<?php

/* 
 * @category   Booking Software
 * @package    Srider Module
 * @author     Brinzaru Andrei-Dan <dan.brinzaru@gmail.com>
 * @copyright  Copyright (c) 2016 - Technicopro, Brinzaru Andrei-Dan
 * @version    1.0
 */

namespace Application\Model;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
 
class CountryTable extends AbstractTableGateway
{

    public $table = 'country';
    
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(ResultSet::TYPE_ARRAY);
        $this->initialize();
    }
    
    public function getCountries($where = array(), $columns = array())
    {
        try { 
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()->from(array(
                'countries' => $this->table
            ));
            
            if (count($where) > 0) {
                $select->where($where);
            }
            
            if (count($columns) > 0) {
                $select->columns($columns);
            }
            
//            $select->join(array('userRole' => 'user_role'), 'userRole.user_id = users.id', array('role_id'), 'LEFT');
//            $select->join(array('role' => 'role'), 'userRole.role_id = role.id', array('role_name'), 'LEFT');
            
            $statement = $sql->prepareStatementForSqlObject($select);
            $country = $this->resultSetPrototype->initialize($statement->execute())->toArray(); 
            echo '<pre>:::->';
            print_r($country);
            print_r($sql->getSqlstringForSqlObject($select));
            die('stop');
            return $country;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }  
    
    public function getCountry($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find country row id: {$id}");
        }
        return $row;
    }
    
    public function saveCountry(Country $country)
    {
        $data = array(
            'id' => $country->id,
            'name' => $country->name
        );

        $lastId = null;
        $id = (int) $country->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $lastId = $this->tableGateway->lastInsertValue;
        } else {
            if ($this->getCountry($id)) {
                $this->tableGateway->update($data, array('id' => $id));
                $lastId = $id;
            } else {
                throw new \Exception("Country id: {$id} does not exist.");
            }
        }
        
        return $lastId;
    }
    
    public function getAjaxCountry($where = array(), $columns = array())
    {
        try { 
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()->from(array(
                'country' => $this->table
            ));
            
            if (count($where) > 0) {
                $whereOr = new Where();
                $whereOr
                        ->nest()
                        ->like('id', '%' . $where['search'] . '%')
                        ->or
                        ->like('name', '%' . $where['search'] . '%')
                        ->or
                        ->like('phone_prefix', '%' . $where['search'] . '%')
                        ->unnest();
                $select->where($whereOr, $columns);
            }
            
            if (count($columns) > 0) {
                $select->columns($columns);
            }
            
            $statement = $sql->prepareStatementForSqlObject($select);
            $countries = $this->resultSetPrototype->initialize($statement->execute())->toArray(); 

            return $countries;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }    
}