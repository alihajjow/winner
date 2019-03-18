<?php
class Recover_model extends CI_Model {
    public function __construct() {
        parent::__construct();
		need_login();
    }
	public function reset_password($password='')
	{
		if (!$password) {
			return FALSE;
		}
		
		$user_id = $this->session->userdata('user_id');
		$password = sha1($password);
		$this->db->where('emp_id', $user_id);
		$this->db->update('employees', array('password' => $password, 'login_code' => ''));
		if ($this->db->affected_rows()) {
			return TRUE;
		} 
		return FALSE;
	}
	
	public function save_pass($user_id, $old_pass, $new_pass)
	{
		$really_pass = $this->db->get_where('employees', array('emp_id' => $user_id))->row()->password;
		$old_pass = sha1($old_pass);
		$new_pass = sha1($new_pass);
		//echo "$really_pass $old_pass"; return;
		if ($really_pass == '' & $old_pass == '') {
			$this->db->where('emp_id', $user_id);
			$this->db->update('employees', array('password' => $new_pass));
			return 1;
		} elseif ($really_pass && $really_pass == $old_pass) {
			$this->db->where('emp_id', $user_id);
			$this->db->update('employees', array('password' => $new_pass));
			return 1;
		} else {
			return 0;
		}
	}
	
	public function save_pay_pass($user_id, $old_pass, $new_pass)
	{
		$really_pass = $this->db->get_where('employees', array('emp_id' => $user_id))->row()->pay_pass;
		$old_pass = sha1($old_pass);
		$new_pass = sha1($new_pass);
		//echo "$really_pass $old_pass"; return;
		if ($really_pass == '' & $old_pass == '') {
			$this->db->where('emp_id', $user_id);
			$this->db->update('employees', array('pay_pass' => $new_pass));
			return 1;
		} elseif ($really_pass && $really_pass == $old_pass) {
			$this->db->where('emp_id', $user_id);
			$this->db->update('employees', array('pay_pass' => $new_pass));
			return 1;
		} else {
			return 0;
		}
	}
	
	public function check_paypass($user_id, $pass)
	{
		$pass = sha1($pass);
		$res = $this->db->get_where('employees', array('emp_id' => $user_id, 'password' => $pass))->num_rows();
		
		return $res;
	}
}