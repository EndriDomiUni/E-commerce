<?php
require_once("database.php");


abstract class DatabaseHelper
{

    protected $database;

    public function __construct()
    {
        $this->database = new Database(SERVER, USERNAME, PASSWORD, DBNAME, PORT, CHARSET);
    }

    /**
     * return all record
     */
    abstract function getAll();

    /**
     * It gets a costumer by its id
     * 
     * @param id The id of the costumer you want to get.
     * 
     * @return int costumer with the id that is passed as a parameter.
     */
    public function getCostumerById($id)
    {
        $sql = "SELECT * FROM cliente WHERE Id = ?";
        $paramsList = [$id];
        $queryRes = $this->db->execute($sql, ...$paramsList)[0];
        return $queryRes;
    }

    /**
     * It gets a seller by id
     * 
     * @param id the id of the seller
     * 
     * @return int seller with the given id.
     */
    public function getSellerById($id)
    {
        $sql = "SELECT * FROM venditore WHERE Id = ?";
        $paramsList = [$id];
        $queryRes = $this->db->execute($sql, ...$paramsList)[0];
        return $queryRes;
    }

    /**
     * It inserts a new user in the database
     * 
     * @param userType the type of user that is signing in.
     * @param params array of parameters
     */
    public function signin($userType, $params)
    {
        $allcorrect = true;
        $response_array = [];

        if (!$this->validateParams($params)) {
            $msg = 'Inserire tutti i campi';
        }

        if ($userType == COSTUMER) {
            if (!$this->checkEmail(COSTUMER, $params['Email'])) {
                $allcorrect = false;
                $msg = 'Esiste un altro account con la stessa email.';
            } else {
                $response = $this->database->execute(
                    "INSERT INTO cliente (Nome, Cognome, Email, Password, Status) 
                    VALUES (?, ?, ?, ?, ?)",
                    $params['Nome'],
                    $params['Cognome'],
                    $params['Email'],
                    $params['Password'],
                    ACTIVE
                );

                if (is_int($response)) {
                    $msg = "Iscrizione correttamente effettuata.";
                } else {
                    $allcorrect = false;
                    $msg = $response;
                }
            }
        }

        if ($userType == SELLER) {
            if (!$this->checkEmail(SELLER, $params['Email'])) {
                $allcorrect = false;
                $msg = 'Esiste un altro account venditore con la stessa email.';
            } else {
                $response = $this->database->execute(
                    "INSERT INTO venditore (Nome, Cognome, Ragione Sociale, Email, Password, P. IVA, Status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)",
                    $params['Nome'],
                    $params['Cognome'],
                    $params['Ragione Sociale'],
                    $params['Email'],
                    $params['P. IVA'],
                    ACTIVE
                );

                if (is_int($response)) {
                    $msg = "Iscrizione correttamente effettuata.";
                } else {
                    $allcorrect = false;
                    $msg = $response;
                }
            }
        }

        $response_array["Status"] = $allcorrect ? OK : ERROR;
        $response_array["msg"] = $msg;
        return $response_array;
    }


    /**
     * It takes an array of parameters and returns true if all of them are not empty
     * 
     * @param params An array of parameters to validate.
     * 
     * @return a boolean value.
     */
    private function validateParams($params)
    {
        foreach ($params as $value) {
            if (empty($value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Returns:
     *      0 if doesnt exists
     *      another number if exists
     */
    private function checkEmail($userType, $email)
    {
        return count($this->db->execute("SELECT * FROM `?` WHERE Email = ? ", $userType, $email)) == 0;
    }
}
