<?php

class Category
{
    private $CategoryHelper;
    private $id;
    private $name;
    private $description;

    public __construct($id)
    {
        $CategoryHelper = new CategoryHelper();
        $res = $this->CategoryHelper->getCategory($id);
        $this->id = $res['id'];
        $this->name = $res['name'];
        $this->description = $res['description'];
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

}

?>