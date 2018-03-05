<?php

namespace App\Repositories;

use App\Models\Jadwal;
use InfyOm\Generator\Common\BaseRepository;

class JadwalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'waktu',
        'hari'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Jadwal::class;
    }
}
