<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 25/02/2016
 * Time: 16:52
 */

namespace CodeOrders\V1\Rest\Clients;


use CodeOrders\V1\Rest\Users\UsersRepository;
use CodeOrders\V1\Rest\Users\UsersResource;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class ClientsResource extends AbstractResourceListener
{
    /**
     * @var ClientsService
     */
    private $clientsService;
    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * ClientsResource constructor.
     */
    public function __construct(ClientsService $clientsService, UsersRepository $usersRepository)
    {
        $this->clientsService = $clientsService;
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
        if($this->usersRepository->getAuthenticated()->getRole() != "admin" )
        {
            return new ApiProblem('405', 'The user has not access to this info.');
        }
        return $this->clientsService->insert($data);
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
        return $this->clientsService->findById($id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        return $this->clientsService->findAll();
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
        if($this->usersRepository->getAuthenticated()->getRole() != "admin")
        {
            return new ApiProblem('405', 'The user has not access to this info.');
        }
        return $this->clientsService->update($id, $data);
    }
}