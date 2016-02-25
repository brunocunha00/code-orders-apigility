<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 20/02/2016
 * Time: 19:01
 */

namespace CodeOrders\V1\Rest\Products;


use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Paginator\Adapter\DbTableGateway;

class ProductsRepository
{
    /**
     * @var AbstractTableGateway
     */
    private $tableGateway;


    /**
     * ProductRepository constructor.
     */
    public function __construct(AbstractTableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function findAll()
    {
        return new ProductsCollection(new DbTableGateway($this->tableGateway));
    }

    public function findById($id)
    {
        return $this->tableGateway->select(['id' => (int) $id])->current();
    }

    public function findByName($name)
    {
        return $this->tableGateway->select(['name' => (int) $name]);
    }

    public function insert( $product)
    {
        $this->tableGateway->insert((array) $product);
        return $this->tableGateway->getLastInsertValue();
    }
    public function update($id, $product)
    {
        $this->tableGateway->update((array)$product, ['id' => (int) $id]);
        return $this->findById($id);
    }
}