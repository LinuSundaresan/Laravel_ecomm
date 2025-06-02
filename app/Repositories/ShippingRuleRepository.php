<?php

namespace App\Repositories;

use App\Models\ShippingRule;

use App\Interfaces\ShippingruleRepositoryInterface;

class ShippingRuleRepository implements ShippingruleRepositoryInterface
{
    public function create($data)
    {
        ShippingRule::create($data);
    }

    public function getByid($id)
    {
        return ShippingRule::find($id);
    }

    public function update($data, $id)
    {
        ShippingRule::find($id)->update($data);
    }

    public function delete($id)
    {
        ShippingRule::find($id)->delete();
    }

    public function updateStatus($data, $id)
    {
        ShippingRule::find($id)->update($data);
    }
}
