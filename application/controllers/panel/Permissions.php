<?php
error_reporting(E_ERROR);
class Permissions extends CI_Controller {

    public function __construct() {
        parent::__construct(2);
		if ($this->session->userdata('must_change_pass')) {
            redirect(base_url().'reset_pass');
        }
		error_reporting(0);
		need_login();
		get_statics();
		$this->session->set_userdata('this_url', current_url());
		need_unlock();
        $this->auth->get_balance();
        $this->load->model('panel/permissions_model', 'permissions');
        if (!$this->session->userdata('lang') || $this->session->userdata('lang') == 'ar') {
            $this->lang->load("user","arabic");
            $this->lang->load("sidebar","arabic");
            $this->lang->load("header","arabic");
            $this->lang->load("perms","arabic");
			$this->lang->load("form_validation","arabic");
        } else {
            $this->lang->load("user","english");
            $this->lang->load("sidebar","english");
            $this->lang->load("header","english");
            $this->lang->load("perms","arabic");
        } 
    }
    
    public function index() {
    
    }

    public function get_roles() {
        have_access(1);
        $results = $this->permissions->get_roles();
        if ($results->num_rows()) {
            $data['results'] = $results->result();
        } else {
            $data['results'] = '';
            $data['title'] = $this->lang->line('no_perms');
            $data['body'] = $this->lang->line('no_perms_ex');
        }
        $data['title']	  = trans('roles');
        $data['selected'] = 'roles';
        $this->load->view('panel/perms/roles_view', $data);
    }

    public function edit_role_emps($role_id) {
    	have_access(34);
        if (!$role_id) {
            $this->messages->error($this->lang->line('no_role'));
            redirect(base_url().'roles');
        }
        if ($_POST) {
            $emps_ids = $this->input->post('emp_ids');
            //print_r($emps_ids); exit;
            $updated  = $this->permissions->update_role_emps($emps_ids, $role_id);
            if ($updated) {
                $this->messages->success($this->lang->line('updated'));
            } else {
                $this->messages->error($this->lang->line('not_updated'));
            }
            redirect(base_url().'roles');
        }
        $results = $this->permissions->edit_role_emps($role_id);
        if ($results->num_rows()) {
            $data['results'] = $results->result();
        } else {
            $data['results'] = '';
            $data['title'] = $this->lang->line('no_perms');
            $data['body'] = $this->lang->line('no_perms_ex');
        }
        $data['title']	  = $this->lang->line('roles_emps_list');
        $data['selected'] = 'roles';
        $data['role_name'] = $this->permissions->get_role_name($role_id);
        $data['role_id'] = $role_id;
        $this->load->view('panel/perms/roles_emps_view', $data);
    }

    public function edit_role_perts($role_id='')
    {
    	have_access(33);
        if (!$role_id) {
            $this->messages->error($this->lang->line('no_role'));
            redirect(base_url().'roles');
        }
        if ($_POST) {
            $per_ids = $this->input->post('per_ids');
            
            $updated  = $this->permissions->update_role_pers($per_ids, $role_id);
            if ($updated) {
                $this->messages->success($this->lang->line('updated'));
            } else {
                $this->messages->error($this->lang->line('not_updated'));
            }
            redirect(base_url().'roles');
        }
        $results = $this->permissions->edit_role_pers($role_id);
        if ($results->num_rows()) {
            $data['results'] = $results->result();
        } else {
            $data['results'] = '';
            $data['title'] = $this->lang->line('no_perms');
            $data['body'] = $this->lang->line('no_perms_ex');
        }
        
		$data['title']    = $this->lang->line('roles_pers_list');
        $data['selected'] = 'roles';
        $data['role_name'] = $this->permissions->get_role_name($role_id);
        $data['role_id'] = $role_id;
        $this->load->view('panel/perms/roles_pers_view', $data);
    }
    
    public function add_new_role($value='')
    {
    	have_access(36);
        $this->form_validation->set_rules('role_name', $this->lang->line('role_name'), 'required');
        $this->form_validation->set_rules('role_desc', $this->lang->line('role_desc'), 'required');
        if ($_POST) {
            if ($this->form_validation->run()) {
                $role_name = $this->input->post('role_name');
                $role_desc = $this->input->post('role_desc');
                $added = $this->permissions->add_new_role($role_name, $role_desc);
                if ($added) {
                    $this->messages->success($this->lang->line('role_added'));
                } else {
                    $this->messages->error($this->lang->line('role_not_added'));
                }
                redirect(base_url().'roles');
            } else {
                $data['div_error'] = 'has-error';
            }
        }
		
		$data['title']	  = $this->lang->line('add_role');
        $data['selected'] = 'roles';
        $this->load->view('panel/perms/add_role_view', $data);
    }

    public function edit_role_data($role_id='')
    {
        have_access(35);
        if (!$role_id) {
            $this->messages->error($this->lang->line('no_role'));
            redirect(base_url().'roles');
        }
        
        $this->form_validation->set_rules('role_name', $this->lang->line('role_name'), 'required');
        $this->form_validation->set_rules('role_desc', $this->lang->line('role_desc'), 'required');
        
        if ($_POST) {
            if ($this->form_validation->run()) {
                $role_name = $this->input->post('role_name');
                $role_desc = $this->input->post('role_desc');
                $updated   = $this->permissions->edit_role_data($role_id, $role_name, $role_desc);
                if ($updated) {
                    $this->messages->success($this->lang->line('role_edited'));
                } else {
                    $this->messages->error($this->lang->line('role_not_edited'));
                }
                redirect(base_url().'roles');
            }
        }
		
		$data['title'] = $this->lang->line('edit_role_info');
        $data['role']  = $this->permissions->get_role($role_id);
        $data['selected'] = 'roles';
        $data['role_id'] = $role_id;
        $this->load->view('panel/perms/edit_role_desc_view', $data);
    }
}