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

class TariffTable extends AbstractTableGateway {

    public $table = 'tariff';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(ResultSet::TYPE_ARRAY);
        $this->initialize();
    }

    public function getTariffs($where = array(), $columns = array()) {
        try {
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()->from(array(
                'tariffs' => $this->table
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
            $tariffs = $this->resultSetPrototype->initialize($statement->execute())->toArray();
            echo '<pre>:::->';
            print_r($tariffs);
            print_r($sql->getSqlstringForSqlObject($select));
            die('stop');
            return $tariffs;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }

    public function getTariff($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find tariff id: {$id}");
        }
        return $row;
    }

    public function saveTariffs(Tariff $tariffs) {
        $data = array(
            'id' => $tariffs->id,
            'price' => $tariffs->price,
            'price_km' => $tariffs->price_km,
            'minimum_price' => $tariffs->minimum_price,
            'hour_color_id' => $tariffs->hour_color_id,
            'route_id' => $tariffs->route_id,
            'day_id' => $tariffs->day_id
        );

        $lastId = null;
        $id = (int) $tariffs->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $lastId = $this->tableGateway->lastInsertValue;
        } else {
            if ($this->getTariff($id)) {
                $this->tableGateway->update($data, array('id' => $id));
                $lastId = $id;
            } else {
                throw new \Exception("Tariffs id: {$id} does not exist.");
            }
        }

        return $lastId;
    }

    public function getAjaxTariffs($where = array(), $columns = array()) {
        try {
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()->from(array(
                'tariffs' => $this->table
            ));

            if (count($where) > 0) {
                $whereOr = new Where();
                $whereOr
                        ->nest()
                        ->like('id', '%' . $where['search'] . '%')
                        ->or
                        ->like('price', '%' . $where['search'] . '%')
                        ->or
                        ->like('price_km', '%' . $where['search'] . '%')
                        ->or
                        ->like('minimum_price', '%' . $where['search'] . '%')
                        ->or
                        ->like('hour_color_id', '%' . $where['search'] . '%')
                        ->or
                        ->like('route_id', '%' . $where['search'] . '%')
                        ->or
                        ->like('day_id', '%' . $where['search'] . '%')
                        ->unnest();
                $select->where($whereOr, $columns);
            }

            if (count($columns) > 0) {
                $select->columns($columns);
            }

            $statement = $sql->prepareStatementForSqlObject($select);
            $tariffs = $this->resultSetPrototype->initialize($statement->execute())->toArray();

            return $tariffs;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }

}
