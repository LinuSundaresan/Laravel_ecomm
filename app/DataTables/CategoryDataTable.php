<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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
                $editBtn = "<a href='".route('admin.category.edit' , $query->id)."' class='btn btn-primary' ><i class='fa fa-edit'></i>Edit</a>";
                $deleteBtn = "<a href='".route('admin.category.destroy' , $query->id)."' class='btn btn-danger ml-2 delete-item' ><i class='fa fa-trash'></i>Delete</a>";
                return $editBtn.$deleteBtn;
            })
            ->addColumn('icon' , function($query){
                return "<div><i  class='".$query->icon." fa-xl'></i></div>";
            })
            // ->addColumn('status', function($query){
            //     return $query->status==1 ? '<label class="btn btn-info">Active</label class="btn btn-danger">' :'<label>Inactive</label>';
            // })
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
            ->rawColumns([ 'icon', 'status' ,'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('category-table')
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

            Column::make('id')->width(50),
            Column::make('name')->width(110),
            Column::make('slug')->width(100),
            Column::make('icon')->width(100),
            Column::make('status')->width(20),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}
