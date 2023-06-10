<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/


// Load Config from DB
$hook['post_controller_constructor'][] = array(
    'class'    => '',
    'function' => 'load_config',
    'filename' => 'App_config.php',
    'filepath' => 'hooks'
);

// Load Languages File
$hook['post_controller_constructor'] = array(
    'class'    => '',
    'function' => 'set_lang',
    'filename' => 'App_lang.php',
    'filepath' => 'hooks'
);
