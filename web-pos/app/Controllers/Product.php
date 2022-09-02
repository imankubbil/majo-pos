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
                'label' => 'picture',
                'rules' => 'required'
            ],
            'description' => [
                'label' => 'description',
                'rules' => 'required'
            ]
        ];

        $this->validation->setRules($validatePayloadProduct);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $dataPostProduct = $this->request->getPost();

            $param = [
                'name' => $dataPostProduct['name'],
                'unit' => $dataPostProduct['unit'],
                'category' => $dataPostProduct['category'],
                'supplier' => $dataPostProduct['supplier'],
                'price' => $dataPostProduct['price'],
                'picture' => $dataPostProduct['picture'],
                'description' => $dataPostProduct['description'],
            ];

            $response = $this->client->post('product', ['form_params' => $param]);
            $response = json_decode($response->getBody(), true);

            if($response['error'] === null) {
                return redirect()->to(site_url('product'))->with('success', $response['message']);
            } else {
                return redirect()->to(site_url('product'))->with('error', $response['error']);
            }
        } else {
            return redirect()->back()->with('error', $this->validation->listErrors());
        }
    }

    public function edit($id = null)
    {
		$responseProduct = $this->client->get("product/{$id}");
        $responseProduct = json_decode($responseProduct->getBody(), true);
        $product = $responseProduct['product'];

        $responseUnit = $this->client->get('unit');
        $units = json_decode($responseUnit->getBody(), true);

        $responseCategory = $this->client->get('category');
        $categories = json_decode($responseCategory->getBody(), true);

        $responseSupplier = $this->client->get('supplier');
        $suppliers = json_decode($responseSupplier->getBody(), true);

        if(!empty($product)) {
			return view('product/edit', compact('product', 'units', 'categories', 'suppliers'));
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
            'description' => [
                'label' => 'description',
                'rules' => 'required'
            ]
        ];

        $this->validation->setRules($validatePayloadProduct);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
    
            $dataPostProduct = $this->request->getPost();
            unset($dataPostProduct['_method']);

            $param = [
                'name' => $dataPostProduct['name'],
                'unit_id' => $dataPostProduct['unit'],
                'category_id' => $dataPostProduct['category'],
                'supplier_id' => $dataPostProduct['supplier'],
                'price' => $dataPostProduct['price'],
                'picture' => $dataPostProduct['picture'],
                'description' => $dataPostProduct['description'],
            ];

            if($dataPostProduct['picture'] === '') { unset($param['picture']); };

            if(is_null($id)) {
                return redirect()->to(site_url('product'))->with('error', ['product' => 'Data Product Not Found']);
            }

            $response = $this->client->put("product/{$id}", ['form_params' => $param]);
            $response = json_decode($response->getBody(), true);

            if($response['error'] === null) {
                return redirect()->to(site_url('product'))->with('success', $response['message']);
            } else {
                return redirect()->to(site_url('product'))->with('error', $response['error']);
            }

        } else {
            return redirect()->back()->with('error', $this->validation->listErrors());
        }
    }

    public function delete($id = null)
    {
		$response = $this->client->delete("product/{$id}");
        $response = json_decode($response->getBody(), true);

        if($response['error'] === null) {
            return redirect()->to(site_url('product'))->with('success', $response['message']);
        } else {
            return redirect()->to(site_url('product'))->with('error', $response['message']);
        }
    }

    public function listProduct()
    {
        $product = [];

        $responseProduct = $this->client->get('product');
        $products = json_decode($responseProduct->getBody(), true);

        return view('product/listproduct', compact('products'));
    }
}
