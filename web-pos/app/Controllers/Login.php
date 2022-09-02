<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    protected $modelName    = 'App\Models\Api\AdminModel';

    public function index()
    {
        return view('login');
    }

    public function loginProcess()
	{
		try
		{

			$validatePayload = [
				'email' => [
					'label' => 'Email', 
					'rules' => 'required|valid_email|max_length[35]'
				],
				'password' => [
					'label' => 'Password',
					'rules' => 'required|min_length[3]|max_length[35]'
				]
			];

			$this->validation->setRules($validatePayload);

			if($this->validation->withRequest($this->request)->run() === TRUE) {
				$postData = $this->request->getPost();
                $param = [
                    'email' => $postData['email'],
                    'password' => $postData['password']
                ];

                $response = $this->client->post('login', ['form_params' => $param]);
                $response = json_decode($response->getBody(), true);

				if($response['error'] === null) {
                    session()->set($response['user']);
					return redirect()->to(site_url('dashboard'))->with('success', $response['message']);
				} else {
					return redirect()->with('error', $response['message']);
				}
			} else {
				return redirect()->back()->with('error', $this->validation->listErrors());
			}

		}
		catch (\Exception $e)
		{
			return redirect()->back()->with('error', $e->getMessage());
		}
	}

	public function logout()
	{
		$session = session();
        $session->destroy();
        return redirect()->to('/');
	}
}
