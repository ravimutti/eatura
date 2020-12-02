<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 
/**
 * Class : BaseController (BaseController)
 * @author : Ravinder singh / ravimutti.mutti@gmail.com
 * @version : 1.0
 * @since : 10.08.2020
 */
class BaseController extends CI_Controller {
	public $pageParam = null;
	function __construct() 
	{
		$this->pageParam = new stdClass();
        parent::__construct();
		$this->pageParam->isAuth = false;
    }
	
	public function checkIsAuth() {
		if(isset($this->session->userdata('userdata')['token']))
		{
			$url = SITEURL . "authenticateToken";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, array('token' => $this->session->userdata('userdata')['token'], 'userId' => $this->session->userdata('userdata')['user']->userId));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = json_decode(curl_exec($ch));
			curl_close($ch);
			
			if ($response->error == 202) {
				//echo '<pre>'; print_r($response->data); die;
				if(isset($response->data->userId) && isset($response->data->email) && isset($response->data->role)) {
					if($response->data->userId == $this->session->userdata('userdata')['user']->userId 
					&& $response->data->email == $this->session->userdata('userdata')['user']->email
					&& $response->data->role == $this->session->userdata('userdata')['user']->role) {
						$this->pageParam->isAuth = true;
					}
				}
			}
			
			
		}
		
	}
}