<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CoupenDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CoupenRequest;
use App\Http\Requests\CoupenUpdateRequest;
use App\Interfaces\CoupenRepositoryInterface;
use Illuminate\Http\Request;

class CoupenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CoupenDataTable $datatable)
    {
        return $datatable->render('admin.coupen.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CoupenRequest $request)
    {
        $total_used = 0;
        app(CoupenRepositoryInterface::class)->create(array_merge($request->validated(), ['total_used' => $total_used]));
        toastr()->success('Coupen Created Successfully!');
        return redirect()->route('admin.coupens.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupen = app(CoupenRepositoryInterface::class)->getById( $id);
        return view('admin.coupen.edit', compact(
            'coupen'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CoupenUpdateRequest $request, string $id)
    {
        app(CoupenRepositoryInterface::class)->update($request->validated(), $id);
        toastr()->success('Coupen Updated Successfully!');
        return redirect()->route('admin.coupens.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        app(CoupenRepositoryInterface::class)->delete($id);

        return response(["status" => "success" , "message" =>
        "Coupen deleted successfully!"]);
    }

    /*** Update status **/

    public function updateStatus(Request $request)
    {
        $request->status=='false' ? $status = 0 : $status = 1;

         $data = ['status'=> $status];
         app(CoupenRepositoryInterface::class)->updateStatus($data ,$request->id);
         return response(['status' =>'success' , 'message' =>"Status updated successfully"]);
    }
}
