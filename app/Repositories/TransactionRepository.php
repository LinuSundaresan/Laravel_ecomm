<?php

namespace App\Repositories;

use App\Models\Transaction;

use App\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function store($data){
        
        Transaction::create($data);
    }
}
