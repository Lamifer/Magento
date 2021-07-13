<?php

namespace ProductName\OverrideName\Model\Catalog;

class Product extends \Magento\Catalog\Model\Product

{
    public function getName()
    {
        return $this->_getData(self::NAME).'+ Override Name';
    }
}
