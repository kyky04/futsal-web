<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Kompetisi
 * @package App\Models
 * @version February 22, 2018, 7:40 pm UTC
 */
class Kompetisi extends Model
{
    use SoftDeletes;

    public $table = 'kompetisis';

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'waktu',
        'keterangan'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'waktu' => 'string',
        'keterangan' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [ 
        'nama' => 'required',
        'waktu' => 'required',
        'keterangan' => 'required'
    ];

    
}
