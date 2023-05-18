<?php
// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

class Session extends Dbh
{
    private readonly int $id;

    public function __construct($id)
    {
        parent::__construct();
        $this->id = $id;
        $this->init();
    }

    /**
     * Init current user
     *
     * @return void
     */
    private function init(): void
    {
        if ($this->checkSessionId($this->id)) {
            $claimType = $this->getClaimTypeFromId($this->id);

            switch ($claimType) {
                case CLAIM_USER_DESC:
                case CLAIM_USER_PRO_DESC:
                    // echo "user cart id: " . $this->getUserCartIdFromDb() . '</br>';
                    // echo "user cart id session: " . $this->getCurrentUser()[CARRELLO_ID] . '</br>';
                    break;
                case CLAIM_SELLER_DESC:
                case CLAIM_SELLER_PR0_DESC:
                    // dashboard stuff
                    break;
            }
        }
    }

    public function checkSessionId($id): bool
    {
        if (isset($id)) {
            $response = parent::execute("SELECT * FROM `Utente` WHERE `Id` = '$id' ");
            if (is_int($response[0]["Id"])) {
                $this->setSessionUser($response[0]);
                $user = $this->getCurrentUser();
                return $user[ID] > 0 && $user["Id"] == $id;
            }
        }
        return false;
    }

    public function setSessionUser($params): void
    {
        $_SESSION[ID] = $params[ID];
        $_SESSION[NOME] = $params[NOME];
        $_SESSION[COGNOME] = $params[COGNOME];
        $_SESSION[EMAIL] = $params[EMAIL];
        $_SESSION[PASSWORD] = $params[PASSWORD];
        $_SESSION[STATUS] = $params[STATUS];
        $_SESSION[CLAIM_ID] = $params[CLAIM_ID];
        $_SESSION[INDIRIZZO_ID] = $params[INDIRIZZO_ID];

        //echo "sono qui -> set session user</br>";
        $_SESSION[CARRELLO_ID] = $this->getUserCartIdFromDb() !== null && $this->getUserCartIdFromDb() !== CARRELLO_UNSET
            ? $this->getUserCartIdFromDb()
            : $this->bindCartWithUser();
        $_SESSION[RACCOLTA_ID] = $this->getUserCollectionIdFromDb() !== null && $this->getUserCartIdFromDb() !== RACCOLTA_UNSET
            ? $this->getUserCollectionIdFromDb()
            : $this->generateCollectionRecord();

        //debug
        //echo "current carrello id: ".$_SESSION[CARRELLO_ID];
    }

    public function getCurrentUser(): array|int
    {
        return [
            ID => $_SESSION[ID],
            NOME => $_SESSION[NOME],
            COGNOME => $_SESSION[COGNOME],
            EMAIL => $_SESSION[EMAIL],
            PASSWORD => $_SESSION[PASSWORD],
            STATUS => $_SESSION[STATUS],
            CLAIM_ID => $_SESSION[CLAIM_ID],
            INDIRIZZO_ID => $_SESSION[INDIRIZZO_ID],
            CARRELLO_ID => $_SESSION[CARRELLO_ID],
            RACCOLTA_ID => $_SESSION[RACCOLTA_ID]
        ];
    }

    private function generateCollectionRecord(): array|int|string
    {
        if (UtilsFunctions::issetSessionId()) {
            $query = "INSERT INTO Raccolta (Tipo_raccolta, Titolo, Utente_id, Status)
            VALUES (?, ?, ?, ?)";
            return parent::insertData($query,
                WHISLIST,
                WHISLIST_STRING,
                $_SESSION[ID],
                STATUS_INTACT_DATA);
        }
        return RACCOLTA_UNSET;
    }

    public function getUserCollectionIdFromDb() {
        $where = "Utente_id = " . $this->getCurrentUser()[ID];
        $res = parent::getRecord(RACCOLTA, $where);
        if ($res !== null) {
            return UtilsFunctions::checkResponse($res[ID])
                ? $res[ID]
                : RACCOLTA_UNSET;
        }
        return null;
    }

    /**
     * returns current product while insertion new product
     * @return array|int
     */
    public function getCurrentProduct(): array|int
    {
        return parent::getProductById($_SESSION[PRODOTTO_ID]);
    }

    public function __toString(): string
    {
        return $this->getCurrentUser();
    }

