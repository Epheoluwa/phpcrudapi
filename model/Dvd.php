<?php
namespace Model;

use Classes\Product;

class Dvd extends Product
{
    protected $attribute;

    public function __construct($inputs)
    {
        parent::__construct($inputs);
        $this->attribute = $inputs->size . "MB";
    }
}
?>