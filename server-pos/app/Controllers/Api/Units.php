<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class Units extends ResourceController
{
    protected $modelName    = 'App\Models\Api\UnitModel';
    protected $format       = 'json';

    public function index()
    {
        $status = 200;
        $error = null;

        $units = $this->model->getUnits();
        
        if(empty($units)) {
            $status = 204;
        }
        
        $response = [
            'status' => $status,
            'error' => $error,
            'units' => $units
        ];

        return $this->respond($response);
    }

    public function show($id = null)
    {
        $status = 200;
        $error = null;

        $unit = $this->model->getUnitById($id);
        
        if(empty($unit)) {
            $status = 204;
        }
        
        $response = [
            'status' => $status,
            'error' => $error,
            'unit' => $unit
        ];

        return $this->respond($response);
    }

    public function create()
    {
        $status = 200;
        $error = null;
        $message = '';
        
        $validatePayloadUnit = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'required|min_length[2]|max_length[35]|is_unique[units.name]'
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required|max_length[55]'
            ]
        ];

        $this->validation->setRules($validatePayloadUnit);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $payload = $this->request->getPost();

            $unit = [
                'name' => $payload['name'],
                'description' => $payload['description']
            ];
    
    
            $modelResponse = $this->model->addUnit($unit);
    
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
        
        $validatePayloadUnit = [
            'name' => [
                'label' => 'Name', 
                'rules' => 'max_length[35]|is_unique[units.name]'
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'max_length[55]'
            ]
        ];

        $this->validation->setRules($validatePayloadUnit);

        if($this->validation->withRequest($this->request)->run() === TRUE) {
            $payloadUnit = $this->request->getRawInput();
            $payloadUnit['updated_at'] = date('Y-m-d H:i:s');

            $modelResponse = $this->model->updateUnit($id, $payloadUnit);
    
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
        $modelResponse = $this->model->deleteUnit($id);
    
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
