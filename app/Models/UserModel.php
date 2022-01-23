<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
  protected $table = 'users';
  protected $primaryKey = 'id';
  
  protected $allowedFields = ['employee_name', 'contact_number', 'email', 'image', 'updated_at'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];


    public function getLoggedUserByUserName($username){

      
      $query   = $this->db->query("SELECT * FROM users where username = '" . $username . "'" );
      $results = $query->getResult();

      $data['username'] = $results[0]->username;
      $data['user_role'] = $results[0]->role_id;
      $data['employee_id'] = $results[0]->employee_id;

      return $data;
      
    }

    public function getLoggedUserDataByEmpId(){

      // print(session()->get('employee_id'));
      // exit;

      $user = $this
      ->join('employees', 'users.employee_id = employees.id')
      ->where('users.employee_id', session()->get('employee_id'))
      ->first();

      return $user;  
      
    }


    public function getLoggedUserDataByUserName($username){

      $user = $this
      ->join('employees', 'users.employee_id = employees.id')
      ->where('users.username', $username)
      ->first();

      return $user;  
      
    }

    public function getLoggedUser($id){

      $builder = $this->db->table('users');
      $builder->select('*');
      $builder->join('employees', 'employees.id = users.employee_id');
      $builder->where('users.username =' . $username);
      $query = $builder->get();
      $row = $query->getRow();
      return $row;     
      
    }
}