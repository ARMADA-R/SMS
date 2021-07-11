<?php

namespace App\DataTables;

use App\Models\Teacher;
use App\Models\Teachers;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TeachersDataTable extends DataTable
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
            ->addColumn('Action', 'Admin.teachers.action')
            ->setRowId(function ($teacher) {
                return 'row_' . $teacher->id;
            })
            ->rawColumns([
                'Action',
            ])
            ->setRowId(function ($teacher) {
                return 'row_' . $teacher->id;
            })
            ->editColumn('created_at', function ($teacher) {
                return $teacher->created_at ? with(new Carbon($teacher->created_at))->format('Y-m-d H:i') : '';
            })
            ->addIndexColumn();;
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
     * @param \App\Models\Teachers $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Teachers $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('teachers-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('lBfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create')->className('btn-info'),
                Button::make('print')->className('btn-info'),
                Button::make('excel')->className('btn-info'),
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
            Column::make('name')->title(trans('app.teachers.name')),
            Column::make('degree')->title(trans('app.teachers.degree')),
            Column::make('created_at')->title(trans('app.created-at')),
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
        return 'Teachers_' . date('YmdHis');
    }
}
