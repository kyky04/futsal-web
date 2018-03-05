<?php

namespace App\Repositories;

use App\Models\Kompetisi;
use InfyOm\Generator\Common\BaseRepository;

class KompetisiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'waktu',
        'keterangan'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Kompetisi::class;
    }
}
