<?php

namespace App\DataTables;

use App\Models\Coupen;
use App\Models\GeneralSetting;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CoupenDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                $editBtn = "<a href='".route('admin.coupens.edit' , $query->id)."' class='btn btn-primary' ><i class='fa fa-edit'></i></a>";
                $deleteBtn = "<a href='".route('admin.coupens.destroy' , $query->id)."' class='btn btn-danger ml-2 delete-item' ><i class='fa fa-trash'></i></a>";

                return $editBtn.$deleteBtn;
            })
            ->addColumn('discount', function($query){
                $discount_icon = $query->discount_type=='amount'?GeneralSetting::first()->currency_icon : '%';

                return $discount_icon.' '.$query->discount;
            })
            ->addColumn('status', function($query){

                if($query->status==1){
                    $button = '<label class="custom-switch">
                          <input type="checkbox" name="option" value="'.$query->status.'" class="custom-switch-input change-status" data-id="'.$query->id.'" checked >
                          <span class="custom-switch-indicator"></span>
                        </label>';
                } else {
                    $button = '<label class="custom-switch">
                          <input type="checkbox" name="option" value="'.$query->status.'" class="custom-switch-input change-status" data-id="'.$query->id.'">
                          <span class="custom-switch-indicator"></span>
                        </label>';
                }

                return $button;

            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Coupen $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('coupen-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('name'),
            Column::make('code'),
            Column::make('discount_type'),
            Column::make('discount'),
            Column::make('quantity'),
            Column::make('start_date'),
            Column::make('end_date'),
            Column::make('status'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(200)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Coupen_' . date('YmdHis');
    }
}
