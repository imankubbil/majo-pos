<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Customers extends ResourceController
{
    protected $modelName    = 'App\Models\Api\CustomerModel';
    protected $format       = 'json';

    public function index()
    {
        $status = 200;
        $error = null;

        $customers = $this->model->getCustomers();
        
        if(empty($customers)) {
            $status = 204;
        }
        
        $response = [
            'status' => $status,
            'error' => $error,
            'customers' => $customers
        ];

        return $this->respond($response);
    }

    public function show($id = null)
    {
        $status = 200;
        $error = null;

        $customer = $this->model->getCustomerById($id);
        
        if(empty($customer)) {
            $status = 204;
        }
        
        $response = [
            'status' => $status,
            'error' => $error,
            'customer' => $customer
        ];

        return $this->respond($response);
    }

    public function create()
    {
        $status = 200;
        $error = null;
        $message = '';
        
        $validatePayloadCustomer = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'required|min_length[3]|max_length[35]|is_unique[customers.name]'
            ],
            'email' => [
                'label' => 'Email', 
                'rules' => 'required|valid_email|is_unique[customers.email]'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|max_length[25]'
            ]
        ];

        $this->validation->setRules($validatePayloadCustomer);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $payload = $this->request->getPost();

            $customer = [
                'name' => $payload['name'],
                'email' => $payload['email'],
                'password' => password_hash($payload['password'], PASSWORD_BCRYPT)
            ];
    
            $modelResponse = $this->model->addCustomer($customer);
    
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
        
        $validatePayloadCustomer = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'max_length[35]|is_unique[customers.name]'
            ],
            'email' => [
                'label' => 'Email', 
                'rules' => 'valid_email|is_unique[customers.email]'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'max_length[25]'
            ]
        ];

        $this->validation->setRules($validatePayloadCustomer);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $payloadCustomer = $this->request->getRawInput();

            if(isset($payloadCustomer['password'])) {
                $passwordHashCustomer = password_hash($payloadCustomer['password'], PASSWORD_BCRYPT);
                $payloadCustomer['password'] = $passwordHashCustomer;
            }

            $payloadCustomer['updated_at'] = date('Y-m-d H:i:s');

            $modelResponse = $this->model->updateCustomer($id, $payloadCustomer);
    
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
        $modelResponse = $this->model->deleteCustomer($id);
    
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
