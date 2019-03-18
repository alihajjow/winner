<?php
/**
 * 
 */
class Manage extends CI_Controller {
	
	function __construct() {
		parent::__construct();		error_reporting(0);        have_access(39);
		need_login();
		if (!$this->session->userdata('lang') || $this->session->userdata('lang') == 'ar') {
            $this->lang->load("manage","arabic");
            $this->lang->load("sidebar","arabic");
            $this->lang->load("header","arabic");
			$this->lang->load("form_validation","arabic");
        } else {
            $this->lang->load("manage","english");
            $this->lang->load("sidebar","english");
            $this->lang->load("header","english");
        } 
		
		$this->load->model('panel/manage_model', 'manage_model');
	}
	
	public function index()
	{
		$this->sliders_manage();
	}
	
	public function sliders_manage($value='')
	{
		//exit;
		//have_access(20);
		if ($_POST) {
			$this->form_validation->set_rules('slider1', trans('ar_img_title'), 'required|min_length[3]|trim');
			
			$this->form_validation->set_rules('slider1_en', trans('en_img_title'), 'required|min_length[3]|trim');
			
			$this->form_validation->set_rules('desc1', trans('ar_img_desc'), 'required|min_length[3]|trim');
		
			$this->form_validation->set_rules('desc1_en', trans('en_img_desc'), 'required|min_length[3]|trim');
		
			if ($this->form_validation->run()) {
				$slider1 	= $this->input->post('slider1');
		
				$slider1_en = $this->input->post('slider1_en');
				$desc1 		= $this->input->post('desc1');
				$desc1_en 	= $this->input->post('desc1_en');
				$inserted = $this->manage_model->update_sliders($slider1, $slider1_en,  $desc1, $desc1_en);
				//exit;
				if ($inserted[0]) {
					$this->messages->success(trans('updated'));
				} elseif ($inserted[1]) {
					$this->messages->error($inserted[1]);
				} else {
					$this->messages->error(trans('notupdated'));
				}
				redirect(base_url()."sliders");
			}
			
		}
		
		$data['title']	  = trans('sliders_list');
		$data['selected'] = 'sliders';
		$this->load->view('manage/sliders_add_view', $data);
	}
	
	public function activate_slider($s_id='')
	{
		$result = $this->manage_model->activate_slider($s_id);
		//print_r($result); exit;
		echo $result;
	}
	
	public function get_sliders()
	{
		//have_access(21);
		
		$data['sliders'] = $sliders = $this->manage_model->get_sliders();
		//echo "<pre>";
		//print_r($sliders->result()); exit;
		$data['title']	  = trans('sliders_manage');
		$data['selected'] = 'sliders';
		$this->load->view('manage/sliders_view', $data);
	}
	
	public function del_slide($slide_id='')
	{
		//have_access(27);
		$slider = $this->manage_model->get_slider($slide_id);
		if (!$slider->num_rows()) {
			$this->messages->error(trans('no_slide'));
			redirect(base_url()."sliders_list");
		}
		$user_id = $this->session->userdata('user_id');
		$deleted = $this->manage_model->delete_slide($slide_id, $user_id);
		if ($deleted) {
			$this->messages->success(trans('deleted'));
		} else {
			$this->messages->error(trans('notdeleted'));
		}
		redirect(base_url()."sliders_list");
	}
	
