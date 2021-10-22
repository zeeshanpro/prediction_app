<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sport;

class Championship extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'sports_id',
        'logo',
        'is_status',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class,'sports_id');
    }
}
