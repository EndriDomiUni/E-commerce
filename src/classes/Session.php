<?php

use utility\UtilsFunctions;

require_once("./src/classes/Cart.php");

class Session extends Dbh
{
    private readonly int $id; // $_SESSION["Id"];
    private int $cartId;


    public function __construct($id)
    {
        parent::__construct();
        $this->id = $id;
        if ($this->checkSessionId($this->id)) {
           /* if($this->bindCartWithUser()) {
                $cart = new Cart($this->id);
                $this->cartId = $cart->getCartByUserId($this->id);
            }*/
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

    public function changeClaim($params): bool
    {
        return UtilsFunctions::issetSessionId()
            &&
            parent::updateData($this->getCurrentUser()[ID],
                UTENTE,
                CLAIM_ID,
                $params[CLAIM_ID])
            &&
            parent::updateData($this->getCurrentUser()[ID],
                UTENTE,
                STATUS,
                $params[STATUS]);
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

    /**
     * @throws Exception
     */
    private function bindCartWithUser(): bool
    {
        if (UtilsFunctions::issetSessionId()) {
            $query = "INSERT INTO carrello (Utente_id, Status)
            VALUES (?, ?)";
            $res = parent::insertData($query,
                $this->getCurrentUser()[ID],
                STATUS_INTACT_DATA);
            return UtilsFunctions::checkResponse($res);
        }else {
            throw new Exception("session id doesn't exist");
        }
    }

    public function getClaimTypeFromId($id): ?string
    {
        $res = parent::execute("SELECT * FROM Claim WHERE Id = '$id' ");
        return $res[0][DESCRIZIONE];
    }

    public function insertProduct($params)
    {
        if (Utils::checkParams($params)) {
            $dimensionId = null;
            $nome = $params[NOME];
            $descrizione = $params[DESCRIZIONE];
            $immagine = $params[IMMAGINE];
            $dimensionId = null;
            $categoriaId = $params[CATEGORIA_ID];
            $dim_x = $params[DIMENSIONE_X_PRODOTTO];
            $dim_y = $params[DIMENSIONE_Y_PRODOTTO];
            $dim_z = $params[DIMENSIONE_Z_PRODOTTO];
            if (parent::checkDimension($params["Dim_x"], $params["Dim_y"], $params["Dim_z"]))
            {
                $query = "INSERT INTO `Dimensione` (`Dim_X`, `Dim_Y`, `Dim_Z`, `Timestamp`) 
                    VALUES ('$dim_x', '$dim_y', '$dim_z', current_timestamp())";
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
            $dimensionTableName = `Dimensione`;
            $getDimensionIdCondition = "Dim_X = '$dim_x AND Dim_Y = '$dim_y AND Dim_Z = '$dim_z'";
            $dimensionId = $this->selectSpecificField($dimensionTableName, ID, $getDimensionIdCondition);
            $insertProductQuery = "INSERT INTO `Prodotto` (`Nome`, `Descrizione`, `Immagine`, `Dim_id`, `Categoria_id`)
                VALUES (?, ?, ?, ?, ?)";
            $res = $this->insertData($insertProductQuery,
                $nome,
                $descrizione,
                $immagine,
                $dimensionId,
                $categoriaId);
            if (UtilsFunctions::checkResponse($res))
            {
                return $res;
            }
        }
        return false;
    }
    /*
    private function insertProductBySeller($params): bool
    {
        $query = "INSERT INTO Prodotto (Nome, Descrizione, Immagine, Dimensione_id, Categoria_id,Status)
            VALUES (?, ?, ?, ?, ?)";
        $res = $this->dbh->insertData($query,
            $params[NOME],
            $params[DESCRIZIONE],
            $params[IMMAGINE],
            $params[DIMENSIONE_ID],
            $params[CATEGORIA_ID]);
        
        return Utils::checkResponse($res);
    }
    */
}
