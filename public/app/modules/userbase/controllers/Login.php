<?php defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_users");
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->input->is_ajax_request()) {
            header('HTTP/1.1 503 Service Temporarily Unavailable');
            header('Status: 503 Service Temporarily Unavailable');
            header("Content-type: text/html");
            exit("Service is unavailable, go back to the previous page!");
        }

        header("Content-type: text/html");

        $data["title"][]   = "Authentication Form";
        $data["title"][]   = "CodeIgniter 3";

        $this->load->view("userbase/login", $data);
    }

    public function register() {
        header("Content-type: application/json");

        $pro = FALSE;
        $msg = "Data was not successfully added.";
        $name = $this->input->post("name");
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $email = $this->input->post("email");

        if ( ! $this->input->is_ajax_request()) {
            $msg = "Service is unavailable, go back to the previous page!";
        }
        else {
            if ( ! $this->m_users->is_username_exist($username, NULL)) {
                if ( ! $this->m_users->is_email_exist($email, NULL)) {
                    $this->db->trans_begin();

                    // Insert User
                    $this->db->insert("userdata", array(
                        "password" => password_hash($password, PASSWORD_DEFAULT),
                        "full_name" => $name,
                        "username" => $username,
                        "email" => $email,
                        "phone" => "-"
                    ));

                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                    } else {
                        $this->db->trans_commit();
                        $pro = TRUE;
                        $msg = "Data successfully added.";
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

    public function enter_app()
    {
        header("Content-type: application/json");

        $pro = FALSE; $url = "";
        $sub = "Oops!";
        $msg = "Wrong Username or Password.";
        $username = $this->input->post("email");
        $email = $this->input->post("email");
        $password = $this->input->post("password");

        if (!$this->input->is_ajax_request()) {
            $msg = "Service is unavailable, go back to the previous page!";
        } else {
            $result = $this->m_users->do_login($username, $email, $password);
            if ($result) {
                foreach ($result as $row) {
                    $userdata = array(
                        "role" => $row["role"],
                        "logged_in" => TRUE,
                        "id" => $row["user_id"],
                        "name" => $row["full_name"],
                        "username" => $row["username"],
                        "email" => $row["email"],
                        "phone" => $row["phone"],
                    );

                    $this->session->set_userdata($userdata);
                    $pro = TRUE;
                    $sub = "Yeah!";
                    $msg = "Redirecting .....";
                    $url = "dashboard/" . $this->session->userdata("id") . md5($this->session->userdata("name"));
                }
            }
        }
        echo json_encode(array(
            "success" => $pro,
            "title" => $sub,
            "messages" => $msg,
            "profile" => $url,
        ));
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect($this->index());
    }

    public function test()
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('foo' => 'bar')));
    }
}
