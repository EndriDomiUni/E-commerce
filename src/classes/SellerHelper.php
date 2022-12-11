<?php

class SellerHelper extends DatabaseHelper
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM venditori";
        $res = $this->db->execute($sql);
        return $res;
    }
}
