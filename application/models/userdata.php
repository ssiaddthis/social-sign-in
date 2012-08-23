<?php
class Userdata extends CI_Model {
	
    function __construct()
    {
    	parent::__construct();
    }
    
    function user_auth($data)
    {
        $query = $this->db->get_where('users', array('user_id' => $data['username'], 'password' =>  md5($data['password'])));
        return $query->row();
    }
    
    function check_social_login($data)
    {
    	$query = $this->db->get_where('user_social_login', array('signature' => $data));
        return $query->row();
    }
    
    function user_register($data)
    {
        $data = array('user_id' => $data['username'],'password' => md5($data['password']) );

		$this->db->insert('users', $data);
		return $this->db->insert_id();
    }
    
    function connect_signature()
    {
		$data = array('userid' => $this->session->userdata('id'), 'signature' => $this->session->userdata('signature'), 'service' => $this->session->userdata('service'), 'profileUrl' => $this->session->userdata('link'));
		$this->db->insert('user_social_login', $data);
    }

    function connect_more($data)
    {
		$data = array('userid' => $this->session->userdata('id'), 'signature' => $data['signature'], 'service' => $data['service'], 'profileUrl' => $this->session->userdata('link'));
		$this->db->insert('user_social_login', $data);
    }

    function updatePassword($password)
    {
		$update = array('password' => md5($password));
		$this->db->where('id', $this->session->userdata('id'));
		$this->db->update('users', $update); 
    } 
    
    function social_user_register($data)
    {
        $data = array('user_id' => $data);
		$this->db->insert('users', $data);
		$id = $this->db->insert_id();
		if($id>0){
			$data = array('userid' => $id, 'signature' => $this->session->userdata('signature'), 'service'=> $this->session->userdata('service'), 'profileUrl' => $this->session->userdata('link'));
			$this->db->insert('user_social_login', $data);
			return $id;
		}else{
			return 0;
		}
    }
    
    function getUserData($id)
    {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row();
    }
    
    function deleteAll()
    {
        $this->db->empty_table('users'); 
        $this->db->empty_table('user_social_login'); 
    }
    
    function removeAccess($socialid)
    {
        $this->db->delete('user_social_login', array('social_id' => $socialid)); 
    }
    
    function getConnectedAccounts($id)
    {
    	$query = $this->db->get_where('user_social_login', array('userid' => $id));
        return $query->result();
    }
}    