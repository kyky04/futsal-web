<?php

namespace App\Models;
use App\User;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Team
 * @package App\Models
 * @version February 22, 2018, 6:57 pm UTC
 */
class Team extends Model
{
    use SoftDeletes;

    public $table = 'teams';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'id_lapang',
        'id_user'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'id_lapang' => 'integer',
        'id_user' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'required',
        'id_lapang' => 'required',
        'id_user' => 'required'
    ];

     public function lapang()
    {
        return $this->belongsTo(Lapangan::class, 'id_lapang');
    }

     public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    
}
