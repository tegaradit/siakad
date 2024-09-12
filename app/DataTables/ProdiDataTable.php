<?php

namespace App\DataTables;

use App\Models\Prodi;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class ProdiDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))->setRowId('id');
    }

    public function query(Prodi $model): QueryBuilder
    {
        return $model->newQuery()->with(['department', 'educationLevel']);
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('prodi-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('add'),
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    public function getColumns(): array
    {
        // return [
        //     'id' => 'prodi.id',
        //     'kode' => 'prodi.kode',
        //     'nama_prodi' => 'prodi.nama_prodi',
        //     'nm_jur' => 'ruangan_jurusan.nm_jur',
        //     'nm_jenj_didik' => 'education_level.nm_jenj_didik',
        //     'sks_lulus' => 'prodi.sks_lulus',
        //     'status' => 'prodi.status',
        // ];
        // return [
        //     'prodi.id' => 'id',
        //     'prodi.kode' => 'kode',
        //     'prodi.nama_prodi' => 'nama_prodi',
        //     'department.nm_jur' => 'nm_jur',
        //     'educationLevel.nm_jenj_didik' => 'nm_jenj_didik',
        //     'prodi.sks_lulus' => 'sks_lulus',
        //     'prodi.status' => 'status'
        // ];
        return [
            ['data' => 'id', 'name' => 'prodi.id', 'title' => 'id'],
            ['data' => 'kode', 'name' => 'prodi.kode', 'title' => 'kode'],
            ['data' => 'nama_prodi', 'name' => 'prodi.nama_prodi', 'title' => 'nama_prodi'],
            // ['data' => 'nm_jur', 'name' => 'ruangan_jurusan.nm_jur', 'title' => 'nm_jur'],
            // ['data' => 'nm_jenj_didik', 'name' => 'educationLevel.nm_jenj_didik', 'title' => 'nm_jenj_didik'],
            ['data' => 'sks_lulus', 'name' => 'prodi.sks_lulus', 'title' => 'sks_lulus'],
            ['data' => 'status', 'name' => 'prodi.status', 'title' => 'status']
        ];
        // return [
        //     'id',
        //     'kode',
        //     'nama_prodi',
        //     [
        //         'nm_jur' => 'ruangan_jurusan.nm_jur',
        //         'nm_jenj_didik' => 'education_level.nm_jenj_didik',
        //     ],
        //     'sks_lulus',
        //     'status'
        // ];
    }

    protected function filename(): string
    {
        return 'Prodi_' . date('YmdHis');
    }
}