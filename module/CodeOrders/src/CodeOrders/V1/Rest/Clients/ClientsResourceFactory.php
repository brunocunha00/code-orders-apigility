<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 25/02/2016
 * Time: 17:01
 */

namespace CodeOrders\V1\Rest\Clients;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ClientsResourceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ClientsResource(
            $serviceLocator->get("CodeOrders\\V1\\Rest\\Clients\\ClientsService"),
            $serviceLocator->get("CodeOrders\\V1\\Rest\\Users\\UsersRepository"));
    }
}