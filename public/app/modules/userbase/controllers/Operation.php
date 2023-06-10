<?php if ( ! defined('BASEPATH')) Exit('No direct script access allowed');

class Operation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("userbase/m_users");
        $this->my_auth->setExceptedPage(
            array("login","logout")
        );
        $this->my_auth->run();
    }

    public function __destruct() {
        $this->db->close();
    }

    public function add() {
        header("Content-type: application/json");

        $pro = FALSE;
        $msg = "Data was not successfully added.";
        $name = $this->input->post("name");
        $username = $this->input->post("username");
        $password = "1234";
        $email = $this->input->post("email");
        $phone = $this->input->post("phone");
        $role = "member";

        if ( ! $this->input->is_ajax_request()) {
            $msg = "Service is unavailable, go back to the previous page!";
        }
        else {
            $config = array(
                "upload_path" => './assets/img/users/',
                "allowed_types" => 'jpg',
                "max_size" => 500
            );
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('user_img')) {
                $pro = FALSE;
                $error = $this->upload->display_errors();
                $errmsg = str_replace(array('<p>','</p>'),'',$error); 
                $msg = $errmsg;
            }
            else {
                if ( ! $this->m_users->is_username_exist($username, NULL)) {
                    if ( ! $this->m_users->is_email_exist($email, NULL)) {
                        $this->db->trans_begin();

                        // Insert User
                        $this->db->insert("userdata", array(
                            "full_name" => $name,
                            "username" => $username,
                            "password" => password_hash($password, PASSWORD_DEFAULT),
                            "email" => $email,
                            "phone" => $phone,
                            "role" => $role
                        ));
                        $new_id = $this->db->insert_id();

                        $res = $this->upload->data();

                        $full_pat = $res['full_path'];
                        $file_new = $res['file_name'];
                        $file_pat = 'assets/img/users/';
                        $file_ext = '.jpg';
                        
                        move_uploaded_file($_FILES['user_img']['tmp_name'], $file_pat.$new_id.$file_ext);
                        unlink($full_pat);

                        // Write Activity
                        $this->db->insert("useractivities", array(
                            "user_id" => $this->session->userdata("id"),
                            "activity_action" => "add",
                            "activity_detail" => "add-new_".strtolower($role."_".str_replace(" ", "-", $name)),
                            "activity_created" =>  date("Y-m-d H:i:s")
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
        }
        echo json_encode(array(
            "success" => $pro,
            "title" => "Message",
            "messages" => $msg
        ));
    }

    public function edit() {
        header("Content-type: application/json");

        $pro = FALSE;
        $msg = "Data was not successfully edited.";
        $id = $this->input->post("id");
        $last_username = $this->input->post("last_username");
        $last_email = $this->input->post("last_email");
        $last_phone = $this->input->post("last_phone");
        $name = $this->input->post("name");
        $username = $this->input->post("username");
        $email = $this->input->post("email");
        $phone = $this->input->post("phone");

        if ( ! $this->input->is_ajax_request()) {
            $msg = "Service is unavailable, go back to the previous page!";
        }
        else {
            $config = array(
                "upload_path" => './assets/img/users/',
                "allowed_types" => 'jpg',
                "max_size" => 500,
                "file_name" => $id
            );
            $this->load->library('upload', $config);

            $this->db->trans_begin();
            $this->db->where("user_id", $id);
            $update = array(
                "full_name" => $name,
                "username" => $username,
                "email" => $email,
                "phone" => $phone,
            );
            $this->db->update("userdata", $update);  

            $res = $this->upload->data();

            if ($res["file_name"] != "") { 
                if ( ! $this->upload->do_upload('user_img')) {
                    $pro = FALSE;
                    $error = $this->upload->display_errors();
                    $errmsg = str_replace(array('<p>','</p>'),'',$error); 
                    $msg = $errmsg;
                } 
                else {
                    $full_pat = $res['full_path'];
                    $file_new = $res['file_name'];
                    $file_pat = 'assets/img/users/';
                    $file_ext = '.jpg';
                    
                    move_uploaded_file($_FILES['user_img']['tmp_name'], $file_pat.$id.$file_ext);
                    unlink($full_pat.'1'.$file_ext);
                }
            }

            // Write Activity
            $this->db->insert("useractivities", array(
                "user_id" => $this->session->userdata("id"),
                "activity_action" => "edit",
                "activity_detail" => "edit_".strtolower(str_replace(" ", "-", $name)),
                "activity_created" =>  date("Y-m-d H:i:s")
            ));

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $pro = TRUE;
                $msg = "Data successfully edited.";
            }
        }
        echo json_encode(array(
            "success" => $pro,
            "title" => "Message",
            "messages" => $msg
        ));
    }

    public function delete() {
        header("Content-type: application/json");
        
        $pro = FALSE;
        $msg = "Data was not successfully deleted.";
        $id = $this->input->post("id");
        $name = $this->input->post("name");
        $role = $this->input->post("role");

        if ( ! $this->input->is_ajax_request()) {
            $msg = "Service is unavailable, go back to the previous page!";
        } else {
            $this->db->trans_begin();

            // Update User
            $this->db->where("user_id", $id);
            $this->db->update("userdata", array(
                "is_deleted" => "1"
            ));

            // Write Activity
            $this->db->insert("useractivities", array(
                "user_id" => $this->session->userdata("id"),
                "activity_action" => "delete",
                "activity_detail" => "delete_".strtolower($role."_".str_replace(" ", "-", $name)),
                "activity_created" =>  date("Y-m-d H:i:s")
            ));
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
                $pro = TRUE;
                $msg = "Data successfully deleted.";
            }
        }
        echo json_encode(array(
            "success" => $pro,
            "title" => "Message",
            "messages" => $msg
        ));
    }

}
