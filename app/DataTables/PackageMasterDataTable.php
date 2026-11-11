<?php

namespace App\DataTables;

use App\Models\PackageMaster;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PackageMasterDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'packagemaster.action')
            ->addColumn('package_image',function($query){
                return '<img alt="Image Link" src="'.asset($query->{PackageMaster::PACKAGE_IMAGE}).'" class="img-thumbnail">';
            })->addColumn(PackageMaster::PACKAGE_EXTERNAL_LINK,function($query){
                return '<a alt="External Link" target="_blank" src="'.$query->{PackageMaster::PACKAGE_EXTERNAL_LINK}.'" class="link">Link<a>';
            })->rawColumns(['package_image', 'action',PackageMaster::PACKAGE_EXTERNAL_LINK])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PackageMaster $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('packagemaster-table')
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
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make(PackageMaster::PACKAGE_NAME),
            Column::make(PackageMaster::PACKAGE_IMAGE),
            Column::make(PackageMaster::PACKAGE_TYPE),
            Column::make(PackageMaster::PACKAGE_PRICE),
            Column::make(PackageMaster::PACKAGE_OFFER_PRICE),
            Column::make(PackageMaster::PACKAGE_DURATION_DAYS),
            Column::make(PackageMaster::PACKAGE_DURATION_NIGHTS),
            Column::make(PackageMaster::PACKAGE_EXTERNAL_LINK),
            Column::make(PackageMaster::STATUS),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PackageMaster_' . date('YmdHis');
    }
}
