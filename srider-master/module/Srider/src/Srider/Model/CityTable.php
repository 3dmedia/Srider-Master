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

class CityTable extends AbstractTableGateway {

    public $table = 'city';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(ResultSet::TYPE_ARRAY);
        $this->initialize();
    }

    public function getCities($where = array(), $columns = array()) {
        try {
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()->from(array(
                'users' => $this->table
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
            $city = $this->resultSetPrototype->initialize($statement->execute())->toArray();
            echo '<pre>:::->';
            print_r($city);
            print_r($sql->getSqlstringForSqlObject($select));
            die('stop');
            return $city;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }

    public function getCity($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find city row id: {$id}");
        }
        return $row;
    }

    public function saveCity(City $city) {
        $data = array(
            'id' => $city->id,
            'name' => $city->name
        );

        $lastId = null;
        $id = (int) $city->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $lastId = $this->tableGateway->lastInsertValue;
        } else {
            if ($this->getCity($id)) {
                $this->tableGateway->update($data, array('id' => $id));
                $lastId = $id;
            } else {
                throw new \Exception("City id: {$id} does not exist.");
            }
        }

        return $lastId;
    }

    public function getAjaxCity($where = array(), $columns = array()) {
        try {
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()->from(array(
                'city' => $this->table
            ));

            if (count($where) > 0) {
                $whereOr = new Where();
                $whereOr
                        ->nest()
                        ->like('id', '%' . $where['search'] . '%')
                        ->or
                        ->like('name', '%' . $where['search'] . '%')
                        ->unnest();
                $select->where($whereOr, $columns);
            }

            if (count($columns) > 0) {
                $select->columns($columns);
            }

            $statement = $sql->prepareStatementForSqlObject($select);
            $cities = $this->resultSetPrototype->initialize($statement->execute())->toArray();

            return $cities;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }

}
