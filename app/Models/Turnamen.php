<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Turnamen
 * @package App\Models
 * @version February 23, 2018, 3:42 pm UTC
 */
class Turnamen extends Model
{
    use SoftDeletes;

    public $table = 'turnamens';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'waktu',
        'tempat',
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
        'tempat' => 'string',
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
        'tempat' => 'required',
        'keterangan' => 'required'
    ];

    
}
