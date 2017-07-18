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

class EarningsTable extends AbstractTableGateway {

    public $table = 'earnings';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(ResultSet::TYPE_ARRAY);
        $this->initialize();
    }

    public function getEarnings($where = array(), $columns = array()) {
        try {
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()->from(array(
                'earnings' => $this->table
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
            $earnings = $this->resultSetPrototype->initialize($statement->execute())->toArray();
            echo '<pre>:::->';
            print_r($earnings);
            print_r($sql->getSqlstringForSqlObject($select));
            die('stop');
            return $earnings;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }

    public function getEarning($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find earnings id: {$id}");
        }
        return $row;
    }

    public function saveEarnings(Earnings $earnings) {
        $data = array(
            'id' => $car_types->id,
            'user_id' => $car_types->user_id,
            'booking_id' => $car_types->booking_id,
            'sum' => $car_types->sum,
            'created_at' => $car_types->created_at,
            'penalty' => $car_types->penalty
        );

        $lastId = null;
        $id = (int) $earnings->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $lastId = $this->tableGateway->lastInsertValue;
        } else {
            if ($this->getEarning($id)) {
                $this->tableGateway->update($data, array('id' => $id));
                $lastId = $id;
            } else {
                throw new \Exception("Earnings id: {$id} does not exist.");
            }
        }

        return $lastId;
    }

    public function getAjaxEarnings($where = array(), $columns = array()) {
        try {
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()->from(array(
                'earnings' => $this->table
            ));

            if (count($where) > 0) {
                $whereOr = new Where();
                $whereOr
                        ->nest()
                        ->like('id', '%' . $where['search'] . '%')
                        ->or
                        ->like('user_id', '%' . $where['search'] . '%')
                        ->or
                        ->like('booking_id', '%' . $where['search'] . '%')
                        ->or
                        ->like('sum', '%' . $where['search'] . '%')
                        ->or
                        ->like('created_at', '%' . $where['search'] . '%')
                        ->or
                        ->like('penalty', '%' . $where['search'] . '%')
                        ->unnest();
                $select->where($whereOr, $columns);
            }

            if (count($columns) > 0) {
                $select->columns($columns);
            }

            $statement = $sql->prepareStatementForSqlObject($select);
            $earnings = $this->resultSetPrototype->initialize($statement->execute())->toArray();

            return $earnings;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }

}
