<?php
namespace CodeOrders\V1\Rest\Orders;

use CodeOrders\V1\Rest\Users\UsersRepository;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class OrdersResource extends AbstractResourceListener
{
    /**
     * @var OrdersRepository
     */
    private $ordersRepository;
    /**
     * @var OrdersService
     */
    private $ordersService;
    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * OrdersResource constructor.
     */
    public function __construct(OrdersRepository $ordersRepository, OrdersService $ordersService, UsersRepository $usersRepository)
    {
        $this->ordersRepository = $ordersRepository;
        $this->ordersService = $ordersService;
        $this->usersRepository = $usersRepository;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        if($this->usersRepository->getAuthenticated()->getRole() != "salesman")
        {
            return new ApiProblem('405', 'The user has not access to this info.');
        }

        try {
            return $this->ordersService->insert($data);
        } catch (\Exception $e) {
            return new ApiProblem('405', 'Error processing order');
        }
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return $this->ordersRepository->findById($id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        if($this->usersRepository->getAuthenticated()->getRole() == "admin")
        {
            return $this->ordersRepository->findAll();
        }

        return $this->ordersRepository->findByUser($this->usersRepository->getAuthenticated()->getId());


    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return $this->ordersRepository->updateStatus($id,$data);
    }
}
