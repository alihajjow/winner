<?php
class Auth {
    var $CI;
    public function __construct() {
        $this->CI = & get_instance();
        //$this->CI->load->model('general/auth_model', 'auth');
        
        //$this->CI->load->model('reports/reports_model', 'reports');
    }
    
    public function need_login()
    {
        if(!$this->CI->session->userdata('user_id')){
            redirect(base_url()."login");
        }
    }
	
	public function need_unlock()
    {
        if($this->CI->session->userdata('screen_locked')){
            redirect(base_url()."lock_screen");
        }
    }
	
	public function need_pay_login()
    {
        if(!$this->CI->session->userdata('payment_logged')){
            redirect(base_url()."pay_login");
        }
    }
    
    public function get_permissions() {
        $user_id = $this->CI->session->userdata('user_id');
        $query = "SELECT * FROM pers_roles WHERE role_id in (SELECT role_id FROM roles_emps WHERE emp_id = '{$user_id}');";
        $result = $this->CI->db->query($query)->result();
        
        $permissions = array();
        foreach($result as $permission) {
            $permissions [] = $permission->per_id;
        }
        return $permissions;    
    }
    
    public function get_balance()
    {
        $emp_id = $this->CI->session->userdata('user_id');
        if ($emp_id) {
            $balance = $this->CI->db->get_where('users', array('emp_id' => $emp_id))->row()->amount;
            $this->CI->session->set_userdata('user_balance', $balance);
        }
        
    }
    
    public function is_logged()
    {
        return $this->CI->session->userdata('user_id') ? 1 : 0;
    }
    
    public function have_access($sub_object_id, $no_redirect = FALSE) { 
        if(!$this->is_logged()) {
            return FALSE;
        }

        $has_access = FALSE;

        $permissions = $this->get_permissions();
        if(in_array($sub_object_id, $permissions)) {
            $has_access = TRUE;
        }

        if(!$has_access) {
            if(!$no_redirect) {
                $this->CI->messages->error($this->CI->lang->line('no_access'));
                redirect('/');
            }
            return FALSE;   
        }
        return TRUE;
    }
	
	public function check_end_date($user_id='')
	{
		$end_date = $this->CI->db->get_where('users', array('emp_id' => $user_id))->row()->contract_end_date;
		if ($end_date && $end_date < time()) {
			return TRUE;
		}
		return FALSE;
	}
	
	public function translate($key='')
	{
		echo $this->CI->lang->line($key);
	}
	
	public function trans($key='')
	{
		return $this->CI->lang->line($key);
	}
	
	public function LANG()
	{
		return $this->CI->session->userdata('lang');
	}
	
	public function get_statics()
	{
		$user_id = $this->CI->session->userdata('user_id');
		$sql = "SELECT count(u.emp_id) user_num 
				  FROM users u, temp_user t 
				 WHERE t.emp_id=u.emp_id 
				   AND u.parent_id=$user_id
				   AND t.deleted=0
				   AND t.approved=0";
				   //echo $sql; exit;
		$edit_num = $this->CI->db->query($sql)->row()->user_num;
		
		$sql = "SELECT count(to_id) pays_num 
				 FROM queued_payments 
				WHERE to_id=$user_id
				  AND approved=0
				  AND canceled=0";
		$pays_num = $this->CI->db->query($sql)->row()->pays_num;
		
		$sql =  "SELECT * 
				   FROM notifications n, operations o 
				  WHERE n.op_id=o.op_id
				    AND n.read=0
				    AND n.notified=0
				    AND n.user_id=$user_id 
				";
		$notifcs = $this->CI->db->query($sql)->result();
		$sql =  "SELECT * 
				   FROM notifications n, operations o 
				  WHERE n.op_id=o.op_id
				    AND n.user_id=$user_id 
				    AND n.notified=1
				  ORDER BY n.not_id DESC
				  LIMIT 0, 5
				";
		//echo $sql; exit;
		$oldnotif = $this->CI->db->query($sql)->result();
		$this->CI->db->where('user_id', $user_id);
		$this->CI->db->update('notifications', array('notified' => 1));
		
		$news = $this->CI->db->get('commisions')->row()->marquee;
		
		$res = array(
						'edit_num' => $edit_num, 
						'pays_num' => $pays_num, 
						'notifcs'  => $notifcs, 
						'oldnotif' => $oldnotif,
						'marquee'  => $news
					);
		$this->CI->session->set_userdata('statics', $res);
		return $res;
	}
	
	public function sendmail($sender='', $reciver='', $subject='', $message='')
	{
		return True;
		$sender = $sender ? $sender : 'noreply@dalilacom.com';
		$config = Array( 
							'protocol'  => 'smtp', 
							'smtp_host' => 'smtpout', 
							'smtp_port' => '3535', 
							'smtp_user' => 'noreply@ex.com', 
							'smtp_pass' => ''
						); 
		
		$this->CI->load->library('email', $config); 
		$this->CI->email->set_newline("\r\n");
		$this->CI->email->from($sender, 'Farma | Support');
		$this->CI->email->to($reciver);
		$this->CI->email->subject($subject); 
		$this->CI->email->message($message);
		if (!$this->CI->email->send()) {
			return FALSE;
		} else {
		    return TRUE;
		}
   
	}
	
	public function send_sms($to='', $var='', $msg='')
	{
	    return true;
		$message = '';
		switch ($msg) {
			case 'password':
				$message = "Your account password is $var";
				break;
			case 'text_sms':
				$message = $var;
				break;
			case 'pend_money':
				$message = "تم إيقاف وكالتك ماليا بسبب عدم التزامك حضور الكورس، يرجى مراجعة الادارة";
				break;
			default:
				
				break;
		}
		
		$message =  mb_convert_encoding(bin2hex(mb_convert_encoding($message, 'UCS-2', 'auto')), 'UTF-8', 'auto');
		
		$from = urlencode($from);
		//$msg = utf8_decode($msg);
		
		//echo $msg; exit;
		$message = urlencode($message);
		$url = "http://Services.mtn.com.sy/General/ConcatenatedSender.asp?User=IHCenter&Pass=IHC421&From=Winner&Gsm=$to&Msg=$message&Lang=0";
		//echo $url; exit;
		//echo $url; exit;
		$res = file_get_contents($url);
		//echo "$res"; exit;
		if ($res == $to) {
			return 1;
		} else {
			return 0;
		}
		
	}
	
	public function ftp_trans($filename='')
	{
		return TRUE;
		if (!$filename) {
			return FALSE;
		}
		$ftp_server = "ftp.hybridware.co";
		$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
		$login = ftp_login($ftp_conn, 'ads@hybridware.co', 'aZ06chLwxZsL');
		
		$file = base_url()."uploads/$filename";
		error_reporting(0);
		// upload file
		if (ftp_put($ftp_conn, "/website/uploads/$filename", $file, FTP_ASCII)) {
			//echo "string";
			ftp_close($ftp_conn);
			//exit;
			return TRUE;
		} else {
			//echo "no";
			ftp_close($ftp_conn);
			//exit;
			return FALSE;
		}
	}
}