    public function insertCardPayModInformation($params): array|int|string|null
    {
        $query = "INSERT INTO Forma_di_pagamento (Circuito, Numero_carta, Data_scadenza, CVV, Tipo_di_pagamento, Utente_id, Status)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
        $res = parent::insertData($query,
            $params[CIRCUITO],
            $params[NUMERO_CARTA],
            $params[DATA_SCADENZA],
            $params[CVV],
            $params[TIPO_DI_PAGAMENTO] ?? 1,
            $this->getCurrentUser()[ID],
            $params[STATUS]);
        return UtilsFunctions::checkResponse($res) ? $res : null;
    }

    public function insertAddressInformation($params): bool
    {
        $query = "INSERT INTO Indirizzo (Via, Numero_civico, Citta, CAP, Status)
            VALUES (?, ?, ?, ?, ?)";
        $res = parent::insertData($query,
            $params[VIA],
            $params[NUMERO_CIVICO],
            $params[CITTA],
            $params[CAP],
            $params[STATUS]);
        $this->associatesUserInSessionAddress($res);
        return UtilsFunctions::checkResponse($res);
    }

    public function changeClaim($params)
    {
        if (UtilsFunctions::issetSessionId()) {
            parent::updateData($this->getCurrentUser()[ID],
                UTENTE,
                CLAIM_ID,
                $params[CLAIM_ID]);
            parent::updateData($this->getCurrentUser()[ID],
                UTENTE,
                STATUS,
                $params[STATUS]);
        }
    }

    private function associatesUserInSessionAddress($addressId): void
    {
        if (UtilsFunctions::issetSessionId()) {
            if ($this->getCurrentUser()[ID] && $this->getCurrentUser()[CLAIM_ID]) {
                parent::updateData($_SESSION[ID], UTENTE, INDIRIZZO_ID, $addressId);
            }
        }
    }

    private function bindCartWithUser(): int
    {
        if (UtilsFunctions::issetSessionId()) {
            $query = "INSERT INTO `Carrello` (Utente_id, Status)
            VALUES (?, ?)";

            //debug
            //echo "query bind cart with user: {$query}</br>";

            return parent::insertData($query,
                $this->getCurrentUser()[ID],
                STATUS_INTACT_DATA);
        }
        return CARRELLO_UNSET;
    }

    public function getUserCartIdFromDb()
    {
        $where = UTENTE_ID." = ".$this->getCurrentUser()[ID];
        $res = parent::getRecord(CARRELLO, $where);

        if ($res !== null) {
            return UtilsFunctions::checkResponse($res[ID])
                ? $res[ID]
                : CARRELLO_UNSET;
        }
        return null;

    }

    public function getClaimTypeFromId($id): ?string
    {
        $res = parent::execute("SELECT * FROM Claim WHERE Id = '$id' ");
        return $res ? $res[0][DESCRIZIONE] : "";
    }

    public function insertProduct($params): false|array|int|string
    {
        if (UtilsFunctions::checkParams($params)) {
            $nome = $params[NOME];
            $descrizione = $params[DESCRIZIONE];
            $immagine = $params[IMMAGINE];
            $categoriaId = $params[CATEGORIA_ID];
            $dim_x = $params[DIMENSIONE_X_PRODOTTO];
            $dim_y = $params[DIMENSIONE_Y_PRODOTTO];
            $dim_z = $params[DIMENSIONE_Z_PRODOTTO];
            $getDimensionIdCondition = "`Dim_X` = {$dim_x} AND `Dim_Y` = {$dim_y} AND `Dim_Z` = {$dim_z}";
            $dimensionId = parent::getRecord(DIMENSIONE,$getDimensionIdCondition )[ID] != null ?
                parent::getRecord(DIMENSIONE,$getDimensionIdCondition )[ID] : null;

            if ($dimensionId === null ) {
                $query = "INSERT INTO `Dimensione` (`Dim_X`, `Dim_Y`, `Dim_Z`) 
                    VALUES (?, ?, ?)";
                $res = $this->insertData($query, $dim_x, $dim_y, $dim_z);
                if (UtilsFunctions::checkResponse($res)) {
                    $dimensionId = parent::getDimensionIdByParameters($dim_x, $dim_y, $dim_z);
                } else {
                    return false;
                }
            }
            $insertProductQuery = "INSERT INTO `Prodotto` (`Nome`, `Descrizione`, `Immagine`, `Dim_id`, `Categoria_id`, `Status`)
                VALUES (?, ?, ?, ?, ?, ?)";
            $res = $this->insertData($insertProductQuery,
                $nome,
                $descrizione,
                $immagine,
                $dimensionId,
                $categoriaId,
                STATUS_MODIFIED_DATA);
            if (UtilsFunctions::checkResponse($res)) {
                return $res;
            }
        }
        return false;
    }

    public function loadArticlesByUserId($userId): array|int|string
    {
        $where = "Utente_id = $userId";
        $query = "SELECT * FROM `Articolo` WHERE $where";
        return parent::execute($query); // should return an array
    }

