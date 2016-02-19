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

        $orderId = $this->ordersRepository->insert($order);

        $items = $data['items'];

        foreach ($items as $item) {
            $item['order_id'] = $orderId;
            $this->ordersRepository->insertItem($item);
        }

        return ['order_id' => $orderId];
    }
}