<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Lapangan
 * @package App\Models
 * @version February 22, 2018, 6:49 pm UTC
 */
class Lapangan extends Model
{
    use SoftDeletes;

    public $table = 'lapangans';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama',
        'latitude',
        'longitude'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama' => 'string',
        'alamat' => 'string',
        'latitude' => 'double',
        'longitude' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama' => 'required',
        'alamat' => 'required',
        'latitude' => 'required',
        'longitude' => 'required'
    ];

    public function team()
    {
        return $this->hasMany('App\Models\Team','id_lapang');
    }
    
}
