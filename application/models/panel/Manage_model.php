<?php
/**
 * 
 */
class Manage_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	public function update_sliders($slider1, $slider1_en,  $desc1, $desc1_en)
	{
		if (!$_FILES) {
			return array(0, 0);
			
		}
		$fs_images 	 = array();
		$i			 = 0;
		$logos[]	 = array();
		$errors		 = array();
		$ext		 = array();
		$config['upload_path']   = '../site/uploads/sliders';
		$path				     = $config['upload_path'];
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] 	 = '1000';
		$config['max_width'] 	 = '5000';
		$config['max_height'] 	 = '5000';
		$config['overwrite'] 	 = FALSE;
		$this->load->library('upload');
		
		foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
		{
			//echo "<pre>"
			//print_r($expression)$fieldname $fileObject;
		    if (!empty($fileObject['name']))
		    {
		        $this->upload->initialize($config);
		        if (!$this->upload->do_upload($fieldname))
		        {
		            $error = $this->upload->display_errors();
		            $errors[] = $error;
		        } else {
		        	$upload_data     = $this->upload->data();
					//$ext[$config['file_name']] = $upload_data['file_ext'];
		            //echo $fieldname . $upload_data['file_name'].'gfdg<br>';
		            $fs_images[$i] = $upload_data['file_name'];
					$i++;
		        }
		    }	}		
		//print_r($fs_images); echo "<br>"; print_r($errors);
		//exit;
		if ($errors) {
			return array(0, $errors[0]);
		}
		//echo "$film1logo $film2logo $film3logo"; exit;
		
		$this->db->trans_start();
		if (isset($fs_images[0])) {
			$insert = array(
								'img' 		=> $fs_images[0],
								'title_ar' 	=> $slider1,
								'title_en' 	=> $slider1_en,
								'desc_ar' 	=> $desc1,
								'desc_en' 	=> $desc1_en,
								'active' 	=> 0,
								'added_by'	=> $this->session->userdata('user_id'),
								'add_date'	=> time()
							);
			$this->db->insert('sliders', $insert);
		}	
		$this->db->trans_complete();
		return array($this->db->trans_status(), 0);
			
	}
	
	public function activate_slider($s_id)
	{
		$old_stat = $this->db->get_where('sliders', array('s_id' => $s_id))->row()->active;
		$new_stat = $old_stat == 0 ? 1 : 0;
		if ($old_stat == 0) {
			$active_num = $this->db->get_where('sliders', array('active' => 1, 'deleted' => 0))->num_rows();
			if ($active_num == 8) {
				return 0;
			} 
		}
		$this->db->where('s_id', $s_id);
		$this->db->update('sliders', array('active' => $new_stat, 'active_by' => $this->session->userdata('user_id'), 'active_date' => time()));
		return $this->db->affected_rows();
	}		public function add_course_levels($lev_name, $course_id)	{   		    $this->db->trans_start();		$insert = array  (                                                     'lev_name'    		=> $lev_name,                             'added_by'     		=> $this->session->userdata('user_id'),                            'add_date'     		=> time(),                            'course_id'         => $course_id,                           						); 				$this->db->insert('course_levels', $insert); 		$this->db->trans_complete();						return $this->db->trans_status();			}     
	
	public function get_sliders($value='')
	{
		return $this->db->get_where('sliders', array('deleted' => 0));
	}
	
	public function get_tutors()
	{
		$query =  $this->db->query("select * from  courses_cats c , tutors t where t.cat_id = c.cat_id AND t.deleted = 0  order by t.cat_id");
        
		  return $query;	
	}
	
	public function get_tutor($tutor_id)
	{
         return $this->db->get_where('tutors', array('tutor_id' => $tutor_id));        
		  
	}
	public function activate_tutors($tutor_id)
	{
		$old_stat = $this->db->get_where('tutors', array('tutor_id' => $tutor_id))->row()->active;
		$new_stat = $old_stat == 0 ? 1 : 0;
		if ($old_stat == 0) {
			$active_num = $this->db->get_where('tutors', array('active' => 1, 'deleted' => 0))->num_rows();
			if ($active_num == 4) {
				return 0;
			} 
		}
		$this->db->where('tutor_id', $tutor_id);
		$this->db->update('tutors', array('active' => $new_stat, 'active_by' => $this->session->userdata('user_id'), 'active_date' => time()));
		return $this->db->affected_rows();
	}
	
	public function update_tutors($tutor1,  $cat_id1)
	{
		if (!$_FILES) {
			return array(0, 0);
		}
		$fs_images 	 = array();
		$i			 = 0;
		$logos[]	 = array();
		$errors		 = array();
		$ext		 = array();
		$config['upload_path']   = '../site/uploads/tutors';
		$path				     = $config['upload_path'];
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] 	 = '512';
		$config['max_width'] 	 = '1800';
		$config['max_height'] 	 = '1800';
		$config['overwrite'] 	 = FALSE;
		$this->load->library('upload');
		
		foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
		{
			//echo "<pre>"
			//print_r($expression)$fieldname $fileObject;
		    if (!empty($fileObject['name']))
		    {
		        $this->upload->initialize($config);
		        if (!$this->upload->do_upload($fieldname))
		        {
		            $error = $this->upload->display_errors();
		            $errors[] = $error;
		        } else {
		        	$upload_data     = $this->upload->data();
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
		
		$this->db->trans_start();
		if (isset($fs_images[0])) {
			$insert = array(
								'img' 			=> $fs_images[0],
								'tutor_name' 	=> $tutor1,
								'cat_id' 		=> $cat_id1,
								'active' 		=> 0,
								'added_by'		=> $this->session->userdata('user_id'),
								'add_date'		=> time()
							);
			$this->db->insert('tutors', $insert);
		}
		
		$this->db->trans_complete();
		
		return array($this->db->trans_status(), 0);
			
	}
	
	
	public function update_tutor($tutor_name ,$cat_id, $tutor_id)
	{
		$update = array (
							'tutor_name' 	=> $tutor_name,
							'cat_id' 		=> $cat_id							
						);
		$this->db->where('tutor_id', $tutor_id);
		$this->db->update('tutors', $update);
		return $this->db->affected_rows();	
		
		
	}
	

	public function get_slider($slide_id)
	{
		return $this->db->get_where('sliders', array('s_id' => $slide_id));
	}
	
	public function update_slider($slide_id, $slider1, $slider1_en, $desc1, $desc1_en)
	{
		$update = array (
							'title_ar' 	=> $slider1,
							'title_en' 	=> $slider1_en,
							'desc_ar' 	=> $desc1,
							'desc_en' 	=> $desc1_en
						);
		$this->db->where('s_id', $slide_id);
		$this->db->update('sliders', $update);
		return $this->db->affected_rows();
	}
	
	public function delete_slide($slide_id, $user_id)
	{
		$img = $this->db->get_where('sliders', array('s_id' => $slide_id))->row()->img;
		@unlink("uploads/sliders/$img");
		$this->db->where('s_id', $slide_id);
		$this->db->update('sliders', array('deleted' => 1, 'deleted_by' => $user_id, 'deleted_date' => time()));
		return $this->db->affected_rows();
	}
	
	public function delete_tutor($tutor_id, $user_id)
	{
		$img = $this->db->get_where('tutors', array('tutor_id' => $tutor_id))->row()->img;
		@unlink("uploads/tutors/$img");
		$this->db->where('tutor_id', $tutor_id);
		$this->db->update('tutors', array('deleted' => 1, 'deleted_by' => $user_id, 'deleted_date' => time()));
		return $this->db->affected_rows();
	}
	
	public function update_services($fe_serv, $fe_serv_text, $sec_serv, $sec_serv_text ,$thr_serv ,$thr_serv_text)
	{
		$update = array (
							'fe_serv' 	    => $fe_serv ,
							'fe_serv_text' 	=> $fe_serv_text ,
							'sec_serv'    	=> $sec_serv,
							'sec_serv_text' => $sec_serv_text,
						    'thr_serv'      => $thr_serv,
							'thr_serv_text' => $thr_serv_text
						);
		$this->db->where(['id' => 1]);
		$this->db->update('site_data', $update);
		return $this->db->affected_rows();
	}
	
	public function update_social($facebook, $linkedin ,$google)
	{
		$update = array (
							'facebook' 	    => $facebook ,
							'linkedin' 		=> $linkedin ,
							'google'    	=> $google
						);
		$this->db->where(['id' => 1]);
		$this->db->update('site_data', $update);
		return $this->db->affected_rows();
	}	public function update_contact($contact_us_text, $h_contact_us ,$f_contact_us)	{		$update = array (				'h_contact_us' 	    => $h_contact_us ,				'f_contact_us' 	    => $f_contact_us ,				'contact_us_text'   => $contact_us_text 						);		$this->db->where(['id' => 1]);		$this->db->update('site_data', $update);		return $this->db->affected_rows();	}
	
	public function update_about_us($about_us, $about_us_text, $f_skill, $s_skill,
									 $t_skill, $skill_f, $skill_s, $skill_t, $skill_f_a , $skill_s_a ,$skill_t_a)
	{			if (!$_FILES) {exit;			return array(0, 0);		}		$fs_images 	 = array();		$i			 = 0;		$logos[]	 = array();		$errors		 = array();		$ext		 = array();		$config['upload_path']   = '../site/uploads/sliders/';		$path				     = $config['upload_path'];		$config['allowed_types'] = 'gif|jpg|jpeg|png';		$config['max_size'] 	 = '512';		$config['max_width'] 	 = '1800';		$config['max_height'] 	 = '1800';		$config['overwrite'] 	 = FALSE;		$this->load->library('upload');				foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name		{ 			//echo "<pre>"			//print_r($expression)$fieldname $fileObject;		    if (!empty($fileObject['name']))		    {		        $this->upload->initialize($config);		        if (!$this->upload->do_upload($fieldname))		        {		            $error = $this->upload->display_errors();		            $errors[] = $error;		        } else {		        	$upload_data     = $this->upload->data();					//$ext[$config['file_name']] = $upload_data['file_ext'];		            //echo $fieldname . $upload_data['file_name'].'gfdg<br>';		            $fs_images[$i] = $upload_data['file_name'];					$i++;		        }								 		    }		}		//print_r($fs_images); echo "<br>"; print_r($errors);		//exit;		if ($errors) {			return array(0, $errors[0]);		}		//echo "$film1logo $film2logo $film3logo"; exit;				$this->db->trans_start();		if (isset($fs_images[0])) {       // print_r($fs_images[0]); exit();			$update = array(						     							 							 	'about_us_img' 	=> $fs_images[0],	
								'about_us' 	    => $about_us ,	
								'about_text'	=> $about_us_text ,	
								'f_skill'    	=> $f_skill ,	
								's_skill' 		=> $s_skill,	
								't_skill' 		=> $t_skill,	
								'skill_f' 		=> $skill_f,	
								'skill_s' 		=> $skill_s,	
								'skill_t' 		=> $skill_t,	
								'skill_f_a' 	=> $skill_f_a,	
								'skill_s_a'		=> $skill_s_a,	
								'skill_t_a'		=> $skill_t_a
						
					);
		$this->db->where(['id' => 1]);
		$this->db->update('site_data', $update);		}				$this->db->trans_complete();		     	return array($this->db->trans_status(), 0);
		
	}
	
	
	public function update_news($slider1, $slider2, $slider3, $slider1_en, $slider2_en, $slider3_en, $desc1, $desc2, $desc3, $desc1_en, $desc2_en, $desc3_en)
	{
		if (!$_FILES) {
			return array(0, 0);
		}
		$fs_images 	 = array();
		$i			 = 0;
		$logos[]	 = array();
		$errors		 = array();
		$ext		 = array();
		$config['upload_path']   = 'uploads/news';
		$path				     = $config['upload_path'];
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] 	 = '512';
		$config['max_width'] 	 = '1800';
		$config['max_height'] 	 = '1800';
		$config['overwrite'] 	 = FALSE;
		$this->load->library('upload');
		
		foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
		{
			//echo "<pre>"
			//print_r($expression)$fieldname $fileObject;
		    if (!empty($fileObject['name']))
		    {
		        $this->upload->initialize($config);
		        if (!$this->upload->do_upload($fieldname))
		        {
		            $error = $this->upload->display_errors();
		            $errors[] = $error;
		        } else {
		        	$upload_data     = $this->upload->data();
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
		
		$this->db->trans_start();
		if (isset($fs_images[0])) {
			$insert = array(
								'img' 		=> $fs_images[0],
								'title_ar' 	=> $slider1,
								'title_en' 	=> $slider1_en,
								'desc_ar' 	=> $desc1,
								'desc_en' 	=> $desc1_en,
								'active' 	=> 0,
								'added_by'	=> $this->session->userdata('user_id'),
								'add_date'	=> time()
							);
			$this->db->insert('news', $insert);
		}
		
		if (isset($fs_images[1])) {
			$insert = array(
								'img' 		=> $fs_images[1],
								'title_ar' 	=> $slider2,
								'title_en' 	=> $slider2_en,
								'desc_ar' 	=> $desc2,
								'desc_en' 	=> $desc2_en,
								'active' 	=> 0,
								'added_by'	=> $this->session->userdata('user_id'),
								'add_date'	=> time()
							);
			$this->db->insert('news', $insert);
		}
		
		if (isset($fs_images[2])) {
			$insert = array(
								'img' 		=> $fs_images[2],
								'title_ar' 	=> $slider3,
								'title_en' 	=> $slider3_en,
								'desc_ar' 	=> $desc3,
								'desc_en' 	=> $desc3_en,
								'active' 	=> 0,
								'added_by'	=> $this->session->userdata('user_id'),
								'add_date'	=> time()
							);
			$this->db->insert('news', $insert);
		}
		$this->db->trans_complete();
		return array($this->db->trans_status(), 0);
			
	}
	
	public function activate_news($n_id)
	{
		$old_stat = $this->db->get_where('news', array('n_id' => $n_id))->row()->active;
		$new_stat = $old_stat == 0 ? 1 : 0;
		if ($old_stat == 0) {
			$active_num = $this->db->get_where('news', array('active' => 1))->num_rows();
			if ($active_num == 3) {
				//return 0;
			} 
		}
		$this->db->where('n_id', $n_id);
		$this->db->update('news', array('active' => $new_stat, 'active_by' => $this->session->userdata('user_id'), 'active_date' => time()));
		return $this->db->affected_rows();
	}
	
	public function highlight_news($n_id)
	{
		$old_stat = $this->db->get_where('news', array('n_id' => $n_id))->row()->high_light;
		$new_stat = $old_stat == 0 ? 1 : 0;
		if ($old_stat == 0) {
			$active_num = $this->db->get_where('news', array('high_light' => 1, 'deleted' => 0))->num_rows();
			if ($active_num == 3) {
				return 0;
			} 
		}
		//echo $n_id; exit;
		$this->db->where('n_id', $n_id);
		$this->db->update('news', array('high_light' => $new_stat, 'high_by' => $this->session->userdata('user_id'), 'high_date' => time()));
		return $this->db->affected_rows();
	}
	
	public function get_news($value='')
	{
		return $this->db->get_where('news', array('deleted' => 0));
	}
	
	public function get_new($news_id)
	{
		return $this->db->get_where('news', array('n_id' => $news_id));
	}
	
	public function edit_news($news_id, $slider1, $slider1_en, $desc1, $desc1_en)
	{
		$update = array (
							'title_ar' 	=> $slider1,
							'title_en' 	=> $slider1_en,
							'desc_ar' 	=> $desc1,
							'desc_en' 	=> $desc1_en
						);
		$this->db->where('n_id', $news_id);
		$this->db->update('news', $update);
		return $this->db->affected_rows();
	}
	
	public function delete_news($news_id, $user_id)
	{
		$img = $this->db->get_where('news', array('n_id' => $slide_id))->row()->img;
		@unlink("uploads/news/$img");
		$this->db->where('n_id', $news_id);
		$this->db->update('news', array('deleted' => 1, 'deleted_by' => $user_id, 'deleted_date' => time()));
		return $this->db->affected_rows();
	}
	
	public function tut_data()
	{
		
	return	$this->db->get_where('tutors', array('active' => 1));
		
	}
	
	
	
	
	
	
	public function update_prods($slider1, $slider2, $slider3, $slider1_en, $slider2_en, $slider3_en, $desc1, $desc2, $desc3, $desc1_en, $desc2_en, $desc3_en)
	{
		if (!$_FILES) {
			return array(0, 0);
		}
		$fs_images 	 = array();
		$i			 = 0;
		$logos[]	 = array();
		$errors		 = array();
		$ext		 = array();
		$config['upload_path']   = 'uploads/prods';
		$path				     = $config['upload_path'];
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] 	 = '512';
		$config['max_width'] 	 = '1800';
		$config['max_height'] 	 = '1800';
		$config['overwrite'] 	 = FALSE;
		$this->load->library('upload');
		
		foreach ($_FILES as $fieldname => $fileObject)  //fieldname is the form field name
		{
			//echo "<pre>"
			//print_r($expression)$fieldname $fileObject;
		    if (!empty($fileObject['name']))
		    {
		        $this->upload->initialize($config);
		        if (!$this->upload->do_upload($fieldname))
		        {
		            $error = $this->upload->display_errors();
		            $errors[] = $error;
		        } else {
		        	$upload_data     = $this->upload->data();
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
		
		$this->db->trans_start();
		if (isset($fs_images[0])) {
			$insert = array(
								'img' 		=> $fs_images[0],
								'title_ar' 	=> $slider1,
								'title_en' 	=> $slider1_en,
								'desc_ar' 	=> $desc1,
								'desc_en' 	=> $desc1_en,
								'active' 	=> 0,
								'added_by'	=> $this->session->userdata('user_id'),
								'add_date'	=> time()
							);
			$this->db->insert('prods', $insert);
		}
		
		if (isset($fs_images[1])) {
			$insert = array(
								'img' 		=> $fs_images[1],
								'title_ar' 	=> $slider2,
								'title_en' 	=> $slider2_en,
								'desc_ar' 	=> $desc2,
								'desc_en' 	=> $desc2_en,
								'active' 	=> 0,
								'added_by'	=> $this->session->userdata('user_id'),
								'add_date'	=> time()
							);
			$this->db->insert('prods', $insert);
		}
		
		if (isset($fs_images[2])) {
			$insert = array(
								'img' 		=> $fs_images[2],
								'title_ar' 	=> $slider3,
								'title_en' 	=> $slider3_en,
								'desc_ar' 	=> $desc3,
								'desc_en' 	=> $desc3_en,
								'active' 	=> 0,
								'added_by'	=> $this->session->userdata('user_id'),
								'add_date'	=> time()
							);
			$this->db->insert('prods', $insert);  
		}
		$this->db->trans_complete();
		return array($this->db->trans_status(), 0);
			
	}
	
	public function activate_prods($p_id)
	{
		$old_stat = $this->db->get_where('prods', array('p_id' => $p_id))->row()->active;
		$new_stat = $old_stat == 0 ? 1 : 0;
		if ($old_stat == 0) {
			$active_num = $this->db->get_where('prods', array('active' => 1))->num_rows();
			if ($active_num == 3) {
				//return 0;
			} 
		}
		$this->db->where('p_id', $p_id);
		$this->db->update('prods', array('active' => $new_stat, 'active_by' => $this->session->userdata('user_id'), 'active_date' => time()));
		return $this->db->affected_rows();
	}
	
	public function highlight_prods($p_id)
	{
		$old_stat = $this->db->get_where('prods', array('p_id' => $p_id))->row()->high_light;
		$new_stat = $old_stat == 0 ? 1 : 0;
		if ($old_stat == 0) {
			$active_num = $this->db->get_where('prods', array('high_light' => 1, 'deleted' => 0))->num_rows();
			if ($active_num == 3) {
				return 0;
			} 
		}
		//echo $n_id; exit;
		$this->db->where('p_id', $p_id);
		$this->db->update('prods', array('high_light' => $new_stat, 'high_by' => $this->session->userdata('user_id'), 'high_date' => time()));
		return $this->db->affected_rows();
	}
	
	public function get_prods($value='')
	{
		return $this->db->get_where('prods', array('deleted' => 0));
	}
	
	public function get_prod($prod_id)
	{
		return $this->db->get_where('prods', array('p_id' => $prod_id));
	}
	
	public function edit_prod($prod_id, $slider1, $slider1_en, $desc1, $desc1_en)
	{
		$update = array (
							'title_ar' 	=> $slider1,
							'title_en' 	=> $slider1_en,
							'desc_ar' 	=> $desc1,
							'desc_en' 	=> $desc1_en
						);
		$this->db->where('p_id', $prod_id);
		$this->db->update('prods', $update);
		return $this->db->affected_rows();
	}
	
	public function delete_prod($prod_id, $user_id)
	{
		$img = $this->db->get_where('news', array('n_id' => $slide_id))->row()->img;
		@unlink("uploads/prods/$img");
		$this->db->where('p_id', $prod_id);
		$this->db->update('prods', array('deleted' => 1, 'deleted_by' => $user_id, 'deleted_date' => time()));
		return $this->db->affected_rows();
	}
	
	public function get_basic_data($value='')
	{
		return $this->db->get('contact')->row();
	}
	
	public function modify_basics($phone, $our_view, $our_view_en, $email, $address, $address_en)
	{
		$update = array (
							'view'			=> $our_view,
							'view_en'		=> $our_view_en,
							'phone'			=> $phone,
							'email'			=> $email,
							'address'		=> $address,
							'address_en'	=> $address_en
						);
		$this->db->where('id', 1);
		$this->db->update('contact', $update);
		
		return $this->db->affected_rows();
	}
}
