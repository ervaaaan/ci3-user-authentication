<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

class Visitor extends CI_Model {
	
	public function count_visitor() {
        $user_ip=$_SERVER['REMOTE_ADDR'];
        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot(); 
        } elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        } else {
            $agent='Other';
        }
        $cek_ip=$this->db->query("SELECT * FROM visitordata WHERE visit_ip='$user_ip' AND DATE(visit_date)=CURDATE()");
        if($cek_ip->num_rows() <= 0) {
            $hsl=$this->db->query("INSERT INTO visitordata (visit_ip,visit_platform) VALUES('$user_ip','$agent')");
            return $hsl;
        }
    }

}