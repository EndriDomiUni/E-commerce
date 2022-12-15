<?php

class Custumer
{
    private $CustumerHelper;
    private $id;
    private $name;
    private $surname;
    private $mail;
    private $password;
    private $status;

    public function __construct($id, $name, $surname, $mail, $password, $status)
    {
        $this->CustumerHelper = new CustumerHelper();
        $res = $this->CustumerHelper->getCustumerById($id);
        $this->id = $res['Id'];
        $this->name = $res['Nome'];
        $this->surname = $res['Cognome'];
        $this->mail = $res['Email'];
        $this->password = $res['Password'];
        $this->status = $res['Status'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
