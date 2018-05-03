<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Payment extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'payment_list';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_list',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
