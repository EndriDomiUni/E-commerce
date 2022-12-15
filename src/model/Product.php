<?php

class Product
{
    private $ProductHelper;
    private $id;
    private $name;
    private $description;
    private $price;
    private $status;
    private $Category;
    private $Gallery;

    public function __construct($id)
    {

        $this->ProductHelper = new ProductHelper();
        $res = $this->ProductHelper->getProductId($id)
        $this->id = $res['id'];
        $this->name = $res['name'];
        $this->description = $res['description'];
        $this->price = $res['price'];
        $this->status = $res['status'];
        $this->Category = $res['category'];
        $this->gallery = $res['gallery'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getCategory()
    {
        return $this->Category;
    }

    public function geGallery()
    {
        return $this->Gallery;
    }
}

?>