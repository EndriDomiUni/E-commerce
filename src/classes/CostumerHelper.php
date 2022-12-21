<?php

class CostumerHelper extends DatabaseHelper
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * It returns all the rows from the costumer table
     * 
     * @return the result of the query.
     */
    public function getAll()
    {
        $sql = "SELECT * FROM costumer";
        $res = $this->db->execute($sql);
        return $res;
    }
}
