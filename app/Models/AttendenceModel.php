<?php namespace App\Models;

use CodeIgniter\Model;

class AttendenceModel extends Model{
  protected $table = 'attendence';
  protected $primaryKey = 'id';
  
  protected $allowedFields = ['username', 'employee_id', 'in_time', 'out_time', 'special_note', 'updated_at'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];


  public function saveAttendence($data){

    $response = $this->db->table('attendence')->insert($data);

    if($response){
      return true;
    }else{
      return false;
    }
  }

  public function getLastAttendence(){

    $builder = $this->db->table('attendence');
    $builder->select('*');
    $builder->where('employee_id =' . session()->get('employee_id'));
    $builder->orderBy('id', 'asc');
    $query = $builder->get();
    $row = $query->getRow();
    return $row;     

  }



  public function updateAttendence($att_data, $rec_id){

      $builder = $this->db->table('attendence');
      $builder->where('id', $rec_id);
      $response = $builder->update($att_data);

      if($response){
        return true;
      }else{
        return false;
      }

  }


  public function getListAttendence($employee_id){

    $builder = $this->db->table('attendence');
    $builder->select('*');
    $builder->where('employee_id =' . $employee_id);
    $builder->orderBy('id', 'asc');
    $query = $builder->get();
    $row = $query->getRow();
    return $row;     

  }




}