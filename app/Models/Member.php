<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Member extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'member_list';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_list',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
