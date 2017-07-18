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

class AgencyInfoTable extends AbstractTableGateway {

    public $table = 'agency_info';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(ResultSet::TYPE_ARRAY);
        $this->initialize();
    }

    public function getAgencyInfos($where = array(), $columns = array()) {
        try {
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()->from(array(
                'agency_info' => $this->table
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
            $agency_info = $this->resultSetPrototype->initialize($statement->execute())->toArray();
            echo '<pre>:::->';
            print_r($agency_info);
            print_r($sql->getSqlstringForSqlObject($select));
            die('stop');
            return $agency_info;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }

    public function getAgencyInfo($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find agency_info row id: {$id}");
        }
        return $row;
    }

    public function saveAgencyInfo(Agency_info $agency_info) {
        $data = array(
            'id' => $agency_info->id,
            'name' => $agency_info->name,
            'contact' => $agency_info->contact,
            'license' => $agency_info->license,
            'license_file' => $agency_info->license_file,
            'insurance' => $agency_info->insurace,
            'insurance_file' => $agency_info->insurance_file,
            'contract_type_id' => $agency_info->contract_type_id,
            'comission' => $agency_info->comission
        );

        $lastId = null;
        $id = (int) $agency_info->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $lastId = $this->tableGateway->lastInsertValue;
        } else {
            if ($this->getAgencyInfo($id)) {
                $this->tableGateway->update($data, array('id' => $id));
                $lastId = $id;
            } else {
                throw new \Exception("Agency_info id: {$id} does not exist.");
            }
        }

        return $lastId;
    }

    public function getAjaxAgencyInfo($where = array(), $columns = array()) {
        try {
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()->from(array(
                'agency_info' => $this->table
            ));

            if (count($where) > 0) {
                $whereOr = new Where();
                $whereOr
                        ->nest()
                        ->like('id', '%' . $where['search'] . '%')
                        ->or
                        ->like('name', '%' . $where['search'] . '%')
                        ->or
                        ->like('contact', '%' . $where['search'] . '%')
                        ->or
                        ->like('license', '%' . $where['search'] . '%')
                        ->or
                        ->like('license_file', '%' . $where['search'] . '%')
                        ->or
                        ->like('insurance', '%' . $where['search'] . '%')
                        ->or
                        ->like('insurance_file', '%' . $where['search'] . '%')
                        ->or
                        ->like('contract_type_id', '%' . $where['search'] . '%')
                        ->or
                        ->like('comission', '%' . $where['search'] . '%')
                        ->unnest();
                $select->where($whereOr, $columns);
            }

            if (count($columns) > 0) {
                $select->columns($columns);
            }

            $statement = $sql->prepareStatementForSqlObject($select);
            $agency_info = $this->resultSetPrototype->initialize($statement->execute())->toArray();

            return $agency_info;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }

}
