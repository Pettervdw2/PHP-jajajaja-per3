<?php

class Smartphone
{
    public $id;
    public $vendor;
    public $name;
    public $memory;
    public $color;
    public $price;

    function __construct()
    {
        settype($this->id, 'integer');
    }
}

?>
