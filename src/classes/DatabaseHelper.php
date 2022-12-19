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

    public function signin($params)
    {
        if (validateParams($params)) {
        }
    }

    /**
     * It returns true if all the values in the array are not empty, otherwise it returns false
     * 
     * @param params An array of parameters to validate.
     * 
     * @return a boolean value.
     */
    function validateParams($params): bool
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
