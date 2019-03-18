<?php

/**
 * 
 */
class Basics_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function login($username='', $password="")
    {
        if (!$username || !$password) {
            return FALSE;
        }
        
        $user = $this->db->get_where('users', array('username' => $username, 'password' => sha1($password), 'fired' => 0));
        if ($user->num_rows()) {
            $this->session->set_userdata('user_id', $user->row()->emp_id);
            $this->session->set_userdata('user_fullname', $user->row()->f_name.' '.$user->row()->l_name);
			$this->session->set_userdata('user_img', $user->row()->img);
            //$this->session->set_userdata('user_admin', $user->row()->admin);
            //$this->session->set_userdata('profile_pic', $user->row()->profile_pic);
            $user_id = $user->row()->emp_id;
            $ip_address = $this->input->ip_address();
            if ($this->agent->is_robot()) {
                $device = $this->agent->robot();
            } elseif ($this->agent->is_mobile()) {
                $device = $this->agent->mobile();
            } else {
                $device = 'Computer';
            }
            
            $os = $this->agent->platform();
            $browser = $this->agent->browser().' '.$this->agent->version();
            $insert = array(
                             'user_id'      => $user_id,
                             'ip_address'   => $ip_address,
                             'device'       => $device,
                             'os'           => $os,
                             'browser'      => $browser,
                             'start_time'   => time()
                           );
            $this->db->insert('session_log', $insert);
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	public function check_paypass($user_id, $pass)
	{
		$pass = sha1($pass);
		$res = $this->db->get_where('users', array('emp_id' => $user_id, 'password' => $pass))->num_rows();
		
		return $res;
	}
}
