<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author		Jack Devians
 * @copyright	Merlinbox Digital Solution
 * @link		https://merlinbox.com
*/

class Errors extends CI_Controller {

    public $styles = array(
        // Base CSS
        "assets/css/fonts.css",
        "assets/plugins/jquery-ui/jquery-ui.min.css",
        "assets/plugins/bootstrap/4.0.0/css/bootstrap.min.css",
        "assets/plugins/font-awesome/5.7.1/css/all.min.css",
        "assets/plugins/animate/animate.min.css",
        "assets/css/style.min.css",
        "assets/css/style-responsive.min.css",
        "assets/css/theme/default.css",     
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
        "assets/js/apps.min.js"
    );

    public function __construct() {
        parent::__construct();
        $this->load->database();
        // $this->my_auth->run();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function index() {
        $this->not_found();
    }

    public function not_found() {
        header("Content-type: text/html");

        $data["title"][]   = "404";
        $data["title"][]   = _sitename;
        $data["view"]      = "errors/pages/not_found";

        $data['languages'] = App::languages();

        $this->load->view("error_layout", $data);
    }

    public function access_denied() {
        header("Content-type: text/html");

        $data["title"][]   = "401";
        $data["title"][]   = _sitename;
        $data["view"]      = "errors/pages/access_denied";

        $data['languages'] = App::languages();

        $this->load->view("error_layout", $data);
    }

    public function unavailable() {
        header("Content-type: text/html");
        
        $data["title"][]   = "503";
        $data["title"][]   = _sitename;
        $data["view"]      = "errors/pages/unavailable";

        $data['languages'] = App::languages();

        $this->load->view("error_layout", $data);
    }

}
