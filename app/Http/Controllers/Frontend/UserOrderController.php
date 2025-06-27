<?php

namespace App\Http\Controllers\Frontend;


use App\DataTables\UserOrderDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index(UserOrderDataTable $dataTable)
    {
        return $dataTable->render('frontend.dashboard.order.index');
    }

    public function show(string $id)
    {
        $order = app(OrderRepositoryInterface::class)->getByIdwithUser($id);
        return view('frontend.dashboard.order.show', compact(
            'order'
        ));
    }

}
