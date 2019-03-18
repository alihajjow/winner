<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function __construct()
	{
		parent::__construct();
		need_login();
        //echo "dfasda"; exit;
        error_reporting(0);
        get_statics();
        $this->session->set_userdata('this_url', current_url());
		
        if (LANG() != 'en') {
            $this->lang->load("user","arabic");
            $this->lang->load("sidebar","arabic");
            $this->lang->load("header","arabic");
			$this->lang->load("banks","arabic");
			$this->lang->load("form_validation","arabic");
        } else {
            $this->lang->load("user","english");
            $this->lang->load("sidebar","english");
            $this->lang->load("header","english");
			$this->lang->load("banks","english");
        } 
	}
	
	public function home($value='')
	{
		$data = array();
		$this->load->view('new_home', $data);
	}
	
	public function index($value='')
	{
		$user_id = $this->session->userdata('user_id');

		$sql = "SELECT COUNT(s.user_id) all_count, c.c_name
		          FROM stored_bal s, courses c, user_course uc
		         WHERE s.user_id=uc.user_id 
		           AND uc.course_id=c.c_id
		           AND s.parent_id=$user_id
		      GROUP BY c.c_id
		      ORDER BY c.c_id";
		$statics = $this->db->query($sql)->result();


		$sql = "SELECT DATE(from_unixtime(u.reg_date)) as date, COUNT(u.emp_id) dayt 
                  FROM users u, stored_bal sb
                 WHERE sb.user_id=u.emp_id
                   AND sb.parent_id=$user_id
              GROUP BY DATE(from_unixtime(reg_date)) 
              ORDER BY reg_date DESC 
                 LIMIT 10";
        $day_stacks = $this->db->query($sql)->result_array();
        $day_stacks = array_reverse($day_stacks);

        $sql = "SELECT DATE_FORMAT(from_unixtime(u.reg_date), '%Y-%m') as date, COUNT(u.emp_id) dayt 
                  FROM users u, stored_bal sb
                 WHERE sb.user_id=u.emp_id
                   AND sb.parent_id=$user_id
              GROUP BY DATE_FORMAT(from_unixtime(u.reg_date), '%Y-%m') 
              ORDER BY reg_date DESC 
                 LIMIT 6";
        $month_stacks = $this->db->query($sql)->result_array();
        $month_stacks = array_reverse($month_stacks);

        $sql = "SELECT c.c_name
                  FROM courses c, user_course uc
                 WHERE uc.course_id=c.c_id
                   AND uc.user_id=$user_id 
              ORDER BY uc.id DESC
                 LIMIT 1";
        $course = $this->db->query($sql)->row()->c_name;

        $sql = "SELECT u.f_name, u.l_name, u.father_name, u.gov_id, u.emp_id, u.email
                  FROM users u, stored_bal sb
                 WHERE u.emp_id=sb.user_id
                   AND sb.parent_id=$user_id
                 LIMIT 100 ";
        $children = $this->db->query($sql)->result();

		$this->load->model('panel/payments_model', 'payments');
		$balance = $this->payments->get_balance($user_id);
		$r_count = $this->db->get_where('stored_bal', array('parent_id' => $user_id, 'parent_type' => 'r'))->num_rows();
		$l_count = $this->db->get_where('stored_bal', array('parent_id' => $user_id, 'parent_type' => 'l'))->num_rows();
		$count = $l_count > $r_count ? $r_count : $l_count;
		$count = $count * 2;
		
		$sql = "SELECT * FROM specifications WHERE count <= $count ORDER BY id desc LIMIT 1";
		$data['desc'] = $this->db->query($sql)->row() ? $this->db->query($sql)->row()->text : trans('not_classed');
        $data['statics'] = $statics;
        $data['children'] = $children;
        $data['day_stacks'] = $day_stacks;
        $data['month_stacks'] = $month_stacks;
		$data['balance'] = $balance;
		$data['course'] = $course;
		$this->load->view('home', $data);
	}
	
	public function index1($value='')
	{
		$user_id = $this->session->userdata('user_id');
		
		$left_id = $this->db->get_where('users', array('parent_id' => $user_id, 'parent_type' => 'l'));
		$left_id = $left_id->num_rows() ? $left_id->row()->username : '';
		
		$right_id = $this->db->get_where('users', array('parent_id' => $user_id, 'parent_type' => 'r'));
		$right_id = $right_id->num_rows() ? $right_id->row()->username : '';
		
		$left = $left_id ? $this->db->get_where('users', array('username' => $left_id))->row() : '';
		$right = $right_id ? $this->db->get_where('users', array('username' => $right_id))->row() : '';
		$sql = "SELECT u.f_name, u.l_name, u.emp_id, u.username, u.mother_name, u.birth_date, u.address, cl.lev_name, c.c_name
					  FROM users u
					  JOIN user_course uc ON uc.user_id=u.emp_id
					  JOIN course_levels cl ON cl.lev_id=uc.lev_id
					  JOIN courses c ON c.c_id=cl.course_id
					 WHERE u.emp_id=$user_id"; 
		$me = $this->db->query($sql)->row();
		
		$this->session->set_userdata('ids', array('left_id' => $left_id, 'right_id' => $right_id));
		
		$data = array(
						'me' 	=> $me,
						'left' 	=> $left,
						'right' => $right
					 );
		$this->load->model('panel/payments_model', 'payments');
		$balance = $this->payments->get_balance($user_id);
		$r_count = $this->db->get_where('stored_bal', array('parent_id' => $user_id, 'parent_type' => 'r'))->num_rows();
		$l_count = $this->db->get_where('stored_bal', array('parent_id' => $user_id, 'parent_type' => 'l'))->num_rows();
		$count = $l_count > $r_count ? $r_count : $l_count;
		$count = $count * 2;
		
		$sql = "SELECT * FROM specifications WHERE count <= $count ORDER BY id desc LIMIT 1";
		$data['desc'] = $this->db->query($sql)->row() ? $this->db->query($sql)->row()->text : trans('not_classed');
		
		$data['balance'] = $balance;
		$this->load->view('main_view', $data);
	}
	
	public function tree($value='')
	{
		
		$user_id = $this->session->userdata('user_id');
		
		$sql = "SELECT CONCAT_WS(' ', u.f_name, u.l_name) name,'title' title, u.emp_id, u.parent_id d_parent, s.parent_id
					  FROM users u, stored_bal s
					 WHERE u.emp_id=s.user_id
					   AND (s.parent_id=$user_id OR u.emp_id=$user_id) LIMIT 150"; 
		//echo $sql; exit;
		$children = $this->db->query($sql)->result_array();
		//print_r($children); exit;
		

		$new = array();
		$parent = array('emp_id' => $user_id, 'd_parent' => 0, 'name' => 'me', 'title' => 'title');
		foreach ($children as $a){
		    $new[$a['d_parent']][] = $a;
		}
		//echo "<pre>";
		//print_r(array($parent));	exit;
		//exit;
		$tree = $this->createtree($new, array($parent));
		$tree = json_encode($tree);
		echo substr($tree, 1, strlen($tree) - 2);
		//echo "<pre>";
		//print_r($tree);	
		
	}
	
	
	
	public function createtree($list, $parent){
		//echo "string";
		//exit;
	    $tree = array();
	    foreach ($parent as $k=>$l){
	        if(isset($list[$l['emp_id']])){
	            $l['children'] = $this->createtree($list, $list[$l['emp_id']]);
	        }
	        $tree[] = $l;
	    } 
	    return $tree;
	}
	
	public function get_mytree($value='')
	{
		$user_id = $this->session->userdata('user_id');
		
		$sql = "SELECT CONCAT_WS(' ', u.f_name, u.l_name) fullname, u.emp_id, u.parent_id d_parent, s.parent_id
					  FROM users u, stored_bal s
					 WHERE u.emp_id=s.user_id
					   AND s.parent_id=$user_id LIMIT 150"; 
		//echo $sql; exit;
		$children = $this->db->query($sql)->result();
		$mytree = array();
		//$i = 0; 
		echo "<pre>"; 
		foreach ($children as $row) {
			$parent = $row->d_parent;
			$i= 0;
			foreach ($children as $r) {
				if ($parent == $r->d_parent) {
					$mytree[$row->d_parent][$row->emp_id] = $row->fullname;
					//echo "$parent == $r->d_parent fath $row->fullname ---son $r->fullname";
					
				}
				
			} 
			//echo "<br>";
			//$mytree[$row->d_parent] = $row->fullname;
		}
		
		$last_tree = array();
		$temp = array();
		foreach ($mytree as $key => $value) {
			foreach ($value as $k => $val) {
				if ($key = $k) {
					
				}
			}
		}
		
		print_r($mytree); 
	}
	
	public function get_sons($username='')
	{
		$ids = $this->session->userdata('ids');
		
		if (!in_array($username, $ids) && !have_access(51, TRUE)) {
			$this->messages->error(trans('must_come_step'));
			redirect(base_url());
		}
		$user_id = $this->db->get_where('users', array('username' => $username))->row()->emp_id;
		
		$left_id = $this->db->get_where('users', array('parent_id' => $user_id, 'parent_type' => 'l'));
		$left_id = $left_id->num_rows() ? $left_id->row()->username : '';
		
		$right_id = $this->db->get_where('users', array('parent_id' => $user_id, 'parent_type' => 'r'));
		$right_id = $right_id->num_rows() ? $right_id->row()->username : '';
		
		$left = $left_id ? $this->db->get_where('users', array('username' => $left_id))->row() : '';
		$right = $right_id ? $this->db->get_where('users', array('username' => $right_id))->row() : '';
		$me = $this->db->get_where('users', array('emp_id' => $user_id))->row();
		
		$this->session->set_userdata('ids', array('username' => $left_id, 'username' => $right_id));
		
		$data = array(
						'me' 	=> $me,
						'left' 	=> $left,
						'right' => $right
					 );
		$this->load->model('panel/payments_model', 'payments');
		$balance = $this->payments->get_balance($user_id);
		
		$r_count = $this->db->get_where('stored_bal', array('parent_id' => $user_id, 'parent_type' => 'r'))->num_rows();
		$l_count = $this->db->get_where('stored_bal', array('parent_id' => $user_id, 'parent_type' => 'l'))->num_rows();
		$count = $l_count > $r_count ? $r_count : $l_count;
		$count = $count * 2;
		
		if ($this->session->userdata('user_id') == 1) {
			//echo $count; exit;
		}
		$sql = "SELECT * FROM specifications WHERE count <= $count ORDER BY id desc LIMIT 1";
		if ($this->session->userdata('user_id') == 1) {
			//echo $sql; exit;
		}
		$data['desc'] = $this->db->query($sql)->row() ? $this->db->query($sql)->row()->text : trans('not_classed');
		if ($this->session->userdata('user_id') == 1) {
			//echo $data['desc']; exit;
		}
		$data['balance'] = $balance;
		$this->session->set_userdata('ids', array('left_id' => $left_id, 'right_id' => $right_id));
		$this->load->view('main_view', $data);
	}
}
