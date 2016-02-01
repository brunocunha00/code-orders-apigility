<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 29/01/2016
 * Time: 01:39
 */

namespace CodeOrders\V1\Rest\Users;


use JsonSchema\Exception\ResourceNotFoundException;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Paginator\Adapter\DbTableGateway;
use ZF\ApiProblem\Exception\InvalidArgumentException;

class UsersRepository
{
    /**
     * @var TableGatewayInterface
     */
    private $tableGateway;


    /**
     * UsersRepository constructor.
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function findAll()
    {
        return new UsersCollection(new DbTableGateway($this->tableGateway));
    }

    public function findById($id)
    {
        return $this->tableGateway->select(['id' => (int)$id])->current();
    }

    public function create($user)
    {
        return $this->tableGateway->insert((array)$user);
    }

    public function delete($id)
    {
        return $this->tableGateway->delete(['id' => (int) $id]);
    }

    public function update($user, $id)
    {
        $this->tableGateway->update((array)$user,['id' =>(int) $id]);
        return  $this->findById($id);
    }
}