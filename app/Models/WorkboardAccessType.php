<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkboardAccessType extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description'
    ];

    /**
     * Referencia o tipo de acesso à varios quasros de trabalho
     */
    public function userWorkboardAccess()
    {
        return $this->hasMany(UserWorkboardAccess::class);
    }
}
