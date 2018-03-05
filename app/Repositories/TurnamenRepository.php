<?php

namespace App\Repositories;

use App\Models\Turnamen;
use InfyOm\Generator\Common\BaseRepository;

class TurnamenRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'waktu',
        'tempat',
        'keterangan'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Turnamen::class;
    }
}
