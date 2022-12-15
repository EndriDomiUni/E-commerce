<?php

class CategoryHelper
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM category";
        $res = $this->db->execute($sql);
        return $res;
    }
}

?>