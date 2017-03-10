<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		// Set Property
		$this->Title = 'Test menu';
    }

	public function index()
	{
		echo $this->Title;
	}
}
