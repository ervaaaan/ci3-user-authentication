<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

// if(!function_exists("substr_link")) {
//     function substr_link($url, $pos, $len) {
//         $url1 = $url;
//         $url2 = substr($url, $pos, $len);
//         $output = "<a href=\"{$url1}\" target=\"_blank\">{$url2}</a>";
        
//         return $output;
//     }
// }

if ( ! function_exists('check_status')) {
    function check_status($status = '') {
        return ($status == 0) ? 'class="hide"' : '';
    }   
}

/* End of file my_function_helper.php */
/* Location: ./application/helpers/my_function_helper.php */