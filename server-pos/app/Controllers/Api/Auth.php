<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{
    protected $modelName    = 'App\Models\Api\AdminModel';
    protected $format       = 'json';

    public function index()
	{
        $response = [
            'status' => 200,
            'error' => null,
            'message' => ''
        ];

        $validatePayloadLogin = [
            'email' => [
                'label' => 'Email', 
                'rules' => 'required|valid_email|max_length[35]'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[5]|max_length[35]'
            ]
        ];

        $this->validation->setRules($validatePayloadLogin);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $postData = $this->request->getPost();

            $user = $this->model->getAdminByEmail($postData['email']);
            
            if($user) {   
                if(password_verify($postData['password'], $user->password))
                {
                    $dataSessionAdmin = [
                        'id' => $user->id,
                        'name' => $user->name,
                        'createdAt' => $user->created_at,
                        'updatedAt'	=> $user->updated_at,
                        'logged_in' => TRUE,
                    ];
                    
                    $response['message'] = 'You have successfully logged in';
                    $response['user'] = $dataSessionAdmin;
                } else {
                    $response['status'] = 401;
                    $response['message'] = 'You failed to login';
                }
            } else {
                $response['status'] = 401;
                $response['message'] = 'Email Not Found';
            }
        } else {
            return redirect()->back()->with('error', $this->validation->listErrors());
        }

        return $this->respond($response);
	}

	public function logout() {
		$session = session();
        $session->destroy();
        return redirect()->to('/');
	}
}