<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Admins extends ResourceController
{
    protected $modelName    = 'App\Models\Api\AdminModel';
    protected $format       = 'json';

    public function index()
    {
        $status = 200;
        $error = null;

        $admins = $this->model->getAdmins();
        
        if(empty($admins)) {
            $status = 204;
        }
        
        $response = [
            'status' => $status,
            'error' => $error,
            'admins' => $admins
        ];

        return $this->respond($response);
    }

    public function show($id = null)
    {
        $status = 200;
        $error = null;

        $admin = $this->model->getAdminById($id);
        
        if(empty($admin)) {
            $status = 204;
        }
        
        $response = [
            'status' => $status,
            'error' => $error,
            'admin' => $admin
        ];

        return $this->respond($response);
    }

    public function create()
    {
        $status = 200;
        $error = null;
        $message = '';
        
        $validatePayloadAdmin = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'required|min_length[3]|max_length[35]|is_unique[admins.name]'
            ],
            'email' => [
                'label' => 'Email', 
                'rules' => 'required|valid_email|is_unique[admins.email]'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|max_length[25]'
            ]
        ];

        $this->validation->setRules($validatePayloadAdmin);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $payload = $this->request->getPost();

            $admin = [
                'name' => $payload['name'],
                'email' => $payload['email'],
                'password' => password_hash($payload['password'], PASSWORD_BCRYPT)
            ];
    
            $modelResponse = $this->model->addAdmin($admin);
    
            if($modelResponse) {
                $message = 'Data Saved Successfully';
            } else {
                $message = 'Data Failed to Save';
            }

        } else {
            $error = $this->validation->getErrors();
        }
        
        $response = [
            'status' => $status,
            'error' => $error,
            'message' => $message
        ];

        return $this->respond($response);
    }

    public function update($id = null)
    {
        $status = 200;
        $error = null;
        $message = '';
        
        $validatePayloadAdmin = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'max_length[35]'
            ],
            'email' => [
                'label' => 'Email', 
                'rules' => 'valid_email'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'max_length[25]'
            ]
        ];

        $this->validation->setRules($validatePayloadAdmin);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $payloadAdmin = $this->request->getRawInput();

            if(isset($payloadAdmin['password'])) {
                $passwordHashAdmin = password_hash($payloadAdmin['password'], PASSWORD_BCRYPT);
                $payloadAdmin['password'] = $passwordHashAdmin;
            }

            $payloadAdmin['updated_at'] = date('Y-m-d H:i:s');

            $modelResponse = $this->model->updateAdmin($id, $payloadAdmin);
    
            if($modelResponse) {
                $message = 'Data Updated Successfully';
            } else {
                $message = 'Data Failed to Update';
            }
        } else {
            $error = $this->validation->getErrors();
        }
        
        $response = [
            'status' => $status,
            'error' => $error,
            'message' => $message
        ];

        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $modelResponse = $this->model->deleteAdmin($id);
    
        if($modelResponse) {
            $message = 'Data Deleted Successfully';
        } else {
            $message = 'Data Failed to Delete';
        }

        $response = [
            'status' => 200,
            'error' => null,
            'message' => $message
        ];

        return $this->respond($response);
    }

    
}
