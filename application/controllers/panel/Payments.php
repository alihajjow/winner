<?php
/**
 * 
 */
class Payments extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		need_login();
		have_access(56);
		have_access(38);
		get_statics();
		error_reporting(0);
		$this->load->model('panel/payments_model', 'payments');
		$this->session->set_userdata('this_url', current_url());
		need_unlock();
		need_pay_login();
		if (!$this->session->userdata('lang') || $this->session->userdata('lang') == 'ar') {
            $this->lang->load("banks","arabic");
            $this->lang->load("sidebar","arabic");
            $this->lang->load("header","arabic");
			$this->lang->load("form_validation","arabic");
        } else {
            $this->lang->load("banks","english");
            $this->lang->load("sidebar","english");
            $this->lang->load("header","english");
        } 
		error_reporting(0);
	}
	
	public function index()
	{
		
		$this->transfer_bank_ops();
	}
	
	public function transfer_bank_ops($value='')
	{
		$from_emp = $emp_id = $this->session->userdata('user_id');
		
		//$this->form_validation->set_rules('from_emp', $this->lang->line('from_emp'), 'required');
		//$this->form_validation->set_rules('to_emp', $this->lang->line('to_emp'), 'required');
		$results = '';
		if ($_POST) {
		//	if ($this->form_validation->run()) {
				
			
			$to_emp 	= $this->input->post('to_emp');
			$from 		= $this->input->post('from');
			$to 		= $this->input->post('to');
			$from		= strtotime($from);
			$to			= strtotime($to);
			
			$results = $this->payments->transfer_bank($from_emp, $to_emp, $from, $to, 1);
				//echo "<pre>"; print_r($result->result()); exit;
		//	}
		}
		
		$data['balance'] = $this->db->get_where('users', array('emp_id' => $emp_id))->row()->balance;
		$data['results'] 	= $results;
		//print_r($results); exit;
		$data['users'] 	= $this->db->get_where('users', array('parent_id' => $emp_id, 'fired' => 0))->result();
		//print_r($users); exit;
		$data['selected'] 	= 'transfer_bank';
		$data['title'] 	  	= $this->lang->line('transfer_bank');
		$this->load->view('panel/payments/trans_comm_view', $data);
	}
	
	public function trans_comm_op($value='')
	{   $this->form_validation->set_rules('to_emp', $this->lang->line('to_emp'), 'required');
		$this->form_validation->set_rules('amount', $this->lang->line('amount'), 'required|is_natural|trim');
		$user_id = $this->session->userdata('user_id');
		if ($_POST) {
			//echo "<pre>"; print_r($this->input->post('amount')); exit;
			if ($this->form_validation->run()) {
		      
			    $to   = $this->payments->check_username($this->input->post('to_emp'));
			//	print_r($to_emp); exit();
				if($to){
				$amount  = $this->input->post('amount');
			    $to_emp  =  $this->input->post('to_emp');
				$result  = $this->payments->temp_trans($user_id, $to_emp, $amount);
				if ($result != 'f' && $result > 0) {
					$this->messages->success($this->lang->line('transaction_completed'));
				} elseif($result === 'f') {
				    $this->messages->error($this->lang->line('no_enough_comm_balance'));
				} else {
					$this->messages->error($this->lang->line('transaction_not_completed'));
				}
				} else {
					$this->messages->error($this->lang->line('transaction_not_completed'));
				}
				redirect(base_url()."transfer");
			}
		}
		
		$balance = $this->db->get_where('users', array('emp_id' => $user_id))->row()->balance;
		$sql = "SELECT sum(amount) amount 
				  FROM queued_payments 
				 WHERE from_id=$user_id
				   AND approved=0
				   AND canceled=0";
		$res = $this->db->query($sql);
		$data['balance']    = $balance = $balance - $res->row()->amount;
		$data['users']  	= $this->db->query("SELECT * FROM users WHERE fired=0 AND emp_id!=$user_id");
		$data['selected'] 	= 'transfer';
		$data['title'] 	  	= $this->lang->line('transfer');
		
		$this->load->view('panel/payments/transfer', $data);
	}
	
	public function pending_payments($value='')
	{
		$this->session->set_userdata('last_url', current_url());
		$user_id = $this->session->userdata('user_id');
		$results = $this->payments->get_pending_payments($user_id);
		//echo "<pre>"; print_r($results->result()); exit;
		$data['selected'] 	= 'pending_payments';
		$data['title'] 	  	= $this->lang->line('pending_payments');
		$data['results']	= $results;
		$this->load->view('panel/payments/pending_payments_view', $data);
	}
	
	public function my_pending_payments($value='')
	{
		$this->session->set_userdata('last_url', current_url());
		$user_id = $this->session->userdata('user_id');
		$results = $this->payments->get_user_pending($user_id);
		//echo "<pre>"; print_r($results->result()); exit;
		$data['selected'] 	= 'my_pending_payments';
		$data['title'] 	  	= $this->lang->line('pending_payments');
		$data['results']	= $results;
		$this->load->view('panel/payments/my_pending_payments_view', $data);
	}
	
	public function approve_payment($pay_id='')
	{
		$user_id = $this->session->userdata('user_id');
		$result  = $this->payments->trans_amount($pay_id, $user_id);
		if ($result) {
			$this->messages->success($this->lang->line('transaction_completed'));
		} else {
			$this->messages->error($this->lang->line('transaction_not_completed'));
		}
		redirect(base_url()."pending_pays");
	}

	public function cancel_payment($pay_id='')
	{
		
		$result  = $this->payments->cancel_payment($pay_id);
		if ($result) {
			$this->messages->success($this->lang->line('transaction_canceled'));
		} else {
			$this->messages->error($this->lang->line('transaction_not_canceled'));
		}
		//echo $result; exit;
		redirect($this->session->userdata('last_url'));
	}

	
	
	
	public function bank_logout_op($value='')
	{
		$this->session->unset_userdata('payment_logged');
		redirect(base_url());
	}
	
	
	 public function change_pay_password()
    {
	  		$id = $this->session->userdata('user_id');
		    $this->form_validation->set_rules('old_password', $this->lang->line('old_password'), 'required');
		    $this->form_validation->set_rules('new_password', $this->lang->line('new_password'), 'required|min_length[8]|matches[confirm_password]');
	        $this->form_validation->set_rules('confirm_password', $this->lang->line('confirm_password'), 'required|min_length[8]');
		
			if ($_POST) {
		      if ($this->form_validation->run() == true) {
		      	  
			     $old_pass = $this->db->get_where('users', array('emp_id' => $id, 'pay_pass' => sha1($this->input->post('old_password'))))->num_rows();
				  
				// print_r($old_pass); exit();
				if($old_pass){
			
			    	$password 	= $this->input->post('new_password');	
					$edited = $this->payments->change_pay_pass($id, $password);
	                if ($edited) {
	                //	print_r($edited); exit;
	                    $this->messages->success($this->lang->line('pass_update_success'));
	                } else {
	                    $this->messages->error($this->lang->line('pass_update_not_success'));
	             	}	
	             	}
        	}
		  } 
		$data['title']	  = $this->lang->line('change_pay_password');
     
        $data['selected'] = "change_pay_password";
		
		$this->load->view('panel/payments/change_pay_password', $data);
    
   
    }
	
}
