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
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
 
class UsersTable extends AbstractTableGateway
{

    public $table = 'users';
    
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->resultSetPrototype = new ResultSet(ResultSet::TYPE_ARRAY);
        $this->initialize();
    }
    
    public function getUsers($where = array(), $columns = array())
    {
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
            
            $select->join(array('userRole' => 'user_role'), 'userRole.user_id = users.id', array('role_id'), 'LEFT');
            $select->join(array('role' => 'role'), 'userRole.role_id = role.id', array('role_name'), 'LEFT');
            
            $statement = $sql->prepareStatementForSqlObject($select);
            $users = $this->resultSetPrototype->initialize($statement->execute())->toArray(); 
//            echo '<pre>:::->';
//            print_r($users);
//            print_r($sql->getSqlstringForSqlObject($select));
//            die('stop');
            return $users;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }  
    
    public function getUser($id)
    {
//        echo '<pre>--->';
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find user row id: {$id}");
        }
        return $row;
    }
    
    public function saveUser(User $user)
    {
        $data = array(
            'id'         => $user->id,
            'first_name' => $user->first_name ,          
            'last_name'  => $user->last_name,           
            'role_id'    => $user->role_id,
            'email'      => $user->email,                
            'telephone'  => $user->telephone,            
            'address'    => $user->address,              
            'city'       => $user->city,                 
            'county'     => $user->county,               
            'country'    => $user->country,              
            'post_code'  => $user->post_code,            
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'active'     => $user->active,
            'clinic_id'  => $user->clinic_id,
            'gmail_user' => $user->gmail_user,
            'picture'    => $user->picture,
            'u_settings' => $user->u_settings,
            'password'   => $user->password,
            'created_by' => $user->created_by  
        );
        
        $lastId = null;
        $id = (int) $user->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $lastId = $this->tableGateway->lastInsertValue;
        } else {
            if ($this->getUser($id)) {
                $this->tableGateway->update($data, array('id' => $id));
                $lastId = $id;
            } else {
                throw new \Exception("User id: {$id} does not exist.");
            }
        }
        
        return $lastId;
    }
    
    public function getAjaxUsers($where = array(), $columns = array(), $clinicId = null)
    {
        try { 
            $sql = new Sql($this->getAdapter());
            $select = $sql->select()->from(array(
                'users' => $this->table
            ));
            
            if (count($where) > 0) {
                $whereOr = new Where();
                $whereOr
                    ->nest()
                        ->like('email', '%'.$where['search'].'%')
                        ->or
                        ->like('first_name', '%'.$where['search'].'%')
                        ->or
                        ->like('last_name', '%'.$where['search'].'%')
                        ->or
                        ->equalTo('telephone', $where['search'])                    
                    ->unnest()
                    ->and
                    ->nest()
                        ->greaterThan('users.role_id',1) # Cuz` role_id: 1 is Superadmin :-)
                    ->unnest()
                    ->and
                        ->equalTo('users.active', 1)  # Active user      
                    ->and
                    ->nest()
                        ->equalTo('users.clinic_id', $clinicId)  # User clinic   
                        ->or
                        ->equalTo('users.clinic_id', 0)   # Or no clinic (regular user)  
                    ->unnest();
                $select->where($whereOr, $columns);
            }
            
            if (count($columns) > 0) {
                $select->columns($columns);
            }
            
            $statement = $sql->prepareStatementForSqlObject($select);
            $users = $this->resultSetPrototype->initialize($statement->execute())->toArray(); 

            return $users;
        } catch (\Exception $e) {
            throw new \Exception($e->getPrevious()->getMessage());
        }
    }    
}