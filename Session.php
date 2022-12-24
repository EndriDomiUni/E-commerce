<?php

require_once("./config/AppConstants.php");

class Session{
    private int $id;
    private string $typeUser;

    public __construct($id, $typeUser) {
        $this->id = $id;
        $this->typeUser = $typeUser;
    }

    public function checkSessionId($id){
        try{
            $dbh = new Dbh();
            if (isset($id))
            {
                $response = $dbh->execute("SELECT * FROM `$userType` WHERE Id = '$id' ");
                if (is_int($response[0]["Id"])) {
                    setSessionUser($response[0]);
                }
            }
        } catch (Exception $ex){
            echo $ex->getMessage();
        }
    }

    public function setSessionUser($params){
        $_SESSION['Id'] = $response["Id"];
        $_SESSION['Nome'] = $response["Nome"];
        $_SESSION['Cognome'] = $response["Cognome"];
        $_SESSION['Email'] = $response["Email"];
        $_SESSION['Password'] = $response["Password"];
        if ($this->typeUser == SELLER){
            $_SESSION['Ragione_Sociale'];
            $_SESSION['P_IVA'];
        }

    }

    public function notifyActionResult($msg, $attribute){
        echo '<script type="text/javascript">notifyAlert('$msg', '$attribute')</script>';
    }

    public function getCurrentUser(){
        $user = array(
            "Id"=>$_SESSION['Id'],
            "Nome"=>$_SESSION['Nome'],
            "Cognome"=>$_SESSION['Cognome'],
            "Email"=>$_SESSION['Email'],
            "Password"=>$_SESSION['Password'],
        );
        if ($this->typeUser == SELLER){
            $user = array_push(
                $user, 
                "Ragione_Sociale"=>$_SESSION['Ragione_Sociale'],
                "P_IVA"=>$_SESSION['P_IVA']);
        }
        return $user;
    }

}