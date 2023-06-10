<?php if ( ! defined('BASEPATH')) Exit('No direct script access allowed');

class Users extends CI_Controller {

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
        $this->load->helper("my_form");
        $this->load->model("userbase/m_users");
        $this->my_auth->setExceptedPage(
            array("login","logout")
        );
        $this->my_auth->run();
        
        $this->visitor->count_visitor();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function get_data() {
        header("Content-type: application/json");

        $result = $this->m_users->get_data_by_id($this->input->get("id"));
        for ($i = 0; $i < count($result); $i++) {
            unset($result[$i]["password"]);
        }
        echo json_encode(array(
            "total" => count($result),
            "data" => $result
        ));
    }

    public function load_data() {
        header("Content-type: application/json");

        $this->load->library("datatables");
        $this->datatables->select("'' as no, user_id, full_name, username, phone, email, role, is_active, is_deleted", FALSE);
        $this->datatables->from("userdata");
        $this->datatables->where("role !=", "developer");
        $this->datatables->where("is_deleted =", "0");
        $this->datatables->add_column("action",
            "<div class=\"btn-group\">
                <button type=\"button\" class=\"btn btn-inverse btn-xs dropdown-toggle\" data-toggle=\"dropdown\">
                    Options
                </button>
                <ul class=\"dropdown-menu dropdown-menu-right\" role=\"menu\">
                    <li><a href=\"javascript:;\" url-api=\"".base_url("userbase/users/get_data?id=$1").md5($this->input->get("name"))."\" class=\"data-edit\">
                      <button type=\"button\" class=\"btn btn-icon btn-info btn-xs\"><i class=\"fa fa-pencil-alt\"></i></button> Edit User
                    </a></li>
                    <li><a href=\"javascript:;\" url-api=\"".base_url("userbase/users/get_data?id=$1").md5($this->input->get("name"))."\" class=\"data-delete\">
                      <button type=\"button\" class=\"btn btn-icon btn-danger btn-xs\"><i class=\"fa fa-times\"></i></button> Remove</a></li>
                </ul>
            </div>",
            "user_id");
        echo $this->datatables->generate();
    }

    public function index() {
        header("Content-type: text/html");

        $data["title"][] = "Settings";
        $data["title"][] = "Manage Users";
        $data["view"] = "userbase/index";

        $data['languages'] = App::languages();
        $data['activities'] = App::get_activity($limit = 30);
        $data["roles"] = array(
            "administrator" => "Admin"
        );
        
        $this->load->view("main_layout", $data);
    }

    public function settings() {
        header("Content-type: text/html");

        $data["title"][] = "Settings";
        $data["title"][] = "My Profile";
        $data["view"] = "userbase/settings";

        $data['languages'] = App::languages();
        $data['activities'] = App::get_activity($limit = 30);
        
        $this->load->view("main_layout", $data);
    }

    public function save_profile() {
        header("Content-type: application/json");

        $id = $this->session->userdata("id");
        $username = $this->input->post("username");
        $name = $this->session->userdata("name");
        $email = $this->input->post("email");
        $last_username = $this->input->post("last_username");
        $last_email = $this->input->post("last_email");
        $pro = FALSE;
        $msg = "Data was not successfully edited.";

        if ( ! $this->input->is_ajax_request()) {
            $msg = "Service is unavailable, go back to the previous page!";
        } else {
            if ( ! $this->m_users->is_username_exist($username, $last_username)) {
                if ( ! $this->m_users->is_email_exist($email, $last_email)) {
                    $this->db->trans_begin();

                    // Update User
                    $this->db->where("user_id", $id);
                    $this->db->update("userdata", array(
                        "username" => $username,
                        "email" => $email,
                        "full_name" => $name
                    ));

                    // Write Activity
                    $this->db->insert("useractivities", array(
                        "user_id" => $this->session->userdata("id"),
                        "activity_action" => "edit",
                        "activity_detail" => "user_".$name,
                        "activity_created" =>  date("Y-m-d H:i:s")
                    ));
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                    } else {
                        $this->db->trans_commit();
                        $pro = TRUE;
                        $msg = "Data successfully edited.";
                    }
                } else {
                    $msg = "Email {$email} already exist.";
                }
            } else {
                $msg = "Username {$username} already exist.";
            }
        }
        echo json_encode(array(
            "success" => $pro,
            "title" => "Message",
            "messages" => $msg
        ));
    }

    public function save_password() {
        header("Content-type: application/json");

        $id = $this->session->userdata("id");
        $username = $this->session->userdata("username");
        $name = $this->session->userdata("name");
        $prev_password = $this->input->post("prev_password");
        $new_password = $this->input->post("new_password");
        $confirm_password = $this->input->post("confirm_password");
        $pro = FALSE;
        $msg = "Kata Sandi tidak berhasil diubah.";

        if ( ! $this->input->is_ajax_request()) {
            $msg = "Service is unavailable, go back to the previous page!";
        } else {
            if (count($this->m_users->get_signed($username, $prev_password))) {
                if ($new_password == $confirm_password) {
                    $this->db->trans_begin();

                    // Update User
                    $this->db->where("user_id", $id);
                    $this->db->update("userdata", array(
                        "password" => password_hash($new_password, PASSWORD_DEFAULT)
                    ));

                    // Write Activity
                    $this->db->insert("useractivities", array(
                        "user_id" => $this->session->userdata("id"),
                        "activity_action" => "edit",
                        "activity_detail" => "user_".$name,
                        "activity_created" =>  date("Y-m-d H:i:s")
                    ));
                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                    } else {
                        $this->db->trans_commit();
                        $pro = TRUE;
                        $msg = "Password Changed.";
                    }
                } else {
                    $msg = "Confirm password not match.";
                }
            } else {
                $msg = "Old password not match.";
            }
        }
        echo json_encode(array(
            "success" => $pro,
            "title" => "Message",
            "messages" => $msg
        ));
    }

}
