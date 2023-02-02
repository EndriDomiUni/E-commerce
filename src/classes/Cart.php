<?php

use utility\Utils;

require_once("./config/AppConstants.php");
require_once("./src/utility/UtilsFunctions.php");

class Cart extends Dbh
{
    private readonly int $id; // $_SESSION["Id"];
    private Session $session;

    /**
     * @throws Exception
     */
    public function __construct($id)
    {
        parent::__construct();
        $this->id = $id;
        $this->session = new Session($this->id);
    }

    public function getCartByUserId($userId): int|null
    {
        $where = "Utente_id = $userId";
        return $this->dbh->selectId(CARRELLO, $where);
    }

    public function addArticleToCart($params) {
        $query = "INSERT INTO Articolo (Prezzo, Quantita, Carrello_id, Dettaglio_ord_id, Prodotto_id, Conf_variaz_id, Status)
            VALUES (?, ?, ?, ?, ?)";
        $res = $this->dbh->insertData($query, $params); // da pensare come gestire
        return UtilsFunctions::checkResponse($res);
    }

    public function removeArticleFromCart(): void
    {
        $where = "";
        $this->dbh->deleteRecord("", $where);
    }

    public function manageQuantity($params): void
    {
        $this->dbh->updateData($this->id, "", "", $params);
    }
}