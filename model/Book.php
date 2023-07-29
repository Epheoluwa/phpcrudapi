<?php

namespace Model;
use Classes\Product;
class Book extends Product
{

    protected $attribute;

    public function __construct($inputs)
    {
        parent::__construct($inputs);
        $this->attribute = $inputs->weight . "KG";
    }
}

?>