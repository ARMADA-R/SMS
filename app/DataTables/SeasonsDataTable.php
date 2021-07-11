<?php

namespace App\DataTables;

use App\Models\Season;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SeasonsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('Action', 'Admin.seasons.Action')
            ->rawColumns([
                'Action',
            ])
            ->editColumn('created_at', function ($season) {
                return $season->created_at ? with(new Carbon($season->created_at))->format('Y-m-d') : '';
            })
            ->editColumn('start_date', function ($season) {
                return $season->start_date ? with(new Carbon($season->start_date))->format('Y-m-d') : '';
            })
            ->editColumn('end_date', function ($season) {
                return $season->end_date ? with(new Carbon($season->end_date))->format('Y-m-d') : '';
            })
            ->editColumn('updated_at', function ($season) {
                return $season->updated_at ? with(new Carbon($season->updated_at))->format('Y-m-d') : '';
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Season $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Season $model)
    {
        return $model->newQuery();
    }


    public function lang()
    {

        $langJson = [
            "sEmptyTable"     =>  trans('app.datatable.sEmptyTable'),
            "sInfo"           =>  trans('app.datatable.sInfo'),
            "sInfoEmpty"      =>  trans('app.datatable.sInfoEmpty'),
            "sInfoFiltered"   =>  trans('app.datatable.sInfoFiltered'),
            "sInfoPostFix"    =>  trans('app.datatable.sInfoPostFix'),
            "sInfoThousands"  =>  trans('app.datatable.sInfoThousands'),
            "sLengthMenu"     =>  trans('app.datatable.sLengthMenu'),
            "sLoadingRecords" =>  trans('app.datatable.sLoadingRecords'),
            "sProcessing"     =>  trans('app.datatable.sProcessing'),
            "sSearch"         =>  trans('app.datatable.sSearch'),
            "sZeroRecords"    =>  trans('app.datatable.sZeroRecords'),
            "sFirst"          =>  trans('app.datatable.sFirst'),
            "sLast"           =>  trans('app.datatable.sLast'),
            "sNext"           =>  trans('app.datatable.sNext'),
            "sPrevious"       =>  trans('app.datatable.sPrevious'),
            "sSortAscending"  =>  trans('app.datatable.sSortAscending'),
            "sSortDescending" =>  trans('app.datatable.sSortDescending'),
        ];
        return $langJson;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('seasons-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lBfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create')->className('btn-info')->text(' <i class="fas fa-plus-circle"></i> ' . trans('app.datatable.create-season')),
                Button::make('excel')->className('btn-info')->text(' <i class="far fa-file-excel"></i> ' . trans('app.datatable.excel')),
                Button::make('print')->className('btn-info')->text(' <i class="fas fa-print"></i> ' . trans('app.datatable.print')),
                Button::make('reset')->className('btn-info')->text(' <i class="fas fa-redo"></i> ' . trans('app.datatable.reset')),
                Button::make('reload')->className('btn-info')->text(' <i class="fas fa-sync-alt"></i> ' . trans('app.datatable.reload'))
            )->parameters([
                'responsive' => true,
                'autoWidth' => false,
                'lengthMenu' => [[10, 25, 50, 100], ['10', '25', '50', '100']],
                'language' => $this->lang(),
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('#')
                ->addClass('text-center'),

            Column::make('name')->title(trans('app.seasons.name')),
            Column::make('year')->title(trans('app.seasons.year')),
            Column::make('start_date')->title(trans('app.seasons.start-date')),
            Column::make('end_date')->title(trans('app.seasons.end-date')),
            Column::make('created_at')->title(trans('app.created-at')),
            Column::make('updated_at')->title(trans('app.updated-at')),
            Column::computed('Action')
                ->title('Action')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Seasons_' . date('YmdHis');
    }
}
