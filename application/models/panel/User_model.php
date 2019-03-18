<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
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
    }


    public function create_new_user($first_name, $last_name, $username, $password, $email, $father_name, $mother_name, $gov_id, $birth_place, $birth_date, $civil_reg, $amaneh, $address, $mobile, $inheritor, $area_id)
    {


        $rand = substr(md5(rand(1000, 9999)), 0, 6);
        $pass = substr(md5(rand(1000, 9999)), 0, 6);
        if (!$_FILES) {

            return array(0, 0);

        }

        $fs_images = array();
        $i = 0;
        $logos[] = array();
        $errors = array();
        $ext = array();
        $config['upload_path'] = 'uploads/profile';
        $path = $config['upload_path'];
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';
        $config['overwrite'] = FALSE;
        $this->load->library('upload');

        foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
        {
            //echo "<pre>"
            //print_r($expression)$fieldname $fileObject;
            if (!empty($fileObject['name'])) {
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($fieldname)) {
                    $error = $this->upload->display_errors();
                    $errors[] = $error;
                } else {
                    $upload_data = $this->upload->data();
                    //$ext[$config['file_name']] = $upload_data['file_ext'];
                    //echo $fieldname . $upload_data['file_name'].'gfdg<br>';
                    $fs_images[$i] = $upload_data['file_name'];
                    $i++;
                }
            }
        }
        //print_r($fs_images); echo "<br>"; print_r($errors);
        //exit;
        if ($errors) {
            return array(0, $errors[0]);
        }
        //echo "$film1logo $film2logo $film3logo"; exit;
        $insert = array(
            'img' => @$fs_images[0],
            'f_name' => $first_name,
            'l_name' => $last_name,
            'parent_id' => $this->session->userdata('user_id'),
            'father_name' => $father_name,
            'mother_name' => $mother_name,
            'username' => $username,
            'password' => $pass,
            'gov_id' => $gov_id,
            'civil_reg' => $civil_reg,
            'amaneh' => $amaneh,
            'address' => $address,
            'mobile' => $mobile,
            'reg_date' => time(),
            'email' => $email,
            'birth_date' => $birth_date,
            'pay_pass' => $rand,
            'birth_place' => $birth_place,
            'balance' => 0,
            'inheritor' => $inheritor,
            'area_id' => $area_id
        );
        //echo "<pre>";
        //print_r($insert); exit;
        $this->session->set_userdata('new_student', $insert);


        return $this->session->userdata('new_student') ? array(1, 0) : array(0, 0);
    }

    public function get_comms($user_id, $from_date, $to_date)
    {
        $sql = "SELECT u.*, sb.comm, sb.paid_date, sb.parent_type p_type
        		  FROM users u, stored_bal sb
        		 WHERE u.emp_id=sb.user_id
        		   AND sb.parent_id=$user_id
        		   AND sb.paid=1
        		   AND sb.paid_date BETWEEN $from_date AND $to_date
        		 ORDER BY p_type";
        if ($this->session->userdata('user_id') == 1) {
            //echo $sql; exit;
            //echo date('Y-m-d 23:59:59', $to_date);
            //exit;
        }
        $res = $this->db->query($sql);
        return $res;
    }

    public function get_studs($user_id, $from_date, $to_date)
    {
        $sql = "SELECT u.*, sb.comm, sb.paid_date, sb.parent_type p_type, cl.lev_name, c.c_name
        		  FROM users u, stored_bal sb, course_levels cl, user_course uc, courses c
        		 WHERE u.emp_id=sb.user_id
        		   AND uc.lev_id=cl.lev_id
        		   AND uc.user_id=u.emp_id
        		   AND c.c_id=cl.course_id
        		   AND sb.parent_id=$user_id
        		   AND u.reg_date BETWEEN $from_date AND $to_date
        		 ORDER BY p_type";
        //echo $sql; exit;
        if ($this->session->userdata('user_id') == 1) {
            //echo $sql; exit;
            //echo date('Y-m-d 23:59:59', $to_date);
            //exit;
        }
        $res = $this->db->query($sql);
        return $res;
    }

    public function get_alldetails($user_id, $from_date = '', $to_date = '')
    {
        $from_date = $from_date ? strtotime($from_date) : time() - 2592000;
        $to_date = $to_date ? strtotime($to_date) : time();

        $sql = "SELECT * FROM session_log WHERE user_id=$user_id AND start_time BETWEEN $from_date AND $to_date";
        $sessions = $this->db->query($sql)->result();

        $sql = "SELECT p.*, pc.*, concat_ws(' ', u.f_name, u.l_name) full_name , des.username
				  FROM users u, users des, payments p, payment_categories pc
				 WHERE p.pay_cat_id=pc.pay_cat_id
                   AND u.emp_id=p.emp_id
                   AND p.payment_date between $from_date AND $to_date
                   AND (
                   			p.emp_id=$user_id AND p.to_id=des.emp_id
                   		OR
                   			p.to_id=$user_id AND p.to_id=u.emp_id
                   		)
                   ";
        $payments = $this->db->query($sql)->result();

        $sql = "SELECT uc.*, cl.*, c.*
				  FROM user_course uc, users u, course_levels cl, courses c
				 WHERE u.emp_id=$user_id
				   AND cl.lev_id=uc.lev_id
				   AND uc.user_id=u.emp_id
				   AND c.c_id=cl.course_id";
        $courses = $this->db->query($sql)->result();

        $sql = "SELECT *
				  FROM notifications n, operations o
				 WHERE n.op_id=o.op_id
				   AND n.user_id=$user_id
				   AND n.date BETWEEN $from_date AND $to_date";
        $notifications = $this->db->query($sql)->result();

        $sql = "SELECT u.*, concat_ws(' ', p.f_name, p.l_name) full_name
				  FROM users u
				  LEFT JOIN  users p ON u.parent_id=p.emp_id
				 WHERE  u.emp_id=$user_id";
        $user = $this->db->query($sql)->row();
        $result = array(
            'sessions' => $sessions,
            'payments' => $payments,
            'courses' => $courses,
            'notifications' => $notifications,
            'user' => $user
        );
        return $result;
    }

    public function modify_cource($uc_id, $course, $course_lvl)
    {
        //echo "$uc_id, $course, $course_lvl"; exit;
        $update = array(
            'lev_id' => $course_lvl,
            'course_id' => $course
        );
        $this->db->where('id', $uc_id);
        $this->db->update('user_course', $update);
        return $this->db->affected_rows();
    }

    public function get_course_cats($value = '')
    {
        return $this->db->get('courses_cats');
    }

    public function register($course_cat, $course, $course_lvl, $student = array())
    {
        if (!$student) {
            return 0;
        }
        $is_correct = $this->db->get_where('course_levels', array('lev_id' => $course_lvl, 'course_id' => $course))->num_rows();

        if (!$is_correct) {
            $this->session->unset_userdata('new_student');
            return FALSE;
        }

        $is_correct = $this->db->get_where('courses', array('c_id' => $course))->num_rows();

        if (!$is_correct) {
            $this->session->unset_userdata('new_student');
            return FALSE;
        }

        $user_id = $this->session->userdata('user_id');
        $balance = $this->get_balance($user_id);
        $actual_balance = $this->db->get_where('users', array('emp_id' => $user_id))->row()->balance;
        $admin_balance = $this->db->get_where('users', array('emp_id' => 1))->row()->balance;
        $price = $this->db->get_where('course_levels', array('lev_id' => $course_lvl))->row()->price;

        if ($balance < $price) {
            $this->session->unset_userdata('new_student');
            return FALSE;
        }
        $my_users = 0;
        $this->db->trans_start();
        if ($student) {
            //$price -= 500;
            //$old_user = $this->db->get_where('users', array('parent_id' => $user_id, 'parent_type' => 'l'))->num_rows();
            //$dir = $old_user ? 'r' : 'l';
            $student['parent_type'] = '';
            $pay_pass = $student['pay_pass'];
            $pass = $student['password'];
            $mobile = $student['mobile'];
            $student['pay_pass'] = sha1($pay_pass);
            $student['password'] = sha1($pass);
            $this->db->insert('users', $student);

            $user_id = $this->db->insert_id();
            $parent_id = $student['parent_id'] ? $student['parent_id'] : $this->session->userdata('user_id');
            //echo $student['parent_id']; exit;
            $sql = "SELECT emp_id, parent_id FROM `users` WHERE `parent_id`=$parent_id";
            //echo $sql; exit;

            $type = '';
            $i = 0;
            while ($parent_id) {
                //$type = $type ? $type : $student['parent_type'];

                $insert = array(
                    'user_id' => $user_id,
                    'parent_id' => $parent_id,
                    'add_date' => time(),
                    'parent_type' => $i + 1
                );
                $this->db->insert('stored_bal', $insert);
                $type = $this->db->get_where('users', array('emp_id' => $parent_id))->row()->parent_type;
                $parent_id = $this->db->get_where('users', array('emp_id' => $parent_id));
                $parent_id = $parent_id->num_rows() ? $parent_id->row()->parent_id : '';
                $i++;
                if ($i == 5) {
                    break;
                }
                //echo $parent_id."<br>";
            }

            //exit;

            $insert = array(
                'emp_id' => $user_id,
                'role_id' => 3
            );
            $this->db->insert('roles_emps', $insert);

            $insert = array(
                'user_id' => $user_id,
                'op_id' => 3,
                'n_text' => "عزيزي الطالب " . $student['f_name'] . ' ' . $student['l_name'] . " your password is $pay_pass thnak you ",
                'date' => time(),
                'link' => '#'
            );
            $this->db->insert('notifications', $insert);
            $mobile = (int)$mobile;
            $mobile = '963' . $mobile;
            $msg = "password";
            $this->auth->send_sms($mobile, $pass, $msg);

            $this->session->unset_userdata('new_student');
        }
        $insert = array(
            'user_id' => $user_id,
            'lev_id' => $course_lvl,
            'course_id' => $course,
            'reg_date' => time()
        );
        $this->db->insert('user_course', $insert);

        $insert = array(
            'emp_id' => $this->session->userdata('user_id'),
            'to_id' => 1,
            'pay_cat_id' => 2,
            'debit' => $price,
            'credit' => 0,
            'old_balance' => $actual_balance,
            'new_balance' => $actual_balance - $price,
            'payment_date' => time()

        );
        $this->db->insert('payments', $insert);

        $insert = array(
            'emp_id' => 1,
            'to_id' => 0,
            'pay_cat_id' => 2,
            'debit' => 0,
            'credit' => $price,
            'old_balance' => $admin_balance,
            'new_balance' => $admin_balance + $price,
            'payment_date' => time()

        );
        $this->db->insert('payments', $insert);


        $update = array(
            'balance' => $actual_balance - $price
        );
        $this->db->where('emp_id', $this->session->userdata('user_id'));
        $this->db->update('users', $update);

        $update = array(
            'balance' => $admin_balance + $price
        );
        $this->db->where('emp_id', 1);
        $this->db->update('users', $update);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function register_course($course_cat, $course, $course_lvl)
    {
        $is_correct = $this->db->get_where('course_levels', array('lev_id' => $course_lvl, 'course_id' => $course))->num_rows();

        if (!$is_correct) {
            return FALSE;
        }
        exit;
        $is_correct = $this->db->get_where('courses', array('c_id' => $course))->num_rows();

        if (!$is_correct) {
            return FALSE;
        }

        $user_id = $this->session->userdata('user_id');
        $balance = $this->get_balance($user_id);
        $actual_balance = $this->db->get_where('users', array('emp_id' => $user_id))->row()->balance;
        $admin_balance = $this->db->get_where('users', array('emp_id' => 1))->row()->balance;
        $price = $this->db->get_where('course_levels', array('lev_id' => $course_lvl))->row()->price;

        if ($balance < $price) {
            return FALSE;
        }
        $my_users = 0;
        $this->db->trans_start();

        $insert = array(
            'user_id' => $user_id,
            'lev_id' => $course_lvl,
            'course_id' => $course,
            'reg_date' => time()
        );
        $this->db->insert('user_course', $insert);

        $insert = array(
            'emp_id' => $this->session->userdata('user_id'),
            'to_id' => 1,
            'pay_cat_id' => 2,
            'debit' => $price,
            'credit' => 0,
            'old_balance' => $actual_balance,
            'new_balance' => $actual_balance - $price,
            'payment_date' => time()

        );
        $this->db->insert('payments', $insert);

        $insert = array(
            'emp_id' => 1,
            'to_id' => 0,
            'pay_cat_id' => 2,
            'debit' => 0,
            'credit' => $price,
            'old_balance' => $admin_balance,
            'new_balance' => $admin_balance + $price,
            'payment_date' => time()

        );
        $this->db->insert('payments', $insert);


        $update = array(
            'balance' => $actual_balance - $price
        );
        $this->db->where('emp_id', $this->session->userdata('user_id'));
        $this->db->update('users', $update);

        $update = array(
            'balance' => $admin_balance + $price
        );
        $this->db->where('emp_id', 1);
        $this->db->update('users', $update);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function get_balance($user_id = '')
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

    public function admin_new_user($parent_id, $first_name, $last_name, $username, $password, $email, $father_name, $mother_name, $gov_id, $birth_place, $birth_date, $civil_reg, $amaneh, $address, $mobile)
    {

        $my_users = $this->db->get_where('users', array('parent_id' => $parent_id))->num_rows();

        $max_redirect = 2; //$this->db->get_where('users', array('emp_id' => $this->session->userdata('user_id')))->row()->max_directs;
        //echo $max_redirect.'  '.$my_users; exit;
        if ($max_redirect && $my_users >= $max_redirect) {
            return FALSE;
        }

        $rand = substr(md5(rand(1000, 9999)), 0, 6);

        $insert = array(
            'f_name' => $first_name,
            'l_name' => $last_name,
            'parent_id' => $parent_id,
            'father_name' => $father_name,
            'mother_name' => $mother_name,
            'username' => $username,
            'password' => $password,
            'gov_id' => $gov_id,
            'civil_reg' => $civil_reg,
            'amaneh' => $amaneh,
            'address' => $address,
            'mobile' => $mobile,
            'reg_date' => time(),
            'email' => $email,
            'birth_date' => $birth_date,
            'pay_pass' => $rand,
            'birth_place' => $birth_place,
            'balance' => 15000
        );
        //echo "<pre>";
        //print_r($insert); exit;
        $this->session->set_userdata('new_student', $insert);
        return $this->session->userdata('new_student') ? 1 : 0;

    }


    public function edit_user($first_name, $last_name, $email, $father_name, $mother_name, $gov_id, $birth_place, $birth_date, $civil_reg, $amaneh, $address, $mobile)
    {


        $this->db->trans_start();
        $insert = array(

            'f_name' => $first_name,
            'l_name' => $last_name,
            'emp_id' => $this->session->userdata('user_id'),
            'father_name' => $father_name,
            'mother_name' => $mother_name,
            'gov_id' => $gov_id,
            'civil_reg' => $civil_reg,
            'amaneh' => $amaneh,
            'address' => $address,
            'mobile' => $mobile,
            'email' => $email,
            'birth_date' => $birth_date,
            'birth_place' => $birth_place
        );

        $this->db->insert('temp_user', $insert);

        $user_id = $this->session->userdata('user_id');
        $user = $this->db->get_where('users', array('emp_id' => $user_id))->row();

        $insert = array(
            'user_id' => $user->parent_id,
            'op_id' => 3,
            'n_text' => "قام الطالب $user->f_name $user->l_name بتقديم طلب تعديل بيانات",
            'date' => time(),
            'link' => 'edit_request_data/' . $user_id
        );
        $this->db->insert('notifications', $insert);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function edited_user($id, $first_name, $last_name, $email, $father_name, $mother_name, $gov_id, $birth_place, $birth_date, $civil_reg, $amaneh, $address, $mobile)
    {
        $update = array('img' => $img,
            'f_name' => $first_name,
            'l_name' => $last_name,
            // 'emp_id'     	=> $this->session->userdata('user_id'),
            'father_name' => $father_name,
            'mother_name' => $mother_name,
            'gov_id' => $gov_id,
            'civil_reg' => $civil_reg,
            'amaneh' => $amaneh,
            'address' => $address,
            'mobile' => $mobile,
            'email' => $email,
            'birth_date' => $birth_date,
            'birth_place' => $birth_place
        );
        //echo $id; exit;
        $this->db->trans_start();
        $emp_id = $this->db->get_where('temp_user', array('id' => $id))->row()->emp_id;
        $parent_id = $this->db->get_where('users', array('emp_id' => $emp_id))->row()->parent_id;
        if ($parent_id != $this->session->userdata('user_id') && !have_access(46, TRUE)) {
            return FALSE;
        }
        //print_r( $emp_id); exit;
        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', $update);

        $this->db->where('id', $id);
        $this->db->update('temp_user', array('approved' => 1));


        $insert = array(
            'user_id' => $emp_id,
            'op_id' => 3,
            'n_text' => "قام الطالب المسؤول عنك بتأكيد طلب تعديل بيانات",
            'date' => time(),
            'link' => '#'
        );
        $this->db->insert('notifications', $insert);

        $this->db->trans_complete();
        return $this->db->trans_status();

    }

    public function edit_student($id, $first_name, $last_name, $email, $father_name, $mother_name, $gov_id, $birth_place, $birth_date, $civil_reg, $amaneh, $address, $mobile, $password, $inheritor, $balance, $pay_pass)
    {
        $this->db->trans_start();
        $update = array(
            'f_name' => $first_name,
            'l_name' => $last_name,
            'father_name' => $father_name,
            'mother_name' => $mother_name,
            'gov_id' => $gov_id,
            'civil_reg' => $civil_reg,
            'amaneh' => $amaneh,
            'address' => $address,
            'mobile' => $mobile,
            'email' => $email,
            'birth_date' => $birth_date,
            'birth_place' => $birth_place,
            'inheritor' => $inheritor
        );
        if ($password) {
            $update['password'] = $password;
        }

        if ($pay_pass) {
            $pay_pass = sha1($pay_pass);
            $update['pay_pass'] = $pay_pass;
        }

        if (have_access(49, TRUE)) {
            $update['balance'] = $balance;
        }

        $this->db->where('emp_id', $id);
        $this->db->update('users', $update);

        $insert = array(
            'user_id' => $id,
            'op_id' => 3,
            'n_text' => "قام الأدمن بتعديل بياناتك الشخصية",
            'date' => time(),
            'link' => '#'
        );
        $this->db->insert('notifications', $insert);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }


    public function edit_data()
    {
        $parent_id = $this->session->userdata('user_id');
        $this->db->where(array('deleted' => 0, 'approved' => 0));
        $query = $this->db->get('temp_user');


        return $query->result();

    }

    public function get_edit_data($id)
    {
        //print_r($id); exit();
        $this->db->where(array('id' => $id, 'approved' => 0, 'deleted' => 0));
        $query = $this->db->get('temp_user');


        return $query->result();

    }


    public function admin_edited_user($id, $first_name, $last_name, $email, $father_name, $mother_name, $gov_id, $birth_place, $birth_date, $civil_reg, $amaneh, $address, $mobile)
    {
        $update = array(
            'f_name' => $first_name,
            'l_name' => $last_name,
            // 'emp_id'     	=> $this->session->userdata('user_id'),
            'father_name' => $father_name,
            'mother_name' => $mother_name,
            'gov_id' => $gov_id,
            'civil_reg' => $civil_reg,
            'amaneh' => $amaneh,
            'address' => $address,
            'mobile' => $mobile,
            'email' => $email,
            'birth_date' => $birth_date,
            'birth_place' => $birth_place
        );
        //echo $id; exit;
        $this->db->trans_start();
        $emp_id = $this->db->get_where('temp_user', array('id' => $id))->row()->emp_id;
        //print_r( $emp_id); exit;
        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', $update);

        $this->db->where('id', $id);
        $this->db->update('temp_user', array('approved' => 1));


        $insert = array(
            'user_id' => $emp_id,
            'op_id' => 3,
            'n_text' => "قام الطالب المسؤول عنك بتأكيد طلب تعديل بيانات",
            'date' => time(),
            'link' => '#'
        );
        $this->db->insert('notifications', $insert);

        $this->db->trans_complete();
        return $this->db->trans_status();

    }


    public function admin_edit_data()
    {
        $this->db->where(array('deleted' => 0, 'approved' => 0));
        $query = $this->db->get('temp_user');


        return $query->result();

    }

    public function admin_get_edit_data($id)
    {
        //print_r($id); exit();
        $this->db->where(array('id' => $id, 'approved' => 0, 'deleted' => 0));
        $query = $this->db->get('temp_user');


        return $query->result();

    }

    public function std_data($id)
    {
        $this->db->where('emp_id', $id);
        $query = $this->db->get('users');


        return $query->result();

    }

    public function check_oldrequest($user_id)
    {
        $this->db->where(array('emp_id' => $user_id, 'deleted' => 0, 'approved' => 0));

        $query = $this->db->get('temp_user');
        //echo $query->num_rows(); //exit;
        return $query->num_rows();


    }


    public function change_pass($id, $password)
    {
        $update = array('password' => sha1($password));
        $this->db->trans_start();
        $this->db->where('emp_id', $id);
        $this->db->update('users', $update);
        $this->db->trans_complete();

        return $this->db->trans_status();


    }

    /*

    public function check_oldpass($old)
    {

    $id = $this->session->userdata('user_id');

    $res = $this->db->get_where('users', array('emp_id' => $id, 'password' => sha1($old)));
    //print_r($sql->num_rows()); exit();
    //$user = $this->db->get_where('users', array('emp_id' => $id, 'password' => sha1($old)));
    //	print_r($sql); exit();

         if ($res->num_rows()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    */


    public function add_course_cat($course_cat_name, $cat_name_en, $desc_ar, $desc_en)
    {
        $fs_images = array();
        $errors = array();
        $ext = array();
        $i = 0;
        $config['upload_path'] = 'uploads/courses';
        $path = $config['upload_path'];
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '5000';
        $config['max_height'] = '5000';
        $config['overwrite'] = FALSE;
        $this->load->library('upload');
        foreach ($_FILES as $fieldname => $fileObject) {
            if (!empty($fileObject['name'])) {
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($fieldname)) {
                    $error = $this->upload->display_errors();
                    $errors[] = $error;
                } else {
                    $upload_data = $this->upload->data();
                    $fs_images[$i] = $upload_data['file_name'];
                    $i++;
                }
            }
        }
        //print_r($fs_images); exit;
        if ($errors) {
            return array(0, $errors[0]);
        }
        if ($fs_images[0]) {
            $this->db->trans_start();
            $insert = array(
                'cat_name' => $course_cat_name,
                'name_en' => $cat_name_en,
                'desc_ar' => $desc_ar,
                'desc_en' => $desc_en,
                'thumb' => $fs_images[0],
                'added_by' => $this->session->userdata('user_id'),
                'add_date' => time()
            );

            $this->db->insert('courses_cats', $insert);
            $this->db->trans_complete();
        }


        return $this->db->trans_status();

    }

    public function edit_cat($cat_id, $cat_name)
    {

        $this->db->trans_start();
        $update = array('cat_name' => $cat_name);
        $this->db->where('cat_id', $cat_id);
        $this->db->update('courses_cats', $update);

        return $this->db->trans_status();

    }

    public function add_course($c_name, $tutor_id, $price, $duration, $cat_id, $c_name_en, $desc_ar, $desc_en)
    {

        if (!$_FILES) {
            return array(0, 0);
        }

        $fs_images = array();
        $i = 0;
        $logos[] = array();
        $errors = array();
        $ext = array();
        $config['upload_path'] = 'uploads/courses';
        $path = $config['upload_path'];
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1800';
        $config['max_height'] = '1800';
        $config['overwrite'] = FALSE;
        $this->load->library('upload');
        foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name

        {
            if (!empty($fileObject['name'])) {
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($fieldname)) {
                    $error = $this->upload->display_errors();
                    $errors[] = $error;
                } else {
                    $upload_data = $this->upload->data();
                    $fs_images[$i] = $upload_data['file_name'];
                    $i++;
                }
            }
        }
        if ($errors) {

            return array(0, $errors[0]);

        }

        $this->db->trans_start();

        if (isset($fs_images[0])) {


            $insert = array(
                'img' => $fs_images[0],
                'c_name' => $c_name,
                'name_en' => $c_name_en,
                'desc_en' => $desc_en,
                'desc_ar' => $desc_ar,
                'added_by' => $this->session->userdata('user_id'),
                'add_date' => time(),
                'tutor_id' => $tutor_id,
                'price' => $price,
                'duration' => $duration,
                'cat_id' => $cat_id
            );

            $this->db->insert('courses', $insert);

            $this->db->insert('tut_course', array('tutor_id' => $tutor_id, 'course_id' => $this->db->insert_id()));


            $this->db->trans_complete();

        }

        return $this->db->trans_status();


    }


    public function add_tutors($tutor_name, $cat_id)
    {

        $this->db->trans_start();
        $insert = array(
            'tutor_name' => $tutor_name,
            'cat_id' => $cat_id,
            'added_by' => $this->session->userdata('user_id'),
            'add_date' => time()

        );

        $this->db->insert('tutors', $insert);
        $this->db->trans_complete();


        return $this->db->trans_status();

    }

    public function add_course_levels($lev_name, $course_id, $lev_price, $name_en, $desc_ar, $desc_en, $lev_comm)
    {
//echo $lev_comm; exit;
        $fs_images = array();
        $i = 0;
        $logos[] = array();
        $errors = array();
        $ext = array();
        $config['upload_path'] = 'uploads/courses';
        $path = $config['upload_path'];
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1800';
        $config['max_height'] = '1800';
        $config['overwrite'] = FALSE;
        $this->load->library('upload');
        foreach ($_FILES as $fieldname => $fileObject) {
            if (!empty($fileObject['name'])) {
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($fieldname)) {
                    $error = $this->upload->display_errors();
                    $errors[] = $error;
                } else {
                    $upload_data = $this->upload->data();
                    $fs_images[$i] = $upload_data['file_name'];
                    $i++;
                }
            }
        }
        if ($errors) {
            return array(0, $errors[0]);
        }
        //print_r($fs_images); exit;
        $this->db->trans_start();

        if (isset($fs_images[0])) {
            $insert = array(
                'course_id' => $course_id,
                'lev_name' => $lev_name,
                'name_en' => $name_en,
                'desc_ar' => $desc_ar,
                'desc_en' => $desc_en,
                'thumb' => $fs_images[0],
                'price' => $lev_price,
                'commission' => $lev_comm,
                'added_by' => $this->session->userdata('user_id'),
                'add_date' => time()

            );
            //echo "<pre>";
            //print_r($insert); exit;
            $this->db->insert('course_levels', $insert);
        }
        $this->db->trans_complete();


        return $this->db->trans_status();
    }

    public function edit_course_levels($lev_name, $lev_id, $lev_price)
    {
        $this->db->trans_start();

        $update = array(
            'lev_name' => $lev_name,
            'price' => $lev_price,
            'added_by' => $this->session->userdata('user_id'),
            'add_date' => time()
        );
        //echo "<pre>";
        //print_r($update);
        $this->db->where('lev_id', $lev_id);
        $this->db->update('course_levels', $update);
        $this->db->trans_complete();


        return $this->db->trans_status();
    }

    public function get_std_levl($lev_id)
    {
        //print_r($id); exit();

        $sql = "SELECT u.emp_id, u.passchange , u.f_name, u.l_name, u.mobile, cu.u_active, r.id, r.role_id
				  FROM users u
				  LEFT JOIN user_course cu ON cu.u_active=0
				  LEFT JOIN roles_emps r ON r.emp_id=u.emp_id
				  JOIN course_levels cl ON cl.lev_id=cu.lev_id AND cl.lev_id=$lev_id
				  JOIN courses c ON c.c_id= cl.course_id
                 WHERE u.emp_id=cu.user_id";
        return $this->db->query($sql);


    }

    public function deactivate_std_levl($lvl_id = '', $emp_id = '')
    {

        $status = $this->db->get_where('user_course', array('lev_id' => $lvl_id, 'user_id' => $emp_id))->row()->u_active;
        if ($status) {
            $this->db->where(array('lev_id' => $lvl_id, 'user_id' => $emp_id));
            $this->db->update('user_course', array('u_active' => 0));
        } else {
            $this->db->where(array('lev_id' => $lvl_id, 'user_id' => $emp_id));
            $this->db->update('user_course', array('u_active' => 1));
        }
        return $this->db->affected_rows();
    }

    public function pend_all_level($lev_id = '')
    {
        if (!$lev_id) {
            return 0;
        }
        $sql = "UPDATE roles_emps SET role_id=4 WHERE emp_id IN (SELECT user_id FROM user_course WHERE lev_id=$lev_id)";
        $students = $this->db->query($sql);
        return $this->db->affected_rows();

    }

    public function deactivate_std_role($emp_id = '')
    {

        $mobile = $this->db->get_where('users', array('emp_id' => $emp_id))->row()->mobile;
        $mobile = (int)$mobile;
        $mobile = '963' . $mobile;

        $new_pass = substr(md5(rand(1111, 9999)), 2, 8);

        $hashed_pass = sha1($new_pass);

        $sms = $this->auth->send_sms($mobile, $new_pass, 'password');

        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', array('password' => $hashed_pass));

        /*if($status==0){
            $this->db->trans_start();

            $this->db->trans_complete();
        } else {
            $this->db->trans_start();
            $this->db->where('emp_id', $emp_id);
            $this->db->update('users', array('password' =>   sha1 (123456),'passchange' => 0));
            $this->db->trans_complete();
        }*/
        return $this->db->affected_rows();

    }

    public function get_courses_cat()
    {

        $this->db->where('deleted', 0);
        $query = $this->db->get('courses_cats');


        return $query->result();

    }

    public function get_courses($cat_id)
    {
        //print_r($id); exit();
        $this->db->where(array('cat_id' => $cat_id));
        $query = $this->db->get('courses');


        return $query->result();

    }

    public function get_courses_levels($course_id)
    {
        //print_r($id); exit();
        $this->db->where(array('course_id' => $course_id));
        $query = $this->db->get('course_levels');


        return $query->result();

    }

    public function deactivate_cat($cat_id = '')
    {

        $status = $this->db->get_where('courses_cats', array('cat_id' => $cat_id))->row()->active;
        if ($status) {
            $this->db->where('cat_id', $cat_id);
            $this->db->update('courses_cats', array('active' => 0));
        } else {
            $this->db->where('cat_id', $cat_id);
            $this->db->update('courses_cats', array('active' => 1));
        }
        return $this->db->affected_rows();
    }

    public function deactivate_course($c_id = '')
    {

        $status = $this->db->get_where('courses', array('c_id' => $c_id))->row()->active;
        if ($status) {

            $this->db->where('c_id', $c_id);
            $this->db->update('courses', array('active' => 0));
        } else {

            $this->db->where('c_id', $c_id);
            $this->db->update('courses', array('active' => 1));
        }
        return $this->db->affected_rows();
    }

    public function deactivate_course_levels($lev_id = '')
    {

        $status = $this->db->get_where('course_levels', array('lev_id' => $lev_id))->row()->active;
        if ($status) {
            $this->db->where('lev_id', $lev_id);
            $this->db->update('course_levels', array('active' => 0));
        } else {
            $this->db->where('lev_id', $lev_id);
            $this->db->update('course_levels', array('active' => 1));
        }
        return $this->db->affected_rows();
    }


    public function create_newcus_data($first_name, $last_name, $first_name_en, $last_name_en, $username, $password, $email, $gender, $branch_id, $gov_id, $phone, $birth_date)
    {
        $insert = array(
            'client_fname' => $first_name,
            'client_lname' => $last_name,
            'client_fname_en' => $first_name_en,
            'client_lname_en' => $last_name_en,
            'emp_id' => $this->session->userdata('user_id'),
            'username' => $username,
            'password' => $password,
            'client_gov_id' => $gov_id,
            'join_date' => time(),
            'branch_id' => $branch_id,
            'email' => $email,
            'gender' => $gender,
            'birth_date' => strtotime($birth_date),
            'phone' => $phone
        );
        $this->db->insert('clients', $insert);
        $res = $this->db->insert_id();
        $this->session->set_userdata('new_customer', $res);
        //echo $res; exit;
        return $res;
    }

    public function users_list($emp_id = '', $from = "", $to = "", $parent_id = "")
    {
        $first_day = $from ? $from : 0;
        $now = $to ? $to : time();

        $sql = "SELECT emps.*, br.branch_name_ar br_name, br.branch_name_en br_name_en, ci.city_name_ar ci_name, ci.city_name_en ci_name_en,
        				co.coun_name_ar co_name, co.coun_name_en co_name_en,
                       (select count(ad_id) from ads where ads.emp_id=emps.emp_id) ads_sum
                  FROM users emps, branches br, countries co, cities ci
                 WHERE emps.branch_id=br.branch_id
                   AND br.city_id=ci.city_id
                   AND ci.country_id=co.country_id
                   AND fired = 0
                   AND emps.join_date between $first_day AND $now";
        $sql .= $emp_id && !$parent_id ? " AND emps.emp_id=$emp_id" : "";
        $sql .= $parent_id ? " AND emps.parent_id=$emp_id" : "";
        //echo $sql; exit;
        //echo $sql; exit;
        return $this->db->query($sql);
    }

    public function restore_emp($emp_id)
    {
        if (!$emp_id) {
            return FALSE;
        }
        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', array('fired' => 0));
        return $this->db->affected_rows();
    }

    public function del_employee($emp_id)
    {
        if (!$emp_id) {
            return FALSE;
        }
        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', array('fired' => 2));
        return $this->db->affected_rows();
    }

    public function suspended_emps()
    {
        $sql = "SELECT emps.*, br.branch_name_ar br_name, ci.city_name_ar ci_name, co.coun_name_ar co_name,
                       (select count(ad_id) from ads where ads.emp_id=emps.emp_id) ads_sum
                  FROM users emps, branches br, countries co, cities ci
                 WHERE emps.branch_id=br.branch_id
                   AND br.city_id=ci.city_id
                   AND ci.country_id=co.country_id
                   AND fired = 1 ";
        return $this->db->query($sql);

    }

    public function clients_list($client_id = "", $from = "", $to = "", $my_clt = "")
    {
        $first_day = $from ? $from : 0;
        $now = $to ? $to : time();

        $sql = "SELECT emps.*, concat_ws(' ', emp.first_name, emp.last_name) name, br.branch_name_ar br_name, ci.city_name_ar ci_name, co.coun_name_ar co_name,
                       (select count(ad_id) from ads where ads.client_id=emps.client_id) ads_sum
                  FROM clients emps, branches br, countries co, cities ci, users emp
                 WHERE emps.branch_id=br.branch_id
                   AND br.city_id=ci.city_id
                   AND ci.country_id=co.country_id
                   AND emp.emp_id=emps.emp_id
                   AND deleted = 0
                   AND emps.join_date between $first_day and $now";
        //echo $my_clt;  exit;
        if ($my_clt == 3) {

        } elseif ($my_clt == 2) {
            $sql .= " AND (emps.emp_id = $client_id OR emps.emp_id IN (SELECT emp_id FROM users where parent_id=$client_id))";
        } else {
            $sql .= " AND emps.emp_id = $client_id ";
        }
        //echo $sql; exit;
        return $this->db->query($sql);
    }

    public function clts_list($client_id = "")
    {

        $sql = "SELECT emps.*, concat_ws(' ', emp.first_name, emp.last_name) name, br.branch_name_ar br_name, ci.city_name_ar ci_name, co.coun_name_ar co_name,
                       (select count(ad_id) from ads where ads.client_id=emps.client_id) ads_sum
                  FROM clients emps, branches br, countries co, cities ci, users emp
                 WHERE emps.branch_id=br.branch_id
                   AND br.city_id=ci.city_id
                   AND ci.country_id=co.country_id
                   AND emp.emp_id=emps.emp_id
                   AND deleted = 0";
        $sql .= $client_id ? " AND emps.client_id=$client_id" : "";

        return $this->db->query($sql);
    }

    public function del_client($client_id)
    {
        if (!$client_id) {
            return FALSE;
        }
        $this->db->where('client_id', $client_id);
        $this->db->update('clients', array('deleted' => 1));
        return $this->db->affected_rows();
    }

    public function del_expenses($exp_id)
    {
        if (!$exp_id) {
            return FALSE;
        }
        $this->db->where('pay_cat_id', $exp_id);
        $this->db->delete('payment_categories');
        return $this->db->affected_rows();
    }

    public function add_new_payment($emp_id, $payment)
    {
        if (!$this->db->get_where('users', array('emp_id' => $emp_id))->num_rows()) {
            return FALSE;
        }
        $amount = $this->db->get_where('users', array('emp_id' => $emp_id))->row()->amount;
        $this->db->trans_start();
        $payment_array = array(
            'emp_id' => $emp_id,
            'ad_id' => 0,
            'pay_cat_id' => 4,
            'debit' => 0,
            'credit' => $payment,
            'payment_date' => time()
        );
        $this->db->insert('payments', $payment_array);

        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', array('amount' => $amount + $payment));

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_username_emp($username)
    {
        $result = $this->db->get_where('users', array('username' => $username, 'fired' => 0))->num_rows();
        return $result;
    }

    public function get_username_clt($username)
    {
        $result = $this->db->get_where('clients', array('username' => $username, 'deleted' => 0))->num_rows();
        return $result;
    }

    public function get_email_emp($email)
    {
        $result = $this->db->get_where('users', array('email' => $email, 'fired' => 0))->num_rows();
        return $result;
    }

    public function get_phone_emp($phone)
    {
        $result = $this->db->get_where('users', array('phone' => $phone, 'fired' => 0))->num_rows();
        return $result;
    }

    public function new_restore_payment($emp_id, $payment)
    {
        if (!$this->db->get_where('users', array('emp_id' => $emp_id))->num_rows()) {
            return FALSE;
        }
        $amount = $this->db->get_where('users', array('emp_id' => $emp_id))->row()->amount;
        $admin_amount = $this->db->get_where('users', array('emp_id' => 1))->row()->amount;
        if ($payment > $amount) {
            $payment = $amount;
        }
        $this->db->trans_start();
        $payment_array = array(
            'emp_id' => $emp_id,
            'ad_id' => 0,
            'pay_cat_id' => 7,
            'debit' => $payment,
            'to_id' => 1,
            'credit' => 0,
            'payment_date' => time()
        );
        $this->db->insert('payments', $payment_array);

        $payment_array = array(
            'emp_id' => 1,
            'ad_id' => 0,
            'pay_cat_id' => 7,
            'debit' => 0,
            'credit' => $payment,
            'payment_date' => time()
        );
        $this->db->insert('payments', $payment_array);

        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', array('amount' => $amount - $payment));

        $this->db->where('emp_id', 1);
        $this->db->update('users', array('amount' => $admin_amount + $payment));

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function fire_employee($emp_id, $fire_res, $emp)
    {
        if (!$this->db->get_where('users', array('emp_id' => $emp_id))->num_rows()) {
            return FALSE;
        }
        $parent_id = $emp;
        $this->db->trans_start();

        $this->db->where('parent_id', $emp_id);
        $this->db->update('users', array('parent_id' => $parent_id));

        $this->db->where('emp_id', $emp_id);
        $this->db->update('clients', array('emp_id' => $parent_id));

        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', array('fired' => 1, 'fired_reason' => $fire_res));

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function edit_emp_salary($emp_id, $new_salary)
    {
        if (!$this->db->get_where('users', array('emp_id' => $emp_id))->num_rows()) {
            return FALSE;
        }

        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', array('salary' => $new_salary));

        if ($this->db->affected_rows() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function edit_father_commision($emp_id, $new_code)
    {
        if (!$this->db->get_where('users', array('emp_id' => $emp_id))->num_rows()) {
            return FALSE;
        }

        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', array('father_comm' => $new_code));

        if ($this->db->affected_rows() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function edit_commision_all($new_comm, $new_father_comm, $salary)
    {


        $this->db->where('emp_id !=', 1);
        $update = array(
            'father_comm' => $new_father_comm,
            'commision' => $new_comm,
            'salary' => $salary
        );
        $this->db->update('users', $update);

        if ($this->db->affected_rows() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function edit_payment_code($emp_id, $new_code)
    {
        if (!$this->db->get_where('users', array('emp_id' => $emp_id))->num_rows()) {
            return FALSE;
        }

        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', array('code' => $new_code));

        if ($this->db->affected_rows() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function edit_commision($emp_id, $new_comm)
    {
        if (!$this->db->get_where('users', array('emp_id' => $emp_id))->num_rows()) {
            return FALSE;
        }

        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', array('commision' => $new_comm));

        if ($this->db->affected_rows() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function edit_basic_emp_info($emp_id = "", $first_name = "", $last_name = "", $email = "", $phone = "", $max_directs, $contruct_date)
    {
        if (!$this->db->get_where('users', array('emp_id' => $emp_id))->num_rows()) {
            return FALSE;
        }
        //echo $max_directs.'  '.$contruct_date; exit;
        $contruct_date = strtotime($contruct_date);
        $update = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'max_directs' => $max_directs,
            'contract_end_date' => $contruct_date
        );
        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', $update);

        if ($this->db->affected_rows() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function edit_clt_info($clt_id = "", $password = "", $first_name = "", $last_name = "", $email = "", $phone = "", $branch_id = "", $first_name_en, $last_name_en)
    {
        if (!$this->db->get_where('clients', array('client_id' => $clt_id))->num_rows()) {
            return FALSE;
        }
        //echo $max_directs.'  '.$contruct_date; exit;
        //$contruct_date = strtotime($contruct_date);

        $update = array(
            'client_fname' => $first_name,
            'client_lname' => $last_name,
            'client_fname_en' => $first_name_en,
            'client_lname_en' => $last_name_en,
            'email' => $email,
            'phone' => $phone
        );
        if ($password) {
            $update['password'] = $password;
        }
        if ($branch_id) {
            $update['branch_id'] = $branch_id;
        }
        $this->db->where('client_id', $clt_id);
        $this->db->update('clients', $update);

        if ($this->db->affected_rows() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function payments_list($emp_id = "", $start_date = "", $end_date = "", $cat_id = "", $from_emp = '', $to_emp = '')
    {
        $first_day = $start_date ? $start_date : strtotime(date('Y-m-1'));
        $now = $end_date ? $end_date : time();
        if ($from_emp && !$to_emp) {
            $emp_id = $from_emp;
        }
        $emp = $emp_id ? " AND p.emp_id=$emp_id " : "";
        $cat = $cat_id ? " AND p.pay_cat_id=$cat_id " : "";

        $emps_cond = $from_emp && $to_emp ? " AND p.emp_id=$from_emp && p.to_id=$to_emp AND em.emp_id=$to_emp " : "";
        $emps_sel = $from_emp && $to_emp ? " ,concat_ws(' ', em.first_name, em.last_name) to_name, em.username to_username " : "";
        $emps_table = $from_emp && $to_emp ? " ,users em " : "";

        if ($cat_id == 6) {
            $emps_cond = " AND ((p.emp_id=$emp_id AND em.emp_id=p.to_id) OR (p.to_id=$emp_id AND em.emp_id=p.emp_id))";
            $emps_sel = " ,concat_ws(' ', em.first_name, em.last_name) to_name, em.username to_username ";
            $emps_table = " ,users em ";
            //echo $emps_cond.'   '.$emps_sel.'     '.$emps_table;
        }

        $sql = "select p.*, pc.*, concat_ws(' ', emp.first_name, emp.last_name) full_name,
                       emp.username $emps_sel
                  from payments p, payment_categories pc, users emp $emps_table
                 where p.pay_cat_id=pc.pay_cat_id
                   AND emp.emp_id=p.emp_id
                   AND p.payment_date between $first_day AND $now
                  $emp $cat $emps_cond
                 order by p.payment_id";
        if ($cat_id == 6) {
            //echo $sql; exit;
        }
        return $this->db->query($sql);
    }

    public function money_det($emp_id = '', $start_date = '', $end_date = '')
    {
        $first_day = $start_date ? $start_date : strtotime(date('Y-m-1'));
        $now = $end_date ? $end_date : time();

        $sql = "select p.*, pc.*, concat_ws(' ', emp.first_name, emp.last_name) full_name,
                       emp.username
                  from payments p, payment_categories pc, users emp
                 where p.pay_cat_id=pc.pay_cat_id
                   AND emp.emp_id=p.emp_id
                   AND p.payment_date between $first_day AND $now
                   AND (p.emp_id=$emp_id OR p.emp_id IN (SELECT emp_id FROM users WHERE parent_id=$emp_id))
                 order by p.payment_id";
        return $this->db->query($sql);

    }

    public function user_transfers($emp_id = '', $start_date = "", $end_date = "")
    {
        $first_day = $start_date ? $start_date : strtotime(date('Y-m-1'));
        $now = $end_date ? $end_date : time();

        $sql = "SELECT p.*, pc.*, concat_ws(' ', emp.first_name, emp.last_name) full_name,
				                       emp.username, concat_ws(' ', em.first_name, em.last_name) to_name,
				                       em.username to_username
				  FROM payments p, payment_categories pc, users emp, users em
				 WHERE p.pay_cat_id=pc.pay_cat_id AND pc.pay_cat_id=6
				   AND ((p.emp_id=$emp_id OR p.emp_id in (SELECT emp_id FROM users WHERE parent_id=$emp_id)) OR (p.to_id=$emp_id OR p.to_id in (SELECT emp_id FROM users WHERE parent_id=$emp_id)))
				   AND emp.emp_id=p.emp_id
				   AND em.emp_id=p.to_id
				   AND debit>0
				   AND p.payment_date between $first_day AND $now ";
        //echo $sql; exit;
        return $this->db->query($sql);
    }

    public function expense_list($emp_id = "", $start_date = "", $end_date = "")
    {
        $first_day = $start_date ? $start_date : strtotime(date('Y-m-1'));
        $now = $end_date ? $end_date : time();

        $emp = $emp_id ? " AND (p.emp_id=$emp_id OR p.emp_id in (SELECT emp_id FROM users WHERE parent_id=$emp_id)) " : "";
        $sql = "SELECT p.*, pc.*, emp.* , concat_ws(' ', emp.first_name, emp.last_name) full_name
				  FROM payments p, payment_categories pc, users emp
				 WHERE pc.pay_cat_id>=9 AND p.pay_cat_id=pc.pay_cat_id AND emp.emp_id=p.emp_id
					$emp
				   AND p.payment_date between $first_day AND $now ";
        //echo $sql; exit;
        return $this->db->query($sql);
    }

    public function payments_cats()
    {
        return $this->db->get('payment_categories')->result();
    }

    public function emp_sessions($emp_id, $from = "", $to = "")
    {
        if (!$emp_id) {
            return FALSE;
        }

        $first_day = $from ? $from : strtotime(date('Y-m-1'));
        $now = $to ? $to : time();

        $sql = "SELECT sl.*, e.first_name, e.last_name, e.username
                  from session_log sl, users e
                 where e.emp_id=sl.user_id
                   AND start_time between $first_day AND $now
                   AND e.emp_id=$emp_id order by sl.id desc";

        return $this->db->query($sql);
    }

    public function trans_emps_balance($destination_id, $amount)
    {
        $emp_id = $this->session->userdata('user_id');
        if ($emp_id == $destination_id) {
            return FALSE;
        }
        $emp_balance = $this->db->get_where('users', array('emp_id' => $emp_id))->row()->amount;
        if ($amount > $emp_balance && $emp_id != 1) {
            return 'no';
        }
        $des_balance = $this->db->get_where('users', array('emp_id' => $destination_id))->row()->amount;

        $new_emp_balance = $emp_balance - $amount;
        $new_des_balance = $des_balance + $amount;
        $this->db->trans_start();
        $insert = array(
            'emp_id' => $emp_id,
            'pay_cat_id' => 6,
            'debit' => $amount,
            'to_id' => $destination_id,
            'payment_date' => time()
        );
        $this->db->insert('payments', $insert);

        $this->db->where('emp_id', $emp_id);
        $this->db->update('users', array('amount' => $new_emp_balance));


        $insert = array(
            'emp_id' => $destination_id,
            'pay_cat_id' => 6,
            'credit' => $amount,
            'payment_date' => time()
        );
        $this->db->insert('payments', $insert);

        $this->db->where('emp_id', $destination_id);
        $this->db->update('users', array('amount' => $new_des_balance));

        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_pay_descs()
    {
        return $this->db->get('payment_categories')->result();
    }

    public function expenses_list()
    {
        $expenses = $this->db->get_where('payment_categories', array('type' => 1));
        return $expenses;
    }

    public function get_expenses($exp_id)
    {
        $expenses = $this->db->get_where('payment_categories', array('pay_cat_id' => $exp_id, 'type' => 1));
        return $expenses;
    }

    public function update_expenses($exp_id, $name_ar, $name_en)
    {
        if (!$this->db->get_where('payment_categories', array('pay_cat_id' => $exp_id, 'type' => 1))->num_rows()) {
            return FALSE;
        }

        $updated = array(
            'category_name' => $name_ar,
        );
        $this->db->where('pay_cat_id', $exp_id);
        $this->db->update('payment_categories', $updated);
        if ($this->db->affected_rows()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function add_new_expenses($name_ar)
    {
        $inserted = array(
            'category_name' => $name_ar,
            'type' => 1
        );
        $this->db->insert('payment_categories', $inserted);

        if ($this->db->insert_id()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function regions_list()
    {
        $regions = $this->db->order_by('name_ar', 'ASC')->get('regions');
        return $regions;
    }

    public function delete_region($region_id)
    {
        $countries = $this->db->query('select country_id from countries where region_id=' . $region_id)->result();
        $co_ids = array();
        $ci_ids = array();
        $br_ids = array();
        foreach ($countries as $country) {
            $co_ids[] = $country->country_id;
        }
        $co_ids = implode(',', $co_ids);
        if ($co_ids) {
            $cities = $this->db->query("select city_id from cities where country_id in ($co_ids)")->result();
            foreach ($cities as $city) {
                $ci_ids[] = $city->city_id;
            }
            $ci_ids = implode(',', $ci_ids);
        }

        if ($ci_ids) {
            //echo $ci_ids; exit;
            $branches = $this->db->query("select branch_id from branches where city_id in ($ci_ids)")->result();
            //print_r($branches); exit;
            foreach ($branches as $branch) {
                $br_ids[] = $branch->branch_id;
            }
            $br_ids = implode(',', $br_ids);
        }


        //echo $br_ids; exit;
        $this->db->trans_start();

        $this->db->where('region_id', $region_id);
        $this->db->delete('regions');
        if ($co_ids) {
            $this->db->where('region_id', $region_id);
            $this->db->delete('countries');
        }

        if ($ci_ids) {
            $this->db->query("delete from cities where city_id in ($ci_ids)");
        }

        if ($br_ids) {
            $this->db->query("delete from branches where branch_id in ($br_ids)");
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function get_region($region_id)
    {
        $region = $this->db->order_by('name_ar', 'ASC')->get_where('regions', array('region_id' => $region_id));
        return $region;
    }

    public function update_regname($region_id, $name_ar, $name_en)
    {
        if (!$this->db->get_where('regions', array('region_id' => $region_id))->num_rows()) {
            return FALSE;
        }

        $updated = array(
            'name_ar' => $name_ar,
            'name_en' => $name_en,

        );
        $this->db->where('region_id', $region_id);
        $this->db->update('regions', $updated);
        if ($this->db->affected_rows()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function add_new_region($name_ar, $name_en)
    {
        $inserted = array(
            'name_ar' => $name_ar,
            'name_en' => $name_en,

        );
        $this->db->insert('regions', $inserted);

        if ($this->db->insert_id()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function countries_list($region_id = '')
    {
        $countries = $this->db->order_by('coun_name_ar', 'ASC')->get_where('countries', array('region_id' => $region_id));
        return $countries;
    }

    public function delete_country($country_id)
    {
        $cities = $this->db->query('select city_id from cities where country_id=' . $country_id)->result();

        $ci_ids = array();
        $br_ids = array();
        foreach ($cities as $city) {
            $ci_ids[] = $city->city_id;
        }
        $ci_ids = implode(',', $ci_ids);

        if ($ci_ids) {
            //echo $ci_ids; exit;
            $branches = $this->db->query("select branch_id from branches where city_id in ($ci_ids)")->result();
            //print_r($branches); exit;
            foreach ($branches as $branch) {
                $br_ids[] = $branch->branch_id;
            }
            $br_ids = implode(',', $br_ids);
        }


        //echo $br_ids; exit;
        $this->db->trans_start();


        $this->db->where('country_id', $country_id);
        $this->db->delete('countries');


        if ($ci_ids) {
            $this->db->query("delete from cities where city_id in ($ci_ids)");
        }

        if ($br_ids) {
            $this->db->query("delete from branches where branch_id in ($br_ids)");
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function get_country($country_id)
    {
        return $this->db->order_by('coun_name_ar', 'ASC')->get_where('countries', array('country_id' => $country_id));
    }

    public function update_countname($country_id, $name_ar, $name_en)
    {
        if (!$this->db->get_where('countries', array('country_id' => $country_id))->num_rows()) {
            return FALSE;
        }

        $updated = array(
            'coun_name_ar' => $name_ar,
            'coun_name_en' => $name_en,

        );
        $this->db->where('country_id', $country_id);
        $this->db->update('countries', $updated);
        if ($this->db->affected_rows()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function add_new_country($region_id, $name_ar, $name_en)
    {

        $inserted = array(
            'region_id' => $region_id,
            'coun_name_ar' => $name_ar,
            'coun_name_en' => $name_en
        );
        $this->db->insert('countries', $inserted);
        if ($this->db->insert_id()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function cities_list($country_id = '')
    {
        return $this->db->order_by('city_name_ar', 'ASC')->get_where('cities', array('country_id' => $country_id));
    }

    public function delete_cities($city_id = '', $new_id)
    {
        $this->db->trans_start();

        $this->db->where('city_id', $city_id);
        $this->db->delete('cities');

        $this->db->where('city_id', $city_id);
        $this->db->update('branches', array('city_id' => $new_id));

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function get_city($city_id)
    {
        return $this->db->order_by('city_name_ar', 'ASC')->get_where('cities', array('city_id' => $city_id));
    }

    public function update_cityname($city_id, $name_ar, $name_en)
    {
        if (!$this->db->get_where('cities', array('city_id' => $city_id))->num_rows()) {
            return FALSE;
        }

        $updated = array(
            'city_name_ar' => $name_ar,
            'city_name_en' => $name_en
        );
        $this->db->where('city_id', $city_id);
        $this->db->update('cities', $updated);
        if ($this->db->affected_rows()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function add_new_city($country_id, $name_ar, $name_en)
    {

        $inserted = array(
            'country_id' => $country_id,
            'city_name_ar' => $name_ar,
            'city_name_en' => $name_en
        );
        $this->db->insert('cities', $inserted);
        if ($this->db->insert_id()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function branches_list($city_id = '')
    {
        return $this->db->order_by('branch_name_ar', 'ASC')->get_where('branches', array('city_id' => $city_id));
    }

    public function delete_branch($branch_id = '')
    {
        $this->db->where('branch_id', $branch_id);
        $this->db->delete('branches');

        return $this->db->affected_rows();
    }

    public function get_branch($branch_id)
    {
        return $this->db->order_by('branch_name_ar', 'ASC')->get_where('branches', array('branch_id' => $branch_id));
    }

    public function update_branchname($branch_id, $name_ar, $name_en)
    {
        if (!$this->db->get_where('branches', array('branch_id' => $branch_id))->num_rows()) {
            return FALSE;
        }

        $updated = array(
            'branch_name_ar' => $name_ar,
            'branch_name_en' => $name_en
        );
        $this->db->where('branch_id', $branch_id);
        $this->db->update('branches', $updated);
        if ($this->db->affected_rows()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function add_new_branch($city_id, $name_ar, $name_en)
    {

        $inserted = array(
            'city_id' => $city_id,
            'branch_name_ar' => $name_ar,
            'branch_name_en' => $name_en
        );
        $this->db->insert('branches', $inserted);
        if ($this->db->insert_id()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_region_id($country_id)
    {
        return $this->db->get_where('countries', array('country_id' => $country_id))->row()->region_id;
    }

    public function get_country_id($city_id)
    {
        return $this->db->get_where('cities', array('city_id' => $city_id))->row()->country_id;
    }

    public function get_city_id($branch_id)
    {
        return $this->db->get_where('branches', array('branch_id' => $branch_id))->row()->city_id;
    }

    public function checkcode($id = '', $str)
    {
        return $this->db->get_where('users', array('emp_id' => $id, 'code' => $str))->num_rows();
    }

    public function send_code($email = '')
    {
        if (!$email) {
            return FALSE;
        }

        $result = $this->db->get_where('users', array('email' => $email));
        if (!$result->num_rows()) {
            return FALSE;
        }
        $rand = substr(md5(rand(1000, 9999)), 0, 10);
        $this->db->where('email', $email);
        $this->db->update('users', array('login_code' => $rand));
        $message = "Your recovery code is: $rand";
        return $this->auth->sendmail('', $email, 'Dalilacom recovery code', $message);

    }

    public function check_mycode($str, $id)
    {
        if ($this->db->get_where('users', array('emp_id' => $id))->row()->code == $str) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function edit_my_payments_code($code, $id)
    {
        $this->db->where('emp_id', $id);
        $this->db->update('users', array('code' => $code));
        return $this->db->affected_rows();
    }

    public function expanse_payment_cats()
    {
        return $this->db->get_where('payment_categories', array('type' => 1));
    }

    public function expanse_payment($emp_id, $ex_rex, $balance)
    {
        $emp = $this->db->get_where('users', array('emp_id' => $emp_id));
        if (!$emp->num_rows()) {
            return FALSE;
        }
        $emp = $emp->row();
        $emp_balance = $emp->amount;
        $new_emp_balance = $emp_balance - $balance;

        $admin_balance = $this->db->get_where('users', array('emp_id' => 1))->row()->amount;
        $new_admin_balance = $admin_balance + $balance;

        $this->db->trans_start();

        /*$this->db->where('emp_id', $emp_id);
        $this->db->update('users', array('amount' => $new_emp_balance));*/

        $payment = array(
            'emp_id' => $emp_id,
            'pay_cat_id' => $ex_rex,
            'debit' => $balance,
            'to_id' => 1,
            'payment_date' => time()
        );
        $this->db->insert('payments', $payment);

        /*$this->db->where('emp_id', 1);
        $this->db->update('users', array('amount' => $new_admin_balance));*/

        $payment = array(
            'emp_id' => 1,
            'pay_cat_id' => $ex_rex,
            'credit' => $balance,
            'payment_date' => time()
        );
        $this->db->insert('payments', $payment);


        $this->db->trans_complete();

        return $this->db->trans_status();

    }

    public function get_charts($user_id = '', $my_ads = '', $sons_ads = '', $from_date = '', $to_date = '', $every)
    {
        $date = $to_date ? strtotime($to_date) : time();
        $mounth = $from_date ? strtotime($from_date) : time() - (30 * 24 * 60 * 60);
        $user = '';
        if ($my_ads && $sons_ads) {
            return FALSE;
        }
        if ($user_id || $my_ads) {
            $user_id = $this->session->userdata('user_id');
            $user = "AND emp_id=$user_id";
        }

        if ($sons_ads) {
            $user_id = $this->session->userdata('user_id');
            $user = "AND emp_id in (SELECT emp_id FROM users WHERE parent_id=$user_id)";
        }
        if (!$my_ads && !$sons_ads) {

            $user_id = $this->session->userdata('user_id');
            //echo $user_id; exit;
            $user = "AND (emp_id in (SELECT emp_id FROM users WHERE parent_id=$user_id) OR emp_id=$user_id)";
        }
        if ($every) {
            $user = "";
        }
        $sql = "SELECT COUNT(ad_id) num, MID(FROM_UNIXTIME(register_date), 1, 10) date
				  FROM ads
				 WHERE register_date BETWEEN $mounth AND $date $user
			  GROUP BY MID(FROM_UNIXTIME(register_date), 1, 10)";
        //echo $sql; exit;
        $result = $this->db->query($sql);
        //print_r($result->result()); exit;
        return $result;
        //echo $sql; exit;
    }

    public function get_slider_ads($user_id = '', $my_ads = '', $sons_ads = '', $from_date = '', $to_date = '', $every = '')
    {
        $date = $to_date ? strtotime($to_date) : time();
        $mounth = $from_date ? strtotime($from_date) : time() - (30 * 24 * 60 * 60);
        $user = '';
        if ($my_ads && $sons_ads) {
            return FALSE;
        }
        if ($user_id || $my_ads) {
            $user_id = $this->session->userdata('user_id');
            $user = "AND emp_id=$user_id";
        }
        if ($sons_ads) {
            $user_id = $this->session->userdata('user_id');
            $user = "AND emp_id in (SELECT emp_id FROM users WHERE parent_id=$user_id)";
        }

        if (!$my_ads && !$sons_ads) {
            $user_id = $this->session->userdata('user_id');
            //echo "string"; exit;
            $user = "AND (emp_id in (SELECT emp_id FROM users WHERE parent_id=$user_id) OR emp_id=$user_id)";
        }

        if ($every) {
            //exit;
            $user = "";
        }
        $sql = "SELECT COUNT(ad_id) num FROM ads
				 WHERE register_date BETWEEN $mounth AND $date AND position_id in
				 (SELECT position_id FROM ad_positions WHERE type=1) $user";
        $sliders = $this->db->query($sql)->row()->num;

        $sql = "SELECT COUNT(ad_id) num FROM ads
				 WHERE register_date BETWEEN $mounth AND $date AND position_id in
				 (SELECT position_id FROM ad_positions WHERE type=2) $user";
        $disterbuted = $this->db->query($sql)->row()->num;

        $sql = "SELECT COUNT(ad_id) num FROM ads
				 WHERE register_date BETWEEN $mounth AND $date AND position_id in
				 (SELECT position_id FROM ad_positions WHERE type=3) $user";
        $market = $this->db->query($sql)->row()->num;
        return array('slide' => $sliders, 'dist' => $disterbuted, 'market' => $market);
        //echo $sliders; exit
    }

    public function check_paypass($user_id, $pass)
    {
        $pass = sha1($pass);
        $res = $this->db->get_where('users', array('emp_id' => $user_id, 'pay_pass' => $pass))->num_rows();

        return $res;
    }

    public function broadcast_email($subject, $message)
    {
        $res = FALSE;

        $clients = $this->db->get('emails_table');
        foreach ($clients as $client) {
            $email = $client->email;
            if ($email) {
                $res = $this->auth->sendmail('', $email, $subject, $message);
            }
        }


        return $res;
    }
}
