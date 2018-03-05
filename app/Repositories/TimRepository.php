<?php

namespace App\Repositories;

use App\Models\Tim;
use InfyOm\Generator\Common\BaseRepository;

class TimRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'id_lapang',
        'id_user'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tim::class;
    }
}
