<?php

use utility\Utils;

require_once("./config/AppConstants.php");
require_once("./src/utility/Utils.php");

class Session
{
    private int $id;
    private Dbh $dbh;

    public function __construct($id)
    {
        $this->id = $id;
        $this->dbh = new Dbh();
    }

    public function checkSessionId($id): bool
    {
        if (isset($id)) {
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
        return array(
            ID => $_SESSION[ID],
            NOME => $_SESSION[NOME],
            COGNOME => $_SESSION[COGNOME],
            EMAIL => $_SESSION[EMAIL],
            PASSWORD => $_SESSION[PASSWORD],
            STATUS => $_SESSION[STATUS],
            CLAIM_ID => $_SESSION[CLAIM_ID],
            INDIRIZZO_ID => $_SESSION[INDIRIZZO_ID]
        );
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
        $this->associatesUserInSessionAddress();
        return Utils::checkResponse($res);
    }

    public function changeClaim($params): bool
    {
        return $this->dbh->updateData($this->getCurrentUser()["Id"],
                UTENTE,
                CLAIM_ID,
                $params[CLAIM_ID])
            &&
            $this->dbh->updateData($this->getCurrentUser()["Id"],
                UTENTE,
                STATUS,
                $params[STATUS]);
    }

    private function associatesUserInSessionAddress($addressId): void
    {
        if (Utils::issetSessionId()) {
            if ($this->getCurrentUser()[ID] && $this->getCurrentUser()[CLAIM_ID]) {
                $this->dbh->updateData($_SESSION[ID], UTENTE, INDIRIZZO_ID, $addressId);
            }
        }
    }
}
