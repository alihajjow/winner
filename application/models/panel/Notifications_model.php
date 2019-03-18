<?php
/**
 * 
 */
class Notifications_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function get_notifications($user_id)
	{
		$sql =  "SELECT * 
				   FROM notifications n, operations o 
				  WHERE n.op_id=o.op_id
				    AND n.read=0
				    AND n.informed=0
				    AND n.notified=0
				    AND n.user_id=$user_id";
		$result = $this->db->query($sql);
		return $result;
	}
	
	public function read($user_id='')
	{
		$this->db->where(array('user_id' => $user_id, 'read' => 0));
		$update = array (
							'read' 		=> 1,
							'read_time' => time()
						);
		$this->db->update('notifications', $update);
		return $this->db->affected_rows();
	}
	
	public function all_notifications($user_id)
	{
		$sql =  "SELECT * 
				   FROM notifications n, operations o 
				  WHERE n.op_id=o.op_id
				    AND n.user_id=$user_id 
				  ORDER BY n.not_id DESC
				  LIMIT 0, 20";
		return $this->db->query($sql);
	}
	
	public function more_notifications($user_id, $f_id)
	{
		$f_id *= 20;
		$sql =  "SELECT * 
				   FROM notifications n, operations o 
				  WHERE n.op_id=o.op_id
				    AND n.user_id=$user_id 
				  ORDER BY n.not_id DESC
				  LIMIT $f_id, 20";
		//echo $sql; exit;
		return $this->db->query($sql);
		
	}
}
