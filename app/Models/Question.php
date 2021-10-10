<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;
use App\Models\Game;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'game_id',
        'question',
        'created_by',
        'updated_by',
    ];
	
	public function game()
    {
        return $this->belongsTo(Game::class,'game_id');
    }
	
	public function answers(){
        return $this->hasMany(Answer::class,'question_id');    
    }
	
}

