<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_session extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		// Set Property
		$this->Title = 'Session';
    }

	public function index()
	{
		echo $this->Title;
	}
	
	public function set_session()
	{
		$data = array('test'=>'Test');
		$this->session->set_userdata($data);
		echo 'Test set session "test"="'.$this->session->userdata('test').'" ';
	}
	
	public function get_session()
	{
		echo 'Test get session "test"='.$this->session->userdata('test');
	}
	
	public function destroy()
	{
		$this->session->sess_destroy();
		echo 'Destroy session complete';
	}
}
