<?php
namespace Model;

use Classes\Product;

class Furniture extends Product
{
    protected $attribute;

    public function __construct($inputs)
    {
        parent::__construct($inputs);
        $this->attribute = $inputs->height . 'x' . $inputs->width . 'x' . $inputs->length;
    }
}

?>