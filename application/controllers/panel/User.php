<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
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
        //echo "strfring"; exit;
        parent::__construct();
        need_login();
        have_access(56);
        get_statics();

        //echo "dfasda"; exit;
        $this->session->set_userdata('this_url', current_url());

        if (LANG() != 'en') {
            $this->lang->load("user", "arabic");
            $this->lang->load("sidebar", "arabic");
            $this->lang->load("header", "arabic");
            $this->lang->load("form_validation", "arabic");
        } else {
            $this->lang->load("user", "english");
            $this->lang->load("sidebar", "english");
            $this->lang->load("header", "english");
        }
        $this->load->model('panel/user_model', 'user_model');
        //echo "string"; exit;
        error_reporting(0);
    }

    public function send_message($lev_id = '')
    {
        have_access(59);
        $users = $this->db->query("SELECT DISTINCT(mobile), CONCAT_WS(' ', f_name, l_name) full_name FROM users");
        if ($_POST) {

            //$this->form_validation->set_rules('to', 'message_to', 'required');
            $this->form_validation->set_rules('msg', 'message', 'required');
            if ($this->form_validation->run()) {
                //exit;
                $all = $this->input->post('all');
                $phones = $this->input->post('to');
                if (empty($phones) && !$all) {
                    redirect(base_url() . "send_message");
                }
                $phones = array_unique($phones);
                $phones = implode(';', $phones);
                //echo $phones; exit;
                $msg = $this->input->post('msg');
                if ($all) {
                    $all_users = $users->result_array();
                    $phones = array();
                    $i = 0;
                    foreach ($all_users as $user) {
                        $phone = (int)$user['mobile'];
                        $phones[] = '963' . $phone;
                        $i++;
                        if ($i == 100) {
                            $phones = array_unique($phones);
                            //echo "<pre>";
                            //print_r($phones); exit;
                            $phones = implode(';', $phones);
                            //echo $phones; exit;
                            $sent = $this->auth->send_sms($phones, $msg, 'text_sms');
                            $i = 0;
                            $phones = array();
                        }
                    }

                    if ($sent) {
                        $this->messages->success($this->lang->line('send_success'));
                    } else {
                        $this->messages->error($this->lang->line('send_not_success'));
                    }
                    redirect(base_url() . "send_message");


                }


                //echo $phones; exit;
                $sent = $this->auth->send_sms($phones, $msg, 'text_sms');
                if ($sent) {
                    $this->messages->success($this->lang->line('send_success'));
                } else {
                    $this->messages->error($this->lang->line('send_not_success'));
                }
                if ($lev_id) {
                    redirect(base_url() . "get_std_lev/$lev_id");
                }
            }
        } elseif ($lev_id) {
            redirect(base_url() . "get_std_lev/$lev_id");
        }
        $data['users'] = $users->result();
        $data['title'] = trans('send_message');
        $data['selected'] = "send_message";
        $data['uc_id'] = $uc_id;
        $this->load->view('panel/send_messages_view', $data);
    }

    public function index()
    {
        $this->login();
    }

    public function get_week_comms($user_id = '')
    {
        have_access(40);
        if ($user_id == 1) {
            have_access(54);
        }
        $user_id = $user_id ? $user_id : $this->session->userdata('user_id');
        if (!have_access(41, TRUE)) {
            $user_id = $this->session->userdata('user_id');
        }
        $week = $this->input->post('week') ? $this->input->post('week') : 0;
        $year = $this->input->post('year') != '' ? $this->input->post('year') : date('Y');

        $from_date = strtotime($year . '-01-01') + $week * 7 * 24 * 60 * 60;
        $to_date = strtotime($year . '-01-01') + ($week + 1) * 7 * 24 * 60 * 60;
        if ($this->session->userdata('user_id') == 1) {
            //echo date('Y-m-d 23:59:59', $from_date).' ';
            //echo date('Y-m-d 23:59:59', $to_date);
            //exit;
        }


        $requests = $this->user_model->get_comms($user_id, $from_date, $to_date);

        $ddate = date('Y-m-d');
        $date = new DateTime($ddate);
        $week = $date->format("W");
        //if ($this->session->userdata('user_id') == 1) {
        $day = date('N', time());
        //echo date("Y-m-d H:i", strtotime('sunday last week')); exit;
        if ($day > 5) {
            $week++;

        }
        //}
        $data['week'] = $week;
        $balance = $this->db->get_where('users', array('emp_id' => $user_id))->row()->balance;
        $sql = "SELECT sum(amount) amount
				  FROM queued_payments
				 WHERE from_id=$user_id
				   AND approved=0
				   AND canceled=0";
        $res = $this->db->query($sql);
        $data['balance'] = $balance = $balance - $res->row()->amount;
        $data['res'] = $requests->result();
        //print_r($data['res']); exit;
        $data['agent_count'] = $requests->num_rows();
        $data['title'] = $this->lang->line('week_com');
        $data['user_id'] = $user_id;
        $data['selected'] = "week_com";
        $this->load->view('panel/week_comms_view', $data);
    }

    public function get_week_studs($user_id = '')
    {
        have_access(40);
        if ($user_id == 1) {
            have_access(54);
        }
        $user_id = $user_id ? $user_id : $this->session->userdata('user_id');
        if (!have_access(41, TRUE)) {
            $user_id = $this->session->userdata('user_id');
        }
        $week = $this->input->post('week') ? $this->input->post('week') : 0;
        $year = $this->input->post('year') != '' ? $this->input->post('year') : date('Y');

        $from_date = strtotime($year . '-01-01') + $week * 7 * 24 * 60 * 60;
        $to_date = strtotime($year . '-01-01') + ($week + 1) * 7 * 24 * 60 * 60;
        if ($this->session->userdata('user_id') == 1) {
            //echo date('Y-m-d 23:59:59', $from_date).' ';
            //echo date('Y-m-d 23:59:59', $to_date);
            //exit;
        }


        $requests = $this->user_model->get_studs($user_id, $from_date, $to_date);

        $ddate = date('Y-m-d');
        $date = new DateTime($ddate);
        $week = $date->format("W");
        //if ($this->session->userdata('user_id') == 1) {
        $day = date('N', time());
        //echo date("Y-m-d H:i", strtotime('sunday last week')); exit;
        if ($day > 5) {
            $week++;

        }
        //}
        $data['week'] = $week;
        $balance = $this->db->get_where('users', array('emp_id' => $user_id))->row()->balance;
        $sql = "SELECT sum(amount) amount
				  FROM queued_payments
				 WHERE from_id=$user_id
				   AND approved=0
				   AND canceled=0";
        $res = $this->db->query($sql);
        $data['balance'] = $balance = $balance - $res->row()->amount;
        $data['res'] = $requests->result();
        //print_r($data['res']); exit;
        $data['agent_count'] = $requests->num_rows();
        $data['title'] = $this->lang->line('week_com');
        $data['user_id'] = $user_id;
        $data['selected'] = "week_studs";
        $this->load->view('panel/week_studs_view', $data);
    }

    public function students_list($value = '')
    {
        have_access(43);
        $res = '';
        if ($_GET) {
            $id = $_GET['stud_list'] ? $_GET['stud_list'] : 0;
            $name = explode('-', $id);
            $f_name = $name[0];
            $l_name = $name[1];
            $sql = "SELECT MAX(uc.id), u.f_name, u.l_name, u.emp_id, u.username, u.mother_name, u.birth_date, u.address, r.id, cl.lev_id, uc.u_active, cl.lev_name, c.c_name, r.role_id
					  FROM users u
					  LEFT JOIN roles_emps r ON r.emp_id=u.emp_id
					  JOIN (SELECT id, user_id, lev_id, course_id, reg_date, u_active FROM user_course uc) uc ON uc.user_id=u.emp_id
					  JOIN course_levels cl ON cl.lev_id=uc.lev_id
					  JOIN courses c ON c.c_id=cl.course_id
					 WHERE u.f_name='$f_name'
					   AND u.l_name='$l_name'
					 GROUP BY u.emp_id";
            $res = $this->db->query($sql);
        }

        $data['studs'] = $this->db->query('SELECT u.f_name, u.l_name, u.emp_id
				  							 FROM users u')->result();
        $data['res'] = $res;
        $data['title'] = $this->lang->line('students_list');
        $data['selected'] = "students_list";
        $this->load->view('panel/students_view', $data);
    }

    public function stop_student($user_id = '', $status = 0)
    {
        have_access(57);
        $stopped = $this->db->get_where('roles_emps', array('emp_id' => $user_id));
        //echo $stopped->row()->role_id; exit;
        if ($stopped->num_rows() && $stopped->row()->role_id == 3) {
            $this->db->where('emp_id', $user_id);
            $this->db->update('roles_emps', array('role_id' => 4));
            $mobile = $this->db->get_where('users', array('emp_id' => $user_id))->row()->mobile;
            $mobile = (int)$mobile;
            $mobile = '963' . $mobile;
            $sent = $this->auth->send_sms($mobile, '', 'pend_money');
        } elseif (!$stopped->num_rows()) {
            $this->db->insert('roles_emps', array('emp_id' => $user_id, 'role_id' => 3));
        } else {
            $this->db->where(array('emp_id' => $user_id));
            $this->db->update('roles_emps', array('role_id' => 3));
        }

        if ($this->db->affected_rows()) {
            echo 1;
        } else {
            echo 0;
        }

    }

    public function stop_agency($user_id = '', $status = 0)
    {
        have_access(57);
        $stopped = $this->db->get_where('roles_emps', array('emp_id' => $user_id));
        //echo $stopped->row()->role_id; exit;
        if ($stopped->num_rows()) {
            $this->db->delete('roles_emps', array('emp_id' => $user_id));
            $mobile = $this->db->get_where('users', array('emp_id' => $user_id))->row()->mobile;
            $mobile = (int)$mobile;
            $mobile = '963' . $mobile;
            $sent = $this->auth->send_sms($mobile, '', 'pend_money');
        } else {
            $this->db->insert('roles_emps', array('emp_id' => $user_id, 'role_id' => 3));
        }

        if ($this->db->affected_rows()) {
            echo 1;
        } else {
            echo 0;
        }

    }

    public function edit_student($id)
    {
        if ($id == 1) {
            have_access(54);
        }
        $this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'required');
        $this->form_validation->set_rules('father_name', $this->lang->line('father_name'), 'required');
        $this->form_validation->set_rules('mother_name', $this->lang->line('mother_name'), 'required');
        $this->form_validation->set_rules('birth_place', $this->lang->line('birth_place'), 'required');
        $this->form_validation->set_rules('civil_reg', $this->lang->line('civil_reg'), 'required');
        $this->form_validation->set_rules('amaneh', $this->lang->line('amaneh'), 'required');
        $this->form_validation->set_rules('address', $this->lang->line('address'), 'required');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'required');
        $this->form_validation->set_rules('gov_id', $this->lang->line('gov_id'), 'required|numeric');
        $this->form_validation->set_rules('mobile', $this->lang->line('mobile'), 'required|numeric');
        $this->form_validation->set_rules('birth_date', $this->lang->line('birth_date'), 'required');
        $this->form_validation->set_rules('inheritor', $this->lang->line('inheritor'), 'required');
        //$this->form_validation->set_rules('balance', $this->lang->line('balance'), 'required|numeric');

        if ($_POST) {
            if ($this->form_validation->run()) {
                //exit;
                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $email = $this->input->post('email');
                $father_name = $this->input->post('father_name');
                $mother_name = $this->input->post('mother_name');
                $password = $this->input->post('password');
                $pay_pass = $this->input->post('pay_pass');
                $gov_id = $this->input->post('gov_id');
                $birth_place = $this->input->post('birth_place');
                $birth_date = $this->input->post('birth_date');
                $civil_reg = $this->input->post('civil_reg');
                $amaneh = $this->input->post('amaneh');
                $address = $this->input->post('address');
                $mobile = $this->input->post('mobile');
                $inheritor = $this->input->post('inheritor');
                $balance = $this->input->post('balance');

                $updated = $this->user_model->edit_student($id, $first_name, $last_name, $email, $father_name, $mother_name, $gov_id, $birth_place, strtotime($birth_date), $civil_reg, $amaneh, $address, $mobile, sha1($password), $inheritor, $balance, $pay_pass);
                // print_r($created); exit();
                if ($updated) {
                    $this->messages->success($this->lang->line('update_success'));
                } else {
                    $this->messages->error($this->lang->line('update_not_success'));
                }
            }
        }
        redirect(base_url() . "user_details/$id");
    }

    public function user_details($user_id = '')
    {
        if ($user_id == 1) {
            have_access(54);
        }
        have_access(44);
        $data = $this->user_model->get_alldetails($user_id);

        $data['title'] = $this->lang->line('student_details');
        $data['selected'] = "students_list";
        $this->load->view('panel/student_details_view', $data);
    }

    public function user_course($uc_id = '')
    {
        if ($_POST) {
            $this->form_validation->set_rules('course_cat', trans('course_cat'), 'required|is_numeric');
            $this->form_validation->set_rules('course', trans('course'), 'required|is_numeric');
            $this->form_validation->set_rules('course_lvl', trans('course_lvl'), 'required|is_numeric');

            if ($this->form_validation->run()) {
                $course_cat = $this->input->post('course_cat');
                $course = $this->input->post('course');
                $course_lvl = $this->input->post('course_lvl');

                $registerd = $this->user_model->modify_cource($uc_id, $course, $course_lvl);
                if ($registerd) {
                    $this->messages->success(trans('lesson_reged'));
                } else {
                    $this->messages->error(trans('lesson_not_reged'));
                }
                $user_id = $this->db->get_where('user_course', array('id' => $uc_id))->row()->user_id;
                redirect(base_url() . "user_details/$user_id");
            }
        }

        $data['course_cat'] = $this->user_model->get_course_cats();
        $data['title'] = $this->lang->line('register_course');
        $data['selected'] = "register_course";
        $data['uc_id'] = $uc_id;
        $this->load->view('panel/modify_course_view', $data);
    }

    public function get_statics($value = '')
    {
        have_access(47);
        $all_count = 0;
        $counter = array();


        $current_day = date("N");

        $days_to_friday = 5 - $current_day;
        $days_from_monday = $current_day - 1;
        $monday = date("Y-m-d", strtotime("- {$days_from_monday} Days"));

        $friday = strtotime("+{$days_to_friday} Days") - 518400;
        $friday = $current_day > 5 ? $friday + 604800 : $friday;
        $nextfriday = $friday + 604800;
        //echo date('Y-m-d H:i', $lastfriday).' '.date('Y-m-d H:i', $friday); exit;
        $friday = strtotime(date('Y-m-d 00:00:00', $friday));
        if ($_POST) {
            $week = $this->input->post('week') ? $this->input->post('week') : 0;
            $year = $this->input->post('year') != '' ? $this->input->post('year') : date('Y');

            $from_date = strtotime($year . '-01-01') + $week * 7 * 24 * 60 * 60;
            $to_date = strtotime($year . '-01-01') + ($week + 1) * 7 * 24 * 60 * 60;
            $friday = strtotime('last friday', strtotime(date('Y-m-d', $from_date)));
            $friday = $friday - 604800;
            //echo $current_day; exit;
            $nextfriday = $friday + 604800;
            $friday = strtotime('last friday', strtotime(date('Y-m-d', $from_date)));
            $nextfriday = $friday + 604800;
            //echo date('Y-m-d H:i', $nextfriday).' '.date('Y-m-d H:i', $friday); exit;
        }

        $users_count = 0;


        $users = $this->db->query("SELECT * FROM users WHERE reg_date<$friday")->result();
        //echo "SELECT * FROM users WHERE reg_date<$lastfriday"; exit;
        foreach ($users as $user) {
            $sql = "SELECT * FROM stored_bal WHERE parent_id=$user->emp_id AND parent_type='l' AND paid_date BETWEEN $friday AND $nextfriday ";
            $l_res = $this->db->query($sql);
            $l_count = $l_res->num_rows();
            $sql = "SELECT * FROM stored_bal WHERE parent_id=$user->emp_id AND parent_type='r' AND paid_date BETWEEN $friday AND $nextfriday ";
            $r_res = $this->db->query($sql);
            $r_count = $r_res->num_rows();
            $count = $l_count > $r_count ? $r_count : $l_count;
            $count *= 2;
            $users_count += $count;
            //echo $count."<br>";
            //echo $sql; exit;
            $comm = $this->db->get('commisions')->row()->comm;
            $max_pay = $this->db->get('commisions')->row()->max_pay;
            $payment = $count * $comm > $max_pay ? $max_pay : $count * $comm;
            $counter[$user->emp_id] = $payment;
            $all_count += $payment;
        }
        $ddate = date('Y-m-d');
        $date = new DateTime($ddate);
        $week = $date->format("W");
        //if ($this->session->userdata('user_id') == 1) {
        $day = date('N', time());
        //echo date("Y-m-d H:i", strtotime('sunday last week')); exit;
        if ($day > 5) {
            $week++;

        }
        //}
        $user_id = $this->session->userdata('user_id');
        $data['week'] = $week;
        $data['balance'] = $this->db->get_where('users', array('emp_id' => $user_id))->row()->balance;
        $data['title'] = $this->lang->line('get_week_statics');
        $data['selected'] = "get_week_statics";
        $data['results'] = $counter;
        $data['res'] = $all_count;
        $data['users_count'] = $this->db->query("SELECT DISTINCT(user_id) FROM stored_bal WHERE paid_date BETWEEN $friday AND $nextfriday ")->num_rows();
        $data['users'] = $users;
        $data['expanse'] = $this->db->get('commisions')->row()->expanses;
        $this->load->view('panel/statics_data', $data);
    }

    public function get_unpaid_statics($value = '')
    {
        have_access(47);
        $all_count = 0;
        $counter = array();
        $current_day = date("N");
        //echo $current_day; exit;
        $days_to_friday = 5 - $current_day;
        $days_from_monday = $current_day - 1;
        $monday = date("Y-m-d", strtotime("- {$days_from_monday} Days"));

        $friday = strtotime("+{$days_to_friday} Days") - 518400;
        $friday = $current_day > 5 ? $friday + 604800 : $friday;


        $friday = strtotime(date('Y-m-d 00:00:00', $friday));
        $lastfriday = $friday - 604800;
        //echo date('Y-m-d H:i', $lastfriday).' '.date('Y-m-d H:i', $friday); exit;
        $sql = "SELECT u.emp_id, u.username, u.f_name, u.l_name, l_t.left_h, r_t.right_h
				   FROM (SELECT parent_id, COUNT(parent_id) left_h FROM `stored_bal` WHERE parent_type='l' AND paid=0 AND add_date < $friday GROUP BY parent_id) l_t,
				        (SELECT parent_id, COUNT(parent_id) right_h FROM `stored_bal` WHERE parent_type='r' AND paid=0 AND add_date < $friday GROUP BY parent_id) r_t,
				        users u
				  WHERE u.emp_id=l_t.parent_id
				    AND u.emp_id=r_t.parent_id
				    AND l_t.left_h>0
				    AND r_t.right_h>0
				    AND u.reg_date<$friday"; //exit;

        $users = $this->db->query($sql)->result();

        $cond = implode(',', $emps);
        //$users = $this->db->query("SELECT * FROM users WHERE emp_id IN ($cond)")->result();
        //exit;
        $data['title'] = $this->lang->line('get_statics');
        $data['selected'] = "get_statics";
        //$data['results']  = $counter;
        //$data['res']      = $all_count;
        $data['users_count'] = $this->db->query("SELECT * FROM users WHERE reg_date BETWEEN $lastfriday AND $friday")->num_rows();
        $data['users'] = $users;
        $data['expanse'] = $this->db->get('commisions')->row()->expanses;
        $data['comm'] = $this->db->get('commisions')->row()->comm;
        $data['max_pay'] = $this->db->get('commisions')->row()->max_pay;
        $this->load->view('panel/unpaid_statics_data', $data);
    }

    public function update_comm_maqu($value = '')
    {
        have_access(42);
        if ($_POST) {
            $this->form_validation->set_rules('commision', trans('commision'), 'required|trim|is_numeric');
            $this->form_validation->set_rules('fath_comm', trans('fath_comm'), 'required|trim|is_numeric');
            $this->form_validation->set_rules('max_pay', trans('max_pay'), 'required|trim|is_numeric');
            $this->form_validation->set_rules('expanses', trans('expanses'), 'required|trim|is_numeric');
            $this->form_validation->set_rules('marquee', trans('marquee'), 'required|trim');
            if ($this->form_validation->run()) {
                $comm = $this->input->post('commision');
                $fath_comm = $this->input->post('fath_comm');
                $max_pay = $this->input->post('max_pay');
                $expanses = $this->input->post('expanses');
                $marquee = $this->input->post('marquee');

                $update = array(
                    'comm' => $comm,
                    'fath_comm' => $fath_comm,
                    'marquee' => $marquee,
                    'max_pay' => $max_pay,
                    'expanses' => $expanses
                );

                $this->db->trans_start();
                $this->db->where('id', 1);
                $this->db->update('commisions', $update);

                $last_res = $this->db->query("SELECT id FROM expanses_log ORDER BY id DESC LIMIT 1")->row()->id;

                $update = array('end_date' => time());
                $this->db->where('id', $last_res);
                $this->db->update('expanses_log', $update);

                $insert = array(
                    'expanse' => $expanses,
                    'start_date' => time()
                );
                $this->db->insert('expanses_log', $insert);
                $this->db->trans_complete();
                if ($this->db->trans_status()) {
                    $this->messages->success($this->lang->line('updated'));
                } else {
                    $this->messages->error($this->lang->line('update_not_success'));
                }

            }


        }
        $results = $this->db->get('commisions')->row();
        $data['title'] = $this->lang->line('update_marquee_comm');
        $data['selected'] = "update_marqu";
        $data['result'] = $results;
        $this->load->view('panel/comm_marquee_view', $data);
    }

    public function user_info()
    {
        $id = $this->session->userdata('user_id');
        $res = $this->user_model->check_oldrequest($id);
        if ($res) {
            $this->messages->error($this->lang->line('check_oldrequest'));
            redirect(base_url());
        }
        //echo $this->input->post('mother_name'); exit;
        $this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'required');
        $this->form_validation->set_rules('father_name', $this->lang->line('father_name'), 'required');
        $this->form_validation->set_rules('mother_name', $this->lang->line('mother_name'), 'required');
        $this->form_validation->set_rules('birth_place', $this->lang->line('birth_place'), 'required');
        $this->form_validation->set_rules('civil_reg', $this->lang->line('civil_reg'), 'required');
        $this->form_validation->set_rules('amaneh', $this->lang->line('amaneh'), 'required');
        $this->form_validation->set_rules('address', $this->lang->line('address'), 'required');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'required');
        $this->form_validation->set_rules('gov_id', $this->lang->line('gov_id'), 'required|numeric');
        $this->form_validation->set_rules('mobile', $this->lang->line('mobile'), 'required|numeric');
        $this->form_validation->set_rules('birth_date', $this->lang->line('birth_date'), 'required');
        if ($_POST) {
            //exit;
            if ($this->form_validation->run() == true) {

                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $email = $this->input->post('email');
                $father_name = $this->input->post('father_name');
                $mother_name = $this->input->post('mother_name');
                $gov_id = $this->input->post('gov_id');
                $birth_place = $this->input->post('birth_place');
                $birth_date = $this->input->post('birth_date');
                $civil_reg = $this->input->post('civil_reg');
                $amaneh = $this->input->post('amaneh');
                $address = $this->input->post('address');
                $mobile = $this->input->post('mobile');

                $created = $this->user_model->edit_user($first_name, $last_name, $email, $father_name, $mother_name, $gov_id, $birth_place, strtotime($birth_date), $civil_reg, $amaneh, $address, $mobile);

                if ($created) {
                    $this->messages->success($this->lang->line('level_2creation'));
                } else {
                    $this->messages->error($this->lang->line('update_not_success'));
                }

            }
        }
        $data['title'] = $this->lang->line('create_user');

        $data['selected'] = "edit_user";
        $res = $this->user_model->std_data($id);
        //echo "<pre>"; print_r($res); exit;
        $data['results'] = $res;

        $this->load->view('panel/user_info', $data);

    }


    public function check_oldrequest()
    {
        $user_id = $this->session->userdata('user_id');
        $res = $this->user_model->check_oldrequest($user_id);
        if ($res == 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_oldrequest', trans('check_oldrequest'));
            return FALSE;
        }

    }

    public function insert_courses($cat_id)
    {
        have_access(52);
        $this->form_validation->set_rules('c_name', $this->lang->line('course_cat_name'), 'required');
        $this->form_validation->set_rules('tutor_id', $this->lang->line('tutor_id'), 'required');
        $this->form_validation->set_rules('price', $this->lang->line('price'), 'required');
        $this->form_validation->set_rules('duration', $this->lang->line('duration'), 'required');
        $this->form_validation->set_rules('c_name_en', $this->lang->line('c_name_en'), 'required');
        $this->form_validation->set_rules('desc_ar', $this->lang->line('desc_ar'), 'required');
        $this->form_validation->set_rules('desc_en', $this->lang->line('desc_en'), 'required');

        if ($_POST) {
            if ($this->form_validation->run()) {
                $c_name = $this->input->post('c_name');
                $tutor_id = $this->input->post('tutor_id');
                $price = $this->input->post('price');
                $duration = $this->input->post('duration');
                $c_name_en = $this->input->post('c_name_en');
                $desc_ar = $this->input->post('desc_ar');
                $desc_en = $this->input->post('desc_en');

                $inserted = $this->user_model->add_course($c_name, $tutor_id, $price, $duration, $cat_id, $c_name_en, $desc_ar, $desc_en);
                //
                if ($inserted[0]) {
                    $this->messages->success($this->lang->line('insert_success'));
                } else {
                    $this->messages->error($inserted[1]);
                }
            }
        }
        $data['cat'] = $cat_id;
        $data['tutors'] = $this->db->query("SELECT * FROM tutors WHERE cat_id=$cat_id");
        $data['selected'] = 'add_course_cat';
        $data['header'] = $this->lang->line('new_course_cat');
        $this->load->view('panel/add_course', $data);
    }

    public function std_levl_list($lev_id)
    {
        have_access(53);
        $res = $this->user_model->get_std_levl($lev_id);
        //print_r($res); exit;
        $data['results'] = $res->result();
        $data['lev_id'] = $lev_id;
        $data['title'] = $this->lang->line('std_lev_list');
        $data['selected'] = "courses_cat";
        $this->load->view('panel/std_levl_list', $data);
    }

    public function pend_all_level($lev_id = '')
    {
        $result = $this->user_model->pend_all_level($lev_id);
        if ($result) {
            $this->messages->success('تم تبنيد جميع الطلاب لهذا الكورس بنجاح');
        } else {
            $this->messages->error('حدث خطأ أثناء تنفيذ العملية, يرجى المحاولة لاحقا');
        }
        redirect(base_url() . "get_std_lev/$lev_id");
    }

    public function activate_std_levl($lev_id = '', $emp_id = '')
    {
        $deactivated = $this->user_model->deactivate_std_levl($lev_id, $emp_id);
        if ($deactivated) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function activate_std_role($emp_id = '')
    {
        $id = $this->session->userdata('user_id');
        //	print_r($id);
        //	exit;

        if ($id == 1) {
            //exit;
            $deactivated = $this->user_model->deactivate_std_role($emp_id);
            //print_r($deactivated);
            //	exit;
            if ($deactivated) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }


    public function get_courses($id = '')
    {
        $courses = $this->db->get_where('courses', array('cat_id' => $id, 'active' => 1))->result();
        $res = '<option value="0"></option>';
        foreach ($courses as $row) {
            $res .= "<option value='$row->c_id'>$row->c_name</option>";
        }
        echo $res;
    }

    public function get_lvls($id = '')
    {
        $courses = $this->db->get_where('course_levels', array('course_id' => $id, 'active' => 1))->result();
        $res = '<option value="0"></option>';
        foreach ($courses as $row) {
            $res .= "<option value='$row->lev_id'>$row->lev_name</option>";
        }
        echo $res;
    }

    public function create_new_emp()
    {
        //echo $this->session->userdata('user_id'); exit;

        need_login();
        have_access(37);
        $data['div_error'] = '';

        $this->form_validation->set_rules('first_name', trans('first_name'), 'required');
        $this->form_validation->set_rules('last_name', trans('last_name'), 'required');
        $this->form_validation->set_rules('username', trans('username'), 'required|alpha_numeric|min_length[4]|callback_check_user|callback_check_prusername');
        //$this->form_validation->set_rules('password', trans('password'), 'required|min_length[8]');
        $this->form_validation->set_rules('father_name', trans('father_name'), 'required');
        $this->form_validation->set_rules('mother_name', trans('mother_name'), 'required');
        $this->form_validation->set_rules('birth_place', trans('birth_place'), 'required');
        $this->form_validation->set_rules('civil_reg', trans('civil_reg'), 'required');
        $this->form_validation->set_rules('amaneh', trans('amaneh'), 'required');
        $this->form_validation->set_rules('address', trans('address'), 'required');
        $this->form_validation->set_rules('email', trans('email'), 'required');
        $this->form_validation->set_rules('gov_id', trans('gov_id'), 'required|numeric');
        $this->form_validation->set_rules('mobile', trans('mobile'), 'required|numeric');
        $this->form_validation->set_rules('birth_date', trans('birth_date'), 'required');
        $this->form_validation->set_rules('inheritor', trans('inheritor'), 'required');
        $this->form_validation->set_rules('area_id', "المنطقة", 'required|numeric');
        if ($_POST) {
            //exit;
            if ($this->form_validation->run() == true) {
                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $username = $this->input->post('username');
                //$password   	= sha1($this->input->post('password'));
                $email = $this->input->post('email');
                $father_name = $this->input->post('father_name');
                $mother_name = $this->input->post('mother_name');
                $gov_id = $this->input->post('gov_id');
                $birth_place = $this->input->post('birth_place');
                $birth_date = $this->input->post('birth_date');
                $civil_reg = $this->input->post('civil_reg');
                $amaneh = $this->input->post('amaneh');
                $address = $this->input->post('address');
                $mobile = $this->input->post('mobile');
                $inheritor = $this->input->post('inheritor');
                $area_id = $this->input->post('area_id');

                $created = $this->user_model->create_new_user($first_name, $last_name, $username, '', $email, $father_name, $mother_name, $gov_id, $birth_place, strtotime($birth_date), $civil_reg, $amaneh, $address, $mobile, $inheritor, $area_id);

                if ($created[0]) {
                    $this->messages->success($this->lang->line('step_2_reg'));
                    redirect(base_url() . "register_course");
                } else {
                    //  echo "string";
                    //exit();
                    $this->messages->error($created[1]);
                }

            } else {
                //  echo validation_errors(); exit();
            }
        }
        $data['title'] = $this->lang->line('create_user');
        $data['areas'] = $this->db->get('areas')->result();
        $data['selected'] = "create_user";
        $this->load->view('panel/create_user_view', $data);
    }

    public function register_s2($value = '')
    {

        if ($_POST) {
            $this->form_validation->set_rules('course_cat', trans('course_cat'), 'required|is_numeric');
            $this->form_validation->set_rules('course', trans('course'), 'required|is_numeric');
            $this->form_validation->set_rules('course_lvl', trans('course_lvl'), 'required|is_numeric');

            if ($this->form_validation->run()) {
                $course_cat = $this->input->post('course_cat');
                $course = $this->input->post('course');
                $course_lvl = $this->input->post('course_lvl');

                $student = $this->session->userdata('new_student');

                $registerd = $this->user_model->register($course_cat, $course, $course_lvl, $student);
                if ($registerd) {
                    $message = $student ? trans('user_created') : trans('lesson_reged');
                    $this->messages->success($this->lang->line('user_created'));
                } else {
                    $message = $student ? trans('user_not_created') : trans('lesson_not_reged');
                    $this->messages->error($this->lang->line('user_not_created'));
                }
                redirect(base_url());
            }
        }

        $data['course_cat'] = $this->user_model->get_course_cats();
        $data['title'] = $this->lang->line('register_course');

        $data['selected'] = "register_course";
        $this->load->view('panel/create_user_s2_view', $data);
    }

    public function register_new_course($value = '')
    {

        if ($_POST) {
            $this->form_validation->set_rules('course_cat', trans('course_cat'), 'required|is_numeric');
            $this->form_validation->set_rules('course', trans('course'), 'required|is_numeric');
            $this->form_validation->set_rules('course_lvl', trans('course_lvl'), 'required|is_numeric');

            if ($this->form_validation->run()) {
                $course_cat = $this->input->post('course_cat');
                $course = $this->input->post('course');
                $course_lvl = $this->input->post('course_lvl');

                $registerd = $this->user_model->register_course($course_cat, $course, $course_lvl);
                if ($registerd) {
                    $message = $student ? trans('user_created') : trans('lesson_reged');
                    $this->messages->success($this->lang->line('user_created'));
                } else {
                    $message = $student ? trans('user_not_created') : trans('lesson_not_reged');
                    $this->messages->error($this->lang->line('user_not_created'));
                }
                redirect(base_url());
            }
        }

        $data['course_cat'] = $this->user_model->get_course_cats();
        $data['title'] = $this->lang->line('register_course');

        $data['selected'] = "register_course";
        $this->load->view('panel/reg_course_view', $data);
    }

    public function admin_new_emp($value = '')
    {
        need_login();
        // have_access();
        have_access(45);
        $data['div_error'] = '';
        $user_id = $this->session->userdata('user_id');
        $this->form_validation->set_rules('parent_id', $this->lang->line('parent_id'), 'required');
        $this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'required');
        $this->form_validation->set_rules('username', $this->lang->line('username'), 'required|alpha_numeric|min_length[4]|callback_check_user|callback_check_prusername');
        $this->form_validation->set_rules('password', $this->lang->line('password'), 'required|min_length[8]');
        $this->form_validation->set_rules('father_name', $this->lang->line('father_name'), 'required');
        $this->form_validation->set_rules('mother_name', $this->lang->line('mother_name'), 'required');
        $this->form_validation->set_rules('birth_place', $this->lang->line('birth_place'), 'required');
        $this->form_validation->set_rules('civil_reg', $this->lang->line('civil_reg'), 'required');
        $this->form_validation->set_rules('amaneh', $this->lang->line('amaneh'), 'required');
        $this->form_validation->set_rules('address', $this->lang->line('address'), 'required');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'required');
        $this->form_validation->set_rules('gov_id', $this->lang->line('gov_id'), 'required|numeric');
        $this->form_validation->set_rules('mobile', $this->lang->line('mobile'), 'required|numeric');
        $this->form_validation->set_rules('birth_date', $this->lang->line('birth_date'), 'required');
        if ($_POST) {
            //exit;
            if ($this->form_validation->run() == true) {
                $parent_id = $this->input->post('parent_id');
                //	print_r($parent_id); exit();
                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $username = $this->input->post('username');
                $password = sha1($this->input->post('password'));
                $email = $this->input->post('email');
                $father_name = $this->input->post('father_name');
                $mother_name = $this->input->post('mother_name');
                $gov_id = $this->input->post('gov_id');
                $birth_place = $this->input->post('birth_place');
                $birth_date = $this->input->post('birth_date');
                $civil_reg = $this->input->post('civil_reg');
                $amaneh = $this->input->post('amaneh');
                $address = $this->input->post('address');
                $mobile = $this->input->post('mobile');

                $created = $this->user_model->admin_new_user($parent_id, $first_name, $last_name, $username, $password, $email, $father_name, $mother_name, $gov_id, $birth_place, strtotime($birth_date), $civil_reg, $amaneh, $address, $mobile);
                // print_r($created); exit
                if ($created) {
                    $this->messages->success($this->lang->line('step_2_reg'));
                    redirect(base_url() . "register_course");
                } else {
                    $this->messages->error($this->lang->line('user_not_created'));
                }

            } else {
                $data['div_error'] = ' has-error';
            }
        }
        $data['title'] = $this->lang->line('create_user');
        $data['users'] = $this->db->query("SELECT * FROM users WHERE fired=0 AND emp_id!=$user_id");

        $data['selected'] = "create_new_user";
        $this->load->view('panel/create_new_user', $data);


    }

    public function edit_emp($id)
    {
        $res = $this->user_model->get_edit_data($id);
        if (!$res) {
            redirect(base_url());
        }
        //echo $this->input->post('mother_name'); exit;
        $this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'required');
        $this->form_validation->set_rules('father_name', $this->lang->line('father_name'), 'required');
        $this->form_validation->set_rules('mother_name', $this->lang->line('mother_name'), 'required');
        $this->form_validation->set_rules('birth_place', $this->lang->line('birth_place'), 'required');
        $this->form_validation->set_rules('civil_reg', $this->lang->line('civil_reg'), 'required');
        $this->form_validation->set_rules('amaneh', $this->lang->line('amaneh'), 'required');
        $this->form_validation->set_rules('address', $this->lang->line('address'), 'required');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'required');
        $this->form_validation->set_rules('gov_id', $this->lang->line('gov_id'), 'required|numeric');
        $this->form_validation->set_rules('mobile', $this->lang->line('mobile'), 'required|numeric');
        $this->form_validation->set_rules('birth_date', $this->lang->line('birth_date'), 'required');
        if ($_POST) {
            //exit;
            if ($this->form_validation->run() == true) {

                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $email = $this->input->post('email');
                $father_name = $this->input->post('father_name');
                $mother_name = $this->input->post('mother_name');
                $gov_id = $this->input->post('gov_id');
                $birth_place = $this->input->post('birth_place');
                $birth_date = $this->input->post('birth_date');
                $civil_reg = $this->input->post('civil_reg');
                $amaneh = $this->input->post('amaneh');
                $address = $this->input->post('address');
                $mobile = $this->input->post('mobile');

                $created = $this->user_model->edited_user($id, $first_name, $last_name, $email, $father_name, $mother_name, $gov_id, $birth_place, strtotime($birth_date), $civil_reg, $amaneh, $address, $mobile);
                // print_r($created); exit();
                if ($created) {
                    $this->messages->success($this->lang->line('update_success'));
                } else {
                    $this->messages->error($this->lang->line('update_not_success'));
                }
                redirect(base_url() . "edit_request");
            } else {
                $data['div_error'] = ' has-error';
            }
        }
        $data['title'] = $this->lang->line('edit_data');

        $data['selected'] = "edit_user";

        //echo "<pre>"; print_r($res); exit;
        $data['results'] = $res;

        $this->load->view('panel/edit _request_data', $data);
    }


    public function admin_edit_emp_r($id)
    {
        $res = $this->user_model->admin_get_edit_data($id);
        if (!$res) {
            redirect(base_url());
        }
        //echo $this->input->post('mother_name'); exit;
        $this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'required');
        $this->form_validation->set_rules('father_name', $this->lang->line('father_name'), 'required');
        $this->form_validation->set_rules('mother_name', $this->lang->line('mother_name'), 'required');
        $this->form_validation->set_rules('birth_place', $this->lang->line('birth_place'), 'required');
        $this->form_validation->set_rules('civil_reg', $this->lang->line('civil_reg'), 'required');
        $this->form_validation->set_rules('amaneh', $this->lang->line('amaneh'), 'required');
        $this->form_validation->set_rules('address', $this->lang->line('address'), 'required');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'required');
        $this->form_validation->set_rules('gov_id', $this->lang->line('gov_id'), 'required|numeric');
        $this->form_validation->set_rules('mobile', $this->lang->line('mobile'), 'required|numeric');
        $this->form_validation->set_rules('birth_date', $this->lang->line('birth_date'), 'required');
        if ($_POST) {
            //exit;
            if ($this->form_validation->run() == true) {

                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $email = $this->input->post('email');
                $father_name = $this->input->post('father_name');
                $mother_name = $this->input->post('mother_name');
                $gov_id = $this->input->post('gov_id');
                $birth_place = $this->input->post('birth_place');
                $birth_date = $this->input->post('birth_date');
                $civil_reg = $this->input->post('civil_reg');
                $amaneh = $this->input->post('amaneh');
                $address = $this->input->post('address');
                $mobile = $this->input->post('mobile');

                $created = $this->user_model->admin_edited_user($id, $first_name, $last_name, $email, $father_name, $mother_name, $gov_id, $birth_place, strtotime($birth_date), $civil_reg, $amaneh, $address, $mobile);
                // print_r($created); exit();
                if ($created) {
                    $this->messages->success($this->lang->line('update_success'));
                } else {
                    $this->messages->error($this->lang->line('update_not_success'));
                }
                redirect(base_url() . "edit_request");
            } else {
                $data['div_error'] = ' has-error';
            }
        }
        $data['title'] = $this->lang->line('admin_edit_request');

        $data['selected'] = "admin_edit_request";

        //echo "<pre>"; print_r($res); exit;
        $data['results'] = $res;

        $this->load->view('panel/admin_edit_request_data', $data);
    }

    public function edit_emp_data()
    {

        $res = $this->user_model->edit_data();
        $data['results'] = $res;
        $data['title'] = $this->lang->line('edit_child_data');
        $data['selected'] = "edit_child_data";
        $this->load->view('panel/edit_request', $data);
    }

    public function admin_edit_emp()
    {

        $res = $this->user_model->edit_data();
        $data['results'] = $res;
        $data['title'] = $this->lang->line('admin_edit_request');
        $data['selected'] = "admin_edit_request";
        $this->load->view('panel/admin_edit_request', $data);
    }


    public function courses_cat()
    {
        have_access(58);
        $res = $this->user_model->get_courses_cat();
        $data['results'] = $res;
        $data['title'] = $this->lang->line('courses_cat');
        $data['selected'] = "courses_cat";
        $this->load->view('panel/category_list', $data);
    }

    public function courses_list($cat_id)
    {
        have_access(58);
        $res = $this->user_model->get_courses($cat_id);

        // print_r($res); exit;
        $data['results'] = $res;
        $data['cat'] = $cat_id;
        $data['title'] = $this->lang->line('courses');
        $data['selected'] = "courses_cat";
        $this->load->view('panel/course_list', $data);
    }

    public function courses_levels($c_id)
    {
        have_access(58);
        $res = $this->user_model->get_courses_levels($c_id);
        //print_r($res); exit;
        $data['c'] = $c_id;
        $data['course_id'] = $c_id;
        $data['results'] = $res;
        $data['title'] = $this->lang->line('courses_levels');
        $data['selected'] = "courses_cat";
        $this->load->view('panel/courses_levels_list', $data);
    }

    public function activate_cat($cat_id = '')
    {

        have_access(58);
        $deactivated = $this->user_model->deactivate_cat($cat_id);
        if ($deactivated) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function activate_course($c_id = '')
    {

        have_access(58);
        $deactivated = $this->user_model->deactivate_course($c_id);
        if ($deactivated) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function activate_c_lev($lev_id = '')
    {

        have_access(58);
        $deactivated = $this->user_model->deactivate_course_levels($lev_id);
        if ($deactivated) {
            echo 1;
        } else {
            echo 0;
        }
    }


    public function check_prusername($username = '')
    {

        if (!preg_match('/^[A-Za-z0-9_]+$/', $username)) // '/[^a-z\d]/i' should also work.
        {
            $this->form_validation->set_message('check_clusername', $this->lang->line('error_chars'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function employees_list($emp_id = '')
    {
        need_login();
        have_access(10);
        $from = '';
        $to = '';


        if ($_POST) {
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            $from = $from ? strtotime($from) : '';
            $to = $to ? strtotime($to) : '';
            //echo "$from $to"; exit;


        }
        $results = $this->user_model->employees_list($emp_id, $from, $to);
        if ($results->num_rows()) {
            $data['results'] = $results->result();
        } else {
            $data['results'] = '';
            $data['title'] = $this->lang->line('no_emp');
            $data['body'] = $this->lang->line('no_emp_ex');
        }
        $data['title'] = $this->lang->line('employees');
        $data['selected'] = 'employees';
        $this->load->view('users/employees_view', $data);
    }

    public function change_password()
    {
        $id = $this->session->userdata('user_id');
        $this->form_validation->set_rules('old_password', $this->lang->line('old_password'), 'required');
        $this->form_validation->set_rules('new_password', $this->lang->line('new_password'), 'required|min_length[8]|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', $this->lang->line('confirm_password'), 'required|min_length[8]');

        if ($_POST) {
            if ($this->form_validation->run() == true) {

                $old_pass = $this->db->get_where('users', array('emp_id' => $id, 'password' => sha1($this->input->post('old_password'))))->num_rows();
                // print_r($old_pass); exit;
                //  print_r($old_pass); exit();
                if ($old_pass) {

                    $password = $this->input->post('new_password');
                    $edited = $this->user_model->change_pass($id, $password);
                    if ($edited) {
                        $this->messages->success($this->lang->line('update_success'));
                    } else {
                        $this->messages->error($this->lang->line('update_not_success'));
                    }
                } else {
                    $this->messages->error($this->lang->line('update_not_success'));
                }
            }
        }
        $data['title'] = $this->lang->line('change_password');

        $data['selected'] = "change_password";

        $this->load->view('panel/change_password', $data);


    }


    public function insert_courses_cats()
    {
        $this->form_validation->set_rules('course_cat_name', $this->lang->line('course_cat_name'), 'required');
        $this->form_validation->set_rules('cat_name_en', $this->lang->line('cat_name_en'), 'required');
        $this->form_validation->set_rules('desc_ar', $this->lang->line('desc_ar'), 'required');
        $this->form_validation->set_rules('desc_en', $this->lang->line('desc_en'), 'required');

        if ($_POST) {
            if ($this->form_validation->run()) {
                $course_cat_name = $this->input->post('course_cat_name');
                $cat_name_en = $this->input->post('cat_name_en');
                $desc_ar = $this->input->post('desc_ar');
                $desc_en = $this->input->post('desc_en');

                $inserted = $this->user_model->add_course_cat($course_cat_name, $cat_name_en, $desc_ar, $desc_en);
                //
                if ($inserted) {
                    $this->messages->success($this->lang->line('insert_success'));
                } else {
                    $this->messages->error($this->lang->line('insert_not_success'));
                }
            }
        }
        $data['selected'] = 'add_course_cat';
        $data['header'] = $this->lang->line('new_course_cat');
        $this->load->view('panel/add_course_cat', $data);
    }


    public function insert_tutors()
    {

        $this->form_validation->set_rules('cat_id', $this->lang->line('cat_co_name'), 'required');
        $this->form_validation->set_rules('tutors_name', $this->lang->line('tutors_name'), 'required');
        // print_r($inserted); exit;
        if ($_POST) {
            if ($this->form_validation->run()) {
                $tutor_name = $this->input->post('tutors_name');
                $cat_id = $this->input->post('cat_id');


                $inserted = $this->user_model->add_tutors($tutor_name, $cat_id);
                // print_r($inserted); exit;
                if ($inserted) {
                    $this->messages->success($this->lang->line('insert_success'));

                } else {
                    $this->messages->error($this->lang->line('insert_not_success'));

                }
            }
        }

        $data['cats'] = $this->db->query("SELECT * FROM courses_cats");
        $data['selected'] = 'add_tutors';
        $data['header'] = $this->lang->line('new_tutors');
        $this->load->view('panel/add_tutors', $data);
    }


    public function insert_courses_levels($course_id)
    {

        $this->form_validation->set_rules('lev_name', $this->lang->line('course_cat_name'), 'required');
        $this->form_validation->set_rules('lev_price', 'سعر التسجيل', 'required|is_numeric');
        $this->form_validation->set_rules('lev_comm', 'نسبة العمولة', 'required');
        $this->form_validation->set_rules('c_name_en', $this->lang->line('c_name_en'), 'required');
        $this->form_validation->set_rules('desc_ar', $this->lang->line('desc_ar'), 'required|trim');
        $this->form_validation->set_rules('desc_en', $this->lang->line('desc_en'), 'required|trim');
        if ($_POST) {
            if ($this->form_validation->run()) {
                $lev_name = $this->input->post('lev_name');
                $lev_price = $this->input->post('lev_price');
                $lev_comm = $this->input->post('lev_comm');
                $name_en = $this->input->post('c_name_en');
                $desc_en = $this->input->post('desc_en');
                $desc_ar = $this->input->post('desc_ar');
//echo $lev_comm; exit;
                $inserted = $this->user_model->add_course_levels($lev_name, $course_id, $lev_price, $name_en, $desc_ar, $desc_en, $lev_comm);
                //
                if ($inserted) {
                    $this->messages->success($this->lang->line('insert_success'));
                } else {
                    $this->messages->error($this->lang->line('insert_not_success'));
                }
            }
        }
        $data['course_id'] = $course_id;
        $data['selected'] = 'add_course_cat';
        $data['header'] = $this->lang->line('new_course_cat');
        $this->load->view('panel/add_course_levels', $data);
    }

    public function edit_courses_levels($lev_id, $course_id)
    {

        $this->form_validation->set_rules('lev_name', $this->lang->line('course_cat_name'), 'required');
        $this->form_validation->set_rules('lev_price', 'سعر التسجيل', 'required|is_numeric');
        if ($_POST) {
            if ($this->form_validation->run()) {
                //exit;
                $lev_name = $this->input->post('lev_name');
                $lev_price = $this->input->post('lev_price');
                $inserted = $this->user_model->edit_course_levels($lev_name, $lev_id, $lev_price);
                //
                if ($inserted) {
                    $this->messages->success($this->lang->line('insert_success'));
                } else {
                    $this->messages->error($this->lang->line('insert_not_success'));
                }
                redirect(base_url() . "courses_levels/$course_id");
            }
        }

        $data['level'] = $this->db->get_where('course_levels', array('lev_id' => $lev_id))->row();
        $data['course_id'] = $course_id;
        $data['lev_id'] = $lev_id;
        $data['selected'] = 'add_course_cat';
        $data['header'] = $this->lang->line('new_course_cat');
        $this->load->view('panel/edit_course_levels', $data);
    }

    /*
    public function edit_cat($cat_id)
    {
        $this->form_validation->set_rules('cat_name', $this->lang->line('cat_name'), 'required');
     if ($_POST) {
     if ($this->form_validation->run()) {
         $cat_name = $this->input->post('cat_name');
         $inserted = $this->user_model->edit_cat($cat_id,$cat_name);
        //
     if ($inserted) {
             $this->messages->success($this->lang->line('insert_success'));

     } else {
             $this->messages->error($this->lang->line('insert_not_success'));
     }
       }
    }
    $data['']     = ;
    $data['selected']   = 'add_course_cat';
    $data['header']     = $this->lang->line('new_course_cat');
    $this->load->view('panel/', $data);
    }
    }
    /*
    public function edit_courses($value='')
    {
        $this->form_validation->set_rules('', $this->lang->line(''), 'required');
     if ($_POST) {
     if ($this->form_validation->run()) {
         $lev_name = $this->input->post('');
         $inserted = $this->user_model->add_course_levels(,  );
        //
     if ($inserted) {
             $this->messages->success($this->lang->line('insert_success'));

     } else {
             $this->messages->error($this->lang->line('insert_not_success'));
     }
       }
    }
    $data['course_id']     = ;
    $data['selected']   = '';
    $data['header']     = $this->lang->line('');
    $this->load->view('panel/', $data);
    }

    }

    public function edit_level($value='')
    {
        $this->form_validation->set_rules('lev_name', $this->lang->line('course_cat_name'), 'required');
     if ($_POST) {
     if ($this->form_validation->run()) {
         $lev_name = $this->input->post('lev_name');
         $inserted = $this->user_model->add_course_levels($lev_name, $course_id );
        //
     if ($inserted) {
             $this->messages->success($this->lang->line('insert_success'));

     } else {
             $this->messages->error($this->lang->line('insert_not_success'));
     }
       }
    }
    $data['course_id']     = $course_id;
    $data['selected']   = 'add_course_cat';
    $data['header']     = $this->lang->line('new_course_cat');
    $this->load->view('panel/add_course_levels', $data);
    }
    }
*/


    public function suspended_employees()
    {
        need_login();
        have_access(58);
        $results = $this->user_model->suspended_emps();
        if ($results->num_rows()) {
            $data['results'] = $results->result();
        } else {
            $data['results'] = '';
            $data['title'] = $this->lang->line('no_emp');
            $data['body'] = $this->lang->line('no_emp_ex');
        }
        $data['title'] = $this->lang->line('sus_emps');
        $data['selected'] = 'sus_emps';
        $this->load->view('users/sus_employees_view', $data);
    }

    public function restore_employee($emp_id = '')
    {
        have_access(56);
        $restored = $this->user_model->restore_emp($emp_id);
        if ($restored) {
            $this->messages_model->success($this->lang->line('emp_restored'));
        } else {
            $this->messages_model->error($this->lang->line('emp_not_restored'));
        }
        redirect(base_url() . 'sus_emps');
    }

    public function del_employee($emp_id = '')
    {
        have_access(57);
        $deleted = $this->user_model->del_employee($emp_id);
        if ($deleted) {
            $this->messages_model->success($this->lang->line('emp_fired'));
        } else {
            $this->messages_model->error($this->lang->line('emp_not_fired'));
        }
        redirect(base_url() . 'sus_emps');
    }

    public function fire_employee($emp_id = '')
    {
        need_login();
        have_access(14);

        if (!$emp_id) {
            $this->messages_model->error($this->lang->line('no_emp'));
            redirect(base_url());
        }
        $this->form_validation->set_rules('fire_res', $this->lang->line('fire_res'), 'required');
        $this->form_validation->set_rules('ad_emp', $this->lang->line('ad_emp'), 'required');


        if ($_POST) {
            if ($this->form_validation->run()) {
                $fire_res = $this->input->post('fire_res');
                $emp = $this->input->post('ad_emp');
                $fired = $this->user_model->fire_employee($emp_id, $fire_res, $emp);
                if ($fired) {
                    $this->messages_model->success($this->lang->line('emp_fired'));
                } else {
                    $this->messages_model->error($this->lang->line('emp_not_fired'));
                }
                redirect(base_url() . 'employees');
            } else {
                $data['div_error'] = ' has-error';
            }
        }
        $data['employees'] = $this->db->query("SELECT * FROM users WHERE fired=0 AND emp_id!=$emp_id")->result();
        $data['title'] = $this->lang->line('fire_emp');
        $data['pay_descs'] = $this->user_model->get_pay_descs();
        $data['emp_id'] = $emp_id;
        $data['selected'] = 'employees';
        $this->load->view('users/fire_emp_view', $data);

    }

    public function all_user_details($emp_id = '')
    {
        need_login();
        have_access(21);
        $this->load->model('advertising_model');
        if (!$emp_id) {
            $this->messages_model->error($this->lang->line('no_emp'));
            redirect(base_url());
        }
        $from = '';
        $to = '';
        $this->form_validation->set_rules('from', $this->lang->line('from'), 'callback_check_date');
        $this->form_validation->set_rules('to', $this->lang->line('to'), 'callback_check_date');
        if ($_POST) {
            if ($this->form_validation->run()) {
                $from = $this->input->post('from');
                $to = $this->input->post('to');
                $from = $from ? strtotime($from) : '';
                $to = $to ? strtotime($to) : '';
            }
        }
        $data['emp_id'] = $emp_id;
        $emp = $this->user_model->employees_list($emp_id);
        if (!$emp->num_rows) {
            $this->messages_model->error($this->lang->line('no_emp'));
            redirect(base_url());
        }

        $data['ads'] = $this->advertising_model->advertisments_list($emp_id, $from, $to);
        $data['sessions'] = $this->user_model->emp_sessions($emp_id, $from, $to);
        $data['employee'] = $emp->row();
        $data['payments'] = $this->user_model->payments_list($emp_id, $from, $to)->num_rows() ?
            $this->user_model->payments_list($emp_id, $from, $to)->result() : '';
        $data['transfer'] = $this->user_model->user_transfers($emp_id, $from, $to)->num_rows() ?
            $this->user_model->user_transfers($emp_id, $from, $to)->result() : '';
        $data['expenses'] = $this->user_model->expense_list($emp_id, $from, $to)->num_rows() ?
            $this->user_model->expense_list($emp_id, $from, $to)->result() : '';
        $data['clients'] = $this->user_model->clients_list($emp_id, $from, $to);
        $data['sons'] = $this->user_model->employees_list($emp_id, $from, $to, 1);
        $data['title'] = $this->lang->line('employees');
        $data['selected'] = 'employees';
        $this->load->view('users/user_details_view', $data);
    }

    public function edit_father_commision($emp_id = '')
    {
        need_login();
        have_access(19);

        if (!$emp_id) {
            $this->messages_model->error($this->lang->line('no_emp'));
            redirect(base_url());
        }
        $this->form_validation->set_rules('new_comm', $this->lang->line('new_comm'), 'required|numeric|is_natural');
        if ($_POST) {
            if ($this->form_validation->run()) {
                $new_comm = $this->input->post('new_comm');
                $updated = $this->user_model->edit_father_commision($emp_id, $new_comm);
                if ($updated) {
                    $this->messages_model->success($this->lang->line('comm_updated'));
                } else {
                    $this->messages_model->error($this->lang->line('comm_not_updated'));
                }
                redirect(base_url() . 'emp_details/' . $emp_id);
            } else {
                $data['div_error'] = ' has-error';
            }
        }

        $data['emp_id'] = $emp_id;
        $data['selected'] = 'employees';
        $this->load->view('users/edit_father_commision_view', $data);
    }

    public function edit_basic_emp_info($emp_id = '')
    {
        need_login();
        have_access(20);

        if (!$emp_id) {
            $this->messages_model->error($this->lang->line('no_emp'));
            redirect(base_url());
        }
        $emp = $this->user_model->employees_list($emp_id);
        $this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'required');
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'required|valid_email');
        $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'required|numeric');
        $this->form_validation->set_rules('max_directs', $this->lang->line('max_directs'), 'required|numeric');
        $this->form_validation->set_rules('contruct_date', $this->lang->line('contruct_date'), 'required');
        if ($_POST) {
            if ($this->form_validation->run()) {
                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');
                $max_directs = $this->input->post('max_directs');
                $contruct_date = $this->input->post('contruct_date');

                $updated = $this->user_model->edit_basic_emp_info($emp_id, $first_name, $last_name, $email, $phone, $max_directs, $contruct_date);
                if ($updated) {
                    $this->messages_model->success($this->lang->line('emp_updated'));
                } else {
                    $this->messages_model->error($this->lang->line('emp_not_updated'));
                }
                redirect(base_url() . 'emp_details/' . $emp_id);
            } else {
                $data['div_error'] = ' has-error';
            }
        }
        $data['title'] = $this->lang->line('edit_basic_info');
        $data['employee'] = $emp->row();
        $data['emp_id'] = $emp_id;
        $data['selected'] = 'employees';
        $this->load->view('users/edit_basic_emp_info_view', $data);
    }

    public function emp_sessions($emp_id = '')
    {
        if (!$emp_id) {
            $this->messages_model->error($this->lang->line('no_emp'));
            redirect(base_url());
        }
        return $this->user_model->emp_sessions($emp_id)->num_rows() ?
            $this->user_model->emp_sessions($emp_id)->result() : '';

    }

    public function payments_list()
    {
        have_access(24);
        $emp = $this->user_model->employees_list();
        $emp_id = '';
        $from = '';
        $to = '';
        $from_emp = '';
        $to_emp = '';
        $cat_id = '';
        $this->form_validation->set_rules('emp_id', $this->lang->line('first_name'), 'numeric');
        if ($_POST) {
            if ($this->form_validation->run()) {
                $emp_id = $this->input->post('emp_id');
                $from = $this->input->post('from') ? strtotime($this->input->post('from')) : '';
                $to = $this->input->post('to') ? strtotime($this->input->post('to')) : '';
                $cat_id = $this->input->post('cat_id');
                $from_emp = $this->input->post('from_emp');
                $to_emp = $this->input->post('to_emp');
            }
        }

        $results = $this->user_model->payments_list($emp_id, $from, $to, $cat_id, $from_emp, $to_emp);
        //print_r($results->result()); exit;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['emp_id'] = $emp_id;
        $data['pay_cat'] = $this->user_model->payments_cats();
        $data['payments'] = $results->result();
        $data['emp'] = $emp->result();
        $data['results'] = 1;
        $data['employees'] = $this->user_model->employees_list()->result();
        $data['selected'] = 'payments';
        $data['to_emp'] = $this->input->post('from_emp') && $this->input->post('to_emp') ? 1 : 0;
        $data['title'] = $this->lang->line('payments');
        $this->load->view('users/payments_view', $data);
    }

    public function get_username_emp($username)
    {
        $result = $this->user_model->get_username_emp($username);
        if (!preg_match('/^[A-Za-z0-9_]+$/', $username)) // '/[^a-z\d]/i' should also work.
        {
            echo 2;
            return;
        }
        if ($result) echo 1;
        else echo 0;
    }

    public function get_username_clt($username)
    {
        $result = $this->user_model->get_username_clt($username);
        /*if (!$this->session->userdata('user_id')) {
            echo 2; return;
        }*/
        if (!preg_match('/^[A-Za-z0-9_]+$/', $username)) // '/[^a-z\d]/i' should also work.
        {
            echo 2;
            return;
        }
        if ($result) echo 1;
        else echo 0;
    }

    public function get_email_emp($email)
    {
        $result = $this->user_model->get_email_emp($email);
        if ($result) echo 1;
        else echo 0;
    }

    public function get_phone_emp($phone)
    {
        $result = $this->user_model->get_phone_emp($phone);
        if ($result) echo 1;
        else echo 0;
    }

    function check_user($str = '')
    {
        if ($str) {
            if ($this->db->query("select * from users where username='$str' and fired<2")->num_rows()) {
                $this->form_validation->set_message('check_user', "%s " . $this->lang->line('unique_validation'));
                return FALSE;
            }
            return TRUE;
        }
    }

    function check_username($str = '')
    {
        if ($str) {
            if ($this->db->get_where('clients', array('username' => $str))->num_rows()) {
                $this->form_validation->set_message('check_username', "%s " . $this->lang->line('unique_validation'));
                return FALSE;
            }
            return TRUE;
        }
    }

    public function check_code($str = '')
    {
        $my_id = $this->session->userdata('user_id');
        $result = $this->user_model->checkcode($my_id, $str);
        if ($result) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_code', '%s ' . $this->lang->line('code_validation'));
            return FALSE;
        }
    }

    public function recover_password()
    {
        $data['no_email'] = '';
        $data['sent'] = '';
        $this->form_validation->set_rules('email', $this->lang->line('email'), 'required|valid_email');
        if ($this->form_validation->run()) {
            $email = $this->input->post('email');
            $data['sent'] = $this->user_model->send_code($email);
            $this->session->set_userdata('sent_code', 1);
            redirect(base_url());
        } else {
            $data['no_email'] = TRUE;
        }

        $this->load->view('login_view', $data);
    }

    public function edit_my_payments_code($value = '')
    {
        need_login();
        if ($_POST) {
            $this->form_validation->set_rules('old_code', $this->lang->line('old_code'), 'required|callback_check_mycode');
            $this->form_validation->set_rules('new_code', $this->lang->line('new_code'), 'required|matches[new_codeconf]|min_length[5]');
            $this->form_validation->set_rules('new_codeconf', $this->lang->line('new_codeconf'), 'required');
            if ($this->form_validation->run()) {
                $id = $this->session->userdata('user_id');
                $code = $this->input->post('new_code');
                $updated = $this->user_model->edit_my_payments_code($code, $id);
                if ($updated) {
                    $this->messages_model->success($this->lang->line('update_success'));
                } else {
                    $this->messages_model->error($this->lang->line('update_not_success'));
                }
                redirect(base_url() . "home");
            }
        }
        $data['selected'] = 'home';
        $this->load->view('users/edit_code_view', $data);
    }

    public function check_mycode($str = '')
    {
        $id = $this->session->userdata('user_id');
        $res = $this->user_model->check_mycode($str, $id);
        if ($res) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_mycode', '%s ' . $this->lang->line('check_code_res'));
            return FALSE;
        }
    }

    public function charts($user_id = '')
    {
        need_login();
        if (!have_access(81, TRUE)) {
            $user_id = $this->session->userdata('user_id');
        }

        $my_ads = '';
        $sons_ads = '';
        $from_date = '';
        $to_date = '';
        $every = '';

        if ($_POST) {
            $my_ads = $this->input->post('my_ids');
            $sons_ads = $this->input->post('sons_ids');
            $from_date = $this->input->post('from');
            $to_date = $this->input->post('to');
            if (have_access(81, TRUE)) {
                //exit;
                $every = $this->input->post('every');
            }
        }

        $result = $this->user_model->get_charts($user_id, $my_ads, $sons_ads, $from_date, $to_date, $every);
        $data['result'] = $result->result();
        $data['title'] = $this->lang->line('chart');
        $data['pie'] = $this->user_model->get_slider_ads($user_id, $my_ads, $sons_ads, $from_date, $to_date, $every);
        $data['selected'] = 'statistics';
        $this->load->view('users/charts_view', $data);
    }

    public function payment_login()
    {
        need_login();
        if ($this->session->userdata('payment_logged')) {
            redirect(base_url() . "payments");
        }
        if ($_POST) {
            $this->form_validation->set_rules('password', $this->lang->line('password'), 'required|callback_check_paypass');
            if ($this->form_validation->run()) {
                redirect($this->session->userdata('this_url'));
            }
        }
        $this->load->view('panel/pay_login_view');
    }

    public function check_paypass($pass = '')
    {
        $user_id = $this->session->userdata('user_id');
        $res = $this->user_model->check_paypass($user_id, $pass);
        if ($res) {
            $this->session->set_userdata('payment_logged', 1);
            return TRUE;
        } else {
            $this->form_validation->set_message('check_paypass', $this->lang->line('pass_error'));
            return FALSE;
        }
    }

}

/* setInterval( "refresh();", 60000 );

refresh = function(){
      var URL = "file.php";
      $.ajax({ type: "GET",
               url: URL,
               succes: function(data){
                 if(data){
                     //change stuff
                 }
               }
      });
   } */
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
