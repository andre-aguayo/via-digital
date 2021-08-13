<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'position',
        'column_id',
    ];

    /**
     * Coluna em q o cartao pertence
     */
    public function column()
    {
        return $this->belongsTo(Column::class);
    }
}
