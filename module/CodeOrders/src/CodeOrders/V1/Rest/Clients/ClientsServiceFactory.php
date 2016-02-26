<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 25/02/2016
 * Time: 16:57
 */

namespace CodeOrders\V1\Rest\Clients;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ClientsServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ClientsService($serviceLocator->get("CodeOrders\\V1\\Rest\\Clients\\ClientsRepository"));
    }
}