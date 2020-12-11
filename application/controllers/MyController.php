<?php 

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class MyController extends BaseController {

	public $uri_slug = SLUG;
	public function __construct()
	{
		parent::__construct();
		$this->uri_slug = $this->uri->segment(1);
	}
}