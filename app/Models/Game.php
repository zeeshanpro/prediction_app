<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sport;
use App\Models\Championship;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Team;
use DB;

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
        'team1id',
        'team2id',
        'start_time',
        'end_time',
        'is_status',
        'is_allocate',
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
	
	public function questions(){
        return $this->hasMany(Question::class,'game_id');    
    }
	
	public function answers(){
        return $this->hasMany(Answer::class,'game_id');    
    }
	
	public function team1(){
        return $this->belongsTo(Team::class,'id');    
    }
	
	public function team2(){
        return $this->belongsTo(Team::class,'id');    
    }
	
}

