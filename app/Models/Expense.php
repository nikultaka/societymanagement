<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Expense extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'expenses_list';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'expenses_list',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
