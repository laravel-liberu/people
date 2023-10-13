<?php

use Illuminate\Support\Facades\Route;
use LaravelLiberu\People\Http\Controllers\Create;
use LaravelLiberu\People\Http\Controllers\Destroy;
use LaravelLiberu\People\Http\Controllers\Edit;
use LaravelLiberu\People\Http\Controllers\ExportExcel;
use LaravelLiberu\People\Http\Controllers\InitTable;
use LaravelLiberu\People\Http\Controllers\Options;
use LaravelLiberu\People\Http\Controllers\Store;
use LaravelLiberu\People\Http\Controllers\TableData;
use LaravelLiberu\People\Http\Controllers\Update;

Route::middleware(['api', 'auth', 'core'])
    ->prefix('api/administration/people')
    ->as('administration.people.')
    ->group(function () {
        Route::get('create', Create::class)->name('create');
        Route::post('', Store::class)->name('store');
        Route::get('{person}/edit', Edit::class)->name('edit');
        Route::patch('{person}', Update::class)->name('update');
        Route::delete('{person}', Destroy::class)->name('destroy');

        Route::get('initTable', InitTable::class)->name('initTable');
        Route::get('tableData', TableData::class)->name('tableData');
        Route::get('exportExcel', ExportExcel::class)->name('exportExcel');

        Route::get('options', Options::class)->name('options');
    });
