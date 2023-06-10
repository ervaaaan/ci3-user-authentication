<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

$autoload['packages'] = array();
$autoload['libraries'] = array('database', 'session', 'user_agent', 'pagination', 'my_auth');
$autoload['drivers'] = array();
$autoload['helper'] = array('language', 'url', 'text', 'file');
$autoload['config'] = array('equipment');
$autoload['language'] = array();
$autoload['model'] = array('app', 'inithook', 'visitor');