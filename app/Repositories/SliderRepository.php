<?php

namespace App\Repositories;

use App\Interfaces\SliderRepositoryInterface;

use App\Models\Slider;

class SliderRepository implements SliderRepositoryInterface
{

    public function create(array $data)
    {
        Slider::create($data);
    }

    public function getById($id)
    {
        return Slider::findOrFail($id);
    }

    public function update(array $data , $id)
    {
        $slider = Slider::findOrFail($id)->update($data);
    }
    public function delete($id)
    {
        $slider = Slider::findOrFail($id)->delete();

    }
}


