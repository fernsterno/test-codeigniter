<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		// Set Property
		$this->Title = 'Test menu';
		$this->Menu = array(
			array('text'=>'test','link'=>'#'),
			array('text'=>'Test Set CI Session','link'=>'test_session/set_session'),
			array('text'=>'Test Get CI Session','link'=>'test_session/get_session'),
			array('text'=>'Destroy CI Session','link'=>'test_session/destroy')
		);
    }

	public function index()
	{
		echo $this->Title;
		
		echo '<html>';
		echo '<ul>';
		foreach($this->Menu as $value){
			echo '<li><a href="'.base_url().$value['link'].'" target="_blank">'.$value['text'].'</a></li>';
		}
		echo '</ul>';
		echo '</html>';
	}
}
