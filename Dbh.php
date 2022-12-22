<?php

class Dbh
{
    protected $connection;
    protected $query;

    public function __construct($dbhost = '127.0.0.1', $dbuser = 'root', $dbpass = '', $dbname = 'e-commerce', $charset = 'utf8')
    {
        try {
            $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
            if ($this->connection->connect_error) {
                echo "Connection failed: " . $this->connection->connect_error . "";
            } else {
                echo "Connection successful";
            }
            $this->connection->set_charset($charset);
        } catch (\Exception $e) {
            echo "Connection failed: " . $e->getMessage() . "";
        }
    }

    /**
     * > It returns the first letter of the type of the variable passed to it
     * 
     * @param var The variable you want to bind.
     * 
     * @return string|boolean type of the variable or bool
     */
    private function getType($var)
    {
        if (is_string($var)) return 's';
        if (is_float($var)) return 'd';
        if (is_int($var)) return 'i';
        return 'b';
    }

    /**
     * It executes a query and returns the result
     * 
     * @param sql the SQL query to execute
     * 
     * @return int|string the id of new entry, otherwise msg on failure
     */
    public function execute($sql, ...$params)
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
        return count($this->execute("SELECT * FROM `?` WHERE Email = ? ", $userType, $email)) == 0;
    }

    /**
     * It inserts a new user in the database
     * 
     * @param userType the type of user that is signing in.
     * @param params array of parameters
     */
    public function signin($userType, $params)
    {
        echo "signin called";
        echo "<pre>";
        echo "resp:";
        var_dump($params);
        echo "</pre>";
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
        echo "signin called";
        echo "<pre>";
        echo "resp:";
        var_dump($response_array);
        echo "</pre>";
        return $response_array;
    }
}
