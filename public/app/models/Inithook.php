<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

class Inithook extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_config() {
        return $this->db->get('settings');
    }

    public function get_lang() {
        return $this->session->userdata('lang');
    }
    
}

/* End of file inithook.php */