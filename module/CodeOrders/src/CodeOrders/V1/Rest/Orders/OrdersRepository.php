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

    /**
     * @return AbstractTableGateway
     */
    public function getTableGateway()
    {
        return $this->tableGateway;
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

    public function findById($id)
    {
        $hydrator = new ClassMethods();
        $hydrator->addStrategy('items', new OrderItemHydratorStrategy(new ClassMethods()));
        $order = $this->tableGateway->select(['id' => (int) $id])->current();
        $items = $this->orderItemTableGateway->select(['order_id' => (int) $id]);
        foreach ($items as $item) {
            $order->addItem($item);
        }
        $data[] = $hydrator->extract($order);
        return $data;
    }

    public function findByUser($userId)
    {
        $hydrator = new ClassMethods();
        $hydrator->addStrategy('items', new OrderItemHydratorStrategy(new ClassMethods()));
        $orders = $this->tableGateway->select(['user_id' => (int) $userId]);
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

    public function updateStatus($id, $status)
    {
        $this->tableGateway->update(['status' => (int) $status], ['id' => (int)$id]);
        return $this->findById($id);
    }

    public function delete($id)
    {
        $items = $this->orderItemTableGateway->select(['order_id' => (int) $id]);

        foreach ($items as $item) {
            $this->orderItemTableGateway->delete(['id' => $item->getId()]);
        }

        return $this->tableGateway->delete(['id' => (int) $id]);
    }
}