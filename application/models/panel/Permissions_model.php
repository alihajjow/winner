<?php
class Permissions_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_roles() {
        return $this->db->get('roles');
    }
    
    public function edit_role_emps($role_id)
    {
        $sql = "SELECT e.*, r.id
                  FROM users e
             LEFT JOIN roles_emps r on r.emp_id=e.emp_id AND r.role_id=$role_id
                 WHERE e.fired=0  ";
        return $this->db->query($sql);
    }
    
    public function update_role_emps($emps_ids, $role_id)
    {
        $this->db->trans_start();
        $this->db->delete('roles_emps', array('role_id' => $role_id));
        foreach ($emps_ids as $id) {
            $this->db->insert('roles_emps', array('emp_id' => $id, 'role_id' => $role_id));
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    
    public function get_role_name($role_id='')
    {
        return $this->db->get_where('roles', array('role_id' => $role_id))->row()->role_name;
    }
    
    public function edit_role_pers($role_id)
    {
        $sql = "SELECT p.*, r.id
                  FROM permessins p
             LEFT JOIN pers_roles r on r.per_id=p.per_id AND r.role_id=$role_id
		order by p.per_cat,p.description";
        return $this->db->query($sql);
    }
    
    public function update_role_pers($per_ids, $role_id)
    {
        //print_r($per_ids); exit;
        $this->db->trans_start();
        $this->db->delete('pers_roles', array('role_id' => $role_id));
        foreach ($per_ids as $id) {
            $this->db->insert('pers_roles', array('per_id' => $id, 'role_id' => $role_id));
        }
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    
    public function add_new_role($role_name, $role_desc)
    {
        $this->db->insert('roles', array('role_name' => $role_name, 'role_desc' => $role_desc));
        if ($this->db->insert_id()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function get_role($role_id='')
    {
        if ($this->db->get_where('roles', array('role_id' => $role_id))->num_rows()) {
            return $this->db->get_where('roles', array('role_id' => $role_id))->row();
        } else {
            return FALSE;
        }
    }
    
    public function edit_role_data($role_id, $role_name, $role_desc)
    {
        if ($this->db->get_where('roles', array('role_id' => $role_id))->num_rows()) {
            
            $this->db->where('role_id', $role_id);
            $this->db->update('roles', array('role_name' => $role_name, 'role_desc' => $role_desc));
            
            return $this->db->affected_rows();
        } else {
            return FALSE;
        }
    }
}
