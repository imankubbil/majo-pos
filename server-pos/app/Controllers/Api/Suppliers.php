<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Suppliers extends ResourceController
{
    protected $modelName    = 'App\Models\Api\SupplierModel';
    protected $format       = 'json';

    public function index()
    {
        $status = 200;
        $error = null;

        $suppliers = $this->model->getSuppliers();
        
        if(empty($suppliers)) {
            $status = 204;
        }
        
        $response = [
            'status' => $status,
            'error' => $error,
            'suppliers' => $suppliers
        ];

        return $this->respond($response);
    }

    public function show($id = null)
    {
        $status = 200;
        $error = null;

        $supplier = $this->model->getSupplierById($id);
        
        if(empty($supplier)) {
            $status = 204;
        }
        
        $response = [
            'status' => $status,
            'error' => $error,
            'supplier' => $supplier
        ];

        return $this->respond($response);
    }

    public function create()
    {
        $status = 200;
        $error = null;
        $message = '';
        
        $validatePayloadSupplier = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'required|min_length[3]|max_length[55]|is_unique[suppliers.name]'
            ],
            'email' => [
                'label' => 'Email', 
                'rules' => 'required|valid_email|is_unique[suppliers.email]'
            ],
            'address' => [
                'label' => 'Address', 
                'rules' => 'required|max_length[85]'
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required|max_length[55]'
            ],
            'phone' => [
                'label' => 'Phone',
                'rules' => 'required|max_length[13]'
            ]
        ];

        $this->validation->setRules($validatePayloadSupplier);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $payload = $this->request->getPost();

            $supplier = [
                'name' => $payload['name'],
                'email' => $payload['email'],
                'address' => $payload['address'],
                'description' => $payload['description'],
                'phone' => $payload['phone'],
            ];
    
    
            $modelResponse = $this->model->addSupplier($supplier);
    
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
        
        $validatePayloadSupplier = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'min_length[3]|max_length[55]'
            ],
            'email' => [
                'label' => 'Email', 
                'rules' => 'valid_email'
            ],
            'address' => [
                'label' => 'Address', 
                'rules' => 'max_length[85]'
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'max_length[55]'
            ],
            'phone' => [
                'label' => 'Phone',
                'rules' => 'max_length[13]'
            ]
        ];

        $this->validation->setRules($validatePayloadSupplier);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $payloadSupplier = $this->request->getRawInput();
            $payloadSupplier['updated_at'] = date('Y-m-d H:i:s');

            $modelResponse = $this->model->updateSupplier($id, $payloadSupplier);
    
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
        $modelResponse = $this->model->deleteSupplier($id);
    
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
