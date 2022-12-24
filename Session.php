<?php

require_once("./config/AppConstants.php");

class Session
{
    private int $id;
    private string $typeUser;

    public function __construct($id, $typeUser)
    {
        try {
            $this->id = $id;
            $this->typeUser = $typeUser;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function checkSessionId($id): bool
    {
        $dbh = new Dbh();
        if (isset($id))
        {
            $response = $dbh->execute("SELECT * FROM $this->typeUser WHERE Id = '$id' ");
            if (is_int($response[0]["Id"])) {
                $this->setSessionUser($response[0]);
                return true;
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
        if ($this->typeUser == SELLER){
            $_SESSION['Ragione_Sociale'];
            $_SESSION['P_IVA'];
        }
    }

    public function notifyActionResult($msg, $attribute): void
    {
        echo "<script type=text/javascript >";
        echo "let alert = document.createElement(" . "div" . ")";
        echo "alert.innerHTML = '<div class=" . "alert alert-" . $attribute .'" role="alert">'. $msg . '</div>';
        echo "</script>";
    }

    public function getCurrentUser(): array|int
    {
        $user = array(
            "Id"=>$_SESSION['Id'],
            "Nome"=>$_SESSION['Nome'],
            "Cognome"=>$_SESSION['Cognome'],
            "Email"=>$_SESSION['Email'],
            "Password"=>$_SESSION['Password'],
        );
        if ($this->typeUser == SELLER){
            $seller = array(
                "Ragione_Sociale"=>$_SESSION['Ragione_Sociale'],
                "P_IVA"=>$_SESSION['P_IVA']
            );
            $user = array_push($user, $seller);
        }
        return $user;
    }

    private function drawAlert() {

    }
}