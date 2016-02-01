<?php
/**
 * Created by PhpStorm.
 * User: Bruno
 * Date: 29/01/2016
 * Time: 01:32
 */

namespace CodeOrders\V1\Rest\Users;


use Zend\Stdlib\Hydrator\HydratorInterface;

class UsersMapper extends UsersEntity implements HydratorInterface
{

    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     */
    public function extract($object)
    {
        return [
            'id' => $object->id,
            'username' => $object->username,
            'password' => $object->password,
            'first_name' => $object->first_name,
            'last_name' => $object->last_name,
            'role' => $object->role,
        ];
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return object
     */
    public function hydrate(array $data, $object)
    {
        return [
            $object->id => 'id',
            $object->username => 'username',
            $object->password => 'password',
            $object->first_name => 'first_name',
            $object->last_name => 'last_name',
            $object->role => 'role',
        ];
    }
}