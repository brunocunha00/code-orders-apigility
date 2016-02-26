<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 25/02/2016
 * Time: 16:55
 */

namespace CodeOrders\V1\Rest\Clients;


use Zend\Db\TableGateway\TableGateway;

class ClientsService
{
    /**
     * @var ClientsRepository
     */
    private $clientsRepository;

    /**
     * ClientsService constructor.
     */
    public function __construct(ClientsRepository $clientsRepository)
    {
        $this->clientsRepository = $clientsRepository;
    }

    public function insert($data)
    {
        return ['clients_id' => $this->clientsRepository->insert($data)];
    }

    public function update($id, $data)
    {
        return $this->clientsRepository->update($id, $data);
    }

    public function findAll()
    {
        return $this->clientsRepository->findAll();
    }

    public function findById($id)
    {
        return $this->clientsRepository->findById($id);
    }

    public function findByName($name)
    {
        return $this->clientsRepository->findByName($name);
    }

}