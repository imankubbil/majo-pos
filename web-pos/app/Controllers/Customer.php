<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Customer extends BaseController
{
    public function index()
    {
        $customer = [];

        $response = $this->client->get('customer');
        $customers = json_decode($response->getBody(), true);

        return view('customer/list', compact('customers'));
    }

    public function new() {
        return view('customer/add');
    }

    public function create()
    {
        
        $validatePayloadCustomer = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'required|min_length[3]|max_length[35]'
            ],
            'email' => [
                'label' => 'Email', 
                'rules' => 'required|valid_email'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|max_length[25]'
            ]
        ];

        $this->validation->setRules($validatePayloadCustomer);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $dataPostCustomer = $this->request->getPost();

            $param = [
                'name' => $dataPostCustomer['name'],
                'email' => $dataPostCustomer['email'],
                'password' => $dataPostCustomer['password'],
            ];
    
            $response = $this->client->post('customer', ['form_params' => $param]);
            $response = json_decode($response->getBody(), true);
            
            if($response['error'] === null) {
                return redirect()->to(site_url('customer'))->with('success', $response['message']);
            } else {
                return redirect()->to(site_url('customer'))->with('error', $response['error']);
            }
        } else {
            return redirect()->back()->with('error', $this->validation->listErrors());
        }
    }

    public function edit($id = null)
    {
		$response = $this->client->get("customer/{$id}");
        $response = json_decode($response->getBody(), true);

        $customer = $response['customer'];

        if(!empty($customer)) {
			return view('customer/edit', compact('customer'));
		}

		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function update($id = null)
    {   

        $validatePayloadCustomer = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'min_length[3]|max_length[35]'
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

        $this->validation->setRules($validatePayloadCustomer);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
    
            $dataPostCustomer = $this->request->getPost();
            unset($dataPostCustomer['_method']);

            $param = [
                'name' => $dataPostCustomer['name'],
                'email' => $dataPostCustomer['email'],
                'password' => $dataPostCustomer['password']
            ];
            
            if($dataPostCustomer['password'] === '') {
                unset($param['password']);
            }

            if(is_null($id)) {
                return redirect()->to(site_url('customer'))->with('error', ['customer' => 'Data Customer Not Found']);
            }

            $response = $this->client->put("customer/{$id}", ['form_params' => $param]);
            $response = json_decode($response->getBody(), true);

            if($response['error'] === null) {
                return redirect()->to(site_url('customer'))->with('success', $response['message']);
            } else {
                return redirect()->to(site_url('customer'))->with('error', $response['error']);
            }

        } else {
            return redirect()->back()->with('error', $this->validation->listErrors());
        }
    }

    public function delete($id = null)
    {
		$response = $this->client->delete("customer/{$id}");
        $response = json_decode($response->getBody(), true);

        if($response['error'] === null) {
            return redirect()->to(site_url('customer'))->with('success', $response['message']);
        } else {
            return redirect()->to(site_url('customer'))->with('error', $response['message']);
        }
    }
}
