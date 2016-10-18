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
		render('reports/index');
	}
	public function map()
	{
		render('reports/map');
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

	public function read($id)
	{
		$r = $this->model->read($id)->row();
		vars($r);
		render('reports/read');
	}

	public function update($id = NULL)
	{
		if(method() === 'post')
		{
			extract(post());
			$this->model->update($id, post());
			redirect(site_url('Report/update/' . $id));
		}
		else
		{
			$r = $this->model->read($id)->row();
			vars($r);
			render('reports/update');
		}
	}

	public function delete($id)
	{
		return $this->model->delete($id);
	}
}
