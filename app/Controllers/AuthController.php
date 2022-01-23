<?php
namespace App\Controllers;
use App\Models\UserModel;

class AuthController extends BaseController
{

    public function index()
    {

        if(session()->get('isLoggedIn')){
            return redirect()->to(base_url().'/dashboard');
        }

        // if(session()->get('isLoggedIn') && session()->get('user_role') == 1){
        //     return redirect()->to(base_url().'/user/dashboard');
        // }
     
        
        $data = [];
        helper(['form']);

        if($this->request->getMethod() == 'post'){

            // print("Login post");
            // exit;

           // Form validation for submission
            $rules = [
                'username' => [
                    'rules' => 'required|min_length[6]',
                    'label' => 'User name'
                ],
                'password' => [
                        'rules' =>'required|min_length[6]|validatedUser[username, password]',
                        'label' => 'Password',
                        'errors' => [
                            'validatedUser' => 'Please check your credential again'
                        ]
                ]
            ];


            if(! $this->validate($rules)){
                // Validation Fail
                //echo("Error");
                $data['validation'] = $this->validator;         

            }else{

                    $objUserModel = new UserModel();

                    $loggedUser = $objUserModel->getLoggedUserByUserName($this->request->getVar('username'));

                    $this->userInformation($loggedUser);

                    if($loggedUser['user_role'] == 0){
                        return redirect()->to(base_url().'/dashboard')->with('admin_data', $loggedUser);
                    
                    }else{
                        return redirect()->to(base_url().'/user/dashboard')->with('user_data', $loggedUser);
                    
                    }

                    
                    // print_r($loggedUser);
                    // exit;

            }          

        }

       
        return view('login', $data);
       
    }

    
    public function register()
    {
     
        helper(['form']);
        echo view('layout/header');
        echo view('register');
        echo view('layout/footer');
       
    }

    private function userInformation($userData){

       $data = [
            'user_role' => $userData['user_role'],
            'username' => $userData['username'],
            'employee_id' => $userData['employee_id'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;

    }

    public function logout(){
        session()->destroy();
        return redirect()->to(base_url().'/');
    }
}
