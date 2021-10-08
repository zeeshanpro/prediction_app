<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sport;
use App\Models\Championship;

class Game extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'sport_id',
        'championship_id',
        'type',
        'team1',
        'team1Logo',
        'team2',
        'team2Logo',
        'start_time',
        'end_time',
        'created_by',
        'updated_by',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class,'sport_id');
    }

    public function championships(){
        return $this->belongsTo(Championship::class,'championship_id');    
    }
}

