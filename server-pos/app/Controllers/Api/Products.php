<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Products extends ResourceController
{
    protected $modelName    = 'App\Models\Api\ProductModel';
    protected $format       = 'json';

    public function index()
    {
        $status = 200;
        $error = null;

        $products = $this->model->getProducts();
        
        if(empty($products)) {
            $status = 204;
        }
        
        $response = [
            'status' => $status,
            'error' => $error,
            'products' => $products
        ];

        return $this->respond($response);
    }

    public function show($id = null)
    {
        $status = 200;
        $error = null;

        $product = $this->model->getProductById($id);
        
        if(empty($product)) {
            $status = 204;
        }
        
        $response = [
            'status' => $status,
            'error' => $error,
            'product' => $product
        ];

        return $this->respond($response);
    }

    public function create()
    {
        $status = 200;
        $error = null;
        $message = '';
        
        $validatePayloadProduct = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'required|min_length[3]|max_length[55]|is_unique[products.name]'
            ],
            'unit' => [
                'label' => 'Unit', 
                'rules' => 'required'
            ],
            'category' => [
                'label' => 'Category', 
                'rules' => 'required'
            ],
            'supplier' => [
                'label' => 'Supplier', 
                'rules' => 'required'
            ],
            'price' => [
                'label' => 'Price', 
                'rules' => 'required'
            ],
            'picture' => [
                'label' => 'Picture', 
                'rules' => 'required'
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required'
            ]
        ];

        $this->validation->setRules($validatePayloadProduct);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $payload = $this->request->getPost();

            $product = [
                'name' => $payload['name'],
                'unit_id' => $payload['unit'],
                'category_id' => $payload['category'],
                'supplier_id' => $payload['supplier'],
                'price' => $payload['price'],
                'picture' => $payload['picture'],
                'description' => $payload['description'],
            ];
    
            $modelResponse = $this->model->addProduct($product);
    
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
            'message' => $message,
        ];

        return $this->respond($response);
    }

    public function update($id = null)
    {
        $status = 200;
        $error = null;
        $message = '';
        
        $validatePayloadProduct = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'required|min_length[3]|max_length[55]'
            ],
            'unit_id' => [
                'label' => 'Unit', 
                'rules' => 'required'
            ],
            'category_id' => [
                'label' => 'Category', 
                'rules' => 'required'
            ],
            'supplier_id' => [
                'label' => 'Supplier', 
                'rules' => 'required'
            ],
            'price' => [
                'label' => 'Price', 
                'rules' => 'required'
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required'
            ]
        ];

        $this->validation->setRules($validatePayloadProduct);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $payloadProduct = $this->request->getRawInput();
            $payloadProduct['updated_at'] = date('Y-m-d H:i:s');

            $modelResponse = $this->model->updateProduct($id, $payloadProduct);
    
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
        $modelResponse = $this->model->deleteProduct($id);
    
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
