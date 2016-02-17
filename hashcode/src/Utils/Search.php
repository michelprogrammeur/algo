<?php namespace Utils;

use Save\Container;
use Save\Product;

class Search
{

    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function dispoWarehouse(Product $product)
    {
        $prodId = $product->getId();

        $warehouses = $this->container->allProduct();

        $this->container->getProduct($prodId);
    }

}