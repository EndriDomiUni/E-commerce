<?php

class Database
{
    protected $connection;
    protected $queryString;

    // Set up db 
    public function __construct()
    {
        try {
            $this->connection = new mysqli("127.0.0.1", "root", "", "e-commerce", 3306, "utf8");

            if ($this->connection->connect_error) {
                die("Connection failed: " . $this->connection->connect_error);
            }
        } catch (Exception $e) {
            die("Connection failed: " . $e->getMessage());
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
}
