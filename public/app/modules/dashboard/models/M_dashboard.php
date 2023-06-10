<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

class M_dashboard extends CI_Model {
	
	function visitor_statistics() {
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        $query = $this->db->query("SELECT DATE_FORMAT(visit_date,'%d %M') AS tgl,COUNT(visit_ip) AS jumlah FROM visitordata WHERE MONTH(visit_date)=MONTH(CURDATE()) GROUP BY DATE(visit_date)");
        
        if($query->num_rows() > 0) {
            foreach($query->result() as $data) {
                $result[] = $data;
            }
            return $result;
        }
    }

    function count_all_visitors() {
    	$query = $this->db->count_all('visitordata');
    	return $query;
    }

    function count_visitor_this_month() {
    	$query = $this->db->query("SELECT COUNT(*) tot_visitor FROM visitordata WHERE MONTH(visit_date)=MONTH(CURDATE())");
    	return $query;
    }

    function count_chrome_visitors() {
    	$query = $this->db->query("SELECT COUNT(*) chrome_visitor FROM visitordata WHERE visit_platform='Chrome' AND MONTH(visit_date)=MONTH(CURDATE())");
    	return $query;
    }

    function count_firefox_visitors() {
    	$query = $this->db->query("SELECT COUNT(*) firefox_visitor FROM visitordata WHERE (visit_platform='Firefox' OR visit_platform='Mozilla') AND MONTH(visit_date)=MONTH(CURDATE())");
    	return $query;
    }

    function count_explorer_visitors() {
    	$query = $this->db->query("SELECT COUNT(*) explorer_visitor FROM visitordata WHERE visit_platform='Internet Explorer' AND MONTH(visit_date)=MONTH(CURDATE())");
    	return $query;
    }

    function count_safari_visitors() {
    	$query = $this->db->query("SELECT COUNT(*) safari_visitor FROM visitordata WHERE visit_platform='Safari' AND MONTH(visit_date)=MONTH(CURDATE())");
    	return $query;
    }

    function count_opera_visitors() {
    	$query = $this->db->query("SELECT COUNT(*) opera_visitor FROM visitordata WHERE visit_platform='Opera' AND MONTH(visit_date)=MONTH(CURDATE())");
    	return $query;
    }

    function count_robot_visitors() {
    	$query = $this->db->query("SELECT COUNT(*) robot_visitor FROM visitordata WHERE (visit_platform='YandexBot' OR visit_platform='Googlebot' OR visit_platform='Yahoo') AND MONTH(visit_date)=MONTH(CURDATE())");
    	return $query;
    }

    function count_other_visitors() {
    	$query = $this->db->query("SELECT COUNT(*) other_visitor FROM visitordata WHERE 
			(NOT visit_platform='YandexBot' AND NOT visit_platform='Googlebot' AND NOT visit_platform='Yahoo' 
			AND NOT visit_platform='Chrome' AND NOT visit_platform='Firefox' AND NOT visit_platform='Mozilla'
			AND NOT visit_platform='Internet Explorer' AND NOT visit_platform='Safari' AND NOT visit_platform='Opera') 
			AND MONTH(visit_date)=MONTH(CURDATE())");
    	return $query;
    }

}