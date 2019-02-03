<?php

class User_model extends Base_model {

    protected $table = "users_info";

    function __construct() {
        parent::__construct();
        $this->index();
    }

    public function index() {
        if ( $this->ifNotExistsTable($this->table) ) {
            $query = " CREATE TABLE `" . $this->table . "` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(100) NOT NULL,
                `email` varchar(50) NOT NULL,
                `gender` tinyint(1) NOT NULL,
                `birthday` date default NULL,
                `company` varchar(100) not NULL,
                `job` varchar(100) not NULL,
                `address` varchar(100) not NULL,
                `contact` varchar(30) not NULL,
                `password` varchar(32) NOT NULL,
                `reg_date` datetime default NULL,
                `login_count` int(11) NOT NULL,
                `status` int(1) NOT NULL,
                `role` tinyint(4) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
            $this->db->query($query);
        }
    }

    public function changeUserInfo($data) {
        $cols = $this->getTableColumns($this->table);
        $updateAry = array();
        foreach ($cols as $col) {
            if ($col == "id") {
                continue;
            }
            if (isset($data[$col])) {
                if ($col == "password") {
                    $data[$col] = $this->encrypt($data[$col]);
                }
                $updateAry[$col] = $data[$col];
            }
        }
        if (isset($data["id"]) && $data['id']) {
            $this->db->where(array("id" => $data['id']));
            if ($this->db->update($this->table, $updateAry)) {
                return "OK";
            } else {
                return "Failed";
            }
        } else {
            $this->db->insert($this->table, $updateAry);
            if ($this->db->insert_id()) {
                return "OK";
            } else {
                return "Failed";
            }
        }
    }

    public function changeUserByEmail($data, $email) {
        $cols = $this->getTableColumns($this->table);
        $updateAry = array();
        foreach ($cols as $col) {
            if ($col == "id" || $col == "role" || $col == "login_count" || $col == "reg_date" || $col == "status" || ($col == "password" && $data["password"] == "")) {
                continue;
            }
            if ($col == "password" && isset($data["password"])) {
                $updateAry[$col] = $this->encrypt($data[$col]);
            } else {
                $updateAry[$col] = $data[$col];     
            }
        }
        $this->db->where(array("email" => $email));
        if ($this->db->update($this->table, $updateAry)) {
            return "OK";
        } else {
            return "Failed";
        }
    }

    public function getUserInfo($email = null) {
        if (!$email) {
            $email = $this->session->userdata("user_key");
        }
        return $this->db->get_where($this->table, array("email" => $email))->row();
    }

    public function getUsers() {
        $email = $this->session->userdata("user_key");
        $sql = "SELECT * FROM " . $this->table . " WHERE email != '" . $email . "'";
        return $this->db->query($sql)->result();
    }

    public function login($email, $password) {
        $row = $this->db->get_where($this->table, array("email" => $email, "password" => $this->encrypt($password)))->row();
        if (!$row) {
            return "NOT_EXISTS";
        }
        if ($row->status != "0") {
            return "BLOCK";
        }
        $loginCount = $row->login_count * 1 + 1;
        $this->db->where(array("id" => $row->id));
        $this->db->update($this->table, array("login_count" => $loginCount));
        $this->setSession($row->email, $row->role);
        return "OK";
    }

    public function register($name, $email, $password) {
        $exist = $this->db->get_where($this->table, array("email" => $email))->row();
        if ($exist) {
            return "exist";
        } else {
            $this->db->insert($this->table, array("email" => $email, "name" => $name, "password" => $this->encrypt($password), "login_count" => "1", "reg_date" => date("Y-m-d H:i:s")));
            $this->setSession($email, 2);
            return "OK";
        }
        return;
    }

    public function forgot($email) {
        $row = $this->db->get_where($this->table, array("email" => $email))->row();
        if ($row) {
            $new_password = $this->randomString();
            $this->db->where('id', $row->id);
            $this->db->update($this->table, array('password' => $this->encrypt($new_password)));
            
            $subject = "Hello, " . $row->name;
            $message = '<h3>Dear ' . $row->name . ', ' . '</h3> <br><br>We changed your password because you request reset your password.
            <br><br>Your new password is <strong>' . $new_password . '</strong><br><br>Regards, <br><br> Survey App Team';

            $emailContent = array(
                "from" => "",
                "to" => $email,
                "subject" => $subject,
                "message" => $message
            );
            // $emailSent = send_email($emailContent);

            if ($emailSent) {
                return 'OK';
            } else {
                return 'failed';
            }
        }
    }

    public function deleteRow($id) {
        $this->db->where(array("id" => $id));
        if ($this->db->delete($this->table)) {
            return "OK";
        } else {
            return "Failed";
        }
    }

    private function encrypt($pass) {
        return strrev(md5(sha1('survey' . $pass)));
    }

    private function randomString() {
        $length = 8;        //default password lenght is 8
        $str = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    private function setSession($email, $role) {
        $this->session->set_userdata('user_key', $email);
        $this->session->set_userdata('role', $role);
    }
}
?>