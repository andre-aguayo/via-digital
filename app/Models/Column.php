<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'position',
        'workboard_id'
    ];

    /**
     * Referencia ao quadro de trabalho em q a coluna pertence
     */
    public function workboard()
    {
        return $this->belongsTo(Workboard::class);
    }

    /**
     * cartoes pertencentes à coluna
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
