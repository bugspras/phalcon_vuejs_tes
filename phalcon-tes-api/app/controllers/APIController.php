<?php

use Phalcon\Http\Response;
use Phalcon\Http\Request;
use \Phalcon\Paginator\Adapter\QueryBuilder as PaginacionBuilder;

class APIController extends ControllerBase
{

    /**
     * Simple GET API Request
     * 
     * @method GET
     * @link /api/get
     */
    public function getAction()
    {
        $this->view->disable();
        $response = new Response();
        $request = new Request();

        if ($request->isGet()) {

            if($this->request->get("id")) {
                $returnData = Tes::findFirst($this->request->get("id"));
            }else {
                $returnData = Tes::find();
            }
            $returnResponse = [
                "code" => 200,
                "response" => "success",
                "message" => "Example of success data",
            ];

            $response->setStatusCode(200, 'OK');

            $response->setJsonContent(["status" => $returnResponse, "result" => $returnData ]);

        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->setHeader("Access-Control-Allow-Origin", '*')
        ->setHeader("Access-Control-Allow-Methods", 'GET,PUT,POST,DELETE,OPTIONS')
        ->setHeader("Access-Control-Allow-Headers", '*')
        ->setHeader("Access-Control-Allow-Credentials", true)
        ->send();
    }

    /**
     * Simple POST API Request without Param Data
     * 
     * @method POST
     * @link /api/insert
     */
    public function insertAction()
    {
        $this->view->disable();

        $response = new Response();

        $request = new Request();

        if ($request->isPost()) {
            
            $tes = new Tes();
	        
            $tes->name = $this->request->getPost('name', array('striptags', 'trim'));
	        $tes->sex = $this->request->getPost('sex', array('striptags', 'trim'));
	        $tes->religion = $this->request->getPost('religion', array('striptags', 'trim'));
	        $tes->phone = $this->request->getPost('phone', array('striptags', 'trim'));
	        $tes->address = $this->request->getPost('address', array('striptags', 'trim'));
	        $tes->nik = $this->request->getPost('nik', array('striptags', 'trim'));

            // Use Model for database Query
            if($tes->save()) { 
                $returnData = Tes::find();

                $returnResponse = [
                    "code" => 200,
                    "response" => "success",
                    "message" => "Example of success insert data",
                ];
                $response->setStatusCode(200, 'OK');
                $response->setJsonContent(["status" => $returnResponse, "result" => $returnData ]);
    
            }else{

                $returnResponse = [
                    "code" => 500,
                    "response" => "failed",
                    "message" => "Example of failed insert data",
                ];
                $response->setStatusCode(500, 'OK');
                $response->setJsonContent(["status" => $returnResponse, "result" => [] ]);
    

            }
        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->setHeader("Access-Control-Allow-Origin", '*')
        ->setHeader("Access-Control-Allow-Methods", 'GET')
        ->setHeader("Access-Control-Allow-Headers", '*')
        ->setHeader("Access-Control-Allow-Credentials", true)
        ->send();
    }

    
    /**
     * Simple POST API Request without Param Data
     * 
     * @method POST
     * @link /api/update
     */
    public function updateAction()
    {
        $this->view->disable();

        $response = new Response();

        $request = new Request();

        if (($request->isPost() == true) || ($request->isOptions() == true)) {
            
	        $parameters = array(
                "id" => $this->request->getPost('id')
            );

            $tes = Tes::findFirst(array(
                "id = :id:",
                "bind" => $parameters
            ));
            $tes->name = $this->request->getPost('name', array('striptags', 'trim'));
	        $tes->sex = $this->request->getPost('sex', array('striptags', 'trim'));
	        $tes->religion = $this->request->getPost('religion', array('striptags', 'trim'));
	        $tes->phone = $this->request->getPost('phone', array('striptags', 'trim'));
	        $tes->address = $this->request->getPost('address', array('striptags', 'trim'));
	        $tes->nik = $this->request->getPost('nik', array('striptags', 'trim'));

            if($tes->update()) { 

                $returnResponse = [
                    "code" => 200,
                    "response" => "success",
                    "message" => "Example of success update data",
                ];
                $response->setStatusCode(200, 'OK');
                $response->setJsonContent(["status" => $returnResponse, "result" => $tes ]);
    
            }else{

                $returnResponse = [
                    "code" => 500,
                    "response" => "failed",
                    "message" => "Example of failed update data",
                ];
                $response->setStatusCode(500, 'OK');
                $response->setJsonContent(["status" => $returnResponse, "result" => [] ]);
    

            }
        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->setHeader("Access-Control-Allow-Origin", '*')
        ->setHeader("Access-Control-Allow-Methods", 'POST,OPTIONS')
        ->setHeader("Access-Control-Allow-Headers", '*')
        ->setHeader("Access-Control-Allow-Credentials", true)
        ->send();
    }
    /**
     * Simple DELETE API Request without Param Data
     * 
     * @method DELETE
     * @link /api/delete
     */
    public function deleteAction()
    {
        $this->view->disable();
        $response = new Response();
        $request = new Request();

        if (($request->isDelete() == true) || ($request->isOptions() == true)) {
            // Use Model for database Query
            if($this->request->get("id")) {
                Tes::find(sprintf("id IN (%s)", $this->request->get("id")))->delete();
                $returnData = Tes::find();
                $returnResponse = [
                    "code" => 200,
                    "response" => "success",
                    "message" => "Example of success delete data",
                ];
    
                $response->setStatusCode(200, 'OK');
    
                $response->setJsonContent(["status" => $returnResponse, "result" => $returnData ]);
    
            }else {
                $returnResponse = [
                    "code" => 500,
                    "response" => "failed",
                    "message" => "Example of failed delete data",
                ];
    
                $response->setStatusCode(500, 'OK');
    
                $response->setJsonContent(["status" => $returnResponse, "result" => [] ]);
            }
        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->setHeader("Access-Control-Allow-Origin", '*')
        ->setHeader("Access-Control-Allow-Methods", 'DELETE,OPTIONS')
        ->setHeader("Access-Control-Allow-Headers", '*')
        ->setHeader("Access-Control-Allow-Credentials", true)
        ->send();
    }

}