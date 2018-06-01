<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Receipt extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'house_receipts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'house_receipts',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
