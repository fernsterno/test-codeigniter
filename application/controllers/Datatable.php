<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		// Set Property
		$this->title = 'Datatable';
    }

	public function index()
	{
		$data['title'] = $this->title;
		$this->load->view('datatable',$data);
	}
	

}
