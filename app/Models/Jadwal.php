<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Jadwal
 * @package App\Models
 * @version February 22, 2018, 7:08 pm UTC
 */
class Jadwal extends Model
{
    use SoftDeletes;

    public $table = 'jadwals';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'id_team',
        'waktu',
        'hari'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_team' => 'integer',
        'waktu' => 'string',
        'hari' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id_team' => 'required',
        'waktu' => 'required',
        'hari' => 'required'
    ];
     public function team()
    {
        return $this->belongsTo(Team::class, 'id_team')->with('lapang');
    }

    public function children()
{
    return $this->team->lapang;
}
    
}
