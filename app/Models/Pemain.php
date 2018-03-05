<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Pemain
 * @package App\Models
 * @version February 22, 2018, 7:09 pm UTC
 */
class Pemain extends Model
{
    use SoftDeletes;

    public $table = 'pemains';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'id_team'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'id_team' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'required',
        'id_team' => 'required'
    ];

    
}
