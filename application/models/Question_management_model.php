<?php

class Question_management_model extends Base_model {

    protected $table = "question_management";
    protected $_access_table = "question_access_setting";

    function __construct() {
        parent::__construct();
        // $this->index();
        $this->checkSettingTable();
    }

    public function index() {
        if ( $this->ifNotExistsTable($this->table) ) {
            $query = " CREATE TABLE `" . $this->table . "` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `questions` text NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
            $this->db->query($query);
        }
    }

    public function getQuestions() {
        return $this->db->get($this->table)->result();
    }

    public function saveNewQuestions($new) {
        $row = $this->db->get_where($this->table, array('questions' => $new))->row();
        if ($row) {
            return "exists";
        } else {
            $this->db->insert($this->table, array('questions' => $new));
            return $this->db->insert_id();
        }
        return '0';
    }

    public function deleteQuestions($id) {
        $this->db->where(array('id' => $id));
        return $this->db->delete($this->table);
    }

    public function getPageNames(){
        $jsonFile = './data.json';
        $jsonData = json_decode(file_get_contents($jsonFile));
        $i = 1;
        $res = array();
        foreach ($jsonData->pages as $jsonRow) {
            if (isset($jsonRow->name)) {
                $res[] = $jsonRow->name;
            } else {
                $res[] = "Page" . $i;
            }
        }
        return $res;
    }

    public function getAccess() {
        return $this->db->get($this->_access_table)->row();
    }

    public function setAccess($fr, $fm, $pd) {
        $this->load->model("user_model");
        $user = $this->user_model->getUserInfo();
        $this->db->empty_table($this->_access_table);
        $this->db->insert($this->_access_table, array("free" => $fr,"freemium" => implode(",", $fm),"paid" => implode(",", $pd)));
        if ($this->db->insert_id()) {
            return "OK";
        }
        return "Failed";
    }

    public function setCustomQuestions($json, $page) {
        $json = json_decode($json);
        foreach ($json->pages as $jsonRow) {
            if ($jsonRow->name == $page) {
                //new custome json
                $customJsonFile = './custom.json';
                file_put_contents($customJsonFile, json_encode($jsonRow->elements));
                return "OK";
            }
        }
        return "Failed";
    }

    public function checkCustomizeQuestions() {
        $customJsonFile = './custom.json';
        $jsonData = json_decode(file_get_contents($customJsonFile));
        return $jsonData ? true : false;
    }

    public function getJsonByRole($role = false) {
        if (!$role)
            $role = $this->session->userdata("role");
        $row = $this->db->get($this->_access_table)->row_array();
        $cols = array("free", "freemium", "paid");
        $jsonFile = './data.json';
        $jsonContent = json_decode(file_get_contents($jsonFile));
        if ($role != 1) {
            $new = array();
            $pages = explode(",", $row[$cols[$role - 2]]);
            foreach ($jsonContent->pages as $jsonRow) {
                if (in_array($jsonRow->name, $pages)) {
                    $new["pages"][] = $jsonRow;
                }
            }
            $jsonContent = $new;
        }
        return $jsonContent;
    }

    private function checkSettingTable() {
        if ( $this->ifNotExistsTable($this->_access_table) ) {
            $query = " CREATE TABLE `" . $this->_access_table . "` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `free` varchar(30) NOT NULL,
                `freemium` text NOT NULL,
                `paid` text NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
            $this->db->query($query);
        }
    }
}
?>