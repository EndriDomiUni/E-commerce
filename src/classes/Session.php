<?php

use utility\Utils;

require_once("./config/AppConstants.php");
require_once("./src/utility/Utils.php");

class Session
{
    private readonly int $id; // $_SESSION["Id"];
    private Dbh $dbh;
    private int $cartId;

    /**
     * @throws Exception
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->dbh = new Dbh();

        if ($this->checkSessionId($this->id)) {
            if($this->bindCartWithUser()) {
                $cart = new Cart($this->id);
                $this->cartId = $cart->getCartByUserId($this->id);
            }
        }
    }

    public function checkSessionId($id): bool
    {
        if (isset($this->id)) {
            $response = $this->dbh->execute("SELECT * FROM Utente WHERE Id = '$id' ");
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

    public function __toString(): string
    {
        return $this->getCurrentUser();
    }

    public function insertCardPayModInformation($params): bool
    {
        $query = "INSERT INTO forma_di_pagamento (Circuito, Numero_carta, Data_scadenza, CV2, Status, Utente_id)
            VALUES (?, ?, ?, ?, ?, ?)";
        $res = $this->dbh->insertData($query,
            $params[CIRCUITO],
            $params[NUMERO_CARTA],
            $params[DATA_SCADENZA],
            $params[CV2],
            $params[STATUS],
            $this->getCurrentUser()[ID]);
        return Utils::checkResponse($res);
    }

    /**
     * @throws Exception
     */
    public function insertAddressInformation($params): bool
    {
        $query = "INSERT INTO Indirizzo (Via, Numero_civico, Citta, CAP, Status)
            VALUES (?, ?, ?, ?, ?)";
        $res = $this->dbh->insertData($query,
            $params[VIA],
            $params[NUMERO_CIVICO],
            $params[CITTA],
            $params[CAP],
            $params[STATUS]);
        $this->associatesUserInSessionAddress($res);
        return Utils::checkResponse($res);
    }

    public function changeClaim($params): bool
    {
        return Utils::issetSessionId()
            &&
            $this->dbh->updateData($this->getCurrentUser()[ID],
                UTENTE,
                CLAIM_ID,
                $params[CLAIM_ID])
            &&
            $this->dbh->updateData($this->getCurrentUser()[ID],
                UTENTE,
                STATUS,
                $params[STATUS]);
    }

    /**
     * @throws Exception
     */
    private function associatesUserInSessionAddress($addressId): void
    {
        if (Utils::issetSessionId()) {
            if ($this->getCurrentUser()[ID] && $this->getCurrentUser()[CLAIM_ID]) {
                $this->dbh->updateData($_SESSION[ID], UTENTE, INDIRIZZO_ID, $addressId);
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
        if (Utils::issetSessionId()) {
            $query = "INSERT INTO carrello (Utente_id, Status)
            VALUES (?, ?)";
            $res = $this->dbh->insertData($query,
                $this->getCurrentUser()[ID],
                STATUS_INTACT_DATA);
            return Utils::checkResponse($res);
        }else {
            throw new Exception("session id doesn't exist");
        }
    }
}
