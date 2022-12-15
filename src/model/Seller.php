<?php

class Seller
{
    private $SellerHelper;
    private $id;
    private $name;
    private $surname;
    private $businessName;
    private $mail;
    private $password;
    private $pIVA;
    private $status;

    public function __construct($id, $name, $surname, $businessName, $mail, $password, $pIVA, $status)
    {
        $this->SellerHelper = new SellerHelper();
        $res = $this->SellerHelper->getSellerById($id);
        $this->id = $res['Id'];
        $this->name = $res['Nome'];
        $this->surname = $res['Cognome'];
        $this->businessName = $res['Ragione Sociale'];
        $this->mail = $res['Email'];
        $this->password = $res['Password'];
        $this->pIVA = $res['P. IVA'];
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

    public function getBusinessName()
    {
        return $this->businessName;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getpIVA()
    {
        return $this->pIVA;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
