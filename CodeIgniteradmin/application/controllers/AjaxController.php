<?php
class AjaxController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('AjaxModel');
	}
	public function index()
	{
		$this->load->view('Ajaxform');
	}

	public function savedata()
	{
		$image = '';

		if ($_FILES['image']['error'] == 0) {

			$config['upload_path'] = "./uploads/ajax_images";
			$config['allowed_types'] = "gif|jpg|png|jpeg|pdf";
			// $config['encrypt_name'] = True;
			$config['max_size'] = "204008"; //2MB size of image
			$config['max_height'] = "102422";
			$config['max_width'] = "768222";

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('image')) {
				$error = array('error' => $this->upload->display_errors());

				$this->session->set_flashdata('error', 'Unable to upload image');
			} else {
				$data = $this->upload->data();
				// $image = base_url('./uploads/ajax_images/' . $data['file_name']);
				$image = $data['file_name'];
			}
		}
		$hobbies = $this->input->post('hobby');
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'course' => $this->input->post('course'),
			'gender' => $this->input->post('gender'),
			'image' => $image,
			'hobby' => $hobbies,
			'created' => date('Y-m-d H-i-s')
		);

		$this->load->model('AjaxModel');
		$result = $this->AjaxModel->saveData($data);
		if ($result) {
			echo  1;
		} else {
			echo  0;
		}
	}

	public function ajax_list()
	{
		$this->load->view('Ajaxform_list');
	}
	public function ajaxlist_action()
	{
		$ajaxlist = $this->AjaxModel->getdata('ajaxs', '', '', '', 0);


		if ($ajaxlist) {
			$response = array(
				'status' => 'success',
				'data' => $ajaxlist
			);
		} else {
			$response = array(
				'status' => 'error',
				'data' => 'Not found'
			);
		}
		echo json_encode($response);
	}
}
