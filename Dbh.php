<?php

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

    public function execute($sql, ...$params)
    {
        $types = "";
        foreach ($params as $par) {
            $types .= $this->getType($par);
        }
        var_dump($sql);

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

    private function validateParams($params): bool
    {
        foreach ($params as $value) {
            if (empty($value)) {
                return false;
            }
        }
        return true;
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
    private function checkEmail($userType, $email): bool
    {
        return count($this->db->execute("SELECT * FROM `?` WHERE Email = ? ", $userType, $email)) == 0;
    }

    public function signIn($userType, $params): array
    {
        $allCorrect = true;
        $response_array = [];

        if (!$this->validateParams($params)) {
            $msg = 'Inserire tutti i campi';
        }

        if ($userType == COSTUMER) {
            if (!$this->checkEmail(COSTUMER, $params['Email'])) {
                $allCorrect = false;
                $msg = 'Esiste un altro account con la stessa email.';
            } else {
                $response = $this->execute(
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
                    $allCorrect = false;
                    $msg = $response;
                }
            }
        }

        if ($userType == SELLER) {
            if (!$this->checkEmail(SELLER, $params['Email'])) {
                $allCorrect = false;
                $msg = 'Esiste un altro account venditore con la stessa email.';
            } else {
                $response = $this->execute(
                    "INSERT INTO venditore (Nome, Cognome, Ragione Sociale, Email, Password, P. IVA, Status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)",
                    $params['Nome'],
                    $params['Cognome'],
                    $params['Ragione Sociale'],
                    $params['Email'],
                    $params['Password'],
                    $params['P. IVA'],
                    ACTIVE
                );
                if (is_int($response)) {
                    $msg = "Iscrizione correttamente effettuata.";
                } else {
                    $allCorrect = false;
                    $msg = $response;
                }
            }
        }

        $response_array["Status"] = $allCorrect ? OK : ERROR;
        $response_array["msg"] = $msg;
        return $response_array;
    }
}
