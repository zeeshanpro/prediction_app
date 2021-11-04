<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packageshistory extends Model
{
	protected $table = 'packageshistory';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'userid',
        'packageid',
    ];
}
