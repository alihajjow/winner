<?php
/**
 * 
 */
class Excel extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function export_level_students($lev_id='')
	{
		have_access(60);
		$students = '';
		if ($_POST) {
			$students = $this->input->post('export');
		}
		$cond = $students ? implode(',', $students) : '';
		$cond = $cond ? "AND u.emp_id IN ($cond)" : "";
		$file="num_list.xls";
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=$file");
		$sql = "SELECT u.mobile , CONCAT_WS(' ', u.f_name, u.l_name) full_name, u.username
				  FROM users u, user_course uc
				 WHERE u.emp_id=uc.user_id
				   AND uc.lev_id=$lev_id
				   $cond";
		$res = $this->db->query($sql);
		if (!$res->num_rows()) {
			redirect(base_url()."get_std_lev/$lev_id");
		}
		echo "<table>";
		foreach ($res->result() as $row) {
			$mobile = "963".substr($row->mobile, 1);
			$name = iconv("utf-8", "windows-1256", $row->full_name);
			echo "<tr>";
			echo 	"<td>$row->username</td>";
			echo 	"<td>$mobile</td>";
			echo "</tr>";
		}
				
		echo "</table>";
		//redirect(base_url()."get_std_lev/$lev_id");
	}
}
