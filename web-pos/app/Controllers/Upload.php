<?php namespace App\Controllers;

use App\Controllers\BaseController;

class Upload extends BaseController
{
	// POST
    public function index()
    {

        $picture = [];
        $errorMessage = '';

        try
        {
            $this->validation->setRules([
                'picture' => 'uploaded[picture]|mime_in[picture,image/png]|max_size[picture, 5120] '
            ]);

            if($this->validation->withRequest($this->request)->run() === TRUE) {
                $file = $this->request->getFile('picture');

                $documentRootPath = $_SERVER["DOCUMENT_ROOT"];
                $documentPath = "/product";

                if($file->isValid() && ! $file->hasMoved()) {
                    $upload = $file->move("${documentRootPath}/upload/${documentPath}");

                    if(!$upload) {
                        $errorMessage = 'Failed to upload file';
                    }
                } else {
                    $errorMessage = $file->getErrorString().'('.$file->getError().')';
                }

				if($errorMessage === '') {
					$fileName = $file->getName();
	
					$picture['file_name'] = $fileName;
					$picture['picture_path'] = $documentPath;
					$picture['upload_date'] = date('Y-m-d H:i:s');
				}

            } else {
                $errorMessage = $this->validation->getErrors(); 
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }

        $response['code'] = $errorMessage == '' ? '00' : '04';
        $response['message'] = $errorMessage;
        $response['data'] = $picture;

        return json_encode($response);
    }
}