<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 18/02/2016
 * Time: 22:08
 */

namespace CodeOrders\V1\Rest\Orders;


use Zend\Stdlib\Hydrator\ObjectProperty;

class OrdersService
{
    /**
     * @var OrdersRepository
     */
    private $ordersRepository;

    /**
     * OrdersService constructor.
     */
    public function __construct(OrdersRepository $ordersRepository)
    {
        $this->ordersRepository = $ordersRepository;
    }

    public function insert($data)
    {
        $hydrator = new ObjectProperty();
        $data = $hydrator->extract($data);
        $order = $data;
        unset($order['items']);
        $items = $data['items'];

        $tableGateway = $this->ordersRepository->getTableGateway();

        try {
            $tableGateway->getAdapter()->getDriver()->getConnection()->beginTransaction();
            $orderId = $this->ordersRepository->insert($order);

            foreach ($items as $item) {
                $item['order_id'] = $orderId;
                $this->ordersRepository->insertItem($item);
            }
            $tableGateway->getAdapter()->getDriver()->getConnection()->commit();
            return ['order_id' => $orderId];

        } catch (\Exception $e) {
            $tableGateway->getAdapter()->getDriver()->getConnection()->rollback();
            throw new \Exception;
        }


    }
}