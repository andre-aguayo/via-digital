<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardFormRequest;
use App\Models\Card;

class CardController extends Controller
{

    public function store(CardFormRequest $card): bool
    {
        return Card::create([
            'description' => $card->description,
            'position' => $card->position,
            'column_id' => $card->column_id
        ]);
    }

    public function edit(CardFormRequest $card): bool
    {
        return Card::where(['id' => $card->id])
            ->update([
                'description' => $card->description,
                'position' => $card->position,
                'column_id' => $card->column_id
            ]);
    }

    public function destroy(CardFormRequest $card): bool
    {
        return Card::destroy($card->id);
    }
}
