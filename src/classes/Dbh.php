<?php

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

    private function validateParams(array $params): bool
    {
        $filtered = array_filter($params, 'strlen');
        return count($filtered) === count($params);
    }


    public function getLastID()
    {
        return $this->connection->insert_id;
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

    public function logIn(array $params): array
    {
        $responseArray = [
            "Status" => ERROR,
            "msg" => ""
        ];
        $check = $this->checkParams($params);
        if ($check['Status'] !== ERROR) {
            $email = $params["Email"];
            $pass = $params["Password"];

            if (!$this->checkEmail($email)) {
                $where = "Email = '$email' AND Password = '$pass'";
                $response = $this->execute("SELECT * FROM `Utente` WHERE $where");
                $this->checkSession($response[0], $email, $pass);
            } else {
                $responseArray["msg"] = "L'utente non esiste";
                return $responseArray;
            }
        }

        $responseArray["Status"] = OK;
        $responseArray["msg"] = OK;
        return $responseArray;
    }


    public function register(array $params): array
    {
        $responseArray = [];
        $claim = $this->getClaimByType($params['claimType']);
        if ($claim) {
            $check = $this->checkParams($params);
            if ($check['Status'] !== ERROR) {
                if (!$this->checkEmail($params['Email'])) {
                    $responseArray['Status'] = ERROR;
                    $responseArray['msg'] = 'Esiste un altro account con la stessa email.';
                    return $responseArray;
                }
                $response = $this->execute(
                    "INSERT INTO Utente (Nome, Cognome, Email, Password, Status, Claim_id, Indirizzo_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)",
                    $params['Nome'],
                    $params['Cognome'],
                    $params['Email'],
                    $params['Password'],
                    STATUS_INTACT_DATA,
                    $claim,
                    ADDRESS_UNSET
                );
                $this->checkSession($response[0], $params['Email'], $params['Password']);
            }
        } else {
            $responseArray['Status'] = ERROR;
            $responseArray['msg'] = 'Claim non trovato';
        }

        return $responseArray;
    }

    private function getClaimByType($typeClaim)
    {
        $claim = $this->execute("SELECT * FROM `Claim` WHERE Valore = ?", $typeClaim);
        return $claim[0]["Id"];
    }

    private function checkSession($response, $email, $pass): void
    {
        if (isset($response["Email"]) && isset($response["Password"])) {
            if ($email === $response["Email"] && $pass === $response["Password"]) {
                $session = new Session($response["Id"]);
                if ($session->checkSessionId($response["Id"])) {
                    //
                }
            }
        }
    }

    public function insertAddressInformation($params): array
    {
        $responseArray = [];
        if ($_SESSION["Id"]) {
            $check = $this->checkParams($params);
            if ($check['Status'] !== ERROR) {
                $response = $this->execute(
                    "INSERT INTO Indirizzo (Via, Numero_civico, Citta, CAP, Status)
            VALUES (?, ?, ?, ?, ?)",
                    $params['Via'],
                    $params['Numero_civico'],
                    $params['Citta'],
                    $params['CAP'],
                    STATUS_INTACT_DATA
                );
                var_dump($response);
                $responseArray['Status'] = OK;
            }
        } else {
            $responseArray['Status'] = ERROR;
            $responseArray['msg'] = 'Claim non trovato';
        }

        return $responseArray;
    }

    private function checkParams(array $params): array
    {
        return $this->validateParams($params) ? [
            'Status' => OK,
            'msg' => OK
        ] : [
            'Status' => ERROR,
            'msg' => 'Inserire tutti i campi'
        ];
    }

}
