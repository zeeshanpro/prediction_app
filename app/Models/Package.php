<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'flag',
        'details',
        'duration',
        'price',
        'is_status',
		'created_by',
        'updated_by',
    ];
}
