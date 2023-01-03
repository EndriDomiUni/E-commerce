<?php

use utility\Utils;

include("./src/classes/Session.php");

class Dbh
{
    protected mysqli $connection;

    public function __construct($dbhost = '127.0.0.1', $dbuser = 'root', $dbpass = '', $dbname = 'e-commerce', $charset = 'utf8')
    {
        try {
            $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
            if ($this->connection->connect_error) {
                echo "Connection failed: " . $this->connection->connect_error;
            }
            $this->connection->set_charset($charset);
        } catch (\Exception $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    private function getType($var): string
    {
        if (is_string($var)) return 's';
        if (is_float($var)) return 'd';
        if (is_int($var)) return 'i';
        return 'b';
    }

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

    public function register($params) {
        if (Utils::checkParams($params)) {
            if (!$this->checkEmail($params["Email"])) {
                return "Esiste già un account con le stesse credenziali";
            } else {
                $query = "INSERT INTO Utente (Nome, Cognome, Email, Password, Status, Claim_id, Indirizzo_id)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
                $res = $this->insertData($query,
                    $params[NOME],
                    $params[COGNOME],
                    $params[EMAIL],
                    $params[PASSWORD],
                    $params[STATUS],
                    $params[CLAIM_ID],
                    $params[INDIRIZZO_ID]);
                return Utils::checkResponse($res) ? $res : null;
            }
        }
    }

    public function logIn($params)  {
        if (Utils::checkParams($params)) {
            if ($this->checkEmail($params["Email"])) {
                return "L'utente non esiste";
            } else {
                $email = $params[EMAIL];
                $pass = $params[PASSWORD];
                $where = "Email = '$email' AND Password = '$pass'";
                $response = $this->execute("SELECT * FROM `Utente` WHERE $where");
                return Utils::checkResponse($response[0][ID]) ? $response[0][ID] : null;
            }
        }
    }
    
    public function updateData($id, $tableName, $fieldName, $toUpdate): bool
    {
        $where = "Id = '$id'";
        $res = $this->execute("UPDATE `$tableName` SET $fieldName = $toUpdate WHERE $where");
        return Utils::checkResponse($res);
    }

    public function insertData($query, ...$params)
    {
        if (Utils::checkParams($params)) {
            $response = $this->execute($query, ...$params);
            return Utils::checkResponse($response) ? $response : null;
        }
    }
 }
