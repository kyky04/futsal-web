<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pertandingan
 * @package App\Models
 * @version March 9, 2018, 3:21 pm UTC
 */
class Pertandingan extends Model
{
    use SoftDeletes;

    public $table = 'pertandingans';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_team_home',
        'id_team_away',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_team_home' => 'integer',
        'id_team_away' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_team_home' => 'required',
        'id_team_away' => 'required',
        'status' => 'required'
    ];

    public function teamHome()
    {
        return $this->belongsTo(Team::class,'id_team_home');
    }

    public function teamAway()
    {
        return $this->belongsTo(Team::class,'id_team_away');
    }

      public function lapang()
    {
        return $this->teamAway->lapang;
    }

    
}
