<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

function load_config() {
    $CI =& get_instance();
    
    foreach($CI->inithook->get_config()->result() as $site_config) {
        $CI->config->set_item($site_config->config_key,$site_config->value);
    }
}

/* End of file app_config.php */
/* Location: ./application/hooks/app_config.php */
