<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Report extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		model('report_model', 'model');
	}
	public function index()
	{
		$reports = $this->model->all()->result();
		vars(['reports' => $reports]);
		render('index');
	}
	public function map()
	{
		render('map');
	}

	public function search()
	{
		if(method() === 'post')
		{
			$result = $this->model->search(post());
			showJsonView(array('result' => $result));
		}
	}

	public function create()
	{
		if(method() === 'post')
		{
			$result = $this->model->create(post());
			showJsonView(array('result' => $result));
		}
	}
}
