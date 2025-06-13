<?php

namespace App\Repositories;

use App\Models\Coupen;

use App\Interfaces\CoupenRepositoryInterface;

class CoupenRepository implements CoupenRepositoryInterface
{
    public function create($data)
    {
        Coupen::create($data);
    }

    public function getById($id)
    {
        return Coupen::find($id);
    }

    public function getActiveCoupenByCode($code)
    {
        return Coupen::where(['code' => $code , 'status' => 1])->first();
    }

    public function update($data , $id)
    {
        return Coupen::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        Coupen::findOrFail($id)->delete();
    }

    public function updateStatus($data , $id)
    {
        return Coupen::findOrFail($id)->update($data);
    }
}
