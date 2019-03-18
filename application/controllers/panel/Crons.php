<?php
/**
 *
 */
class Crons extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function calculate($parent_id) {
		$sql = "SELECT s.*, lp.percent, cl.price, cl.commission
				  FROM stored_bal s, course_levels cl, levels_percentage lp, user_course uc
			     WHERE s.user_id=uc.user_id
			 	   AND cl.lev_id=uc.lev_id
				   AND lp.level_id=s.parent_type
				   AND s.paid=0
				   AND s.parent_id = $parent_id";

			$result = $this->db->query($sql)->result();

			$last_amount = 0;
			$this->db->trans_start();
			foreach ($result as $row) {
				$price = (int) $row->price * $row->commission;
				$percent = $row->percent;
				$row_id = $row->id;

				$amount = $price * $percent / 100;
				$last_amount += $amount;

				$this->db->where('id', $row_id);
				$this->db->update('stored_bal', array('comm' => $amount, 'paid' => 1, 'paid_date' => time()));
			}

			$balance = $this->db->get_where('users', array('emp_id', $parent_id))->row()->balance;
			$new_balance = $balance + $last_amount;

			$this->db->where('emp_id', $parent_id);
			$this->db->update('users', array('balance' => $new_balance));

			$insert = array (
								'emp_id' 		=> 1,
								'to_id'			=> $parent_id,
								'pay_cat_id'	=> 3,
								'debit'			=> $last_amount,
								'credit'		=> 0,
								'old_balance'	=> 0,
								'new_balance'	=> 0,
								'payment_date'	=> time()
							);
			$this->db->insert('payments', $insert);

			$insert = array (
								'emp_id' 		=> $parent_id,
								'to_id'			=> 0,
								'pay_cat_id'	=> 3,
								'debit'			=> 0,
								'credit'		=> $last_amount,
								'old_balance'	=> $balance,
								'new_balance'	=> $new_balance,
								'payment_date'	=> time()
							);
			$this->db->insert('payments', $insert);

			$this->db->trans_complete();
			
