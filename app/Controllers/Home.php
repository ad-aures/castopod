<?php

namespace App\Controllers;

use App\Models\PodcastModel;

class Home extends BaseController
{
	public function index()
	{
		$model = new PodcastModel();
		$data = ["podcasts" => $model->findAll()];

		return view('home', $data);
	}

	//--------------------------------------------------------------------

}
