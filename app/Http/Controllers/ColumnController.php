<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColumnFormRequest;
use App\Models\Column;

class ColumnController extends Controller
{
    public function store(ColumnFormRequest $column): bool
    {
        return Column::create([
            'name' => $column->name,
            'position' => $column->position,
            'workboard_id' => $column->workboard_id
        ]);
    }

    public function edit(ColumnFormRequest $column): bool
    {
        return Column::where(['id' => $column->id])
            ->update([
                'name' => $column->name,
                'position' => $column->position,
            ]);
    }

    public function destroy(ColumnFormRequest $column): bool
    {
        return Column::destroy($column->id);
    }
}