    public function loadArticlesInCart($cartId): string|int|array
    {
        if ($this->getClaimTypeFromId($this->getCurrentUser()[CLAIM_ID]) === CLAIM_USER_DESC
            || $this->getClaimTypeFromId($this->getCurrentUser()[CLAIM_ID]) === CLAIM_USER_PRO_DESC) {

            $where = "Carrello_id = ". $cartId . " AND Articolo_id != 1";
            $query = "SELECT * FROM Articolo_in_carrello WHERE $where";
            return parent::execute($query); // should return an array
        }
        return CARRELLO_UNSET;
    }

    public function getTotalOfArticlesInCart() {
        $total = 0.00;
        $articlesInCart = $this->loadArticlesInCart($this->getCurrentUser()[CARRELLO_ID]);
        foreach ($articlesInCart as $articleInCart) {
            $articleId = $articleInCart[ARTICOLO_ID];
            $whereArticle = "Id = " . $articleId;
            $article = $this->getRecord(ARTICOLO, $whereArticle);
            if ($article !== null) {
                $total = $total + floatval($article[PREZZO]);
            }
        }
        return $total;
    }

    public function loadProductInWishlist(): array|int|string|null
    {
        $collectionUserId = $this->getCurrentUser()[RACCOLTA_ID];
        $where = "Raccolta_id = " . $collectionUserId . " AND Id != 1";
        $query = "SELECT * FROM Prodotto_in_raccolta WHERE $where";
        return parent::execute($query); // should return an array
    }


    public function addArticle($params)
    {
        if (UtilsFunctions::checkParams($params)) {
            echo "add article in Session</br>";
            $prezzo = $params[PREZZO];
            $utente_id = $params[UTENTE_ID];
            $prodotto_id = $params[PRODOTTO_ID];
            $insertArticleQuery = "INSERT INTO `Articolo` (`Prezzo`, `Utente_id`, `Prodotto_id`, `Status`)
                VALUES (?, ?, ?, ?)";
            $res = $this->insertData($insertArticleQuery,
                $prezzo,
                $utente_id,
                $prodotto_id,
                STATUS_MODIFIED_DATA);

            //debug
            //echo "response after add article attempt: " . $res . "</br>";

            if (UtilsFunctions::checkResponse($res)) {
                return $res;
            }
        }
    }

    public function addConfigurationArticle($params): int
    {
        $query = "INSERT INTO Configurazione_variazione (Articolo_id, Opzio_variazione_id, Status)
            VALUES (?, ?, ?)";
        $res = parent::insertData($query,
            $params[ARTICOLO_ID],
            $params[OPZIONE_ID],
            STATUS_MODIFIED_DATA);
        return UtilsFunctions::checkResponse($res) ? $res : 0;
    }

    public function addWarehouseArticle($params) : int
    {
        $query = "INSERT INTO Articolo_in_magazzino (Tassa, Quantità, Data_inizio, Data_fine, Articolo_id, Magazzino_id, Status )
            VALUES (?, ?, ?, ?, ?, ?, ?)";
        //echo "sono qui";

        $res = parent::insertData($query,
            $params[TAX],
            $params[QUANTITA],
            $params[DATA_INIZIO],
            $params[DATA_FINE],
            $params[ARTICOLO_ID],
            $params[MAGAZZINO_ID],
            STATUS_MODIFIED_DATA);
        return UtilsFunctions::checkResponse($res) ? $res : 0;
    }

    public function editProduct($productId, $name, $description, $image): int|array|null
    {
        $checkName = null;
        $checkDescription = null;
        $checkImage = null;

        if ($name !== null) {
            $checkName = parent::updateData($productId, PRODOTTO, NOME, $name);
        }
        if ($description !== null) {
            $checkDescription = parent::updateData($productId, PRODOTTO, DESCRIZIONE, $description);
        }
        if ($image !== null) {
            $checkImage = parent::updateData($productId, PRODOTTO, IMMAGINE, $image);
        }
        if ($checkName === null && $checkDescription && $checkImage === null) {
            return null;
        } else {
            return 1;
        }
    }

    public function addOrder($params): int
    {
        $paymentData = parent::getRecord(FORMA_DI_PAGAMENTO, "Utente_id = " .$this->getCurrentUser()[ID]);
        if ($paymentData !== null) {
            $query = "INSERT INTO Ordine (Data_ordine, Tot_ordine, Status, Metodo_di_spedizione, Forma_di_pag_id)
                 VALUES (?, ?, ?, ?, ?)";
            $res = parent::insertData($query,
                $params[DATA_ORDINE],
                $params[TOTALE_ORDINE],
                STATUS_INTACT_DATA,
                1,
                $paymentData[ID]);
            return UtilsFunctions::checkResponse($res) ? $res : 0;
        }
        return 0;
    }

