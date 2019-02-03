<?php

class Base_model extends CI_Model {

    function __construct()  {
        parent::__construct();
        $this->index();
    }

    public function index() {
        $json_file = "./data.json";
        if (!file_exists($json_file) ) {
            $fh = fopen($json_file, 'w+') or die("Can't create file");
        }
    }

    public function ifNotExistsTable($tableName) {
        $query = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = '" . $tableName . "'";
        $result = $this->db->query($query)->row_array();
        if ($result) {
            return false;
        } else {
            return true;
        }
    }

    public function getTableColumns($tableName) {
        if (!$tableName) return false;
        $infos = $this->db->list_fields($tableName);
        return $infos;
    }
}
?>