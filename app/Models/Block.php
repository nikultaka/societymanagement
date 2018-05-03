<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Block extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'block';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'block',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
