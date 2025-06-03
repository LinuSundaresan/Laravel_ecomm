<?php

namespace App\Repositories;

use App\Interfaces\UserAddressRepositoryInterface;

use App\Models\UserAddress;

class UserAddressRepository implements UserAddressRepositoryInterface
{

    public function create(array $data)
    {
        UserAddress::create($data);
    }

    public function getAll(string $userId)
    {
        return UserAddress::where('user_id', $userId)->get();
    }

    public function getById($id)
    {
        return UserAddress::find($id);
    }

    public function update($data , $id)
    {
        return UserAddress::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return UserAddress::findOrFail($id)->delete();
    }
}
