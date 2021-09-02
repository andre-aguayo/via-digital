<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workboard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Referencia os quadros de trabalhos ao usuario
     */
    public function userWorkboardAccess()
    {
        return $this->belongsTo(UserWorkboardAccess::class);
    }

    /**
     * Colunas pertencentes ao quadro de trabalho
     */
    public function columns()
    {
        return $this->hasMany(Column::class);
    }
}
