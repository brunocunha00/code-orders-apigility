<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 20/02/2016
 * Time: 19:03
 */

namespace CodeOrders\V1\Rest\Products;


use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class ProductsRepositoryFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $dbAdapter = $serviceLocator->get('DbAdapter');
        $hydrator = new HydratingResultSet(new ClassMethods(), new ProductsEntity());
        $tableGateway = new TableGateway('products', $dbAdapter, null, $hydrator);
        return new ProductsRepository($tableGateway);
    }
}