<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\AttendenceModel;

class UsersController extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        if($this->request->getMethod() == 'post'){

            $rules = [                
                'username' => 'required|min_length[6]',
                'password' => 'required|min_length[6]|validatedUser[username, password]',
            ];

            $error = [
                'password' => [
                    'validatedUser' => 'Please check your credential again',
                ]
            ];

            if(!$this->validate($rules, $error)){
                $data['validation'] = $this->validator;                
            }else{
                $model = new UserModel();
            }

        }

        return view('login');


    }

    public function attendence(){

        $data = [];
        date_default_timezone_set('Asia/Colombo');
        $objUserModel = new UserModel();
        $objAttendence = new AttendenceModel();
        
        $data['employee'] =  $objUserModel->getLoggedUserDataByEmpId();
        $data['today_date'] = date("Y-m-d H:i:s");
        $data['out_time'] = false;

        $data['last_attendence'] = $objAttendence->getLastAttendence();

        if($this->request->getMethod() !== 'post'){

            if(isset($data['last_attendence']->in_time) && $data['last_attendence']->in_time != ""  && $data['last_attendence']->out_time == ""){
                $data['out_time'] = true;
                $data['rec_id'] = $data['last_attendence']->id;
                return view('users/attendence', $data);
            }else{
                return redirect()->to(base_url().'/user/report');         
            }

        }

      
        
        // print_r($data['last_attendence']->id);
        exit;

        if($this->request->getMethod() == 'post'){

            

            $out = $this->request->getVar('out');            
            
            if(isset($out) && $out == 'out'){
                $objAttendenceOutData = [
                    'employee_id' => session()->get('employee_id'),
                    'out_time' => time(),
                    'special_note' => $this->request->getVar('special_note'),
                ];

                $out_success =  $objAttendence->updateAttendence($objAttendenceOutData, $this->request->getVar('rec_id'));
                
                if($out_success === true){
                    return redirect()->to(base_url().'/user/report')->with('success', "Departure data successfully added");
                    
                }else{
                    return redirect()->to(base_url().'/user/attendence')->with('error', "Departure data adding fail call HR department");
                }

            }else{            

                $objAttendenceData = [
                    'username' => session()->get('username'),
                    'employee_id' => session()->get('employee_id'),
                    'in_time' => time(),
                    'special_note' => $this->request->getVar('special_note'),
                ];
    
                $success =  $objAttendence->saveAttendence($objAttendenceData);
    
                if($success === true){
                    return redirect()->to(base_url().'/user/attendence')->with('success', "Attendence data successfully added");
                    
                }else{
                    return redirect()->to(base_url().'/user/attendence')->with('error', "Attendence data adding fail call HR department");
                }
            }         
        }

        return view('users/attendence', $data);
        
    }

    public function dashboard(){

        return view('users/user_dashboard');
        
    }

    public function attendence_list(){

        // $objAttendence = new AttendenceModel();
        // $data['last_attendence'] = $objAttendence->getLastAttendence();

        $content = file_get_contents("http://localhost:8080/api/employee/empAattendenceById/0002");

        print_r($content);
        exit;

        //return view('users/attendence_list', $data);
        
    } 

    public function report(){

        $objAttendence = new AttendenceModel();
        $data['last_attendence'] = $objAttendence->getLastAttendence();
        return view('users/report', $data);
        
    } 




    public function empAattendenceById($id){

        $objAttendence = new AttendenceModel();
        $data['last_attendence'] = $objAttendence->getListAttendence($id);

        return $this->response->setStatusCode(200)
                    ->setJSON($data['last_attendence']);
    }

    
   public function emp_attendence(){
    return $this->response->setStatusCode(200)
                ->setContentType('text/plain')
                ->setBody('Emp Att');
}

public function emp_attendence_by_id($id){

    $objAttendence = new AttendenceModel();
    $data['last_attendence'] = $objAttendence->getLastAttendence();

    return $this->response->setStatusCode(200)
                ->setContentType('text/plain')
                ->setBody('Emp Att ' . $id);
}












}
