<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

class Set_language extends MX_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$this->session->set_userdata('lang', $this->input->get('lang'));
		// setcookie("mbox_lang",$this->input->get('lang'), time() + 86400);
		redirect($_SERVER["HTTP_REFERER"]);
	}
	
}

/* End of file set_language.php */
/* Location: ./application/controllers/set_language.php */