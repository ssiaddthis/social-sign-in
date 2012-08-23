<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

 	public function __construct()
    {
        parent::__construct();
		$this->load->helper('url');
    }	
	
	public function index()
	{
		$this->load->model('userdata');		
		$script_path = $this->config->item('script_path');
		
		$data['page'] = 'login';

		if($this->input->post('signature'))
		{ 
			$this->session->set_userdata('signature', $this->input->post('signature'));
			$this->session->set_userdata('firstname', $this->input->post('firstname'));
			$this->session->set_userdata('lastname', $this->input->post('lastname'));
			$this->session->set_userdata('thumb_url', $this->input->post('thumb_url'));
			$this->session->set_userdata('service', $this->input->post('service'));
			$this->session->set_userdata('link', $this->input->post('link'));
			$this->session->set_userdata('locale', $this->input->post('locale'));
			$this->session->set_userdata('timezone', $this->input->post('timezone'));
			
			$auth = $this->userdata->check_social_login($this->input->post('signature'));
			
			if(isset($auth->social_id))
			{
				$this->session->set_userdata('id', $auth->userid);				
				redirect('/user/dashboard');	
			} else
			{				
				redirect('/user/login_unknown');	
			}
			
		}
		if($this->input->post() && !$this->input->post('signature'))
		{
			$auth = $this->userdata->user_auth($this->input->post());
			if(isset($auth->id)){
				$this->session->set_userdata('id', $auth->id);
				if($this->input->post('link_login'))
				{
					$this->userdata->connect_signature();	
				}
				redirect('/user/dashboard');	
			} else
			{	
				if($this->input->post('link_login'))
				{
					$data['page'] = 'login_unknown';
				}			
				$data['error_message'] = 'Invalid Login.';	
			}
		}
		
		$data['script_path'] = $script_path;
		$this->load->view('container', $data);
	}
	
	public function login_unknown($event="")
	{
		$data['page'] = 'login_unknown';
		$data['event'] = $event;
		$this->load->view('container', $data);
	}
	
	public function create_social_account()
	{
		if($this->input->post('social_username'))
		{				
			
			$this->load->model('userdata');
			$id = $this->userdata->social_user_register($this->input->post('social_username'));				
			if(isset($id) && $id>0){
				$this->session->set_userdata('id', $id);
				redirect('/user/dashboard');	
			} else{				
				$data['social_error_message'] = 'User already exists.';	
			}					
		}			
		$data['page'] = 'login_unknown';
		$this->load->view('container', $data);
	}
	
	public function register()
	{
		$this->load->model('userdata');		
		$script_path = $this->config->item('script_path');
		$data['script_path'] = $script_path;
		if($this->input->post('signature'))
		{ 
			$this->session->set_userdata('signature', $this->input->post('signature'));
			$this->session->set_userdata('firstname', $this->input->post('firstname'));
			$this->session->set_userdata('lastname', $this->input->post('lastname'));
			$this->session->set_userdata('thumb_url', $this->input->post('thumb_url'));
			$this->session->set_userdata('service', $this->input->post('service'));
			$this->session->set_userdata('link', $this->input->post('link'));
			$this->session->set_userdata('locale', $this->input->post('locale'));
			$this->session->set_userdata('timezone', $this->input->post('timezone'));
			
			$auth = $this->userdata->check_social_login($this->input->post('signature'));
			if(isset($auth->social_id)){
				$this->session->set_userdata('id', $auth->userid);
				redirect('/user/dashboard');	
			} else{				
				redirect('/user/login_unknown/register');	
			}			
		}		
		
		if($this->input->post() && !$this->input->post('signature'))
		{
			if($this->input->post('username'))
			{				
				if($this->input->post('password') && ($this->input->post('password') == $this->input->post('confirm_password')))
				{
					$id = $this->userdata->user_register($this->input->post());
								
					if(isset($id) && $id>0){
						$this->session->set_userdata('id', $id);
						redirect('/user/dashboard');	
					} else{				
						$data['error_message'] = 'User already exists.';	
					}
				} else{
					$data['error_message'] = 'Password mismatches.';
				}
			} else{
					$data['error_message'] = 'Invalid Username.';
			}			
			
		}			
		$data['page'] = 'register';
		$this->load->view('container', $data);
	}
	
	public function dashboard()
	{
		$this->isLoggedin();
		$this->load->model('userdata');
		$userdata = $this->userdata->getUserData($this->session->userdata('id'));		
		$username = $userdata->user_id;		
		$data['username'] = $username;
		$data['firstname'] = $this->session->userdata('firstname');
		$data['lastname'] = $this->session->userdata('lastname');
		$data['thumb_url'] = $this->session->userdata('thumb_url');
		$data['link'] = $this->session->userdata('link');		
		$data['service'] = $this->session->userdata('service');
		$data['timezone'] = $this->session->userdata('timezone');
		$data['locale'] = $this->session->userdata('locale');
		$data['page'] = 'dashboard';
		$this->load->view('container', $data);
	}

	public function connect()
	{
		$this->isLoggedin();
		$this->load->model('userdata');
		
		if($this->input->post('signature'))
		{ 
			$auth = $this->userdata->check_social_login($this->input->post('signature'));
			if($auth)
			{
				$data['error_message'] = 'Account is already connected with another user.';
			} else
			{							
				$this->session->set_userdata('signature', $this->input->post('signature'));
				$this->session->set_userdata('firstname', $this->input->post('firstname'));
				$this->session->set_userdata('lastname', $this->input->post('lastname'));
				$this->session->set_userdata('thumb_url', $this->input->post('thumb_url'));
				$this->session->set_userdata('service', $this->input->post('service'));
				$this->session->set_userdata('link', $this->input->post('link'));
				$this->session->set_userdata('locale', $this->input->post('locale'));
				$this->session->set_userdata('timezone', $this->input->post('timezone'));
				
				$this->userdata->connect_more($this->input->post());
				
				$data['success_message'] = 'Succesfully connected.';
			}			
		}
		
		$script_path = $this->config->item('script_path');
		$connect_data = $this->userdata->getConnectedAccounts($this->session->userdata('id'));
		$data['script_path'] = $script_path;
		$data['connect_data'] = $connect_data;
		$data['page'] = 'connect';
		$this->load->view('container', $data);
	}
	
	
	public function remove_access($socialid)
	{		
		$this->load->model('userdata');
		$this->userdata->removeAccess($socialid);	
		$this->session->set_flashdata('message', 'Account is disconnected successfully.');
		redirect('/user/connect');	
	}
	
	
	public function unlink()
	{
		$this->load->model('userdata');
		$this->userdata->deleteAll();	
		$this->session->set_flashdata('message', 'All accounts are deleted successfully.');
		redirect('/user/index');	
	}
	
	public function change_password()
	{
		$this->isLoggedin();
		$this->load->model('userdata');
		
		if($this->input->post())
		{
			if($this->input->post('new_password') && $this->input->post('confirm_password') && strlen($this->input->post('new_password'))<20 && strlen($this->input->post('new_password'))>2 &&($this->input->post('new_password') == $this->input->post('confirm_password')))
			{
				$this->userdata->updatePassword($this->input->post('new_password'));
				$data['success_message'] = 'Your password has been updated.';
			} else{
				$data['error_message'] = 'Invalid Password.';
			}
		}
		
		$data['page'] = 'change_password';
		$this->load->view('container', $data);	
	}
	
	public function isLoggedin()
	{
		if(!$this->session->userdata('id'))
		{
			redirect('/user/index');
		}	
		else
		{
			return;
		}		
	}	
	
	public function logout()
	{
		$this->session->set_userdata('id', '');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('id');
		$array_items = array('signature' => '', 'firstname' => '', 'lastname' => '', 'thumb_url' => '', 'service' => '', 'link' => '', 'locale' => '', 'timezone' => '');
		$this->session->unset_userdata($array_items);
		$this->session->set_flashdata('message', 'Logged out successfully.');
		
		redirect('/user/index');	
	}
	
}
