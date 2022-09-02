<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Category extends BaseController
{
    public function index()
    {
        $category = [];

        $response = $this->client->get('category');
        $categories = json_decode($response->getBody(), true);

        return view('category/list', compact('categories'));
    }

    public function new() {
        return view('category/add');
    }

    public function create()
    {
        
        $validatePayloadCategory = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'required|min_length[3]|max_length[35]'
            ],
            'description' => [
                'label' => 'Description', 
                'rules' => 'required|max_length[85]'
            ]
        ];

        $this->validation->setRules($validatePayloadCategory);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $dataPostCategory = $this->request->getPost();

            $param = [
                'name' => $dataPostCategory['name'],
                'description' => $dataPostCategory['description'],
            ];
    
            $response = $this->client->post('category', ['form_params' => $param]);
            $response = json_decode($response->getBody(), true);
            
            if($response['error'] === null) {
                return redirect()->to(site_url('category'))->with('success', $response['message']);
            } else {
                return redirect()->to(site_url('category'))->with('error', $response['error']);
            }
        } else {
            return redirect()->back()->with('error', $this->validation->listErrors());
        }
    }

    public function edit($id = null)
    {
		$response = $this->client->get("category/{$id}");
        $response = json_decode($response->getBody(), true);

        $category = $response['category'];

        if(!empty($category)) {
			return view('category/edit', compact('category'));
		}

		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function update($id = null)
    {   

        $validatePayloadCategory = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'min_length[3]|max_length[35]'
            ],
            'description' => [
                'label' => 'Description', 
                'rules' => 'max_length[85]'
            ]
        ];

        $this->validation->setRules($validatePayloadCategory);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
    
            $dataPostCategory = $this->request->getPost();
            unset($dataPostCategory['_method']);

            $param = [
                'name' => $dataPostCategory['name'],
                'description' => $dataPostCategory['description'],
            ];

            if(is_null($id)) {
                return redirect()->to(site_url('category'))->with('error', ['category' => 'Data Category Not Found']);
            }

            $response = $this->client->put("category/{$id}", ['form_params' => $param]);
            $response = json_decode($response->getBody(), true);

            if($response['error'] === null) {
                return redirect()->to(site_url('category'))->with('success', $response['message']);
            } else {
                return redirect()->to(site_url('category'))->with('error', $response['error']);
            }

        } else {
            return redirect()->back()->with('error', $this->validation->listErrors());
        }
    }

    public function delete($id = null)
    {
		$response = $this->client->delete("category/{$id}");
        $response = json_decode($response->getBody(), true);

        if($response['error'] === null) {
            return redirect()->to(site_url('category'))->with('success', $response['message']);
        } else {
            return redirect()->to(site_url('category'))->with('error', $response['message']);
        }
    }
}
