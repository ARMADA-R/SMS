<?php

namespace App\DataTables;

use App\Models\Roles;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
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
            ->addColumn('Action', 'Admin.roles.Action')
            ->rawColumns([
                'Action',
            ])
            ->editColumn('created_at', function ($role) {
                return $role->created_at ? with(new Carbon($role->created_at))->format('Y-m-d H:i') : '';
            })
            ->editColumn('description', function ($role) {
                return $role->description && strlen($role->description) > 40 ? substr($role->description, 0, 30).'. . .' : $role->description;
            })
            ->editColumn('updated_at', function ($role) {
                return $role->updated_at ? with(new Carbon($role->created_at))->format('Y-m-d H:i') : '';
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Roles $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Roles $model)
    {
        return $model->newQuery();
    }

    public function lang()
    {

        $langJson =[
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
        ->setTableId('roles-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->dom('lBfrtip')
        ->orderBy(1)
        ->buttons(
            Button::make('create')->className('btn-info')->text(' <i class="fas fa-plus-circle"></i> '.trans('app.datatable.create-role')),
            Button::make('excel')->className('btn-info')->text(' <i class="far fa-file-excel"></i> '.trans('app.datatable.excel')),
            Button::make('print')->className('btn-info')->text(' <i class="fas fa-print"></i> '.trans('app.datatable.print')),
            Button::make('reset')->className('btn-info')->text(' <i class="fas fa-redo"></i> '.trans('app.datatable.reset')),
            Button::make('reload')->className('btn-info')->text(' <i class="fas fa-sync-alt"></i> '.trans('app.datatable.reload'))
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

            Column::make('name')->title(trans('app.role.name')),
            Column::make('description')->title(trans('app.role.description')),
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
        return 'Roles_' . date('YmdHis');
    }
}
