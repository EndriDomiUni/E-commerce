<?php
require_once("database.php");


class DatabaseHelper
{

    protected $database;

    public function __construct()
    {
        $this->database = new Database(SERVER, USERNAME, PASSWORD, DBNAME, PORT, CHARSET);
    }

    // here generic query
}
