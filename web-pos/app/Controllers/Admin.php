<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Admin extends BaseController
{
    public function index()
    {
        $admin = [];

        $response = $this->client->get('admin');
        $admins = json_decode($response->getBody(), true);

        return view('admin/list', compact('admins'));
    }

    public function new() {
        return view('admin/add');
    }

    public function create()
    {
        
        $validatePayloadAdmin = [
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

        $this->validation->setRules($validatePayloadAdmin);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $dataPostAdmin = $this->request->getPost();

            $param = [
                'name' => $dataPostAdmin['name'],
                'email' => $dataPostAdmin['email'],
                'password' => $dataPostAdmin['password'],
            ];
    
            $response = $this->client->post('admin', ['form_params' => $param]);
            $response = json_decode($response->getBody(), true);
            
            if($response['error'] === null) {
                return redirect()->to(site_url('admin'))->with('success', $response['message']);
            } else {
                return redirect()->to(site_url('admin'))->with('error', $response['error']);
            }
        } else {
            return redirect()->back()->with('error', $this->validation->listErrors());
        }
    }

    public function edit($id = null)
    {
		$response = $this->client->get("admin/{$id}");
        $response = json_decode($response->getBody(), true);

        $admin = $response['admin'];

        if(!empty($admin)) {
			return view('admin/edit', compact('admin'));
		}

		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function update($id = null)
    {   

        $validatePayloadAdmin = [
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

        $this->validation->setRules($validatePayloadAdmin);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
    
            $dataPostAdmin = $this->request->getPost();
            unset($dataPostAdmin['_method']);

            $param = [
                'name' => $dataPostAdmin['name'],
                'email' => $dataPostAdmin['email'],
                'password' => $dataPostAdmin['password']
            ];
            
            if($dataPostAdmin['password'] === '') {
                unset($param['password']);
            }

            if(is_null($id)) {
                return redirect()->to(site_url('admin'))->with('error', ['admin' => 'Data Admin Not Found']);
            }

            $response = $this->client->put("admin/{$id}", ['form_params' => $param]);
            $response = json_decode($response->getBody(), true);

            if($response['error'] === null) {
                return redirect()->to(site_url('admin'))->with('success', $response['message']);
            } else {
                return redirect()->to(site_url('admin'))->with('error', $response['error']);
            }

        } else {
            return redirect()->back()->with('error', $this->validation->listErrors());
        }
    }

    public function delete($id = null)
    {
		$response = $this->client->delete("admin/{$id}");
        $response = json_decode($response->getBody(), true);

        if($response['error'] === null) {
            return redirect()->to(site_url('admin'))->with('success', $response['message']);
        } else {
            return redirect()->to(site_url('admin'))->with('error', $response['message']);
        }
    }
}
