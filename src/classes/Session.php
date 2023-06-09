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
            parent::updateData($this->getCurrentUser()[CLAIM_ID],
            CLAIM,
            CLAIM_TYPE,
                $params[CLAIM_TYPE]);
            parent::updateData($this->getCurrentUser()[CLAIM_ID],
                CLAIM,
                STATUS,
                $params[STATUS]);
        }
    }

    public function hasFormOfPayment($userId): bool
    {
        return !empty(parent::execute("SELECT * FROM Forma_di_pagamento WHERE Utente_id = " . $userId));
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
            $dimensionId = parent::getRecord(DIMENSIONE,$getDimensionIdCondition ) != null ?
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
            $article = $this->getRecord(ARTICOLO, "Id = " . $articleInCart[ARTICOLO_ID]);
            if ($article !== null) {

                $claimType = $this->getClaimTypeFromId($this->getCurrentUser()[CLAIM_ID]);

                // is discounted?
                if ($this->isDiscountArticle($article[ID]) || $claimType === CLAIM_USER_PRO_DESC) {
                    $total = $total + (floatval($article[PREZZO] * $articleInCart[QUANTITA]) * 0.85); // 15% di sconto
                } else {
                    $total = $total + (floatval($article[PREZZO] * $articleInCart[QUANTITA]));
                }
            }
        }
        return $total;
    }

    public function getDescriptionOrderStatus($orderStatus): string
    {
        switch ($orderStatus) {
            default:
                return "Sospeso";
            case ORDER_STATUS_PAID:
                return "Pagato";
            case ORDER_STATUS_PENDING:
                return "In attesa";

        }
    }

    public function getDescriptionOrderDetailStatus($orderStatus): string
    {
        switch ($orderStatus) {
            default:
                return "Sospeso";
            case ORDER_STATUS_PAID:
                return "Pagato";
            case ORDER_STATUS_PENDING:
                return "In attesa";
            case ORDER_DETAILS_TYPE_INSTALLMENT_PAYMENT:
                return "A rate";
        }
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
        $query = "INSERT INTO Articolo_in_magazzino (Quantità, Data_inizio, Data_fine, Articolo_id, Magazzino_id, Status )
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

    /**
     * Create new order from params
     *
     * @param $params
     * @return int
     */
    public function addOrder($params): int
    {
        $paymentData = parent::getRecord(FORMA_DI_PAGAMENTO, "Utente_id = " .$this->getCurrentUser()[ID]);
        if ($paymentData !== null) {
            $query = "INSERT INTO Ordine (Data_ordine, Tot_ordine, Status, Metodo_di_spedizione, Forma_di_pag_id)
                 VALUES (?, ?, ?, ?, ?)";
            $res = parent::insertData($query,
                $params[DATA_ORDINE],
                $params[TOTALE_ORDINE],
                ORDER_STATUS_PENDING,
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


    /**
     * Create new order details also considers the quantity
     *
     * @param $orderId
     * @param $orderTypeList
     * @return bool
     */
    public function addNewOrderDetails($orderId, $orderTypeList): bool
    {
        $result = false;
        $articlesInCart = $this->loadArticlesInCart($this->getCurrentUser()[CARRELLO_ID]);

        for ($i = 0; $i < count($articlesInCart); $i++) {
            $quantity = $articlesInCart[$i][QUANTITA];
            $query = "INSERT INTO Dettaglio_ordine (Tipo, Articolo_id, Ordine_id, Status)
                VALUES (?, ?, ?, ?)";

            for ($j = 0; $j < $quantity; $j++) {
                $res = parent::insertData($query,
                    $orderTypeList[$j],
                    $articlesInCart[$i][ARTICOLO_ID],
                    $orderId,
                    ORDER_DETAIL_STATUS_PENDING_DATA
                );
                $result = parent::isInsertSuccessful(DETTAGLIO_ORDINE, $res);
            }
        }
        return $result;
    }

    /**
     * Set status to paid
     *
     * @param $orderId
     * @param $orderDetailId
     * @return void
     */
    private function setOrderAndOrderDetailToStatusPaid($orderId, $orderDetailId): void
    {
        parent::updateData($orderId, ORDINE, STATUS, ORDER_STATUS_PAID);
        parent::updateData($orderDetailId, DETTAGLIO_ORDINE, STATUS, ORDER_STATUS_PAID);
    }

    /**
     * Return new order id
     *
     * @param $dateTime string if empty, creates based on $orderDate
     * @param $orderDate
     * @param $totalOrder
     * @param $status
     * @param $formOfPaymentId
     * @return array|int|string
     */
    private function createNewOrder(string $dateTime, $orderDate, $totalOrder, $status, $formOfPaymentId): array|int|string
    {
        $startDate = strtotime($orderDate);
        $newDate = date('Y-m-d', strtotime($dateTime, $startDate));
        return parent::insertData("INSERT INTO Ordine (Data_ordine, Tot_ordine, Status, Metodo_di_spedizione, Forma_di_pag_id)
                                VALUES (?, ?, ?, ?, ?)",
            $newDate,
            $totalOrder,
            $status,
            1,
            $formOfPaymentId);
    }

    /**
     *
     *
     * @param $type
     * @param $articleId
     * @param $orderId
     * @param $status
     * @return void
     */
    private function createNewOrderDetail($type, $articleId, $orderId, $status): void
    {
        parent::insertData("INSERT INTO Dettaglio_ordine (Tipo, Articolo_id, Ordine_id, Status)
                                VALUES (?, ?, ?, ?)",
            $type,
            $articleId,
            $orderId,
            $status);
    }

    private function updateOrderStatusToPaid($orderId) {
        $orderDetails = $this->loadOrderDetails($orderId);
        foreach ($orderDetails as $orderDetail) {
            if ($orderDetail[STATUS] === ORDER_STATUS_PAID) {
                parent::updateData($orderId, ORDINE, STATUS, ORDER_STATUS_PAID);
            }
        }
    }

    private function createInvoice($orderDetailsId, $taxable, $tot, $status) {
        $query = "INSERT INTO Fattura (Dettaglio_ordine_id, Imponibile, Totale, Status) VALUES (?, ?, ?, ?)";
        parent::execute($query,
            $orderDetailsId,
            $taxable,
            $tot,
            $status);
    }

    private function getTaxable($total) {
        // iva 22%
        return $total * 78/100;
    }

    private function getNewDiscountedPrice($articleInCartId) {
        var_dump($articleInCartId);

        //$articleInCart = $this->getRecord(ARTICOLO_IN_CARRELLO, "Id = " . $articleInCartId);
        $article = $this->getRecord(ARTICOLO, "Id = " . $articleInCartId);
        if ($this->isDiscountArticle($article[ID])) {
            return ($article[PREZZO] * 0.85); // 15% di sconto
        }
        return $article[PREZZO];
    }

    public function manageOrderDetails($orderId) {

        // original order
        $originalOrder = parent::getRecord(ORDINE, "Id = " . $orderId);

        // load orders detail
        $orderDetails = $this->loadOrderDetails($orderId);
        foreach ($orderDetails as $orderDetail) {

            // get article & article in cart
            $article = parent::getRecord(ARTICOLO, "Id = " . $orderDetail[ARTICOLO_ID]);
            $articleInCart = parent::getRecord(ARTICOLO_IN_CARRELLO, "Articolo_id = " . $article[ID]);

            // check type of order details
            switch ($orderDetail[TIPO]) {

                // STANDARD -> set order to status PAID
                //          -> set order detail to status PAID
                case ORDER_DETAILS_TYPE_STANDARD:
                    $this->setOrderAndOrderDetailToStatusPaid($orderId, $orderDetail[ID]);
                    $this->createInvoice($orderDetail[ID],
                        $this->getTaxable($this->getNewDiscountedPrice($article[ID])),
                        $this->getNewDiscountedPrice($article[ID]),
                        INVOICE_STATUS_PAID);
                    break;

                // MONTHLY -> set order to status PAID
                //         -> set order detail to status PAID for the first
                //         -> generate new order
                //         -> generate new orderDetail  with status ORDER_STATUS_PENDING
                case ORDER_DETAILS_TYPE_MONTHLY:

                    // update status
                    parent::updateData($orderDetail[ID], DETTAGLIO_ORDINE, STATUS, ORDER_STATUS_PAID);
                    $this->createInvoice($orderDetail[ID],
                        $this->getTaxable($this->getNewDiscountedPrice($article[ID])),
                        $this->getNewDiscountedPrice($article[ID]),
                        INVOICE_STATUS_PAID);

                    // get total
                    $totalOrder = $article[PREZZO] * $articleInCart[QUANTITA]; // TODO: conto sbagliato!!!!!! e tutti sotto

                    // create new order
                    $newOrderId = $this->createNewOrder(
                        '+1 month',
                        $originalOrder[DATA_ORDINE],
                        $totalOrder,
                        ORDER_STATUS_PENDING,
                        $originalOrder[FORMA_DI_PAG_ID]);

                    // create new order detail with status pending
                    $this->createNewOrderDetail($orderDetail[TIPO], $orderDetail[ARTICOLO_ID], $newOrderId, ORDER_STATUS_PENDING);
                    $this->createInvoice($orderDetail[ID],
                        $this->getTaxable($this->getNewDiscountedPrice($article[ID])),
                        $this->getNewDiscountedPrice($article[ID]),
                        INVOICE_STATUS_PENDING);
                    break;

                // QUARTERLY -> set order detail to status PAID for the first
                //           -> generate new order
                //           -> generate new orderDetail  with status ORDER_STATUS_PENDING
                case ORDER_DETAILS_TYPE_QUARTERLY:

                    // update status
                    parent::updateData($orderDetail[ID], DETTAGLIO_ORDINE, STATUS, ORDER_STATUS_PAID);
                    $this->createInvoice($orderDetail[ID],
                        $this->getTaxable($this->getNewDiscountedPrice($article[ID])),
                        $this->getNewDiscountedPrice($article[ID]),
                    INVOICE_STATUS_PAID);

                    // get total
                    $totalOrder = $article[PREZZO] * $articleInCart[QUANTITA]; // TODO: conto sbagliato!!!!!! e tutti sotto

                    // create new order
                    $newOrderId = $this->createNewOrder(
                        '+3 month',
                        $originalOrder[DATA_ORDINE],
                        $totalOrder,
                        ORDER_STATUS_PENDING,
                        $originalOrder[FORMA_DI_PAG_ID]);

                    // create new order detail with status pending
                    $this->createNewOrderDetail($orderDetail[TIPO], $orderDetail[ARTICOLO_ID], $newOrderId, ORDER_STATUS_PENDING);
                    $this->createInvoice($orderDetail[ID],
                        $this->getTaxable($this->getNewDiscountedPrice($article[ID])),
                        $this->getNewDiscountedPrice($article[ID]),
                        INVOICE_STATUS_PENDING);
                    break;

                // YEARLY -> set order detail to status PAID for the first
                //           -> generate new order
                //           -> generate new orderDetail  with status ORDER_STATUS_PENDING
                case ORDER_DETAILS_TYPE_YEARLY:
                    // update status
                    parent::updateData($orderDetail[ID], DETTAGLIO_ORDINE, STATUS, ORDER_STATUS_PAID);
                    $this->createInvoice($orderDetail[ID],
                        $this->getTaxable($this->getNewDiscountedPrice($article[ID])),
                        $this->getNewDiscountedPrice($article[ID]),
                        INVOICE_STATUS_PAID);

                    // get total
                    $totalOrder = $article[PREZZO] * $articleInCart[QUANTITA]; // TODO: conto sbagliato!!!!!! e tutti sotto

                    // create new order
                    $newOrderId = $this->createNewOrder(
                        '+12 month',
                        $originalOrder[DATA_ORDINE],
                        $totalOrder,
                        ORDER_STATUS_PENDING,
                        $originalOrder[FORMA_DI_PAG_ID]);

                    // create new order detail with status pending
                    $this->createNewOrderDetail($orderDetail[TIPO], $orderDetail[ARTICOLO_ID], $newOrderId, ORDER_STATUS_PENDING);
                    $this->createInvoice($orderDetail[ID],
                        $this->getTaxable( $this->getNewDiscountedPrice($article[ID])),
                        $this->getNewDiscountedPrice($article[ID]),
                        INVOICE_STATUS_PENDING);
                    break;

                // INSTALLMENT_PAYMENT ->
                //                     ->
                //                     ->
                case ORDER_DETAILS_TYPE_INSTALLMENT_PAYMENT:

                    // update status -> (1/3)
                    parent::updateData($orderDetail[ID], DETTAGLIO_ORDINE, STATUS, ORDER_STATUS_PAID);
                    $this->createInvoice($orderDetail[ID],
                        $this->getTaxable( $this->getNewDiscountedPrice($article[ID])),
                        $this->getNewDiscountedPrice($article[ID]),
                        INVOICE_STATUS_PAID);

                    // get installment by article price and article qty
                    $installment = $article[PREZZO]/3 * $articleInCart[QUANTITA];
                    $newTotal = floatval($originalOrder[TOTALE_ORDINE] - $article[PREZZO] + $installment); // da verificare sconto

                    // update total of order -> set new price
                    parent::updateData($orderId,
                        ORDINE,
                        TOTALE_ORDINE,
                        $newTotal);
                    $originalOrder[TOTALE_ORDINE] = $newTotal;

                    // --------------
                    // create new order 2 -> (2/3)
                    $newOrderId = $this->createNewOrder(
                        '+1 month',
                        $originalOrder[DATA_ORDINE],
                        $installment,
                        ORDER_STATUS_PENDING,
                        $originalOrder[FORMA_DI_PAG_ID]);

                    // carrello: 15, 18
                    // rata = 15/3 * 1 => 5
                    // new tot: 33 - (15 - 5) = 23 - 18 = 5

                    // create new order detail with status pending
                    $this->createNewOrderDetail($orderDetail[TIPO], $orderDetail[ARTICOLO_ID], $newOrderId, ORDER_STATUS_PENDING);

                    // ----------------
                    // create new order 3 -> (3/3)
                    $newOrderId2 = $this->createNewOrder(
                        '+2 month',
                        $originalOrder[DATA_ORDINE],
                        $installment,
                        ORDER_STATUS_PENDING,
                        $originalOrder[FORMA_DI_PAG_ID]);

                    // create new order detail
                    // create new order detail with status pending
                    $this->createNewOrderDetail($orderDetail[TIPO], $orderDetail[ARTICOLO_ID], $newOrderId2, ORDER_STATUS_PENDING);
                    break;
            }
        }

        // update order details status
        $this->updateOrderStatusToPaid($orderId);
    }

    public function notifyNewSale($orderId) {

        // get order details
        $orderDetails = $this->loadOrderDetails($orderId);
        foreach ($orderDetails as $orderDetail) {

            // update quantity
            $articleInStock = $this->getArticlesInStockByArticle($orderDetail[ARTICOLO_ID]);
            if (isset($articleInStock) && !empty($articleInStock)) {

                // if is one article
                if (isset($articleInStock[ID])) { // strano controllo
                    $this->updateQtyArticleInStock($articleInStock[ID], max($articleInStock[QUANTITA] - 1, 0));
                } else {
                    // more than one
                    $firstArticleInStock = $articleInStock[0];
                    $this->updateQtyArticleInStock($firstArticleInStock[ID], max($firstArticleInStock[QUANTITA] - 1, 0));
                }

                // get article & article in cart
                $article = parent::getRecord(ARTICOLO, "Id = " . $orderDetail[ARTICOLO_ID]);
                $articleInCart = parent::getRecord(ARTICOLO_IN_CARRELLO, "Articolo_id = " . $article[ID]);

                // get claim of seller
                $seller = parent::getRecord(UTENTE, "Id = " . $article[UTENTE_ID]);
                $sellerClaim = parent::getRecord(CLAIM, "Id = " . $seller[CLAIM_ID]);

                // update amount seller
                if ($orderDetail[TIPO] !== ORDER_DETAILS_TYPE_INSTALLMENT_PAYMENT) {
                    parent::updateData($sellerClaim[ID],
                        CLAIM,
                        CONTO,
                        floatval($article[PREZZO] * $articleInCart[QUANTITA]));
                } else {
                    parent::updateData($sellerClaim[ID],
                        CLAIM,
                        CONTO,
                        floatval($article[PREZZO]/3 * $articleInCart[QUANTITA]));
                }
            } else {
                echo 'Non è stato trovato nessun articolo';
            }
        }
    }

    private function updateQtyArticleInStock($articleInStockId, $newQuantity){
        parent::updateData($articleInStockId, ARTICOLO_IN_MAGAZZINO, QUANTITA, $newQuantity);
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

    public function loadInvoices(): array|int|string
    {
        return parent::execute("SELECT f.* 
                FROM Fattura f
                JOIN Dettaglio_ordine do ON f.Dettaglio_ordine_id = do.Id
                JOIN Articolo a ON do.Articolo_id = a.Id
                WHERE a.Utente_id = " . $this->getCurrentUser()[ID]);
    }

    /**
     * Load order details by order id
     * @param $orderId
     * @return array|int|string
     */
    public function loadOrderDetails($orderId): array|int|string
    {
        $where = "Ordine_id = " . $orderId;
        $query = "SELECT * FROM Dettaglio_ordine WHERE $where";
        return parent::execute($query);
    }

    /**
     * Get order detail by id
     * @param $orderDetailId
     * @return array|int|string
     */
    public function getOrderDetail($orderDetailId): array|int|string
    {
        $where = "Id = " . $orderDetailId;
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
        }
        return $articlesInStock;
    }

    /**
     * Get articles in stock by article id
     * @param int $articleId
     * @return array|null articles in stock by article id
     */
    public function getArticlesInStockByArticle(int $articleId) : array|null
    {
        return parent::getRecord(ARTICOLO_IN_MAGAZZINO, ARTICOLO_ID . " = " . $articleId);
    }


    /**
     * Get
     * @param $startTime
     * @param $endTime
     * @return int
     */
    public function getOrdersQuantityInRangeDateTime($startTime, $endTime) : int
    {
        $query = 'SELECT COUNT(DISTINCT o.Id) AS numero_ordini
                    FROM Ordine o
                    JOIN Dettaglio_ordine do ON o.Id = do.Ordine_id
                    JOIN Articolo_in_carrello ac ON do.Articolo_id = ac.Articolo_id
                    JOIN Articolo a ON ac.Articolo_id = a.Id
                    WHERE a.Utente_id = ' . $this->getCurrentUser()[ID] . '
                      AND o.Data_ordine >= ' . $startTime . '
                      AND o.Data_ordine <= ' . $endTime;
        $res = $this->execute($query);
        return $res[0]['numero_ordini'];
    }

    /**
     *
     *
     * @return int
     */
    public function getOrdersQuantity() : int
    {
        $query = 'SELECT COUNT(DISTINCT o.Id) AS numero_ordini
                    FROM Ordine o
                    JOIN Dettaglio_ordine do ON o.Id = do.Ordine_id
                    JOIN Articolo_in_carrello ac ON do.Articolo_id = ac.Articolo_id
                    JOIN Articolo a ON ac.Articolo_id = a.Id
                    WHERE a.Utente_id = ' . $this->getCurrentUser()[ID];
        $res = $this->execute($query);
        return $res[0]['numero_ordini'];
    }



    /**
     * Get option by id
     * @param $optionId
     * @return array
     */
    public function getOptionById($optionId) : array
    {
        $query = "Id = " . $optionId;
        $record = parent::getRecord(OPZIONE_VARIAZIONE, $query);

        if ($record != null)
        {
            return $record;
        }
        else{
            return [];
        }
    }

    /**
     * Get variation by id
     * @param $variationId
     * @return array
     */
    public function getVariationById($variationId) : array
    {
        $query = "Id = " . $variationId;
        $record = parent::getRecord(OPZIONE_VARIAZIONE, $query);

        if ($record != null)
        {
            return $record;
        }
        else{
            return [];
        }
    }

    public function addArticleInStockQuantity ($articleInStockId, $quantity) : void
    {
        parent::updateDateWithWhere(ARTICOLO_IN_MAGAZZINO, QUANTITA, $quantity,
            ID . ' = ' . $articleInStockId[ID]);
    }

    public function getWarehousesExpectParam($warehouseId) : array
    {
        $queryCondition = ID . ' != ' . $warehouseId;
        $warehouses = parent::getRecord(MAGAZZINO, $queryCondition);
        if (!empty($warehouses)) {
            return $warehouses;
        }
        return [];
    }

    /**
     * Get address by id
     * @param $addressId
     * @return array
     */
    public function getAddress($addressId) : array
    {
        return parent::getRecord(INDIRIZZO, 'Id = ' . $addressId);
    }

//    public function getArticleIdByConfigurationsAndProduct($productId, $optionsVariation) : int
//    {
//        $ArticleIdFound = null;
//        $query = 'SELECT
//                        DISTINCT a.Id
//                    FROM
//                        Articolo a
//                    JOIN Configurazione_variazione cv ON
//                        a.Id = cv.Articolo_id
//                    JOIN Opzione_variazione ov ON
//                        cv.Opzio_variazione_id = ov.Id
//                    WHERE
//                        a.Prodotto_id = 24 AND(';
//        for ($i = 0; $i < count($optionsVariation); $i++) {
//            if ($i != 0) {
//                $query = $query . ' OR ';
//            }
//            $query = $query . 'ov.Valore = ' . $optionsVariation[$i][VALORE];
//        }
//
//                           // ov.Valore = ' . ' OR ov.Valore = Nero
//                        //)';
//
//    }
    public function getNumberOrderOfArticleForCurrentUser($articleId): int
    {
        $res = parent::execute("SELECT COUNT(*) AS numero_ordini
                                    FROM Ordine o
                                    JOIN Dettaglio_ordine d_o ON o.Id = d_o.Ordine_id
                                    WHERE d_o.Articolo_id = " . $articleId . " 
                                        AND o.Id IN (
                                            SELECT Id
                                            FROM Forma_di_pagamento
                                            WHERE Utente_id = ". $this->getCurrentUser()[ID] . ")");
        return $res[0]['numero_ordini'];
    }

    public function isDiscountArticle($articleId): bool
    {
        return $this->getNumberOrderOfArticleForCurrentUser($articleId) > 2;
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

    /**
     * @param $orderDetailsId
     * @param $params
     * @return int|array|string new record in RECENSIONE
     */
    public function addReview($orderDetailsId, $params): int|array|string
    {
        $queryInsertReview = "INSERT INTO `Recensione` (Valutazione, Commento, Dettaglio_ordine_id, Utente_id, Prodotto_id, Status)
                                VALUES (?, ?, ?, ?, ?, ?) ";
        return $this->insertData($queryInsertReview,
            $params[VALUTAZIONE],
            $params[COMMENTO],
            $orderDetailsId,
            $this->getCurrentUser()[ID],
            $params[PRODOTTO_ID],
            STATUS_INTACT_DATA);
    }

    /**
     * @param $orderDetailId
     * @param $params
     * @return int|array|string new record in RESO
     */
    public function addArticleGiveBack($orderDetailId, $params): int|array|string
    {
        $queryInsertArticleGiveBack = "INSERT INTO `Reso` (Dettaglio_ordine_id, Motivo, Descrizione, Status)
                                    VALUES (?, ?, ?, ?)";
        return $this->insertData($queryInsertArticleGiveBack,
            $orderDetailId,
            $params[MOTIVO],
            $params[DESCRIZIONE],
            STATUS_INTACT_DATA
        );
    }

    /**
     * Insert article in stock
     * @param $quantityToEdit
     * @param $articleId
     * @param $warehouseId
     * @return bool
     */
    public function insertArticleInStock($quantityToEdit, $articleId, $warehouseId) : bool
    {
        $query = 'INSERT INTO Articolo_in_magazzino (Quantità, Articolo_id, Magazzino_id, Status)
                                VALUES (?, ?, ?, ?)';
        $res = parent::insertData($query,
            $quantityToEdit,
            $articleId,
            $warehouseId,
            STATUS_INTACT_DATA
        );
        $result = parent::isInsertSuccessful(ARTICOLO_IN_MAGAZZINO, $res);
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * Update article in stock quantity
     * @param $quantityToEdit
     * @param $articleInStockId
     * @return void
     */
    public function updateQuantityArticleInStock($quantityToUpdate, $articleInStockId)  : void
    {
        $articleInStockToUpdate = parent::getRecord(ARTICOLO_IN_MAGAZZINO, ID . ' = ' . $articleInStockId);
        parent::updateData($articleInStockId, ARTICOLO_IN_MAGAZZINO, QUANTITA, $quantityToUpdate);
    }

    /**
     * Delete
     * @param $articleInStockId
     * @return void
     */
    public function deleteArticleInStock($articleInStockId) : void
    {
        parent::deleteRecord(ARTICOLO_IN_MAGAZZINO, ID . ' = ' . $articleInStockId);
    }

    public function getWarehouseTax($warehouseId) {

        // get warehouse & tax
        $warehouse = parent::getRecord(MAGAZZINO, "Id = " . $warehouseId);

        // get qty
        $quantity = $this->getArticlesInStockQuantity($warehouseId);

        // switch by claim
        $claimType = $this->getClaimTypeFromId($this->getCurrentUser()[CLAIM_ID]);
        switch ($claimType) {
            case CLAIM_SELLER_DESC:
                return $quantity * $warehouse[TASSA];

            case CLAIM_SELLER_PR0_DESC:
                return $quantity * $warehouse[TASSA]/2;
        }
    }

    public function getAllWarehouseTax(): float
    {
        $total = 0.0;
        $warehousesId = parent::execute("SELECT Id FROM Magazzino");
        for ($i = 0; $i < count($warehousesId); $i++) {
            $id = $warehousesId[$i][ID];
            $total += floatval($this->getWarehouseTax($id));
        }
        return $total;
    }

    public function getQuantityArticlesInStockByArticle($articleId): int
    {
        $total = 0;
        // $articlesInStock = parent::getRecord(ARTICOLO_IN_MAGAZZINO, "Articolo_id = ". $articleId);
        $articlesInStock = parent::execute("SELECT * FROM Articolo_in_magazzino WHERE Articolo_id = " . $articleId);

        if (!empty($articlesInStock)) {
            foreach ($articlesInStock as $articleInStock) {
                $total += $articleInStock[QUANTITA];
            }
        }
        return $total;
    }

    /**
     * Check quantity to update
     * @param $articleInStockQuantity
     * @param $quantityToUpdate
     * @return bool
     */
    public function checkArticleInStockQuantity($articleInStockQuantity, $quantityToUpdate) : bool
    {
        if ($articleInStockQuantity >= $quantityToUpdate) {
            return true;
        }
        return false;
    }
}
