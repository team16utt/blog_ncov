<?php

namespace App\Controllers;

use App\Models\NewModel;

class Dieucanbiet extends BaseController
{
	public function index()
	{
		$DCBModel = new NewModel();
		$DCB = $DCBModel->getAllDCB();
		$data['DCB'] = $DCB;
		return view('client/dieu-can-biet', $data);
	}
}