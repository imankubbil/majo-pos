<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Unit extends BaseController
{
    public function index()
    {
        $unit = [];

        $response = $this->client->get('unit');
        $units = json_decode($response->getBody(), true);

        return view('unit/list', compact('units'));
    }

    public function new() {
        return view('unit/add');
    }

    public function create()
    {
        
        $validatePayloadUnit = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'required|min_length[3]|max_length[35]'
            ],
            'description' => [
                'label' => 'Description', 
                'rules' => 'required|max_length[85]'
            ]
        ];

        $this->validation->setRules($validatePayloadUnit);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $dataPostUnit = $this->request->getPost();

            $param = [
                'name' => $dataPostUnit['name'],
                'description' => $dataPostUnit['description'],
            ];
    
            $response = $this->client->post('unit', ['form_params' => $param]);
            $response = json_decode($response->getBody(), true);
            
            if($response['error'] === null) {
                return redirect()->to(site_url('unit'))->with('success', $response['message']);
            } else {
                return redirect()->to(site_url('unit'))->with('error', $response['error']);
            }
        } else {
            return redirect()->back()->with('error', $this->validation->listErrors());
        }
    }

    public function edit($id = null)
    {
		$response = $this->client->get("unit/{$id}");
        $response = json_decode($response->getBody(), true);

        $unit = $response['unit'];

        if(!empty($unit)) {
			return view('unit/edit', compact('unit'));
		}

		throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function update($id = null)
    {   

        $validatePayloadUnit = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'min_length[3]|max_length[35]'
            ],
            'description' => [
                'label' => 'Description', 
                'rules' => 'max_length[85]'
            ]
        ];

        $this->validation->setRules($validatePayloadUnit);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
    
            $dataPostUnit = $this->request->getPost();
            unset($dataPostUnit['_method']);

            $param = [
                'name' => $dataPostUnit['name'],
                'description' => $dataPostUnit['description'],
            ];

            if(is_null($id)) {
                return redirect()->to(site_url('unit'))->with('error', ['unit' => 'Data Unit Not Found']);
            }

            $response = $this->client->put("unit/{$id}", ['form_params' => $param]);
            $response = json_decode($response->getBody(), true);

            if($response['error'] === null) {
                return redirect()->to(site_url('unit'))->with('success', $response['message']);
            } else {
                return redirect()->to(site_url('unit'))->with('error', $response['error']);
            }

        } else {
            return redirect()->back()->with('error', $this->validation->listErrors());
        }
    }

    public function delete($id = null)
    {
		$response = $this->client->delete("unit/{$id}");
        $response = json_decode($response->getBody(), true);

        if($response['error'] === null) {
            return redirect()->to(site_url('unit'))->with('success', $response['message']);
        } else {
            return redirect()->to(site_url('unit'))->with('error', $response['message']);
        }
    }
}
