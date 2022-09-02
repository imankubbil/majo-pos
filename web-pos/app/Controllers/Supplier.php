<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Supplier extends BaseController
{
    public function index()
    {
        $supplier = [];

        $response = $this->client->get('supplier');
        $suppliers = json_decode($response->getBody(), true);

        return view('supplier/list', compact('suppliers'));
    }

    public function new() {
        return view('supplier/add');
    }

    public function create()
    {
        
        $validatePayloadSupplier = [
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

        $this->validation->setRules($validatePayloadSupplier);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $dataPostSupplier = $this->request->getPost();

            $param = [
                'name' => $dataPostSupplier['name'],
                'email' => $dataPostSupplier['email'],
                'address' => $dataPostSupplier['address'],
                'description' => $dataPostSupplier['description'],
                'phone' => $dataPostSupplier['phone'],
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
    
            $dataPostSupplier = $this->request->getPost();
            unset($dataPostSupplier['_method']);

            $param = [
                'name' => $dataPostSupplier['name'],
                'email' => $dataPostSupplier['email'],
                'address' => $dataPostSupplier['address'],
                'description' => $dataPostSupplier['description'],
                'phone' => $dataPostSupplier['phone'],
            ];

            if(is_null($id)) {
                return redirect()->to(site_url('supplier'))->with('error', ['supplier' => 'Data Supplier Not Found']);
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
