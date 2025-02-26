<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data)
    {
        //dd($data);
       // $user->save();
       User::find(Auth::id())->update($data);
    }
}
