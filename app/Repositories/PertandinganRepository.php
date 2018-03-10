<?php

namespace App\Repositories;

use App\Models\Pertandingan;
use InfyOm\Generator\Common\BaseRepository;

class PertandinganRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_team_home',
        'id_team_away',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pertandingan::class;
    }
}
