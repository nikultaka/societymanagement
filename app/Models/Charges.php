<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Charges extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'charges_list';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'charges_list',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
