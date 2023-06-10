<?php if ( ! defined('BASEPATH')) Exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public $styles = array(
        // Base CSS
        "assets/css/fonts.css",
        "assets/plugins/jquery-ui/jquery-ui.min.css",
        "assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css",
        "assets/plugins/font-awesome/5.7.1/css/all.min.css",
        "assets/plugins/animate/animate.min.css",
        "assets/css/style.min.css",
        "assets/css/style-responsive.min.css",
        "assets/css/theme/dongker.css",
        "assets/css/custom.css",

        // Page CSS
        "assets/plugins/gritter/css/jquery.gritter.css",       
    );
    public $scripts = array(
        // Base JS
        "assets/plugins/pace/pace.min.js",
        "assets/plugins/jquery/jquery-3.2.1.min.js",
        "assets/plugins/jquery-ui/jquery-ui.min.js",
        "assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js",
        "assets/plugins/slimscroll/jquery.slimscroll.min.js",
        "assets/plugins/js-cookie/js.cookie.js",
        "assets/js/theme/default.min.js",
        "assets/js/apps.min.js",

        // Page JS
        "assets/plugins/gritter/js/jquery.gritter.min.js",
        "assets/plugins/chartsjs/Chart.min.js",
        // "assets/js/essential/dashboard.js",
    );

    public function __construct() {
        parent::__construct();
        $this->my_auth->run();
        $this->load->model(array("m_dashboard", "userbase/m_users"));

        $this->visitor->count_visitor();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function index($user) {
        header("Content-type: text/html");

        $data["title"][]   = _sitename;
        $data["title"][]   = "Selamat Datang ".$this->session->userdata("name");
		$data["view"]      = "dashboard/index";
		
		$data["user"] = $this->m_users->get_data_by_id($user);
        $data['languages'] = App::languages();

        $visitor = $this->m_dashboard->visitor_statistics();
		foreach($visitor as $result) {
            $tnggl[] = $result->tgl; 
            // $bulan[] = $result->bln; 
            $value[] = (float) $result->jumlah;
        }
        $data['tnggl'] = json_encode($tnggl);
        // $data['bulan'] = json_encode($bulan);
        $data['value'] = json_encode($value);
        $data['all_visitors'] = $this->m_dashboard->count_all_visitors();
		
		$monthly_visitors = $this->m_dashboard->count_visitor_this_month();
		if($monthly_visitors->num_rows() > 0) {
			$row = $monthly_visitors->row_array();
			$data['visitor_this_month'] = $row['tot_visitor'];
		}
		$chrome_visitors = $this->m_dashboard->count_chrome_visitors();
		if($chrome_visitors->num_rows() > 0) {
			$row = $chrome_visitors->row_array();
			$visitor_chrome = $row['chrome_visitor'];
			$data['chrome_visitor'] = ($visitor_chrome / $data['visitor_this_month']) * 100;
		} else {
			$data['chrome_visitor'] = 0;
		}
		$firefox_visitors = $this->m_dashboard->count_firefox_visitors();
		if($firefox_visitors->num_rows() > 0) {
			$row = $firefox_visitors->row_array();
			$visitor_firefox = $row['firefox_visitor'];
			$data['firefox_visitor'] = ($visitor_firefox / $data['visitor_this_month']) * 100;
		}else{
			$data['firefox_visitor'] = 0;
		}
		$explorer_visitors = $this->m_dashboard->count_explorer_visitors();
		if($explorer_visitors->num_rows() > 0) {
			$row = $explorer_visitors->row_array();
			$visitor_explorer = $row['explorer_visitor'];
			$data['explorer_visitor'] = ($visitor_explorer / $data['visitor_this_month']) * 100;
		} else {
			$data['explorer_visitor'] = 0;
		}
		$safari_visitors = $this->m_dashboard->count_safari_visitors();
		if($safari_visitors->num_rows() > 0) {
			$row = $safari_visitors->row_array();
			$visitor_safari = $row['safari_visitor'];
			$data['safari_visitor'] = ($visitor_safari / $data['visitor_this_month']) * 100;
		} else {
			$data['safari_visitor'] = 0;
		}
		$opera_visitors = $this->m_dashboard->count_opera_visitors();
		if($opera_visitors->num_rows() > 0) {
			$row = $opera_visitors->row_array();
			$visitor_opera = $row['opera_visitor'];
			$data['opera_visitor'] = ($visitor_opera / $data['visitor_this_month']) * 100;
		} else {
			$data['opera_visitor'] = 0;
		}
		$robot_visitors = $this->m_dashboard->count_robot_visitors();
		if($robot_visitors->num_rows() > 0) {
			$row = $robot_visitors->row_array();
			$visitor_robot = $row['robot_visitor'];
			$data['robot_visitor'] = ($visitor_robot / $data['visitor_this_month']) * 100;
		} else {
			$data['robot_visitor'] = 0;
		}
		$other_visitors = $this->m_dashboard->count_other_visitors();
		if($other_visitors->num_rows() > 0) {
			$row = $other_visitors->row_array();
			$visitor_other = $row['other_visitor'];
			$data['other_visitor'] = ($visitor_other / $data['visitor_this_month']) * 100;
		} else {
			$data['other_visitor'] = 0;
		}

        $this->load->view("main_layout", $data);
    }

}
