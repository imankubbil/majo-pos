<?php namespace App\Controllers;

use App\Controllers\BaseController;

class Upload extends BaseController
{
	// POST
    public function index()
    {

        $picture = [];
        $postData = $_FILES;

        try
        {
            $this->validation->setRules([
                'picture' => 'uploaded[file]|mime_in[png]|max_size[document, 5120] '
            ]);

            if($this->validation->withRequest($this->request)->run() === TRUE) {
                $file = $this->request->getFile('picture');

                $documentRootPath = $_SERVER["DOCUMENT_ROOT"];
                $documentPath = "/upload";

                if($file->isValid() && ! $file->hasMoved()) {
                    $upload = $file->move("${documentRootPath}/assets/${documentPath}");

                    if(!$upload) {
                        $errorMessage = 'Failed to upload file';
                    }
                } else {
                    $errorMessage = $file->getErrorString().'('.$file->getError().')';
                }

                $fileName = $file->getName();

                $picture['file_name'] = $fileName;
                $picture['picture_path'] = $documentPath;
                $picture['upload_date'] = $this->appHelper->getCurrentDatetime();
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