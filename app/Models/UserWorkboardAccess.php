<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWorkboardAccess extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'workboard_id',
        'workboard_acess_type_id',
    ];

    /**
     * Usuario com acesso ao quadro de trabalho
     */
    public function user()
    {
        return $this->belong(User::class);
    }

    /**
     * Define o quadro de trabalho em questao
     */
    public function workboard()
    {
        return $this->hasOne(Workboard::class);
    }
 
    /**
     * Define o tipo de acesso que o usuario possui ao quadro de trabalho em questao
     */
    public function workboardAccessType()
    {
        return $this->hasOne(WorkboardAccessType::class);
    }
}
