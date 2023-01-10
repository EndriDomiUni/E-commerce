<?php

use utility\Utils;

require_once("./config/AppConstants.php");
require_once("./src/utility/Utils.php");

class Cart
{
    private Dbh $dbh;

    public function __construct()
    {
        $this->dbh = new Dbh();
    }

    public function getCartByUserId($userId) {
        $where = "Utente_id = $userId";
        return $this->dbh->selectId(CARRELLO, $where);
    }
}