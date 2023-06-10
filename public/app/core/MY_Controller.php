<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper("url");
        $this->load->helper("my_form");
        $this->load->library('user_agent');
    }

    public function get_browser(){
        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser().' '.$this->agent->version();
        } 
        elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot();
        } 
        elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } 
        else {
            $agent = 'Unidentified User Agent';
        }
        
        return $agent;
    }  

}

/* End of file my_controller.php */
/* Location: ./application/core/my_controller.php */