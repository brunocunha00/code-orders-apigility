<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 24/02/2016
 * Time: 00:33
 */

namespace CodeOrders\V1\Rest\Products;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProductsServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ProductsService($serviceLocator->get("CodeOrders\\V1\\Rest\\Products\\ProductsRepository"));
    }
}