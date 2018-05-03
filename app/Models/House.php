<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class House extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'house_managment';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'house_managment',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
