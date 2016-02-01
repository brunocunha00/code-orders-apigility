<?php
namespace CodeOrders\V1\Rest\Products;

class ProductsResourceFactory
{
    public function __invoke($services)
    {
        return new ProductsResource();
    }
}