    public function loadArticlesInCartWhere($cartId): string|int|array
    {
        if ($this->getClaimTypeFromId($this->getCurrentUser()[CLAIM_ID]) === CLAIM_USER_DESC
            || $this->getClaimTypeFromId($this->getCurrentUser()[CLAIM_ID]) === CLAIM_USER_PRO_DESC) {

            $where = "Carrello_id = ". $cartId . " AND Articolo_id != 1";
            $query = "SELECT * FROM Articolo_in_carrello WHERE $where";
            return parent::execute($query); // should return an array
        }
        return CARRELLO_UNSET;
    }

    public function addSingleItemInOrder($orderId): bool
    {
        $result = false;
        $articlesInCart = $this->loadArticlesInCartWhere($this->getCurrentUser()[CARRELLO_ID]);
        foreach ($articlesInCart as $article) {
            $quantity = $article[QUANTITA];
            $query = "INSERT INTO Dettaglio_ordine (Tipo, Articolo_id, Ordine_id, Status)
                VALUES (?, ?, ?, ?)";

            for ($i = 0; $i < $quantity; $i++) {
                $res = parent::insertData($query,
                    ORDER_DETAILS_TYPE_STANDARD,
                    $article[ARTICOLO_ID],
                    $orderId,
                    STATUS_INTACT_DATA
                );
                $result = parent::isInsertSuccessful(DETTAGLIO_ORDINE, $res);
            }
        }
        return $result;
    }


    public function removeArticlesInCart() {
        parent::deleteRecord(ARTICOLO_IN_CARRELLO, "Carrello_id = " . $this->getCurrentUser()[CARRELLO_ID]);
    }

    public function loadOrders() {
        $paymentData = parent::getRecord(FORMA_DI_PAGAMENTO, "Utente_id = " . $this->getCurrentUser()[ID]);
        if ($paymentData !== null) {
            $where = "Forma_di_pag_id = " . $paymentData[ID];
            $query = "SELECT * FROM Ordine WHERE $where";
            return parent::execute($query);
        }
    }


    public function loadOrderDetails($orderId): array|int|string
    {
        $where = "Ordine_id = " . $orderId;
        $query = "SELECT * FROM Dettaglio_ordine WHERE $where";
        return parent::execute($query);
    }

    /**
     * Get total quantity of articles in stock
     * @param int $warehouseId
     * @return int
     */
    public function getArticlesInStockQuantity(int $warehouseId): int
    {
        $quantity = 0;
        $articles = parent::getArticlesBySellerId($_SESSION[ID]);

        foreach($articles as $article) {
            $articleInWarehouse = parent::getWarehouseArticle($article[ID], $warehouseId);
            if (count($articleInWarehouse) > 0) {
                //var_dump($articleInWarehouse);
                $quantity += $articleInWarehouse[QUANTITA];
            }
        }
        return $quantity;
    }

    /**
     * Get all articles in stock of seller in session
     * @param int $warehouseId
     * @return array
     */
    public function getArticlesInStockByWarehouse(int $warehouseId) : array
    {
        $articlesInStock = [];
        $articles = parent::getArticlesBySellerId($_SESSION[ID]);
        foreach ($articles as $article) {
            $articleInWarehouse = parent::getWarehouseArticle($article[ID], $warehouseId);

            if (count($articleInWarehouse) > 0) {

                //var_dump($articleInWarehouse);
                $articlesInStock[] = $articleInWarehouse;
            }

            return $articlesInStock;
        }
        return [];
    }

    public function getArticlesInStockByArticle(int $articleId) : array
    {
        return [];
    }


    /**
     * Get
     * @param $startTime
     * @param $endTime
     * @return array
     */
    public function getOrdersQuantityInRangeDateTime($startTime, $endTime) : array
    {
        $query = 'SELECT COUNT(DISTINCT o.id) AS numero_ordini
                    FROM Ordine o
                    JOIN Dettaglio_ordine do ON o.id = do.id_ordine
                    JOIN Articolo_in_carrello ac ON do.id_articolo_in_carrello = ac.id
                    JOIN Articolo a ON ac.Articolo_id = a.id
                    WHERE a.Utente_id = ' . $this->getCurrentUser()[ID] . '
                      AND o.Data_ordine >= ' . $startTime . '
                      AND o.Data_ordine <= ' . $endTime;
        return $this->execute($query);
    }

