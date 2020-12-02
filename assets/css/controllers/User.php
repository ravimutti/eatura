<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Ravinder singh / ravimutti.mutti@gmail.com
 * @version : 1.0
 * @since : 10.08.2020
 */
class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->isLoggedIn();
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
      
            $this->global['pageTitle'] = 'DashBoard';
			$data=array();
            $this->loadViews("dashboard/index", $this->global, $data, NULL);
           
    }
	public function addNew()
    {
            $data['roles'] = $this->User_model->getUserRoles();
            $this->global['pageTitle'] = 'Eatura : Add New Store';
            $this->loadViews("users/addnew", $this->global, $data, NULL);
    }
	
	public function updaterestaurant($id) {
		$obj = $this->User_model->getUserById($id);
		if($obj == null) 
		{
			redirect('store/restaurant');	
		}
		$data['roles'] = $this->User_model->getUserRoles();
		$data['obj'] = $obj;
		$this->global['pageTitle'] = 'Eatura : Edit Store';
		$this->loadViews("users/addnew", $this->global, $data, NULL);
	}
	
	function addNewUser()
    {
		
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name','Store Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('oname','Owner/Manager','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|callback_EmailExists|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('password_confirm','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('phone','Mobile Number','required|min_length[10]');
            $this->form_validation->set_rules('description','description','required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
				$logo = $banner = '';
				$config = array(
					'upload_path' => FCPATH."assets/uploads/restaurant",
					'allowed_types' => 'jpg|png|jpeg|gif',
					'max_size' => "20048"
				);
				$this->load->library('upload', $config);
				 if($this->upload->do_upload('logo')){
					  $uploadedimage = $this->upload->data();
					  $logo=$uploadedimage['file_name'];
				 }
				 else 
				 {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					 redirect('store/addnew');							 
				 }
				 
				 $config = array(
					'upload_path' => FCPATH."assets/uploads/restaurant",
					'allowed_types' => 'jpg|png|jpeg|gif',
					'max_size' => "20048"
				);
				$this->load->library('upload', $config);
				 if($this->upload->do_upload('banner')){
					  $uploadedimage = $this->upload->data();
					  $banner=$uploadedimage['file_name'];
				 }
				 else 
				 {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					 redirect('store/addnew');							 
				 }
				
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('name'))));
                $slugname = $this->slugify(ucwords(strtolower($this->security->xss_clean($this->input->post('name')))));
				  $oname = ucwords(strtolower($this->security->xss_clean($this->input->post('oname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('phone'));
                $description = $this->security->xss_clean($this->input->post('description'));
                
                $userInfo = array(
								'email'=>$email, 
								'password'=>getHashedPassword($password),
								'roleId'=>$roleId, 
								'name'=> $name,
								'slugname'=> $slugname,
								'cname'=> $oname,
								'mobile'=>$mobile, 
								'aboutus'=>$description, 
								'createdBy'=>$this->vendorId, 
								'createdDtm'=>date('Y-m-d H:i:s'),
								'banner'=>$banner,
								'logo'=>$logo,
								);
								
                $result = $this->User_model->addNewUser($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Store created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Store creation failed');
                }
                
                redirect('store/addnew');
            }
      
    }
	/**
     * This function is used list of stores
     */
    function storeList()
    {
		 $this->global['pageTitle'] = 'Restaurant List';
			$data['storelist']=$this->User_model->userListing();
            $this->loadViews("users/storelist", $this->global, $data, NULL);
	}
    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->User_model->checkEmailExists($email);
        } else {
            $result = $this->User_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
 function EmailExists($email)
    {
		$result = $this->User_model->checkEmailExists($email);
		if(empty($result)){ return true; }
		else {  return false; }
    }
    /**
     * This function is used to load edit user view
     */
    function loadUserEdit()
    {
        $this->global['pageTitle'] = 'Eatura: Edit User';
        
        $data['userInfo'] = $this->user_model->getUserInfo($this->vendorId);

        $this->loadViews("userEdit", $this->global, $data, NULL);
    }
    /**
     * This function is used to update the of the user info
     */
    function updateUser()
    {
        $this->load->library('form_validation');
            
        $userId = $this->input->post('userId');
        
        $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
        $this->form_validation->set_rules('oldpassword','Old password','max_length[20]');
        $this->form_validation->set_rules('cpassword','Password','matches[cpassword2]|max_length[20]');
        $this->form_validation->set_rules('cpassword2','Confirm Password','matches[cpassword]|max_length[20]');
        $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->loadUserEdit();
        }
        else
        {
            $name = $this->security->xss_clean($this->input->post('fname'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $password = $this->input->post('cpassword');
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $cname = $this->security->xss_clean($this->input->post('cname'));
            $opentime = $this->security->xss_clean($this->input->post('opentime'));
            $closetime = $this->security->xss_clean($this->input->post('closetime'));
            $aboutus = $this->security->xss_clean($this->input->post('aboutus'));
            $oldPassword = $this->input->post('oldpassword');

            $userInfo = array();

            if(empty($password))
            {
				$userInfo = array(
				'email'=>$email,
				'cname'=>$cname,
				'opentime'=>$opentime,
				'closetime'=>$closetime,
				'aboutus'=>$aboutus,
				'name'=>$name,
				'mobile'=>$mobile,
				'status'=>1,
				'updatedBy'=>$this->vendorId,
				'updatedDtm'=>date('Y-m-d H:i:s'));
            }
            else
            {
                $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
                if(empty($resultPas))
                {
                $this->session->set_flashdata('nomatch', 'repassword not matched.');
                redirect('userEdit');
                }
                else
                {
                $userInfo = array(
								'email'=>$email,
								'cname'=>$cname,
								'opentime'=>$opentime,
								'closetime'=>$closetime,
								'aboutus'=>$aboutus,
								'password'=>getHashedPassword($password),
								'name'=>ucwords($name),					
								'mobile'=>$mobile,'status'=>1,
								'updatedBy'=>$this->vendorId,					
								'updatedDtm'=>date('Y-m-d H:i:s')
					);
                }
            }
            $result = $this->user_model->editUser($userInfo, $userId);
            
            if($result == true)
            {
                $this->session->set_flashdata('success', 'Store updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Something went wrong please try again.');
            }
            
            redirect('userEdit');
        }
    }


    
    /**
     * This function is used to load the change password view
     */
    function loadChangePass()
    {
        $this->global['pageTitle'] = 'Eatura: Change password';
        
        $this->loadViews("changePassword", $this->global, NULL, NULL);
    }
    
    
    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->loadChangePass();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Re-password not matched.');
                redirect('loadChangePass');
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword),'status'=>1, 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) {
                     $this->session->set_flashdata('success', 'Password changed successfully');
                     }
                else {
                     $this->session->set_flashdata('error', 'Something went wrong please try again.'); 
                    }
                
                redirect('loadChangePass');
            }
        }
    }
    /**
     * This function is used to open 404 view
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Eatura : 404 - Not found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
	/**
	* This function for creation of slug name 
	*/
		public  function slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}
	
}

?>