<?php

namespace App\Repositories;

use App\Models\Lapangan;
use InfyOm\Generator\Common\BaseRepository;

class LapanganRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'latitude',
        'longitude'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Lapangan::class;
    }
}
