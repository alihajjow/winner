<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages {

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
    
    var $CI;
    
    public function __construct() {
        $this->CI = & get_instance();
    }
    
    public function success($message='')
    {
        $this->CI->session->set_userdata('suc_message', $message);
    }
    
    public function error($message='')
    {
        $this->CI->session->set_userdata('err_message', $message);
    }
}