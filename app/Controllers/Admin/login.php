<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class login extends BaseController
{
    public function index()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
			//let's do the validation here
			$rules = [
				'username' => 'required|max_length[50]',
				'password' => 'required|max_length[255]',
			];

			$errors = [
				'password' => [
					'validateUser' => 'Username/Email or Password don\'t match'
				]
			];

			if (! $this->validate($rules, $errors)) {
				$data['validation'] = $this->validator;
			}else{
                session_start();
				$model = new UserModel();
                $username = $this->request->getVar('username');
                $password = $this->request->getVar('password');
                $hashed_password = md5($password);
                $data = ['username' => $username,
                        "password"=>$password];
                $user = $model->where($data)->first();
                if($user){
                // $this->setUserSession($user);
                $_SESSION['user'] = $user;
				// $session->set('user', $user);
                return redirect()->to('Home');}
                else {
                    echo '<script>alert("Username/Email or Password don\'t match");</script>';
                }

			}
		}

        return view('admin/login');
        //--------------------------------------------------------------------
    }
    private function setUserSession($user){
		$data = [
			'id' => $user['id'],
			'username' => $user['username'],
			'fullname' => $user['fullname'],
			'email' => $user['email'],
			'isLoggedIn' => true,
		];

		session()->set($data);
		return true;
	}
}

