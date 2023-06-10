<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

function set_lang() {
    $CI =& get_instance();
    $system_lang = $CI->inithook->get_lang();
    
    $CI->config->set_item('language', $system_lang);
    $CI->lang->load('content', $system_lang ? $system_lang : 'indonesian');
    $CI->lang->load('navigation', $system_lang ? $system_lang : 'indonesian');
}

/* End of file app_lang.php */
/* Location: ./application/hooks/app_lang.php */