    /**
     * Set status = delete
     * @return void
     */
    public function deleteCurrentUser(): void
    {
        // set ARTICOLO
        // with status DELETE
        $claimType = $this->getClaimTypeFromId($this->id);
        switch ($claimType) {
            case CLAIM_SELLER_DESC:
            case CLAIM_SELLER_PR0_DESC:
                $obtainArticlesOfCurrentUser = parent::getRecord(ARTICOLO, "Utende_id = " . $this->getCurrentUser()[ID]);
                if (!empty($obtainArticlesOfCurrentUser)) {
                    foreach ($obtainArticlesOfCurrentUser as $article) {

                        // ARTICOLO_IN_CARRELLO
                        $articlesInCart = parent::getRecord(ARTICOLO_IN_CARRELLO, "Articolo_id = " . $article[ID]);
                        if (!empty($articlesInCart)) {
                            foreach ($articlesInCart as $articleInCartItem) {
                                parent::updateDateWithWhere(
                                    ARTICOLO,
                                    STATUS,
                                    STATUS_DELETED_DATA,
                                    "Articolo_id = " . $articleInCartItem[ID]);
                            }
                        }

                        // ARTICOLO_IN_MAGAZZINO
                        $articlesInWarehouses = parent::getRecord(ARTICOLO_IN_MAGAZZINO, "Articolo_id = " . $article[ID]);
                        if (!empty($articlesInWarehouses)) {
                            foreach ($articlesInWarehouses as $articlesInWarehouse) {
                                parent::updateDateWithWhere(
                                    ARTICOLO,
                                    STATUS,
                                    STATUS_DELETED_DATA,
                                    "Articolo_id = " . $articlesInWarehouse[ID]);
                            }
                        }

                        // CONFIGURAZIONE_VARIAZIONE
                        $configVariations = parent::getRecord(CONFIGURAZIONE_VARIAZIONE, "Articolo_id = " . $article[ID]);
                        if (!empty($configVariations)) {
                            foreach ($configVariations as $configVariation) {
                                parent::updateDateWithWhere(
                                    ARTICOLO,
                                    STATUS,
                                    STATUS_DELETED_DATA,
                                    "Articolo_id = " . $configVariation[ID]);
                            }
                        }
                    }
                }
                break;
        }
        parent::updateDateWithWhere(ARTICOLO, STATUS, STATUS_DELETED_DATA, "Utende_id = " . $this->getCurrentUser()[ID]);


        // set ORDINE and DETTAGLIO_ORDINE
        // with status DELETE
        $obtainPaymentFormOfCurrentUser = parent::getRecord(FORMA_DI_PAGAMENTO, "Utende_id = " . $this->getCurrentUser()[ID]);
        if (!empty($obtainPaymentFormOfCurrentUser)) {
            foreach ($obtainPaymentFormOfCurrentUser as $paymentForm) {
                $ordersOfCurrentUser = parent::getRecord(ORDINE, "Forma_di_pag_id = " . $paymentForm[ID]);
                if (!empty($ordersOfCurrentUser)) {
                    foreach ($ordersOfCurrentUser as $orders) {
                        parent::updateDateWithWhere(ORDINE, STATUS, STATUS_DELETED_DATA, "Forma_di_pag_id = " . $paymentForm[ID]);
                        parent::updateDateWithWhere(DETTAGLIO_ORDINE, STATUS, STATUS_DELETED_DATA, "Ordine_id = " . $orders[ID]);
                    }
                }
            }
        }

        // set CARRELLO, FORMA_DI_PAGAMENTO, RACCOLTA, RECENSIONE, RACCOLTA, UTENTE
        // with status DELETE
        parent::updateDateWithWhere(CARRELLO, STATUS, STATUS_DELETED_DATA, "Utende_id = " . $this->getCurrentUser()[ID]);
        parent::updateDateWithWhere(FORMA_DI_PAGAMENTO, STATUS, STATUS_DELETED_DATA, "Utende_id = " . $this->getCurrentUser()[ID]);
        parent::updateDateWithWhere(RACCOLTA, STATUS, STATUS_DELETED_DATA, "Utende_id = " . $this->getCurrentUser()[ID]);
        parent::updateDateWithWhere(RECENSIONE, STATUS, STATUS_DELETED_DATA, "Utende_id = " . $this->getCurrentUser()[ID]);
        parent::updateDateWithWhere(RACCOLTA, STATUS, STATUS_DELETED_DATA, "Id = " . $this->getCurrentUser()[CLAIM_ID]);
        parent::updateData($this->getCurrentUser()[ID], UTENTE, STATUS, STATUS_DELETED_DATA);
    }
}
