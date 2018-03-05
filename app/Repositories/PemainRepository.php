<?php

namespace App\Repositories;

use App\Models\Pemain;
use InfyOm\Generator\Common\BaseRepository;

class PemainRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama',
        'id_team'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Pemain::class;
    }
}