			echo $last_amount;
	}

	public function handle_user($value='')
	{
		//exit;
		$sql = "SELECT user_id , hand_date
				  FROM handled_users
				 ORDER BY id DESC
				 LIMIT 1 ";
		$last_userid = $this->db->query($sql);
		$query = $last_userid;
		//echo time() - $query->row()->hand_date; exit;
		$last_userid = $last_userid->num_rows() ? $last_userid->row()->user_id : 0;
		//print_r($last_userid); exit;
		$sql = "SELECT emp_id
				  FROM users
				 WHERE emp_id>$last_userid
				 LIMIT 20";
		$user_ids = $this->db->query($sql);
		
		$hand_date = isset($query->row()->hand_date) ? $query->row()->hand_date : 0;
		//echo $user_id; exit;
		$user_ids = $user_ids->num_rows() && time() - $hand_date < 87400 ? $user_ids->result() : '';
		//echo "<pre>"; print_r($user_ids); exit;
		if (!$user_ids) {
			if (time() - $hand_date < 87400) {
				echo 0;
				return;
			}
			$res = $this->calculate(1);
			//if ($res) {
			$insert = array (
								'user_id'   => 1,
								'hand_date' => time()
							);
			$this->db->insert('handled_users', $insert);
		} else {
			foreach ($user_ids as $row) {

				//echo "string"; exit;
				$user_id = $row->emp_id;
				$res = $this->calculate($user_id);
				//if ($res) {
				$insert = array (
									'user_id'   => $user_id,
									'hand_date' => time()
								);
				$this->db->insert('handled_users', $insert);
			}
		}


		//}
	}

	public function calc($parent='')
	{
		$all_count = 0;
		$counter = array();
		$current_day = date("N");

		$days_to_friday = 5 - $current_day;
		$days_from_monday = $current_day - 1;
		$monday = date("Y-m-d", strtotime("- {$days_from_monday} Days"));
		$count = 0;
		$r_count = 0;
		$l_count = 0;
		$friday = strtotime("+{$days_to_friday} Days") - 518400;
		$friday= strtotime(date('Y-m-d 00:00:00',$friday));
		//echo date('Y-m-d 00:00:00',$friday); exit;
		//$friday= strtotime(date('Y-m-d 23:59:59',$friday));

		//echo "SELECT * FROM users WHERE reg_date<$lastfriday"; exit;

		$sql = "SELECT * FROM stored_bal WHERE parent_id=$parent AND parent_type='l' AND paid=0 AND add_date< $friday";
		$l_res = $this->db->query($sql);
		$left_ids = $l_res->result();
		$l_count = $l_res->num_rows();
		$sql = "SELECT * FROM stored_bal WHERE parent_id=$parent AND parent_type='r' AND paid=0 AND add_date< $friday";
		$r_res = $this->db->query($sql);
		$right_ids = $r_res->result();
		$r_count = $r_res->num_rows();
		$count = $l_count > $r_count ? $r_count : $l_count;
		$count *= 2;
		// echo $count; exit;
		//echo $sql; exit;
		if ($count == 0) {
			return;
		}
		$comm = $this->db->get('commisions')->row()->comm;
		$max_pay = $this->db->get('commisions')->row()->max_pay;
		$payment = $count * $comm > $max_pay ? $max_pay : $count * $comm;
		$counter[$parent] = $payment;
		$all_count += $payment;

		$balance	= $this->db->get_where('users', array('emp_id' => $parent))->row()->balance;
		$pay_det 	= $this->db->get('commisions')->row();
		$fath_comm 	= $pay_det->fath_comm;
		$comm		= $pay_det->comm;
		$mount		= 0;
		//echo "<pre>";
		//print_r($left_ids);

		if ($l_count == $r_count) {
			//exit;
			$this->db->trans_start();
			foreach ($right_ids as $id) {
				$id = $id->user_id;
				$is_direct_pa = $this->direct_parent($parent, $id);
				$paid_mount = $is_direct_pa ? $comm : $fath_comm;
				$mount += $is_direct_pa ? $comm : $fath_comm;
				$update = array (
									'paid' 			=> 1,
									'paid_date'		=> time(),
									'comm'			=> $paid_mount
								);

				$where  = array (
									'user_id' 	=> $id,
									'parent_id' => $parent
								);

				$this->db->where($where);
				$this->db->update('stored_bal', $update);

			}

			foreach ($left_ids as $id) {
				$id = $id->user_id;
				$is_direct_pa = $this->direct_parent($parent, $id);
				$paid_mount = $is_direct_pa ? $comm : $fath_comm;
				$mount += $is_direct_pa ? $comm : $fath_comm;
				$update = array (
									'paid' 			=> 1,
									'paid_date'		=> time(),
									'comm'			=> $paid_mount
								);
				$where  = array (
									'user_id' 	=> $id,
									'parent_id' => $parent
								);

				$this->db->where($where);
				$this->db->update('stored_bal', $update);

			}

			$new_balance = $balance + $mount;

			$this->db->where('emp_id', $parent);
			$update = array (
								'balance' => $new_balance
							);
			$this->db->where('emp_id', $parent);
			$this->db->update('users', $update);

			$insert = array (
								'emp_id' 		=> 1,
								'to_id'			=> $parent,
								'pay_cat_id'	=> 3,
								'debit'			=> $mount,
								'credit'		=> 0,
								'old_balance'	=> 0,
								'new_balance'	=> 0,
								'payment_date'	=> time()
							);
			$this->db->insert('payments', $insert);

			$insert = array (
								'emp_id' 		=> $parent,
								'to_id'			=> 0,
								'pay_cat_id'	=> 3,
								'debit'			=> 0,
								'credit'		=> $mount,
								'old_balance'	=> $balance,
								'new_balance'	=> $new_balance,
								'payment_date'	=> time()
							);
			$this->db->insert('payments', $insert);
			$this->db->trans_complete();
			echo $this->db->trans_status();
		} else {

			$this->db->trans_start();
			$count = $r_count > $l_count ? $l_count : $r_count;
			//echo $count; ex
			for ($i=0; $i < $count; $i++) {
				$is_direct_pa = $this->direct_parent($parent, $right_ids[$i]->user_id);
				$paid_mount = $is_direct_pa ? $comm : $fath_comm;
				$mount += $is_direct_pa ? $comm : $fath_comm;
				$update = array (
									'paid' 			=> 1,
									'paid_date'		=> time(),
									'comm'			=> $paid_mount
								);

				$where  = array (
									'user_id' 	=> $right_ids[$i]->user_id,
									'parent_id' => $parent
								);

				$this->db->where($where);
				$this->db->update('stored_bal', $update);
			}

			for ($i=0; $i < $count; $i++) {
				$paid_mount = $is_direct_pa ? $comm : $fath_comm;
				$is_direct_pa = $this->direct_parent($parent, $left_ids[$i]->user_id);
				$mount += $is_direct_pa ? $comm : $fath_comm;
				$update = array (
									'paid' 			=> 1,
									'paid_date'		=> time(),
									'comm'			=> $paid_mount
								);

				$where  = array (
									'user_id' 	=> $left_ids[$i]->user_id,
									'parent_id' => $parent
								);

				$this->db->where($where);

				$this->db->update('stored_bal', $update);
			}
			$max_pay = $this->db->get('commisions')->row()->max_pay;
			$mount = $mount > $max_pay ? $max_pay : $mount;
			//echo $mount; exit;
			$new_balance = $balance + $mount;
			//echo $mount; exit;
			$this->db->where('emp_id', $parent);
			$update = array (
								'balance' => $new_balance
							);
			$this->db->where('emp_id', $parent);
			$this->db->update('users', $update);

			$insert = array (
								'emp_id' 		=> 1,
								'to_id'			=> $parent,
								'pay_cat_id'	=> 3,
								'debit'			=> $mount,
								'credit'		=> 0,
								'old_balance'	=> 0,
								'new_balance'	=> 0,
								'payment_date'	=> time()
							);
			$this->db->insert('payments', $insert);

			$insert = array (
								'emp_id' 		=> $parent,
								'to_id'			=> 0,
								'pay_cat_id'	=> 3,
								'debit'			=> 0,
								'credit'		=> $mount,
								'old_balance'	=> $balance,
								'new_balance'	=> $new_balance,
								'payment_date'	=> time()
							);
			$this->db->insert('payments', $insert);
			$this->db->trans_complete();
			echo $this->db->trans_status();
		}
	}

	public function direct_parent($parent='', $child)
	{
		if ($this->db->get_where('users', array('emp_id' => $child, 'parent_id' => $parent))->num_rows()) {
			return TRUE;
		}
		return FALSE;
	}
}
