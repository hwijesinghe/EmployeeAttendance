<?php

namespace App\Controllers;
// use App\Models\UserModel;

use App\Models\EmployeeModel;

class EmployeeController extends BaseController
{

    public function index()
    {
        helper(['form']);
        if(session()->get('isLoggedIn') && session()->get('user_role') == 0 ){
            // return redirect()->to(base_url().'/');
            return view('employee/dashboard');
        }else{
            return redirect()->to(base_url().'/user/dashboard');
        }        
       
    }

    public function listing()
    {
     
        helper(['form']);

        $objEmpData = new EmployeeModel();
        $data['employee'] = $objEmpData->getAllEmployeeData();

        return view('employee/listing', $data);
       
    }
    
    public function new_employee()
    {
     
        $data = [];
        helper(['form']);
        

        if($this->request->getMethod() == 'post'){
            // echo("Add process");
            // exit;
           
            // Form validation for submission
            $rules = [
                'employee_name' => 'required|min_length[3]',
                'contact_number' => 'required|min_length[10]|max_length[15]',
                'email' => 'required|valid_email|is_unique[employees.email]',
                'username' => 'required|min_length[6]|is_unique[users.username]',
                'password' => 'required|min_length[6]',
                'com_password' => 'matches[password]',
            ];



            if(! $this->validate($rules)){
                // Validation Fail
                //echo("Error");
                $data['validation'] = $this->validator;         

            }else{

                // Save data into database
                //echo("Success");

                $objEmpData = new EmployeeModel();

                $objEmployeeData = [
                    'employee_name' => $this->request->getVar('employee_name'),
                    'contact_number' => $this->request->getVar('contact_number'),
                    'email' => $this->request->getVar('email'),
                ];

                $objUserData = [
                    'username'  => $this->request->getVar('username'),
                    'password'  =>  base64_encode($this->request->getVar('password')),
                ];

                $success =  $objEmpData->saveEmployee($objEmployeeData, $objUserData);

                // print($success );
                // exit;

                if($success === true){
                    return redirect()->to(base_url().'/employee/list')->with('success', "Employee data successfully added");
                    
                }else{
                    return redirect()->to(base_url().'/employee/list')->with('error', "Employee data successfully added");
                }

                
            }

           
        }
        
      
        return view('employee/new_employee', $data);

       
       
    }

    public function update_employee()
    {
     
        $data = [];
        helper(['form']);
        

        if($this->request->getMethod() == 'post'){
            // echo("Add process");
            // exit;
           
            // Form validation for submission
            $rules = [
                'employee_name' => 'required|min_length[3]',
                'contact_number' => 'required|min_length[10]|max_length[15]',
                'email' => 'required|valid_email',
                'username' => 'required',  
                'com_password' => 'matches[password]',             
            ];


            if(! $this->validate($rules)){
                // Validation Fail
                $data['validation'] = $this->validator;          

            }else{

                // Save data into database
                //echo("Success");

                $objEmpData = new EmployeeModel();

                $objEmployeeData = [
                    'employee_name' => $this->request->getVar('employee_name'),
                    'contact_number' => $this->request->getVar('contact_number'),
                    'email' => $this->request->getVar('email'),
                ];

                if($this->request->getVar('username') != "" && $this->request->getVar('password') != "")
                {
                    $objUserData = [
                        'username'  => $this->request->getVar('username'),
                        'password'  =>  base64_encode($this->request->getVar('password')),
                    ];
                }

                if($this->request->getVar('username') != "")
                {
                    $objUserData = [
                        'username'  => $this->request->getVar('username'),
                    ];
                }

                $success =  $objEmpData->updateEmployee($objEmployeeData, $objUserData, $this->request->getVar('id'));

                // print($success );
                // exit;

                if($success === true){
                    return redirect()->to(base_url().'/employee/list')->with('success', "Employee data successfully updated");
                    
                }else{
                    return redirect()->to(base_url().'/employee/list')->with('error', "Employee data not updated");
                }

                
            }

           
        }
        
      
        return view('employee/new_employee', $data);

       
       
    }

    public function edit_employee($id){


        $data = [];
        helper(['form']);

        $objEmpData = new EmployeeModel();   
        
        $data['employee'] = $objEmpData->getEmployeeData($id);

       
        return view('employee/edit_employee', $data);


    }

    
    public function register()
    {
     
        helper(['form']);
        echo view('layout/header');
        echo view('employee/register');
        echo view('layout/footer');
       
    }
}
