<?php

namespace App\Interfaces;

interface ShippingruleRepositoryInterface
{
    public function create($data);
    public function getActive();
    public function getByid($id);
    public function update($data, $id);
    public function delete($id);
    public function updateStatus($data, $id);
}
