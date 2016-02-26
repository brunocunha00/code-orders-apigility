<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 25/02/2016
 * Time: 16:44
 */

namespace CodeOrders\V1\Rest\Clients;


use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Paginator\Adapter\DbTableGateway;

class ClientsRepository
{
    /**
     * @var AbstractTableGateway
     */
    private $tableGateway;

    /**
     * ClientsRepository constructor.
     */
    public function __construct(AbstractTableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }


    public function findAll()
    {
        return new ClientsCollection(new DbTableGateway($this->tableGateway));
    }

    public function findById($id)
    {
        return $this->tableGateway->select(['id' => (int) $id])->current();
    }

    public function findByName($name)
    {
        return $this->tableGateway->select(['name' => (int) $name]);
    }

    public function insert($client)
    {
        $this->tableGateway->insert((array) $client);
        return $this->tableGateway->getLastInsertValue();
    }
    public function update($id, $client)
    {
        $this->tableGateway->update((array)$client, ['id' => (int) $id]);
        return $this->findById($id);
    }

}