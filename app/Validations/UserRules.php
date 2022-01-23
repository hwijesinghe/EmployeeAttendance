<?php
namespace App\Validations;
use App\Models\UserModel;

class UserRules
{
    public function validatedUser(string $str, string $fields, array $data){

        $objModel = new UserModel();
        $user = $objModel->where('username', $data['username'])->first();

        if(!$user){
            return false;
        }else{

            if(base64_encode($data['password']) == $user['password']){
                return true;
            }else{
                return false;
            }

            // return password_verify(base64_encode($data['password']), $user['password']);
        }
    }
}


?>
