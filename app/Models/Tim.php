<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tim
 * @package App\Models
 * @version February 22, 2018, 6:59 pm UTC
 */
class Tim extends Model
{
    use SoftDeletes;

    public $table = 'tims';
    

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

    
}
