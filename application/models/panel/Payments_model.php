<?php
/**
 * 
 */
class Payments_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function transfer_bank($to_id="", $start_date="", $end_date="")
	{
		$first_day = $start_date ? $start_date : strtotime(date('Y-m-1'));
        $now       = $end_date ? $end_date : time();
		
		$sql = "select p.*, pc.category_name, concat_ws(' ', emp.f_name, emp.l_name) full_name,
                       emp.username ,concat_ws(' ', em.f_name, em.l_name) to_name, em.username to_username 
                  from payments p, payment_categories pc, users emp ,users em 
                 where p.pay_cat_id=pc.pay_cat_id
                   AND emp.emp_id=p.emp_id
                   AND em.emp_id=p.to_id
                   AND p.pay_cat_id=1
                   AND p.payment_date between $first_day AND $now";
				   
        if ($to_id) {
            $sql .= " AND (
                   			  p.to_id=$to_id
                   		  OR
                   			  p.emp_id=$to_id
                   		  ) ";
        } 
        $sql .= " order by p.payment_id ";
		//echo $sql; exit;
		$result = $this->db->query($sql);
		return $result;
		
	}
	
	
	
	public function temp_trans($user_id='', $to_id, $amount)
	{
		$to_id = $this->db->get_where('users', array('username' => $to_id))->row()->emp_id;
		if ($user_id == $to_id) {
			return FALSE;
		}
		$balance = $this->get_balance($user_id);
		
		$from_user = $this->db->get_where('users', array('emp_id' => $user_id))->row();
		$from_user = $from_user->f_name.' '.$from_user->l_name;
		
		//echo $res->row()->amount; exit;
		if ($amount > $balance) {
			return 'f';
		}
		$balance = $balance - $amount;
		$this->db->trans_start();
			$insert = array (
								'from_id'	=> $user_id,
								'to_id'		=> $to_id,
								'amount'	=> $amount,
								'date'		=> time()
							);
			$this->db->insert('queued_payments', $insert);
			
			$id = $this->db->insert_id();
			//echo $id; exit;
			
			$insert = array (
								'op_id'		=> 1,
								'user_id'	=> $to_id,
								'link'		=> 'pending_pays',
								'n_text'	=> "قام $from_user بتحويل مبلغ $amount لك",
								'date'		=> time()
							);
			$this->db->insert('notifications', $insert);
		$this->db->trans_complete();
		
		
		return $this->db->trans_status() === TRUE ? $this->trans_amount($id, $to_id) : 0;
	}
	
	public function get_balance($user_id='')
	{
		$balance = $this->db->get_where('users', array('emp_id' => $user_id))->row()->balance;
		$sql = "SELECT sum(amount) amount 
				  FROM queued_payments 
				 WHERE from_id=$user_id
				   AND approved=0
				   AND canceled=0";
		$res = $this->db->query($sql);
		
		
		
		if ($res->num_rows()) {
			$balance = $balance - $res->row()->amount;
		} 
		return $balance;
	}
	
	public function get_pending_payments($user_id)
	{
		$sql = "SELECT q.*, u.f_name, u.l_name, concat_ws(' ', t.f_name, t.l_name) to_emp
				  FROM users u, queued_payments q, users t 
				 WHERE t.emp_id = $user_id
				   AND t.emp_id=q.to_id
				   AND q.from_id = u.emp_id
				   AND q.approved=0
				   AND q.canceled=0";
		$result = $this->db->query($sql);
		return $result;
	}
	
	public function get_user_pending($user_id='')
	{
		$sql = "SELECT q.*, u.f_name, u.l_name, concat_ws(' ', t.f_name, t.l_name) to_emp
				  FROM users u, queued_payments q, users t 
				 WHERE u.emp_id = $user_id
				   AND t.emp_id=q.to_id
				   AND q.from_id = u.emp_id
				   AND q.approved=0
				   AND q.canceled=0";
				  // echo $sql; exit;
		$result = $this->db->query($sql);
		return $result;
	}
	
	public function trans_amount ($pay_id, $user_id)
	{
		$payment = $this->db->get_where('queued_payments', array('id' => $pay_id, 'approved' => 0, 'canceled' => 0));
		
		if (!$payment->num_rows()) {
			return FALSE;
		}
		
		if ($payment->row()->to_id != $user_id) {
			return FALSE;
		}
		
		$payment = $payment->row();
		
		$balance = $this->get_balance($user_id);
		
		
		$user 		= $this->db->get_where('users', array('emp_id' => $payment->from_id))->row();
		//echo "<pre>"; print_r( $user); exit;
		$balance 	= $user->balance;
		
		$dist_user 			= $this->db->get_where('users', array('emp_id' => $user_id))->row();
		$dist_balance   	= $dist_user->balance;
		
		$new_balance		= $balance - $payment->amount;
		$new_dist_balance 	= $dist_balance + $payment->amount;
		
		$this->db->trans_start();
			$insert = array(
								'emp_id' 	 	=> $payment->from_id,
								'to_id'			=> $user_id,
								'pay_cat_id' 	=> 1,
								'debit'		 	=> $payment->amount,
								'credit'	 	=> 0,
								'payment_date'	=> time()
							);
			$this->db->insert('payments', $insert);
			
			$insert = array(
								'emp_id' 	 	=> $user_id,
								'to_id'			=> 0,
								'pay_cat_id' 	=> 1,
								'debit'		 	=> 0,
								'credit'	 	=> $payment->amount,
								'payment_date'	=> time()
							);
			$this->db->insert('payments', $insert);
			
			$this->db->where('emp_id', $payment->from_id);
			$this->db->update('users', array('balance' => $new_balance));
			
			$this->db->where('emp_id', $user_id);
			$this->db->update('users', array('balance' => $new_dist_balance));
			
			
			$this->db->where('id', $pay_id);
			$this->db->update('queued_payments', array('approved' => 1, 'approve_date' => time()));
			
			$insert = array (
								'user_id' 	=> $payment->from_id,
								'op_id'		=> 2,
								'n_text'	=> "قبل $dist_user->f_name $dist_user->l_name المبلغ الذي قمت بتحويله له وقدره $payment->amount ل.س",
								'date'		=> time(),
								'link'		=> '#'
							);
			$this->db->insert('notifications', $insert);
			
		$this->db->trans_complete();
		
		return $this->db->trans_status() ? 1 : 0;
	}
	
	public function cancel_payment ($pay_id)
	{
		$user_id = $this->session->user_id;
		$payment = $this->db->get_where('queued_payments', array('id' => $pay_id, 'approved' => 0, 'canceled' => 0));
		
		if (!$payment->num_rows()) {
			return FALSE;
		}
		
		//print_r($payment->row()->to_id); echo $payment->row()->from_id . "  $user_id"; exit;
		if ($payment->row()->to_id != $user_id && $payment->row()->from_id != $user_id) {
			return FALSE;
		}
		$payment   = $payment->row();
		//echo "string"; exit;
		
		$dist_user = $this->db->get_where('users', array('emp_id' => $payment->to))->row();
		$user = $this->db->get_where('users', array('emp_id' => $payment->from_id))->row();
		
		$this->db->trans_start();
			$this->db->where('id', $pay_id);
			$this->db->update('queued_payments', array('canceled' => 1, 'cancel_date' => time()));
			
			$insert = array (
								'user_id' 	=> $payment->from_id,
								'op_id'		=> 4,
								'n_text'	=> "رفض $dist_user->f_name $dist_user->l_name المبلغ الذي قمت بتحويله له وقدره $payment->amount ل.س",
								'date'		=> time(),
								'link'		=> '#'
							);
				
			if ($payment->from_id == $this->session->userdata('user_id')) {
				$insert = array (
									'user_id' 	=> $payment->to_id,
									'op_id'		=> 4,
									'n_text'	=> "ألغى $user->f_name $user->l_name المبلغ الذي قام بتحويله لك وقدره $payment->amount ل.س",
									'date'		=> time(),
									'link'		=> '#'
								);
				//print_r($insert); exit;
			}
			
			//
			$this->db->insert('notifications', $insert);
			//exit;
		$this->db->trans_complete();
		return $this->db->trans_status() ? 1 : 0;
		
	
	}
	
	 public function change_pay_pass($id, $password)
	
    {
    	
   	 	$update = array (    'pay_pass' =>   sha1 ($password)  );
	    
		 $this->db->trans_start();
		 $this->db->where('emp_id', $id);
       	 $this->db->update('users', $update);
         $this->db->trans_complete();
		
        return $this->db->trans_status();
		  
   } 
	
	public function pay_oldpass($old)
    {
    
    $id = $this->session->userdata('user_id');	

	$res = $this->db->get_where('users', array('emp_id' => $id, 'pay_pass' => sha1($old)));
	//print_r($sql->num_rows()); exit();
    //$user = $this->db->get_where('users', array('emp_id' => $id, 'password' => sha1($old)));
	//	print_r($sql); exit();
	
		 if ($res->num_rows()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	         
	   public function check_username($to_emp)
    {
   
	$res = $this->db->get_where('users', array('username' => $to_emp ));
	//print_r($sql->num_rows()); exit();
    //$user = $this->db->get_where('users', array('emp_id' => $id, 'password' => sha1($old)));
	//	print_r($sql); exit();
	
		 if ($res->num_rows()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	
     public function to_id($username)
     {
		$this->db->select('emp_id');	
     	$this->db->where('username' , $username );
        $res = $this->db->get('users');
      //print_r($res->result());  exit();
	      return $res->result();
	 }	
	
	
	
	
	
}
