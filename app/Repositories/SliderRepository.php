<?php

namespace App\Repositories;

use App\Interfaces\SliderRepositoryInterface;

use App\Models\Slider;

class SliderRepository implements SliderRepositoryInterface
{

    public function create(array $data)
    {
        //dd($data);
        Slider::create($data);
    }
}


