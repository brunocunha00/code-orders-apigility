<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 12/02/2016
 * Time: 16:44
 */

namespace CodeOrders\V1\Rest\Orders;


use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\ObjectProperty;

class OrdersRepository
{
    /**
     * @var AbstractTableGateway
     */
    private $tableGateway;
    /**
     * @var AbstractTableGateway
     */
    private $orderItemTableGateway;


    /**
     * OrdersRepository constructor.
     */
    public function __construct(AbstractTableGateway $tableGateway, AbstractTableGateway $orderItemTableGateway)
    {

        $this->tableGateway = $tableGateway;
        $this->orderItemTableGateway = $orderItemTableGateway;
    }

    public function findAll()
    {
        $hydrator = new ClassMethods();
        $hydrator->addStrategy('items', new OrderItemHydratorStrategy(new ClassMethods()));
        $orders = $this->tableGateway->select();
        foreach ($orders as $order) {
            $items = $this->orderItemTableGateway->select(['order_id' => $order->getId()]);
            foreach ($items as $item) {
                $order->addItem($item);
            }
            $data[] = $hydrator->extract($order);
        }

        $ordersCollection = new OrdersCollection(new ArrayAdapter($data));
        return $ordersCollection;
    }

    public function insert(array $data)
    {
        $this->tableGateway->insert($data);
        $id = $this->tableGateway->getLastInsertValue();
        return $id;
    }

    public function insertItem(array $data)
    {
        $this->orderItemTableGateway->insert($data);
        $id = $this->orderItemTableGateway->getLastInsertValue();
        return $id;
    }


}