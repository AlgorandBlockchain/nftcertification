<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notfound extends CI_Controller {

	
	public function index()
	{
		$data['title'] = "Error 404";
		$data['subtitle'] = "Page Not Found";
		$data['description'] = "description halaman page not found";
		$data['view_isi'] = "view_404";
		$this->load->view('layout/template_top',$data);
	}
}
