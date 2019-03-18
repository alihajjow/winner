<?php
/**
 * 
 */
class Basics extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('panel/basics_model', 'basics');
	}
	
	
	
	 public function all_std()
	{
		$this->load->model('Nmodel');
		$id=$this->session->userdata('user_id');
		//print_r($id); exit();
		 $res = $this->Nmodel->std_data($id);
               
        $data['results'] = $res;
		
		
		 $this->load->view('all_students',$data);
		
	}
	
	
	public function index($value='')
	{
		$this->login();
	}
	
	public function login($value='')
    {
        if ($this->session->userdata('user_id')) {
            $message = trans("already_logged");
            
            $this->messages->error($message);
            //echo $this->session->userdata('suc_message'); exit;
            redirect(base_url()."home");
        }
		$data['message'] = '';
        $data = array();
        $this->form_validation->set_rules('username', $this->lang->line("username"), 'required');
        $this->form_validation->set_rules('password', $this->lang->line('Password'), 'required');
        if ($this->form_validation->run()) {
            
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            //echo $username.' '.$password; exit;
            
            if($this->basics->login($username, $password)) {
                
                $message = trans("logged_in");
                $this->messages->success($message);
				//echo $this->session->userdata('suc_message'); exit;
                redirect(base_url().'home');
				//echo "string";
            } else {
                $data['message'] = $message = $this->lang->line("logged_in_fail");
				//echo "fddf";
            }
			//exit;
            
        }
		//$data['message'] = $message
        $data['username'] = $this->input->post('username');
        $this->load->view('login_view', $data);
    }
	
	
	  
	 
    public function lock_screen_fun($value='')
	{
		$this->session->set_userdata('screen_locked', 1);
		redirect(base_url()."lock_screen");
	}

	public function logout($value='')
	{
		$this->session->sess_destroy();
		redirect(base_url());
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
		$res = $this->basics->check_paypass($user_id, $pass);
		if ($res) {
			//$this->session->set_userdata('payment_logged', 1);
			return TRUE;
		} else {
			$this->form_validation->set_message('check_paypass', $this->lang->line('pass_error'));
			return FALSE;
		}
	}
}
