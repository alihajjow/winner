<?php
class Recover extends CI_Controller {
    public function __construct() {
        parent::__construct();
		if (!$this->session->userdata('lang') || $this->session->userdata('lang') == 'ar') {
            $this->lang->load("user","arabic");
            $this->lang->load("sidebar","arabic");
            $this->lang->load("header","arabic");
            $this->lang->load("ads","arabic");
			$this->lang->load("form_validation","arabic");
        } else {
            $this->lang->load("user","english");
            $this->lang->load("sidebar","english");
            $this->lang->load("header","english");
            $this->lang->load("ads","english");
        } 
        //$this->form_validation->set_message('required', "%s ".$this->lang->line('required_validation'));
        //$this->form_validation->set_message('numeric', "%s ".$this->lang->line('numeric_validation'));
		//$this->form_validation->set_message('is_unique', "%s ".$this->lang->line('is_unique_validation'));
        $this->load->model('panel/recover_model', 'recover_model');
    }
    
    public function recover_password($value='')
    {
    	$this->form_validation->set_rules('password', $this->lang->line('password'), 'required|min_length[8]|matches[conf_password]');
		if ($_POST) { 
			if ($this->form_validation->run()) {
				$password = $this->input->post('password');
				$updated = $this->recover_model->reset_password($password);
				if ($updated) {
					$this->session->unset_userdata('must_change_pass');
					$this->messages_model->success($this->lang->line('pass_updated'));
					redirect(base_url().'home');
				} else {
					$this->messages_model->error($this->lang->line('pass_not_updated'));
					redirect(base_url().'reset_pass');
				}
				
			}
		}
		
    	$data['selected'] = 'home';
        $this->load->view('users/recover/reset_password_view', $data);
    }
	
	public function recover_pass($value='')
	{
		$user_id		= $this->session->userdata('user_id');
		$old_pass 		= $this->input->get('old_pass');
		$new_pass 		= $this->input->get('new_pass');
		$conf_new_pass 	= $this->input->get('conf_new_pass');
		
		if ($new_pass != $conf_new_pass) {
			echo 2; return;
		}
		
		$result			= $this->recover_model->save_pass($user_id, $old_pass, $new_pass);
		echo $result;
	}
	
	public function recover_pay_pass($value='')
	{
		$user_id		= $this->session->userdata('user_id');
		$old_pass 		= $this->input->get('old_pass');
		$new_pass 		= $this->input->get('new_pass');
		$conf_new_pass 	= $this->input->get('conf_new_pass');
		
		if ($new_pass != $conf_new_pass) {
			echo 2; return;
		}
		
		$result			= $this->recover_model->save_pay_pass($user_id, $old_pass, $new_pass);
		echo $result;
	}
	
	public function lock_screen_fun($value='')
	{
		$this->session->set_userdata('screen_locked', 1);
		redirect(base_url()."lock_screen");
	}
	
	public function lock_screen_view($value='')
	{
		if (!$this->session->userdata('screen_locked')) {
			redirect(base_url());
		}
		
		if ($_POST) {
			$this->form_validation->set_rules('password', $this->lang->line('password'), 'required|callback_check_paypass');
			if ($this->form_validation->run()) {
				//exit;
				$this->session->unset_userdata('screen_locked');
				redirect($this->session->userdata('this_url'));
			}
			
		}
		$this->load->view('lock_screen_view');
	}
	
	public function swich_lang()
    {
        if (!$this->session->userdata('lang') || $this->session->userdata('lang') == 'ar') {
            $this->session->unset_userdata('lang');
            $this->session->set_userdata('lang', 'en');
            
        } else {
            $this->session->unset_userdata('lang');
            $this->session->set_userdata('lang', 'ar');
        } 
        redirect($this->session->userdata('this_url'));
    }
    
	
	public function check_paypass($pass='')
	{
		$user_id = $this->session->userdata('user_id');
		$res = $this->recover_model->check_paypass($user_id, $pass);
		if ($res) {
			//$this->session->set_userdata('payment_logged', 1);
			return TRUE;
		} else {
			$this->form_validation->set_message('check_paypass', $this->lang->line('pass_error'));
			return FALSE;
		}
	}
}
