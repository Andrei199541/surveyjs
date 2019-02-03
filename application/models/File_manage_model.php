<?php

class File_manage_model extends Base_model {
    protected $table = "uploaded_files";

    function __construct() {
        parent::__construct();
        $this->index();
    }

    public function index() {
        if ( $this->ifNotExistsTable($this->table) ) {
            $query = " CREATE TABLE `" . $this->table . "` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(100) NOT NULL,
                `type` varchar(50) NOT NULL,
                `size` int(11) NOT NULL,
                `idate` datetime default NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
            $this->db->query($query);
        }
    }

    public function checkFileName($filename) {
        $row = $this->db->get_where($this->table, array("name" => $filename))->row();
        if ($row) 
            return true;
        return false;
    }

    public function getCounts() {
        return $this->db->count_all($this->table);
    }

    public function getFiles($limit) {
        $before = ($limit - 1) * 10;
        $limit = $limit * 10;
        $this->db->limit($limit, $before);
        $result = $this->db->get($this->table)->result();
        if ($result) {
            foreach ($result as $row) {
                $row->idate = date("d.m.Y H:i", strtotime($row->idate));
            }
        }
        return $result;
    }

    public function upload ($file) {
        $type = explode(".", $file['file']['name']);
        $file_type = $type[sizeof($type) - 1];
        $exts = array("doc", "docx", "xls", "xlsx", "pdf", "txt");
        if (in_array($file_type, $exts)) {
            $saveAry = array(
                "name" => $file['file']['name'],
                "type" => $file_type,
                "size" => $file['file']['size'],
                "idate" => date("Y-m-d H:i:s")
            );

            $this->db->insert($this->table, $saveAry);
            $result = $this->db->insert_id();

            $filePath = 'assets/uploads/';
            if (!file_exists( ($filePath) )) {
                mkdir($filePath, 0777, true);
            }
            if ( move_uploaded_file($file['file']['tmp_name'], $filePath . '/' . $file['file']['name']) ) {
                return true;
            } else {
                $this->db->where(array('id' => $result));
                $this->db->delete($this->table);
                
                return false;
            }
        }
    }

    public function uploadProfileImage ($file) {
        $type = explode(".", $file['file']['name']);
        $ext = $type[sizeof($type) - 1];

        $this->load->model("user_model");
        $userInfo = $this->user_model->getUserInfo();

        $filePath = 'assets/img/users';
        if (!file_exists( ($filePath) )) {
            mkdir($filePath, 0777, true);
        }
        if ( move_uploaded_file($file['file']['tmp_name'], $filePath . '/' . $userInfo->id . '.jpg') ) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUploadedDocumentFile($id) {
        $row = $this->db->get_where($this->table, array("id" => $id))->row();
        if ($row) {
            $name = $row->name;
            @unlink("assets/uploads/" . $name);
            $this->db->where(array("id" => $id));
            $this->db->delete($this->table);
            return "OK";
        }
        return "Failed";
    }
}
?>