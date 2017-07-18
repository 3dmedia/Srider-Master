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

class BookingTable extends AbstractTableGateway {

    public $table = 'booking';

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(ResultSet::TYPE_ARRAY);
        $this->initialize();
    }

    public function getBookings($where = array(), $columns = array()) {
        try {
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()->from(array(
                'booking' => $this->table
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
            $bookings = $this->resultSetPrototype->initialize($statement->execute())->toArray();
            echo '<pre>:::->';
            print_r($bookings);
            print_r($sql->getSqlstringForSqlObject($select));
            die('stop');
            return $bookings;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }

    public function getBooking($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find booking id: {$id}");
        }
        return $row;
    }

    public function saveBookings(Booking $booking) {
        $data = array(
            'id' => $booking->id,
            'pickup_date' => $booking->pickup_date,
            'reservation_date' => $booking->reservation_date,
            'car_type_id' => $booking->car_type_id,
            'cost' => $booking->cost,
            'user_id' => $booking->user_id,
            'source' => $booking->source,
            'pickup' => $booking->pickup,
            'destination' => $booking->destination,
            'waypoints' => $booking->waypoints,
            'created_at' => $booking->created_at,
            'updated_at' => $booking->updated_at,
            'status' => $booking->status,
            'cancelations' => $booking->cancelations,
            'canceled_by' => $booking->canceled_by,
            'insurance_id' => $booking->insurance_id,
            'flight' => $booking->flight,
            'terminal' => $booking->terminal,
            'referral' => $booking->referral
        );

        $lastId = null;
        $id = (int) $booking->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $lastId = $this->tableGateway->lastInsertValue;
        } else {
            if ($this->getBooking($id)) {
                $this->tableGateway->update($data, array('id' => $id));
                $lastId = $id;
            } else {
                throw new \Exception("Booking id: {$id} does not exist.");
            }
        }

        return $lastId;
    }

    public function getAjaxBookings($where = array(), $columns = array()) {
        try {
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()->from(array(
                'booking' => $this->table
            ));

            if (count($where) > 0) {
                $whereOr = new Where();
                $whereOr
                        ->nest()
                        ->like('id', '%' . $where['search'] . '%')
                        ->or
                        ->like('pickup_date', '%' . $where['search'] . '%')
                        ->or
                        ->like('reservation_date', '%' . $where['search'] . '%')
                        ->or
                        ->like('car_type_id', '%' . $where['search'] . '%')
                        ->or
                        ->like('cost', '%' . $where['search'] . '%')
                        ->or
                        ->like('user_id', '%' . $where['search'] . '%')
                        ->or
                        ->like('source', '%' . $where['search'] . '%')
                        ->or
                        ->like('pickup', '%' . $where['search'] . '%')
                        ->or
                        ->like('destination', '%' . $where['search'] . '%')
                        ->or
                        ->like('waypoints', '%' . $where['search'] . '%')
                        ->or
                        ->like('created_at', '%' . $where['search'] . '%')
                        ->or
                        ->like('update_at', '%' . $where['search'] . '%')
                        ->or
                        ->like('status', '%' . $where['search'] . '%')
                        ->or
                        ->like('cancelations', '%' . $where['search'] . '%')
                        ->or
                        ->like('canceled_by', '%' . $where['search'] . '%')
                        ->or
                        ->like('insurance_id', '%' . $where['search'] . '%')
                        ->or
                        ->like('flight', '%' . $where['search'] . '%')
                        ->or
                        ->like('terminal', '%' . $where['search'] . '%')
                        ->or
                        ->like('referral', '%' . $where['search'] . '%')
                        ->unnest();
                $select->where($whereOr, $columns);
            }

            if (count($columns) > 0) {
                $select->columns($columns);
            }

            $statement = $sql->prepareStatementForSqlObject($select);
            $bookings = $this->resultSetPrototype->initialize($statement->execute())->toArray();

            return $bookings;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }

}
