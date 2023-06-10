<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

class App extends CI_Model {

	private static $db;

	function __construct() {
		parent::__construct();
		self::$db = &get_instance()->db;
	}

	static function languages($lang = FALSE) {
		if (!$lang) {
			return self::$db->order_by('name','ASC')->get('languages')->result();
		}
		$l =  self::$db->where('name',$lang)->get('languages')->result();
		if (count($l > 0)) { return $l[0]; }
		$l =  self::$db->where('name',  config_item('default_language'))->get('languages')->result();
		if (count($l > 0)) { return $l[0]; } else { return FALSE; }
	}

	static function get_activity($limit = NULL) {
		return self::$db->select('useractivities.*, userdata.user_id, userdata.full_name')
			->join('userdata', 'userdata.user_id = useractivities.user_id')
			->order_by('activity_created','desc')
			->get('useractivities',$limit)
			->result();
	}

	static function time_elapsed_string($ptime) {
        // date_default_timezone_set(config_item('timezone'));
        $etime = time() - $ptime;
        if ($etime < 1) {
            return '0 seconds';
        }

        $a = array( 365 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60  =>  'month',
            24 * 60 * 60  =>  'day',
            60 * 60  =>  'hour',
            60  =>  'minute',
            1  =>  'second'
        );
        $a_plural = array( 'year'   => 'years',
            'month'  => 'months',
            'day'    => 'days',
            'hour'   => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds'
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }

}

/* End of file app.php */