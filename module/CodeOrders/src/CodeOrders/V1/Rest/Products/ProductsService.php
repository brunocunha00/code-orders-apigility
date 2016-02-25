<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 24/02/2016
 * Time: 00:32
 */

namespace CodeOrders\V1\Rest\Products;


use Zend\Stdlib\Hydrator\ClassMethods;

class ProductsService
{
    /**
     * @var ProductsRepository
     */
    private $productRepository;

    /**
     * ProductService constructor.
     */
    public function __construct(ProductsRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function insert($data)
    {
        return ['product_id' => $this->productRepository->insert($data)];
    }

    public function update($id, $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function findAll()
    {
        return $this->productRepository->findAll();
    }

    public function findById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function findByName($name)
    {
        return $this->productRepository->findByName($name);
    }
}