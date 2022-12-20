<?php

class Dimension
{

    private $idSeller;
    private string $typeOfDimension; // kg, m, l, ...

    private $dimX;
    private $dimY;
    private $dimZ;

    public function __construct($idSeller, $typeOfDimension, $dimX, $dimY, $dimZ)
    {
    }
}
