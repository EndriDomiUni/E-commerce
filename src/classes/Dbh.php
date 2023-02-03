<?php

// These two lines are used for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

use utility\UtilsFunctions;

include("./config/AppConstants.php");
include("./src/classes/Session.php");
include("./src/utility/UtilsFunctions.php");

class Dbh
{
    protected mysqli $connection;

    public function __construct($dbhost = 'localhost', $dbuser = 'root', $dbpass = '', $dbname = 'e-commerce', $charset = 'utf8')
    {
        try {
            $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
            if ($this->connection->connect_error) {
                echo "Connection failed: " . $this->connection->connect_error;
            }
            $this->connection->set_charset($charset);
        } catch (\Exception $e) {
            echo "[Dbh:26] Sono qui";
            echo "Connection failed: " . mysqli_connect_error();;
        }
    }

    /**
     * It returns a string that represents the type of the variable passed to it
     *
     * @param $var
     * @return string The type of the variable.
     */
    private function getType($var): string
    {
        if (is_string($var)) return 's';
        if (is_float($var)) return 'd';
        if (is_int($var)) return 'i';
        return 'b';
    }

    /**
     * It executes a query and returns the result
     *
     * @param $sql
     * @param ...$params
     * @return array|int|string The result of the query.
     */
    public function execute($sql, ...$params): array|int|string
    {
        $types = "";
        foreach ($params as $par) {
            $types .= $this->getType($par);
        }

        if ($stmt = $this->connection->prepare($sql)) {
            if ($types != "")
                if (!$stmt->bind_param($types, ...$params)) {
                    return "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
                }
            if (!$stmt->execute()) {
                return "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            }
            if ($stmt->errno == 0) {
                $result = $stmt->get_result();
                if (!$result) {
                    return $this->connection->insert_id; // here -> no error
                }
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                return "Errore" . $stmt->errno;
            }
        } else {
            return 'Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error;
        }
    }

    /**
     * Returns:
     *      0 if it doesn't exist
     *      another number if exists
     */
    private function checkEmail($email): bool
    {
        return count($this->execute("SELECT * FROM `Utente` WHERE Email = '$email' ")) == 0;
    }


    public function getDimensionIdByParameters($dim_x, $dim_y, $dim_z) : array
    {
        return $this->execute("SELECT Id FROM `Dimensione` 
            WHERE Dim_X = $dim_x AND Dim_Y = $dim_y AND Dim_Z = $dim_z");
    }

    public function getVariationsByCategoryId($categoryId) : array
    {
        return $this->execute("SELECT * FROM `Variazione`
            WHERE Categoria_id = '$categoryId'");
    }

    public function getOptionsByVariationId($variationId) : array
    {
        return $this->execute("SELECT * FROM `Opzione_variazione`
            WHERE Variazione_Id = '$variationId'");
    }

    /**
     * @param $dim_x
     * @param $dim_y
     * @param $dim_z
     * @return true if it doesn't exit
     * @return false if it exists
     */
    public function checkDimension($dim_x, $dim_y, $dim_z): bool
    {
        return count($this->execute("SELECT * FROM `Dimensione` 
         WHERE `Dim_X`=$dim_x AND `Dim_Y`=$dim_y AND `Dim_Z`=$dim_z")) == 0;
    }


    /**
     * It takes an array of parameters, checks if they are all set, then checks if the email is already
     * in use, and if not, it inserts the data into the database
     *
     * @param $params
     * @return array|int|string|void|null result of the query, if the query is successful, otherwise it returns null.
     */
    public function register($params) {
        if (UtilsFunctions::checkParams($params)) {
            if (!$this->checkEmail($params["Email"])) {
                return "Esiste già un account con le stesse credenziali";
            } else {
                $claimType = $params[CLAIM_TYPE];
                $claimId = $this->generateClaim($claimType);

                $query = "INSERT INTO Utente (Nome, Cognome, Email, Password, Claim_id, Indirizzo_id, Status) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $resp = $this->insertData($query,
                    $params[NOME],
                    $params[COGNOME],
                    $params[EMAIL],
                    $params[PASSWORD],
                    $claimId,
                    $params[INDIRIZZO_ID],
                    $params[STATUS]);
                if (UtilsFunctions::checkResponse($resp)) {
                    return $resp;
                }
            }
        }
    }

    private function generateClaim($claimType): int
    {
        $query = "INSERT INTO Claim (Descrizione, Conto, Status) VALUES (?, ?, ?)";
        return $this->insertData($query,
            $claimType,
            0.00,
            STATUS_INTACT_DATA
        );
    }

    /**
     * It checks if the user exists, if it does, it returns the user's ID
     *
     * @param $params
     * @return mixed|string|void|null ID of the user if the login is successful, null otherwise.
     */
    public function logIn($params)  {
        if (UtilsFunctions::checkParams($params)) {
            if ($this->checkEmail($params["Email"])) {
                return "L'utente non esiste";
            } else {
                $email = $params[EMAIL];
                $pass = $params[PASSWORD];
                $where = "Email = '$email' AND Password = '$pass'";
                $response = $this->execute("SELECT * FROM `Utente` WHERE $where");
                return UtilsFunctions::checkResponse($response[0][ID]) ? $response[0][ID] : null;
            }
        }
    }

    /**
     * Update a field in a table with a given value
     *
     * @param int $id current user -> $_SESSION["Id"];
     * @param string $tableName table name
     * @param string $fieldName table column name to update
     * @param $toUpdate
     * @return int|array|null
     */
    public function updateData(int $id, string $tableName, string $fieldName, $toUpdate): int|array|null
    {
        $where = "Id = '$id'";
        $res = $this->execute("UPDATE `$tableName` SET $fieldName = $toUpdate WHERE $where");
        return UtilsFunctions::checkResponse($res) ? $res : null;
    }

    /**
     * It takes a query and an array of parameters, checks if the parameters are valid, and if they
     * are, it executes the query and returns the response
     *
     * @param $query
     * @param ...$params
     * @return array|int|string
     */
    public function insertData($query, ...$params): int|array|string
    {
        return $this->execute($query, ...$params);
    }

    /**
     * //TODO: DA FIXARE
     * Check always !== null
     *
     * @param string $tableName
     * @param string $field
     * @param string $where
     * @return int|string|array|null
     */
    public function selectSpecificField(string $tableName, string $field, string $where): int|string|array|null
    {
        $response = $this->execute("SELECT `$field` FROM `$tableName` WHERE $where");
        if (UtilsFunctions::checkExistence($response)) {
            if (is_array($response)) {
                if (!empty($response)) {
                    foreach ($response as $value) {
                        echo "response value: " . $value . '</br>';
                    }
                } else {
                    echo "response is empty. " . '</br>';
                }
            }
        } else {
            echo "response is null" . '</br>';
        }
        return UtilsFunctions::checkResponse($response[0][$field]) ? $response[0][$field] : null;
    }

    /**
     * //TODO: DA FIXARE
     * Check always !== null
     *
     * @param string $tableName
     * @param string $where
     * @return mixed|string|null
     */
    public function getRecord(string $tableName, string $where): mixed
    {
        $response = $this->execute("SELECT * FROM `$tableName` WHERE $where");
        return UtilsFunctions::checkResponse($response[0]) ? $response[0] : null;
    }

    /**
     * Delete record of given table, filtered by where condition
     *
     * @param string $tableName
     * @param string $where
     * @return void
     */
    public function deleteRecord(string $tableName, string $where): void
    {
        $this->execute("DELETE FROM $tableName WHERE $where");
    }
    
    public function getCategories()
    {
        return $this->execute("SELECT * FROM CATEGORIA");
    }

    public function getProductById($id)
    {
        return $this->execute("SELECT * FROM PRODOTTO 
            WHERE `Id` = $id");
    }

 }
