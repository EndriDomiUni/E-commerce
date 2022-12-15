<?php

class Catalog
{
    private $CatalogHelper;
    private $id;
    private $name;
    private $description;

    public fucntion __construct($id)
    {
        $this->CatalogHelper = new CatalogHelper();
        $res = $this->CatalogHelper->getCatalogById($id);
        $this->id = $id;
        $this->name = res['id'];
        $this->description = res['description'];
    }

    public function getId()
    {
        return $this-id;
    }

    public function getNmae()
    {
        return $this-name;
    }

    public function getDescription()
    {
        return $this-description;
    }
}

?>