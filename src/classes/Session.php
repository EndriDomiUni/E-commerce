<?php

require_once("./config/AppConstants.php");

class Session
{
    private int $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function checkSessionId($id): bool
    {
        $dbh = new Dbh();
        if (isset($id)) {
            $response = $dbh->execute("SELECT * FROM Utente WHERE Id = '$id' ");
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
        $_SESSION['Id'] = $params["Id"];
        $_SESSION['Nome'] = $params["Nome"];
        $_SESSION['Cognome'] = $params["Cognome"];
        $_SESSION['Email'] = $params["Email"];
        $_SESSION['Password'] = $params["Password"];
        $_SESSION['Status'] = $params["Status"];
        $_SESSION['Claim_id'] = $params["Claim_id"];
        $_SESSION['Indirizzo_id'] = $params["Indirizzo_id"];
    }

    public function getCurrentUser(): array|int
    {
        return array(
            "Id" => $_SESSION['Id'],
            "Nome" => $_SESSION['Nome'],
            "Cognome" => $_SESSION['Cognome'],
            "Email" => $_SESSION['Email'],
            "Password" => $_SESSION['Password'],
            "Status" => $_SESSION['Status'],
            "Claim_id" => $_SESSION['Claim_id'],
            "Indirizzo_id" => $_SESSION['Indirizzo_id']
        );
    }

    public function __toString(): string
    {
        return "Id: " . $this->id;
    }

}