	public function edit_slider($slide_id='')
	{
		//have_access(26);
		$slider = $this->manage_model->get_slider($slide_id);
		if (!$slider->num_rows()) {
			$this->messages->error(trans('no_slide'));
			redirect(base_url()."sliders_list");
		}
		if ($_POST) {
			$this->form_validation->set_rules('slider1', trans('ar_ns_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider1_en', trans('en_ns_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc1', trans('ar_ns_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc1_en', trans('en_ns_desc'), 'required|min_length[3]|trim');
			if ($this->form_validation->run()) {
				$slider1 	= $this->input->post('slider1');
				$slider1_en = $this->input->post('slider1_en');
				$desc1 		= $this->input->post('desc1');
				$desc1_en 	= $this->input->post('desc1_en'); 
				
				$inserted = $this->manage_model->update_slider($slide_id, $slider1, $slider1_en, $desc1, $desc1_en);
				//exit;
				if ($inserted) {
					$this->messages->success(trans('updated'));
				} else {
					$this->messages->error(trans('notupdated'));
				}
				redirect(base_url()."sliders_list");
			}
		}
		$data['slider'] = $slider->row();
		$data['title']	  = trans('sliders_manage');
		$data['selected'] = 'sliders';
		$this->load->view('manage/sliders_edit_view', $data);
	}     
	
	public function news_manage($value='')
	{
		//exit;
		have_access(22);
		if ($_POST) {
			$this->form_validation->set_rules('slider1', trans('ar_ns_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider2', trans('ar_ns_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider3', trans('ar_ns_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider1_en', trans('en_ns_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider2_en', trans('en_ns_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider3_en', trans('en_ns_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc1', trans('ar_ns_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc2', trans('ar_ns_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc3', trans('ar_ns_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc1_en', trans('en_ns_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc2_en', trans('en_ns_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc3_en', trans('en_ns_desc'), 'required|min_length[3]|trim');
			if ($this->form_validation->run()) {
				$slider1 	= $this->input->post('slider1');
				$slider2 	= $this->input->post('slider2');
				$slider3 	= $this->input->post('slider3');
				$slider1_en = $this->input->post('slider1_en');
				$slider2_en = $this->input->post('slider2_en');
				$slider3_en = $this->input->post('slider3_en');
				$desc1 		= $this->input->post('desc1');
				$desc2 		= $this->input->post('desc2');
				$desc3 		= $this->input->post('desc3');
				$desc1_en 	= $this->input->post('desc1_en');
				$desc2_en 	= $this->input->post('desc2_en');
				$desc3_en 	= $this->input->post('desc3_en');
				
				$inserted = $this->manage_model->update_news($slider1, $slider2, $slider3, $slider1_en, $slider2_en, $slider3_en, $desc1, $desc2, $desc3, $desc1_en, $desc2_en, $desc3_en);
				//exit;
				if ($inserted[0]) {
					$this->messages->success(trans('updated'));
				} elseif ($inserted[1]) {
					$this->messages->error($inserted[1]);
				} else {
					$this->messages->error(trans('notupdated'));
				}
				redirect(base_url()."news");
			}
			
		}
		$sliders = $this->manage_model->get_news();
		$data['sliders']  = $sliders;
		$data['title']	  = trans('news_list');
		$data['selected'] = 'news';
		$this->load->view('manage/news_add_view', $data);
	}
	
	public function activate_news($n_id='')
	{
		$result = $this->manage_model->activate_news($n_id);
		echo $result;
	}
	
	public function highlight_news($n_id='')
	{
		$result = $this->manage_model->highlight_news($n_id);
		echo $result;
	}
	
	public function get_news()
	{
		have_access(23);
		$data['news'] = $news = $this->manage_model->get_news();
		$data['title']	  = trans('news_manage');
		$data['selected'] = 'news';
		$this->load->view('manage/news_view', $data);
	}
	
	public function del_news($news_id='')
	{
		have_access(29);
		$slider = $this->manage_model->get_news($news_id);
		if (!$slider->num_rows()) {
			$this->messages->error(trans('no_slide'));
			redirect(base_url()."sliders_list");
		}
		$user_id = $this->session->userdata('user_id');
		$deleted = $this->manage_model->delete_news($news_id, $user_id);
		if ($deleted) {
			$this->messages->success(trans('deleted'));
		} else {
			$this->messages->error(trans('notdeleted'));
		}
		redirect(base_url()."news_list");
	}
	
	public function edit_news($news_id='')
	{
		have_access(28);
		$news = $this->manage_model->get_news($news_id);
		if (!$news->num_rows()) {
			$this->messages->error(trans('no_slide'));
			redirect(base_url()."sliders_list");
		}
		if ($_POST) {
			$this->form_validation->set_rules('slider1', trans('ar_ns_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider1_en', trans('en_ns_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc1', trans('ar_ns_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc1_en', trans('en_ns_desc'), 'required|min_length[3]|trim');
			if ($this->form_validation->run()) {
				$slider1 	= $this->input->post('slider1');
				$slider1_en = $this->input->post('slider1_en');
				$desc1 		= $this->input->post('desc1');
				$desc1_en 	= $this->input->post('desc1_en'); 
				
				$edited = $this->manage_model->edit_news($news_id, $slider1, $slider1_en, $desc1, $desc1_en);
				//exit;
				if ($edited) {
					$this->messages->success(trans('updated'));
				} else {
					$this->messages->error(trans('notupdated'));
				}
				redirect(base_url()."news_list");
			}
		}
		$data['news'] = $news->row();
		$data['title']	  = trans('news_manage');
		$data['selected'] = 'news';
		$this->load->view('manage/news_edit_view', $data);
	}
	
	public function prods_manage($value='')
	{
		//exit;
		have_access(25);
		if ($_POST) {
			$this->form_validation->set_rules('slider1', trans('ar_ps_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider2', trans('ar_ps_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider3', trans('ar_ps_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider1_en', trans('en_ps_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider2_en', trans('en_ps_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider3_en', trans('en_ps_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc1', trans('ar_ps_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc2', trans('ar_ps_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc3', trans('ar_ps_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc1_en', trans('en_ps_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc2_en', trans('en_ps_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc3_en', trans('en_ps_desc'), 'required|min_length[3]|trim');
			if ($this->form_validation->run()) {
				$slider1 	= $this->input->post('slider1');
				$slider2 	= $this->input->post('slider2');
				$slider3 	= $this->input->post('slider3');
				$slider1_en = $this->input->post('slider1');
				$slider2_en = $this->input->post('slider2');
				$slider3_en = $this->input->post('slider3');
				$desc1 		= $this->input->post('desc1');
				$desc2 		= $this->input->post('desc2');
				$desc3 		= $this->input->post('desc3');
				$desc1_en 	= $this->input->post('desc1_en');
				$desc2_en 	= $this->input->post('desc2_en');
				$desc3_en 	= $this->input->post('desc3_en');
				
				$inserted = $this->manage_model->update_prods($slider1, $slider2, $slider3, $slider1_en, $slider2_en, $slider3_en, $desc1, $desc2, $desc3, $desc1_en, $desc2_en, $desc3_en);
				//exit;
				if ($inserted[0]) {
					$this->messages->success(trans('updated'));
				} elseif ($inserted[1]) {
					$this->messages->error($inserted[1]);
				} else {
					$this->messages->error(trans('notupdated'));
				}
				redirect(base_url()."prods");
			} 
			
		}
		
		
		$data['title']	  = trans('prods_list');
		$data['selected'] = 'prods';
		$this->load->view('manage/prods_add_view', $data);
	}
	
	public function activate_prods($p_id='')
	{
		$result = $this->manage_model->activate_prods($p_id);
		echo $result;
	}
	
	public function highlight_prods($p_id='')
	{
		$result = $this->manage_model->highlight_prods($p_id);
		echo $result;
	}
	
	public function get_prods()
	{
		have_access(24);
		$prods = $this->manage_model->get_prods();
		$data['prods'] = $prods;
		$data['title']	  = trans('prods_manage');
		$data['selected'] = 'prods';
		$this->load->view('manage/prods_view', $data);
	}
	
	public function del_prod($prod_id='')
	{
		have_access(31);
		$prod = $this->manage_model->get_news($prod_id);
		if (!$prod->num_rows()) {
			$this->messages->error(trans('no_slide'));
			redirect(base_url()."sliders_list");
		}
		$user_id = $this->session->userdata('user_id');
		$deleted = $this->manage_model->delete_prod($prod_id, $user_id);
		if ($deleted) {
			$this->messages->success(trans('deleted'));
		} else {
			$this->messages->error(trans('notdeleted'));
		}
		redirect(base_url()."prods_list");
	}
	
	public function edit_prod($prod_id='')
	{
		
		have_access(30);
		$prod = $this->manage_model->get_prod($prod_id);
		if (!$prod->num_rows()) {
			$this->messages->error(trans('no_prod'));
			redirect(base_url()."prods_list");
		}
		if ($_POST) { 
			$this->form_validation->set_rules('slider1', trans('ar_ns_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider1_en', trans('en_ns_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc1', trans('ar_ns_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc1_en', trans('en_ns_desc'), 'required|min_length[3]|trim');
			if ($this->form_validation->run()) {
				$slider1 	= $this->input->post('slider1');
				$slider1_en = $this->input->post('slider1_en');
				$desc1 		= $this->input->post('desc1');
				$desc1_en 	= $this->input->post('desc1_en'); 
				
				$edited = $this->manage_model->edit_prod($prod_id, $slider1, $slider1_en, $desc1, $desc1_en);
				//exit;
				if ($edited) {
					$this->messages->success(trans('updated'));
				} else {
					$this->messages->error(trans('notupdated'));
				}
				redirect(base_url()."prods_list");
			}
		}
		$prod = $this->manage_model->get_prod($prod_id);
		$data['prod'] = $prod->row();
		$data['title']	  = trans('prods_manage');
		$data['selected'] = 'prods';
		$this->load->view('manage/prod_edit_view', $data);
	}
	
	public function edit_basic_data($value='')
	{
		have_access(32);
		if ($_POST) {
			$this->form_validation->set_rules('phone', trans('phone'), 'required|min_length[7]');
			$this->form_validation->set_rules('our_view', trans('our_view'), 'required|min_length[7]');
			$this->form_validation->set_rules('our_view_en', trans('our_view_en'), 'required|min_length[7]');
			$this->form_validation->set_rules('email', trans('email'), 'required|min_length[7]|valid_email');
			$this->form_validation->set_rules('address', trans('address'), 'required|min_length[7]');
			$this->form_validation->set_rules('address_en', trans('address_en'), 'required|min_length[7]');
			
			if ($this->form_validation->run()) {
				$phone 			= $this->input->post('phone');
				$our_view 		= $this->input->post('our_view');
				$our_view_en 	= $this->input->post('our_view_en');
				$email 			= $this->input->post('email');
				$address 		= $this->input->post('address');
				$address_en 	= $this->input->post('address_en');
				
				$result = $this->manage_model->modify_basics($phone, $our_view, $our_view_en, $email, $address, $address_en);
				if ($result) {
					$this->messages->success(trans('updated'));
				} else {
					$this->messages->error(trans('notupdated'));
				}
				redirect(base_url()."basics");
			}
		}
		$old_data = $this->manage_model->get_basic_data(); 
		$data['title']	  = trans('basics_manage');
		$data['selected'] = 'basics';
		$data['data'] = $old_data;
		$this->load->view('manage/basics_edit_view', $data);
	}
	public function tut_manage($value='')
	{
		//exit;
		//have_access(20);
		if ($_POST) {
			$this->form_validation->set_rules('slider1', trans('ar_img_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider2', trans('ar_img_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider3', trans('ar_img_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider1_en', trans('en_img_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider2_en', trans('en_img_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('slider3_en', trans('en_img_title'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc1', trans('ar_img_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc2', trans('ar_img_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc3', trans('ar_img_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc1_en', trans('en_img_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc2_en', trans('en_img_desc'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('desc3_en', trans('en_img_desc'), 'required|min_length[3]|trim');
			if ($this->form_validation->run()) {
				$slider1 	= $this->input->post('slider1');
				$slider2 	= $this->input->post('slider2');
				$slider3 	= $this->input->post('slider3');
				$slider1_en = $this->input->post('slider1_en');
				$slider2_en = $this->input->post('slider2_en');
				$slider3_en = $this->input->post('slider3_en');
				$desc1 		= $this->input->post('desc1');
				$desc2 		= $this->input->post('desc2');
				$desc3 		= $this->input->post('desc3');
				$desc1_en 	= $this->input->post('desc1_en');
				$desc2_en 	= $this->input->post('desc2_en');
				$desc3_en 	= $this->input->post('desc3_en');
				
				$inserted = $this->manage_model->update_sliders($slider1, $slider2, $slider3, $slider1_en, $slider2_en, $slider3_en, $desc1, $desc2, $desc3, $desc1_en, $desc2_en, $desc3_en);
				//exit;
				if ($inserted[0]) {
					$this->messages->success(trans('updated'));
				} elseif ($inserted[1]) {
					$this->messages->error($inserted[1]);
				} else {
					$this->messages->error(trans('notupdated'));
				}
				redirect(base_url()."sliders");
			}
			
		}
		
		$data['title']	  = trans('sliders_list');
		$data['selected'] = 'sliders';
		$this->load->view('manage/sliders_add_view', $data);
	}
    public function get_tutors()
	{
		//have_access(21);
		
		$data['tutors'] = $tutors = $this->manage_model->get_tutors();
		//echo "<pre>";
		//print_r($tutors->result()); exit;
		$data['title']	  = trans('tutors');
		$data['selected'] = 'tutors';
		$this->load->view('manage/tutors_view', $data);
	}
	
	public function activate_tutor($tutor_id='')
	{
		$result = $this->manage_model->activate_tutors($tutor_id);
		//print_r($result); exit;
		echo $result;
	}
	public function del_tutor($tutor_id='')
	{
		//have_access(27);
		$tutor = $this->manage_model->get_tutor($tutor_id);
		if (!$tutor->num_rows()) {
			$this->messages->error(trans('no_slide'));
			redirect(base_url()."tutor_list");
		}
		$user_id = $this->session->userdata('user_id');
		$deleted = $this->manage_model->delete_tutor($tutor_id, $user_id);
		if ($deleted) {
			$this->messages->success(trans('deleted'));
		} else {
			$this->messages->error(trans('notdeleted'));
		}
		redirect(base_url()."tutor_list");
	}
	public function tutors_manage($value='')
	{
		//exit;
		//have_access(20);
		if ($_POST) {
			
			$this->form_validation->set_rules('tutor1', trans('tutor_name'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('cat_id1', trans('catigory_name'), 'required|trim');
			
	
	   		if ($this->form_validation->run()) {
				$tutor1 	= $this->input->post('tutor1');
				$cat_id1    = $this->input->post('cat_id1');
			
			//	print_r($tutor1); exit;
				
				$inserted = $this->manage_model->update_tutors($tutor1, $cat_id1);
				//print_r($inserted);
			    //	exit;
				if ($inserted[0]) {
					$this->messages->success(trans('updated'));
				} elseif ($inserted[1]) {
					$this->messages->error($inserted[1]);
				} else {
					$this->messages->error(trans('notupdated'));
				}
				redirect(base_url()."tutors");
			}
		}
		
		$data['cats'] 	= $this->db->query("SELECT * FROM courses_cats");
		$data['title']	  = trans('sliders_list');
		$data['selected'] = 'sliders';
		$this->load->view('manage/tutors_add_view', $data);
	}
	
	public function edit_tut($tutor_id='')
	{
		//have_access(26);
		$tutors = $this->manage_model->get_tutor($tutor_id);
		if (!$tutors->num_rows()) {
			$this->messages->error(trans('no_tutors'));
			redirect(base_url()."tutor_list");
		}
		if ($_POST) {
			$this->form_validation->set_rules('tutor_name', trans('tutor_name'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('cat_id', trans('cat_name'), 'required|trim');
			
			if ($this->form_validation->run()) {
				$tutor_name = $this->input->post('tutor_name');
				$cat_id 	= $this->input->post('cat_id');
				
				$inserted    = $this->manage_model->update_tutor($tutor_name, $cat_id, $tutor_id);
				//exit;
				if ($inserted) {
					$this->messages->success(trans('updated'));
				} else {
					$this->messages->error(trans('notupdated'));
				}
				redirect(base_url()."tutor_list");
			}
		}
        $data['cats'] 	= $this->db->query("SELECT * FROM courses_cats");
		$data['tutor'] = $tutors->row();
		$data['title']	  = trans('edit_tutor');
		$data['selected'] = '';
		$this->load->view('manage/tutors_edit_view', $data);
	}
   
   public function edit_social()
   {
   	
	if ($_POST) {
			
			$this->form_validation->set_rules('facebook', trans('facebook'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('google', trans('google'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('linkedin', trans('linkedin'), 'required|min_length[3]|trim');
	   		if ($this->form_validation->run()) {
				$facebook 		= $this->input->post('facebook');
				$linkedin   	= $this->input->post('linkedin');
				$google 		= $this->input->post('google');
				
			    //print_r(); exit;
				
				$inserted = $this->manage_model->update_social($facebook, $linkedin ,$google);
			  //print_r($inserted); exit;
				if ($inserted) {
					$this->messages->success(trans('updated'));
				
				} else {										
					$this->messages->error(trans('notupdated'));
				}
				
			}
		}
		$data['serv'] = $this->db->get_where('site_data', array('id' => 1))->result();
		
		//print_r($data); exit();
		$data['title']	  = trans('site_services');
		$data['selected'] = 'site_services';
		$this->load->view('manage/social', $data);
       
   }     public function edit_contact_us()   {	if ($_POST) {								$this->form_validation->set_rules('h_contact_us', trans('h_contact_us'), 'required|min_length[3]|trim');			$this->form_validation->set_rules('f_contact_us', trans('f_contact_us'), 'required|min_length[3]|trim');			$this->form_validation->set_rules('contact_us_text', trans('contact_us_text'), 'required|min_length[3]|trim');	   		if ($this->form_validation->run()) {				$h_contact_us 	= $this->input->post('h_contact_us');				$f_contact_us 	= $this->input->post('f_contact_us');				$contact_us_text 	= $this->input->post('contact_us_text');								$inserted = $this->manage_model->update_contact($contact_us_text,$h_contact_us ,$f_contact_us );			  //print_r($inserted); exit;				if ($inserted) {					$this->messages->success(trans('updated'));								} else {															$this->messages->error(trans('notupdated'));				}			}		}		$data['contact'] = $this->db->get_where('site_data', array('id' => 1))->result();				//print_r($data); exit();		$data['title']	  = trans('');		$data['selected'] = '';		$this->load->view('manage/contact_us', $data);          }    
   
   public function edit_services()
   {
   	
	if ($_POST) {
			
			$this->form_validation->set_rules('first_service', trans('first_service'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('first_service_text', trans('first_service_text'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('sec_service', trans('sec_service'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('sec_service_text', trans('sec_service_text'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('thr_service', trans('thr_service'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('thr_service_text', trans('thr_service_text'), 'required|min_length[3]|trim');
	   		if ($this->form_validation->run()) {
				$fe_serv 		= $this->input->post('first_service');
				$fe_serv_text 	= $this->input->post('first_service_text');
				$sec_serv 		= $this->input->post('sec_service');
				$sec_serv_text 	= $this->input->post('sec_service_text');
				$thr_serv		= $this->input->post('thr_service');
				$thr_serv_text 	= $this->input->post('thr_service_text');
			    //print_r(); exit;
				
				$inserted = $this->manage_model->update_services($fe_serv, $fe_serv_text, $sec_serv, $sec_serv_text ,$thr_serv ,$thr_serv_text);
				//print_r($inserted);
			    //	exit;
				if ($inserted) {
					$this->messages->success(trans('updated'));
				
				} else {
					$this->messages->error(trans('notupdated'));
				}
				
			}
		}
		$data['serv'] = $this->db->get_where('site_data', array('id' => 1))->result();
		
		//print_r($data); exit();
		$data['title']	  = trans('site_services');
		$data['selected'] = 'site_services';
		$this->load->view('manage/services', $data);
       
   } 

   public function about_us()
   {
  	
	if ($_POST) {
		    $this->form_validation->set_rules('about_us', trans('about_us'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('about_us_text', trans('about_us_text'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('f_skill', trans('f_skill'), 'required|trim');
			$this->form_validation->set_rules('s_skill', trans('s_skill'), 'required|trim');
			$this->form_validation->set_rules('t_skill', trans('t_skill'), 'required|trim');
			$this->form_validation->set_rules('skill_f', trans('skill_f'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('skill_s', trans('skill_s'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('skill_t', trans('skill_t'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('skill_f_a', trans('skill_f_a'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('skill_s_a', trans('skill_s_a'), 'required|min_length[3]|trim');
			$this->form_validation->set_rules('skill_t_a', trans('skill_t_a'), 'required|min_length[3]|trim');
	   		if ($this->form_validation->run()) {
				$about_us		= $this->input->post('about_us');
				$about_us_text	= $this->input->post('about_us_text');
				$f_skill		= $this->input->post('f_skill');
				$s_skill	 	= $this->input->post('s_skill');
				$t_skill		= $this->input->post('t_skill');
				$skill_f	 	= $this->input->post('skill_f');
				$skill_s		= $this->input->post('skill_s');
				$skill_t		= $this->input->post('skill_t');
				$skill_f_a	 	= $this->input->post('skill_f_a');
				$skill_s_a		= $this->input->post('skill_s_a');
				$skill_t_a	 	= $this->input->post('skill_t_a');
			    //print_r(); exit;
				
				$inserted = $this->manage_model->update_about_us($about_us, $about_us_text, $f_skill, $s_skill,
												 $t_skill,$skill_f, $skill_s, $skill_t, $skill_f_a , $skill_s_a ,$skill_t_a);
				//print_r($inserted);
			    //	exit;
				if ($inserted) {
					$this->messages->success(trans('updated'));
				
				} else {
					$this->messages->error(trans('notupdated'));
				}
				
			}
		}
		$data['serv'] = $this->db->get_where('site_data', array('id' => 1))->result();
		
		//print_r($data); exit();
		$data['title']	  = trans('about_us');
		$data['selected'] = 'about_us';
		$this->load->view('manage/about_us', $data);
       
   } 

   
   
}
