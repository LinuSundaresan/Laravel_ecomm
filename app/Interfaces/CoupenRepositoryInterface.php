<?php

namespace App\Interfaces;

interface CoupenRepositoryInterface
{
    public function create($data);
    public function getById($id);
    public function update($data , $id);
    public function delete($id);
    public function updateStatus($data , $id);
}
