<?php namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model{
  protected $table = 'employees';
  protected $primaryKey = 'id';
  
  protected $allowedFields = ['employee_name', 'contact_number', 'email', 'image', 'updated_at'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];
 

  public function saveEmployee($data_employee, $data_user) {  
   
    $this->db->transBegin();

    $this->db->table('employees')->insert($data_employee);
    $data_user['employee_id'] = $this->db->insertID();
    $this->db->table('users')->insert($data_user);

    if ($this->db->transStatus() === false) {
        $this->db->transRollback();
    } else {       
        $this->db->transCommit();
    }

    return true;

  }

  public function updateEmployee($data_employee, $data_user, $id) {  
   
    // print_r($data_user);
    // exit;
    $this->db->transBegin();


      $builder = $this->db->table('employees');
      $builder->where('id', $id);
      $builder->update($data_employee);

      $builder = $this->db->table('users');
      $builder->where('employee_id', $id);
      $builder->update($data_user);

    if ($this->db->transStatus() === false) {
        $this->db->transRollback();
        return false;
    } else {       
        $this->db->transCommit();
        return true;
    }   

  }

  public function getAllEmployeeData(){

    $builder = $this->db->table('employees');
    $builder->select('*');
    $builder->join('users', 'users.employee_id = employees.id');
    $builder->where('users.role_id = 1');
    $query = $builder->get();

    return $query;
    
    
  }

  public function getEmployeeData($id){

    $builder = $this->db->table('employees');
    $builder->select('*');
    $builder->join('users', 'users.employee_id = employees.id');
    $builder->where('users.employee_id = ' . base64_decode($id) );
    $query = $builder->get();
    $row = $query->getRow();
    return $row;
    
    // return base64_decode($id);
    
  }


}