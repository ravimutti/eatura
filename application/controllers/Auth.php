<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/controllers/MyController.php';
class Auth extends MyController
{
	/**
	 * Store constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->database();
		$this->load->model('Api_model');
		// $this->load->helper('cookie');
		$this->load->library('user_agent');
		
		$this->checkIsAuth();
	}


	public function registerAction()
	{
		if (!$this->input->is_ajax_request())
			exit('No direct script access allowed');

		$url = SITEURL . "register";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);
		echo json_encode($response);
		exit();
	}
	
	public function forgotsendlink() {
		if (!$this->input->is_ajax_request())
			exit('No direct script access allowed');

		$url = SITEURL . "forgotsendlink";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);
		echo json_encode($response);
		exit();
	}
	
	public function profile() {
		if(isset($this->session->userdata('userdata')['user']->userId)) {
			$this->load->view('profile');
		}
		else
		{
			redirect('/');
		}
	}
	
	public function changepassword()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		if(isset($this->session->userdata('userdata')['user']->userId)) {
			$_POST['id'] = $this->session->userdata('userdata')['user']->userId;
		}
		$url = SITEURL . "changepassword";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);
		
		echo json_encode($response);
	}
	
	public function updateprofile()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		if(isset($this->session->userdata('userdata')['user']->userId)) {
			$_POST['id'] = $this->session->userdata('userdata')['user']->userId;
		}
		$url = SITEURL . "updateprofile";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);
	
		echo json_encode($response);
	}

	public function loginAction()
	{
		if (!$this->input->is_ajax_request())
			exit('No direct script access allowed');

		$url = SITEURL . "login";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = json_decode(curl_exec($ch));
		curl_close($ch);

		if ($response->error == 202) {
			$response->delayTime = 2000;
			$response->locationReload = true;
			$session_data = array('token' => $response->token, "user" => $response->user);
			$this->session->set_userdata('userdata', $session_data);
			echo json_encode($response);
			exit();
		}


		echo json_encode($response);
		exit();
	}

	public function logoutAction()
	{
		$this->session->unset_userdata('userdata');
		return redirect($_SERVER['HTTP_REFERER']);
	}
}
