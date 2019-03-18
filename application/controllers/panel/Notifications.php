<?php
/**
 *
 */
class Notifications extends CI_Controller {

	function __construct() {
		parent::__construct();
		need_login();
		error_reporting(0);
		//get_statics();
		if (LANG() != 'en') {
            $this->lang->load("user","arabic");
            $this->lang->load("sidebar","arabic");
            $this->lang->load("header","arabic");
			$this->lang->load("form_validation","arabic");
        } else {
            $this->lang->load("user","english");
            $this->lang->load("sidebar","english");
            $this->lang->load("header","english");
        }
        $this->load->model('panel/user_model', 'user_model');
		$this->load->model('panel/notifications_model', 'notifications');
	}

	public function get_notifications()
	{
		$user_id = $this->session->userdata('user_id');
		$noti = "";

		$notifications = $this->notifications->get_notifications($user_id);
		if ($notifications->num_rows()) {
			$nots = $notifications->row();

			echo json_encode(array($nots->n_text, '', $nots->op_name, $nots->link, '', date('Y-m-d H:i', $nots->date)));
		}

		foreach ($notifications->result() as $res) {

			$ar = LANG() == 'en' ? '' : 'style="direction: rtl"';
			$text = "<a href='".base_url()."$res->link'><span $ar><b>$res->op_name:</b> $res->n_text</span><a>";

			$noti .= '<li class="media">';
			$noti .= "<a href='".base_url()."$res->link'>";
			$noti .= 	'<div class="media-body">';
			$noti .= 		'<span class="label label-default">'.date('Y-m-d H:i', $res->date).'</span>';
			$noti .= 		'<h5 class="media-heading pull-right">'.$res->op_name.'</h5>';
			$noti .= 		'<p class="margin-none pull-right">'.$res->n_text.'</p>';
			$noti .= 	'</div>';
			$noti .= '</a>';
			$noti .= '</li>';

			$result = array($text, $noti);

			//echo json_encode($result);
			$this->db->where('not_id', $res->not_id);
			$this->db->update('notifications', array('notified' => 1));
		}
	}

	public function read_notifications()
	{
		$user_id = $this->session->userdata('user_id');

		$read = $this->notifications->read($user_id);
		echo $read;
	}

	public function notifications($value='')
	{
		get_statics();
		$user_id = $this->session->userdata('user_id');
		$result = $this->notifications->all_notifications($user_id);
		$f_id = 1;
		$this->session->set_userdata('f_notid', $f_id);
		//echo $this->session->userdata('f_notid'); exit;
		$data['res'] = $result;
		$data['title']	  = $this->lang->line('notifications');
        $data['selected'] = "";
		$this->load->view('panel/notifications_view',$data);
	}

	public function get_more_notifications($value='')
	{

		$user_id = $this->session->userdata('user_id');
		//echo $this->session->userdata('f_notid'); exit;
		$result = $this->notifications->more_notifications($user_id, $this->session->userdata('f_notid'));

		$text = "";
		if ($result->num_rows()) {
			$f_id = $this->session->userdata('f_notid') ? $this->session->userdata('f_notid') + 1 : 1;
			$this->session->set_userdata('f_notid', $f_id);

			foreach ($result->result() as $not) {
				$text .= '<li class="border-bottom">';
				$text .= 	"<a href='".($not->link == '#' ? '#' : base_url().$not->link)."'>";
				$text .=		'<div class="media innerAll">';
				$text .=			'<div class="media-body">';
				$text .=				'<div>';
				$text .=					'<span class="strong pull-right">'.$not->op_name.'</span>';
				$text .=					'<small class="text-italic label label-default">'.date('Y-m-d H:i', $not->date).'</small>';
				$text .=				'</div>';
				$text .=				"<div class='pull-right'>$not->n_text</div>";
				$text .=			'</div>';
				$text .=		'</div>';
				$text .=	'</a>';
				$text .= '</li>';
			}
			//echo $text;
		}
		$remove = 0;
		if ($result->num_rows() < 20) {
			$remove = 1;
		}

		echo json_encode(array($text, $remove));

	}
}
