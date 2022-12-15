<?php

class CostumerHelper extends DatabaseHelper
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM product";
        $res = $this->db->execute($sql);
        return $res;
    }
}
