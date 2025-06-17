<?php

namespace App\Interfaces;

interface UserAddressRepositoryInterface
{
    public function create(array $data);
    public function getAll(string $userId);
    public function getById($id);
    public function update($data , $id);
    public function delete($id);
}
