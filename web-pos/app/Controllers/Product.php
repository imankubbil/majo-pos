<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Product extends BaseController
{
    public function index()
    {
        $product = [];

        $responseProduct = $this->client->get('product');
        $products = json_decode($responseProduct->getBody(), true);

        return view('product/list', compact('products'));
    }

    public function new() {
        $responseUnit = $this->client->get('unit');
        $units = json_decode($responseUnit->getBody(), true);

        $responseCategory = $this->client->get('category');
        $categories = json_decode($responseCategory->getBody(), true);

        $responseSupplier = $this->client->get('supplier');
        $suppliers = json_decode($responseSupplier->getBody(), true);

        return view('product/add', compact('units', 'categories', 'suppliers'));
    }

    public function create()
    {
        
        $validatePayloadProduct = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'min_length[3]|max_length[55]'
            ],
            'email' => [
                'label' => 'Email', 
                'rules' => 'required|valid_email'
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

        $this->validation->setRules($validatePayloadProduct);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $dataPostProduct = $this->request->getPost();

            $param = [
                'name' => $dataPostProduct['name'],
                'email' => $dataPostProduct['email'],
                'address' => $dataPostProduct['address'],
                'description' => $dataPostProduct['description'],
                'phone' => $dataPostProduct['phone'],
            ];

            $response = $this->client->post('supplier', ['form_params' => $param]);
            $response = json_decode($response->getBody(), true);
            
            if($response['error'] === null) {
                return redirect()->to(site_url('supplier'))->with('success', $response['message']);
            } else {
                return redirect()->to(site_url('supplier'))->with('error', $response['error']);
            }
        } else {
            echo json_encode($this->validation->listErrors());die();
            return redirect()->back()->with('error', $this->validation->listErrors());
        }
    }

    public function edit($id = null)
    {
		$response = $this->client->get("supplier/{$id}");
        $response = json_decode($response->getBody(), true);

        $supplier = $response['supplier'];

        if(!empty($supplier)) {
			return view('supplier/edit', compact('supplier'));
		}

		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function update($id = null)
    {   

        $validatePayloadProduct = [
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

        $this->validation->setRules($validatePayloadProduct);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
    
            $dataPostProduct = $this->request->getPost();
            unset($dataPostProduct['_method']);

            $param = [
                'name' => $dataPostProduct['name'],
                'email' => $dataPostProduct['email'],
                'address' => $dataPostProduct['address'],
                'description' => $dataPostProduct['description'],
                'phone' => $dataPostProduct['phone'],
            ];

            if(is_null($id)) {
                return redirect()->to(site_url('supplier'))->with('error', ['supplier' => 'Data Product Not Found']);
            }

            $response = $this->client->put("supplier/{$id}", ['form_params' => $param]);
            $response = json_decode($response->getBody(), true);

            if($response['error'] === null) {
                return redirect()->to(site_url('supplier'))->with('success', $response['message']);
            } else {
                return redirect()->to(site_url('supplier'))->with('error', $response['error']);
            }

        } else {
            return redirect()->back()->with('error', $this->validation->listErrors());
        }
    }

    public function delete($id = null)
    {
		$response = $this->client->delete("supplier/{$id}");
        $response = json_decode($response->getBody(), true);

        if($response['error'] === null) {
            return redirect()->to(site_url('supplier'))->with('success', $response['message']);
        } else {
            return redirect()->to(site_url('supplier'))->with('error', $response['message']);
        }
    }
}
