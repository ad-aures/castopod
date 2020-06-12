<?php namespace App\Controllers;
use CodeIgniter\Controller;

class UnknownUserAgents extends Controller
{
    public function index($p_id = 0)
    {
        $model = new \App\Models\UnknownUserAgentsModel();

        $data = [
            'useragents' => $model->getUserAgents($p_id),
        ];

        $this->response->setContentType('application/json');
        $this->response->setStatusCode(\CodeIgniter\HTTP\Response::HTTP_OK);

        echo view('json/unknownuseragents', $data);
    }
}
