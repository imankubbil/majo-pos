<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Categories extends ResourceController
{
    protected $modelName    = 'App\Models\Api\CategoryModel';
    protected $format       = 'json';

    public function index()
    {
        $status = 200;
        $error = null;

        $categories = $this->model->getCategories();
        
        if(empty($unit)) {
            $status = 204;
        }
        
        $response = [
            'status' => $status,
            'error' => $error,
            'categories' => $categories
        ];

        return $this->respond($response);
    }

    public function show($id = null)
    {
        $status = 200;
        $error = null;

        $category = $this->model->getCategoryById($id);
        
        if(empty($category)) {
            $status = 204;
        }
        
        $response = [
            'status' => $status,
            'error' => $error,
            'category' => $category
        ];

        return $this->respond($response);
    }

    public function create()
    {
        $status = 200;
        $error = null;
        $message = '';
        
        $validatePayloadCategory = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'required|min_length[2]|max_length[35]|is_unique[categories.name]'
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required|max_length[55]'
            ]
        ];

        $this->validation->setRules($validatePayloadCategory);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $payload = $this->request->getPost();

            $unit = [
                'name' => $payload['name'],
                'description' => $payload['description']
            ];
    
    
            $modelResponse = $this->model->addCategory($unit);
    
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
        
        $validatePayloadCategory = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'max_length[35]'
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'max_length[55]'
            ]
        ];

        $this->validation->setRules($validatePayloadCategory);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $payloadCategory = $this->request->getRawInput();
            $payloadCategory['updated_at'] = date('Y-m-d H:i:s');

            $modelResponse = $this->model->updateCategory($id, $payloadCategory);
    
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
        $modelResponse = $this->model->deleteCategory($id);
    
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
