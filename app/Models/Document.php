<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Document extends Model
{   
//    public $fillable = ['name','details'];
    
    protected $primaryKey = 'id';
    protected $table = 'document_detail';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_detail',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
