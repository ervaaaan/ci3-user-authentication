<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_users extends CI_Model
{
    private $_table = "userdata";

    public $user_id;
    public $full_name;
    public $password;
    public $email;
    public $role;

    public function rules()
    {
        return [
            [
                'field' => 'full_name',
                'label' => 'Name',
                'rules' => 'required'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[3]'
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ]
        ];
    }

    public function get_all_users()
    {
        return $this->db->get($this->_table)->result();
    }

    public function get_data_by_id($id)
    {
        return $this->db->get_where($this->_table, ["user_id" => substr($id, 0, -32)])->result_array();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->full_name = $post["full_name"];
        $this->email = $post["email"];
        $this->password = password_hash($post["password"], PASSWORD_DEFAULT);
        $this->role = $post["role"] ?? "member";
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->full_name = $post["full_name"];
        $this->username = $post["username"];
        $this->password = $post["password"];
        $this->email = $post["email"];
        $this->db->update($this->_table, $this, array('user_id' => $post['id']));
    }

    public function do_login($username, $email, $password)
    {
        $this->db->where("is_active", "1");
        $this->db->where("is_deleted", "0");
        $this->db->where("email", $email);
        $this->db->or_where('username', $username);

        $query = $this->db->get("userdata");
        if($query->row()){
            $isPasswordTrue = password_verify($password, $query->row()->password);
            // $isAdmin = $query->row()->role == "admin";
            // if ($isPasswordTrue && $isAdmin) {
            if ($isPasswordTrue) { 
                $this->_updateLastLogin($query->row()->user_id);
                return $query->result_array();
            }
		}
        return false;
    }

    public function is_not_login()
    {
        return $this->session->userdata('logged_in') === null;
    }

    private function _updateLastLogin($user_id)
    {
        $sql = "UPDATE {$this->_table} SET last_login=now() WHERE user_id={$user_id}";
        $this->db->query($sql);
    }

    public function is_email_exist($str, $not = NULL) {
        $this->db->where("email", $str);
        if ( ! is_null($not)) {
            $this->db->where("email !=", $not);
        }
        $query = $this->db->get("userdata");
        return $query->num_rows() > 0;
    }

    public function is_username_exist($str, $not = NULL) {
        $this->db->where("username", $str);
        if ( ! is_null($not)) {
            $this->db->where("username !=", $not);
        }
        $query = $this->db->get("userdata");
        return $query->num_rows() > 0;
    }

    public function get_signed($username, $password) {
        $this->db->where("is_deleted", "0");
        $this->db->where("username", $username);

        $query = $this->db->get("userdata");
        if($query->row()){
            $isPasswordTrue = password_verify($password, $query->row()->password);
            if ($isPasswordTrue) { 
                return $query->result_array();
            }
		}
    }

}
