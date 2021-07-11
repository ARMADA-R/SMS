<?php

namespace App\DataTables;

use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->addColumn('Action', 'Admin.users.action')
            ->setRowId(function ($user) {
                return 'row_' . $user->id;
            })
            ->rawColumns([
                'Action',
            ])
            ->setRowId(function ($user) {
                return 'row_' . $user->id;
            })
            ->editColumn('created_at', function ($user) {
                return $user->created_at ? with(new Carbon($user->created_at))->format('Y-m-d H:i') : '';
            })
            ->addIndexColumn();
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
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $users = $model::query()
            ->select([
                'users.id',
                'users.name',
                'users.settings',
                'users.username',
                'users.email',
                'roles.name as role',
                'users.created_at'
            ])
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id');
        return $users;
        // return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lBfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create')->className('btn-info'),
                Button::make('print')->className('btn-info'),
                Button::make('reset')->className('btn-info'),
                Button::make('reload')->className('btn-info')
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
            Column::computed('DT_RowIndex')->title('#')
                ->addClass('text-center'),
            Column::make('name')->title(trans('app.users.name')),
            Column::make('username')->title(trans('app.users.username')),
            Column::make('email')->title(trans('app.users.email')),
            Column::make('role')->title(trans('app.users.role'))
                ->searchable(false),
            Column::make('created_at')->title(trans('app.created-at'))
                ->searchable(false),
            Column::computed('Action')->title('Action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
