<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

class Configuration extends CI_Controller {

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
        "assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css",
        "assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css",
        "assets/plugins/bootstrap-select/bootstrap-select.min.css",
    );
    public $scripts = array(
        // Base JS
        "assets/plugins/pace/pace.min.js",
        "assets/plugins/jquery/jquery-3.2.1.min.js",
        "assets/plugins/jquery-ajaxq/ajaxq.js",
        "assets/plugins/jquery-ui/jquery-ui.min.js",
        "assets/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js",
        "assets/plugins/slimscroll/jquery.slimscroll.min.js",
        "assets/plugins/js-cookie/js.cookie.js",
        "assets/js/theme/default.min.js",
        "assets/js/apps.min.js",

        // Page JS
        "assets/plugins/DataTables/media/js/jquery.dataTables.js",
        "assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js",
        "assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js",
        "assets/plugins/bootstrap-select/bootstrap-select.min.js",
        "assets/plugins/bootstrap-sweetalert/sweetalert.min.js",
        "assets/js/essential/table-manage-responsive.min.js",
        "assets/js/essential/form-plugins.min.js",
        "assets/js/essential/ui-modal-notification.min.js",
    );

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper("my_form");
        $this->my_auth->run();

        $this->visitor->count_visitor();
    }

    public function __destruct() {
        $this->db->close();
    }   

    public function index() {
        header("Content-type: text/html");
        $data["title"][] = "Pengaturan Sistem";
        $data["title"][] = _sitename;
        $data["view"] = "settings/index";

        $data['languages'] = App::languages();
        
        $this->load->view("main_layout", $data);
    }

    public function update() {
        foreach ($_POST as $key => $value) {
            $data = array('value' => $value);
            $this->db->where('config_key', $key)->update('settings', $data);
            $exists = $this->db->where('config_key', $key)->get('settings');
            if ($exists->num_rows() == 0) {
                $this->db->insert('settings',array("config_key"=>$key, "value"=>$value));
            }
        }
        $this->session->set_flashdata('response_status', 'success');
        $this->session->set_flashdata('message', 'settings_updated_successfully');
        redirect('app-settings');
    }

}
