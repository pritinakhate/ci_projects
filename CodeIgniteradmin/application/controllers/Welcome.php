<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('User');
	}


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function index()
	{
		$this->load->view('login');
	}
	public function user()
	{

		$this->load->view('dashboard');
	}
	public function admin()
	{
		$id =	$_SESSION["id"];
		$data = array(
			'totalguest' => $this->User->guesttotalcount($id),
			"totaluser" => $this->User->usertotalcount(),
			'totalguestmale' => $this->User->guestmalecount($id),
			'totalguestfemale' => $this->User->guestfemalecount($id),
			"totalmaleuser" => $this->User->usermalecount(),
			"totalfemaleuser" => $this->User->userfemalecount(),
		);



		$this->load->view('dashboardadmin', $data);
	}
}