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
        if ($this->checkSessionId($this->id)) {
            $claimType = $this->getClaimTypeFromId($this->id);
            if ($claimType === CLAIM_USER_DESC || $claimType === CLAIM_USER_PRO_DESC) {
                $this->bindCartWithUser();
            }
        }
    }

    public function checkSessionId($id): bool
    {
        if (isset($this->id)) {
            $response = parent::execute("SELECT * FROM Utente WHERE Id = '$id' ");
            if (is_int($response[0]["Id"])) {
                $this->setSessionUser($response[0]);
                $user = $this->getCurrentUser();
                return $user["Id"] > 0;
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
            INDIRIZZO_ID => $_SESSION[INDIRIZZO_ID]
        ];
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
            $params[TIPO_DI_PAGAMENTO],
            $this->getCurrentUser()[ID],
            $params[STATUS]);
        return UtilsFunctions::checkResponse($res) ? $res : null;
    }

    /**
     * @throws Exception
     */
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

    public function generateOrder($params) {
        // id, Data_ordine, Tot_ordine, Status, Metodo_di_spedizione, Forma_di_pagamento

    }

    /**
     * @throws Exception
     */
    private function associatesUserInSessionAddress($addressId): void
    {
        if (UtilsFunctions::issetSessionId()) {
            if ($this->getCurrentUser()[ID] && $this->getCurrentUser()[CLAIM_ID]) {
                parent::updateData($_SESSION[ID], UTENTE, INDIRIZZO_ID, $addressId);
            }
        } else {
            throw new Exception("session id doesn't exist");
        }
    }


    private function bindCartWithUser(): void
    {
        if (UtilsFunctions::issetSessionId()) {
            $query = "INSERT INTO carrello (Utente_id, Status)
            VALUES (?, ?)";
            parent::insertData($query,
                $this->getCurrentUser()[ID],
                STATUS_INTACT_DATA);
        }
    }

    public function getClaimTypeFromId($id): ?string
    {
        $res = parent::execute("SELECT * FROM Claim WHERE Id = '$id' ");
        return $res ? $res[0][DESCRIZIONE] : "";
    }

    public function insertProduct($params)
    {
        if (UtilsFunctions::checkParams($params)) {
            $dimensionId = null;
            $nome = $params[NOME];
            $descrizione = $params[DESCRIZIONE];
            $immagine = $params[IMMAGINE];
            $dimensionId = null;
            $categoriaId = $params[CATEGORIA_ID];
            $dim_x = $params[DIMENSIONE_X_PRODOTTO];
            $dim_y = $params[DIMENSIONE_Y_PRODOTTO];
            $dim_z = $params[DIMENSIONE_Z_PRODOTTO];
            if (parent::checkDimension($dim_x, $dim_y, $dim_y))
            {
                $query = "INSERT INTO `Dimensione` (`Dim_X`, `Dim_Y`, `Dim_Z`) 
                    VALUES (?, ?, ?)";
                $res = $this->insertData($query, $dim_x, $dim_y, $dim_z);
                if (UtilsFunctions::checkResponse($res))
                {
                    $dimensionId = parent::getDimensionIdByParameters($dim_x, $dim_y, $dim_z);
                }
                else
                {
                    // Errore
                }
            }
            $dimensionTableName = "Dimensione";
            $getDimensionIdCondition = "Dim_X = $dim_x AND Dim_Y = $dim_y AND Dim_Z = $dim_z";
            $dimensionId = $this->selectSpecificField($dimensionTableName, ID, $getDimensionIdCondition);
            echo "Dimension Id: ".$dimensionId."</br>";
            $status = 1;
            $insertProductQuery = "INSERT INTO `Prodotto` (`Nome`, `Descrizione`, `Immagine`, `Dim_id`, `Categoria_id`, `Status`)
                VALUES (?, ?, ?, ?, ?, ?)";
            $res = $this->insertData($insertProductQuery,
                $nome,
                $descrizione,
                $immagine,
                $dimensionId,
                $categoriaId,
                $status);
            if (UtilsFunctions::checkResponse($res))
            {
                return $res;
            }
        }
        return false;
    }

    public function loadArticlesByUserId($userId): array|int|string
    {
        $where = "Utente_id = $userId";
        $query = "SELECT * FROM Articolo WHERE $where";
        return parent::execute($query); // should return an array
    }

    public function loadArticlesInCart($cartId): string|int|array
    {
        if ($this->getClaimTypeFromId($this->getCurrentUser()[CLAIM_ID]) === CLAIM_USER_DESC
            || $this->getClaimTypeFromId($this->getCurrentUser()[CLAIM_ID]) === CLAIM_USER_PRO_DESC) {

            $where = "Carrello_id = $cartId";
            $query = "SELECT * FROM Articolo_in_carrello WHERE $where";
            return parent::execute($query); // should return an array
        }
        return "CLAIM incorrect";
    }

    public function addArticle($params){

        if (UtilsFunctions::checkParams($params)) {
            echo "add article in Session</br>";
            $prezzo = $params[PREZZO];
            $utente_id = $params[UTENTE_ID];
            $prodotto_id = $params[PRODOTTO_ID];
            $status = 1;
            $insertArticleQuery = "INSERT INTO `Articolo` (`Prezzo`, `Utente_id`, `Prodotto_id`, `Status`)
                VALUES (?, ?, ?, ?)";
            $res = $this->insertData($insertArticleQuery,
                $prezzo,
                $utente_id,
                $prodotto_id,
                $status);
            echo "response after add article attempt: ".$res."</br>";
            if (UtilsFunctions::checkResponse($res))
            {
                return $res;
            }
        }
    }

    public function addConfigurationArticle($params) : int
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
        $query = "INSERT INTO Articolo_in_magazzino (Tassa, Data_inizio, Data_fine, Articolo_id, Magazzino_id, Status )
            VALUES (?, ?, ?, ?, ?, ?)";
        echo "sono qui";

        $res = parent::insertData($query,
            $params[TAX],
            $params[DATA_INIZIO],
            $params[DATA_FINE],
            $params[ARTICOLO_ID],
            $params[MAGAZZINO_ID],
            STATUS_MODIFIED_DATA);
        return UtilsFunctions::checkResponse($res) ? $res : 0;
    }

}
